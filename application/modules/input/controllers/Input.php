<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends MY_Controller {
    
    //index as input interior in mobile view
    private function performance_area($params) {
        $result['data'] = array();
        $result['defect_perform'] = 0;
        $result['dirty_perform'] = 0;

        foreach($params as $v) {
            $result['data'][] = array(
                'inisID' => $v->inis_id,
                'inisName' => $v->inis_name,
                'iniID' => $v->ini_id,
                'total' => $v->total_item,
                'defect' => $v->total_defect,
                'dirty' => $v->total_dirty,
                'defectPerform' => parsing_float((($v->total_item - $v->total_defect) / $v->total_item) * 100),
                'dirtyPerform' => parsing_float((($v->total_item - $v->total_dirty) / $v->total_item) * 100),
                'remark' => $v->remark
            );
            $result['defect_perform'] += parsing_float((($v->total_item - $v->total_defect) / $v->total_item) * 100);
            $result['dirty_perform'] += parsing_float((($v->total_item - $v->total_dirty) / $v->total_item) * 100);
        }
        $num = count($result['data']);
        $result['performance']['defect'] = $result['defect_perform'] / $num;
        $result['performance']['dirty'] = $result['dirty_perform'] / $num;
        $result['performance']['cabin'] = parsing_float(($result['performance']['defect'] * 0.6) + ($result['performance']['dirty'] * 0.4));  
        unset($result['defect_perform']);
        unset($result['dirty_perform']);
        return $result;
    }

    public function index($type, $reg) {
        $this->load->library('user_agent');
        if($this->agent->is_mobile()) {
            redirect(site_url('mobile/input/interior/' . $type . '/' . $reg));
            exit();
        }
        $this->load->model('AircraftReg_model');
        $this->load->model('trans_interior_new_model');
        //get id ac reg
        $data_ac_reg = $this->AircraftReg_model->find($reg, 'name_ac_reg');
        $regID = $data_ac_reg['id'];
        //echo $regID; exit();
        //end get id ac reg
        //get items
        $data['items'] = $this->get_items($regID);
        //print_r($data); exit();
        //echo $data['items'][0]->ini_id; exit();
        $data['type'] = $type;
        $data['reg'] = array('regName' => $reg, 'regID' => $regID);
        $this->page->view('input_interior', $data);
    }

    public function exterior($type, $reg) {
        $this->load->model('AircraftReg_model');
        $this->load->helper('formula_helper');
        $this->load->model('trans_exterior_model');

        $data_ac_reg = $this->AircraftReg_model->find($reg, 'name_ac_reg');
        $id_ac_reg = $data_ac_reg['id'];
        $result = $this->get_exterior_performance($id_ac_reg, TRUE);

        $data['scoring'] = $result['scoring'];
        //print_r($math); exit();
        $data['result'] = $result['result'];
        $data['items'] = distinct_array($data['result'], 'itemId');
        $data['images'] = $this->trans_exterior_model->get_images($id_ac_reg);
        //print_r($data['images']); exit();
        $data['typeac'] = $type;
        $data['typereg'] = $reg;
        $data['idAcReg'] = $id_ac_reg;

        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
        $this->page->view('input_exterior', $data);
    }

    public function functionality($type, $reg) {
        $data = $this->func_io($type, $reg);
        //print_r($data); exit();
        $this->page->view('input_functionality', $data);   
    }

    public function input_ca() {
        $params = json_decode($this->input->raw_input_stream, TRUE);

        $this->load->model('trans_functionality_model');
        $update = $this->trans_functionality_model->update_ca($params);

        $this->json_output($update);
    }
    //methods for ajax request
    public function upload_image() {
        $params['area'] = $this->input->post('extArea');
        $params['acReg'] = $this->input->post('extReg');
        $params['extImg'] = $this->input->post('extImg');

        $error = array();

        $imageName = 'exteriors_' . $params['acReg'] . '_' . $params['area'];
        //clear images
        $srcPath = './assets/images/exteriors/src/' . $imageName;
        $thumbPath = './assets/images/exteriors/thumbnails/' . $imageName;
        
        if(file_exists($srcPath)) {
            chmod($srcPath, 0644);
            unlink($srcPath);
        }

        if(file_exists($thumbPath)) {
            chmod($thumbPath, 0644);
            unlink($thumbPath);
        }

        $config['upload_path']          = './assets/images/exteriors/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = '2000000';
        $config['file_name']            =  $imageName;

        //echo $config['upload_path']; exit();
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('extImg')) {
            $error = array('error' => $this->upload->display_errors());
        }
        else {
            $data = array('upload_data' => $this->upload->data());
            $src = $this->resize_image_max($data);
            if($src) {
                $thumb = $this->resize_image_thumb($data);
                if ($thumb) {
                    $this->load->model('trans_exterior_model');
                    $isInsert = $this->trans_exterior_model->is_image_exist(
                        array(
                            'url' => $data['upload_data']['file_name'],
                            'acReg' => $params['acReg'],
                            'exiID' => $params['area']
                            )
                    );
                    if($isInsert) {
                        chmod($data['upload_data']['full_path'], 0644);
                        unlink($data['upload_data']['full_path']);
                    }
                    else {
                        $error = array('error' => 'Any some errors, please try again later');
                    }

                }
                else {
                    $error = $thumb;
                }    
            }
            else {
                $error = $src;
            }

            if(count($error) > 0) {
                $result = $error;
            }
            else {
                $result = $data;
                $result['area'] = $params['area'];
            }
            $this->json_output($result);
            //print_r($data);
        }

        //$this->json_output($params);
    }
    public function updateExteriorValue() {
        $this->load->helper('formula');
        $this->load->model('trans_exterior_model');

        $params = json_decode($this->input->raw_input_stream, TRUE);
        $result = $this->trans_exterior_model->toDo($params);
        $scoring = $this->get_exterior_performance($params['acReg']);

        if($result) {
            $msg = array('status' => 200, 'score' => $scoring['scoring']);
        }
        else {
            $msg = array('status' => 500);   
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($msg));
        
    }
    
    public function get_sub_items() {
        $params = json_decode($this->input->raw_input_stream, TRUE);
        $this->load->model('trans_interior_new_model');

        $result = $this->trans_interior_new_model->get_transactions($params);
        //print_r($result); exit();
        $formula['result'] = $this->performance_area($result);
        $formula['result']['weight'] = $this->get_items($params['acReg'], TRUE, $params['cabinArea']);

        $this->json_output($formula);
    }

    public function update_interior() {
        $this->load->helper('formula');
        $this->load->model('trans_interior_new_model');
        $params = json_decode($this->input->raw_input_stream, TRUE);

        $result = $this->trans_interior_new_model->update_transactions($params);
        $formula = array();
        if ($result) {
            $params = array(
                    'acReg' => $params['acRID'],
                    'cabinArea' => $params['iniID']
                );
            $res = $this->trans_interior_new_model->get_transactions($params);
            $formula['result'] = $this->performance_area($res);
            $formula['result']['weight'] = $this->get_items($params['acReg'], TRUE, $params['cabinArea']);
        }
        $this->json_output($formula);
    }

    /*
    Stupid script
    */
    public function aircraft_type() {
        $this->load->model('AircraftType_model');
        $data['list'] = $this->AircraftType_model->list_name();
        
        $this->page->view('input_ac_type', $data);  
    }

    public function get_ac_reg() {
        $param = json_decode($this->input->raw_input_stream, TRUE);   
        $data = $this->get_ac_reg_io($param);
        //print_r($data); exit();
        $this->json_output($data);
    }

    public function performance($type, $reg) {
        $data = $this->performance_io($type, $reg);
        $this->page->view('input_performance', $data);
    }
}