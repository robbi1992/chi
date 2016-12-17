<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller { 
    
	public function json_output($result) {
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	public function resize_image_thumb($data) {
		$this->load->library('image_lib');
		$this->image_lib->clear();

		$config['image_library'] = 'gd2';
        $config['source_image'] = $data['upload_data']['full_path'];
        $config['new_image'] = $data['upload_data']['file_path'] . 'thumbnails/';
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 80;
        $config['height']       = 80;

        $this->image_lib->initialize($config);

        if ( ! $this->image_lib->resize()) {
        	$result = $this->image_lib->display_errors();
        }
        else {
        	$result = TRUE;
        }
        return $result;
	}

	public function resize_image_max($data) {
		$this->load->library('image_lib');
		$this->image_lib->clear();

		$config['image_library'] = 'gd2';
        $config['source_image'] = $data['upload_data']['full_path'];
        $config['new_image'] = $data['upload_data']['file_path'] . 'src/';
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 666;
        $config['height']       = 418;

        $this->image_lib->initialize($config); 
        

        if ( ! $this->image_lib->resize()) {
        	$result = $this->image_lib->display_errors();
        }
        else {
        	$result = array('status' => 'success');
        }
        return $result;
	}
	
	public function global_performance_area($params) {
        $result['data'] = array();
        $result['defect_perform'] = 0;
        $result['dirty_perform'] = 0;

        foreach($params as $v) {
            $result['data'][] = array('num' => 1);
            $result['defect_perform'] += parsing_float((($v->total_item - $v->total_defect) / $v->total_item) * 100);
            $result['dirty_perform'] += parsing_float((($v->total_item - $v->total_dirty) / $v->total_item) * 100);
        }
        $num = count($result['data']);
        if($num == 0) $num = 1;
        $result['performance']['defect'] = $result['defect_perform'] / $num;
        $result['performance']['dirty'] = $result['dirty_perform'] / $num;
        $result['performance'] = parsing_float(($result['performance']['defect'] * 0.6) + ($result['performance']['dirty'] * 0.4));  
        unset($result['defect_perform']);
        unset($result['dirty_perform']);
        unset($result['performance']['defect']);
        unset($result['performance']['dirty']);
        unset($result['data']);
        return $result;
    }

    public function get_items($regID, $weight = FALSE, $cabin = '') {
        $items = $this->trans_interior_new_model->get_items($regID, $weight, $cabin);
        return $items;
    }

    public function get_exterior_performance($id_ac_reg, $all = FALSE, $week = NULL) {
        $this->load->model('trans_exterior_model');
        $this->load->helper('formula');

        $performance = $this->trans_exterior_model->performance_list($id_ac_reg, $week);
        $sub_item = $this->trans_exterior_model->sub_items_list();
        //print_r($sub_item); exit();
        $result = array();
        foreach ($sub_item as $v) {
            $push_array = TRUE;
            if (count($performance) > 0) {
                foreach ($performance as $vals) {
                    if($vals->exis_id === $v->exis_id) {
                        $result[] = array(
                            'subItemId' => $v->exis_id,
                            'subItemName' => $v->exis_name,
                            'itemId' => $v->exi_id, 
                            'item' => $v->exi_name,
                            'weight' => $v->exi_weight,
                            'value' => $vals->te_value,
                            'persen' => persentase_exterior($vals->te_value),
                            'date' => $vals->te_date,
                            'inspector' => $vals->te_by
                        );
                        $push_array = FALSE;        
                    }
                }
                if($push_array) {
                    $result[] = array(
                        'subItemId' => $v->exis_id,
                        'subItemName' => $v->exis_name,
                        'itemId' => $v->exi_id, 
                        'item' => $v->exi_name,
                        'weight' => $v->exi_weight,
                        'value' => 4,
                        'persen' => persentase_exterior(4),
                        'date' => date('Y-m-d'),
                        'inspector' => 'Bots'
                    );
                }
            }
            else {
                $result[] = array(
                        'subItemId' => $v->exis_id,
                        'subItemName' => $v->exis_name,
                        'itemId' => $v->exi_id, 
                        'item' => $v->exi_name,
                        'weight' => $v->exi_weight,
                        'value' => 4,
                        'persen' => persentase_exterior(4),
                        'date' => date('Y-m-d'),
                        'inspector' => 'Bots'
                    );
            }
        }
    
        $math = array();
        $itemID = 1;
        $temp_val = 0;
        $n = 0;
        $rows = count($result);
        $nAll = 1;
        foreach($result as $v) {
            if($nAll == $rows) {
                $math[] = ($total / $n) * $weight;
            }
            if($v['itemId'] == $itemID) {
                $total = $temp_val + $v['persen'];
                $temp_val = $total;
                $weight = $v['weight'];
                $n++;
            }
            else {
                $math[] = ($total / $n) * $weight;
                $temp_val = 0;
                $n = 1;
                $total = $temp_val + $v['persen'];
                $temp_val = $total;
                $weight = $v['weight'];
            }
            $itemID = $v['itemId'];
            $nAll++;
        }
        if($all) {
            $data['result'] = $result;    
        }
        $data['scoring'] = parsing_float(array_sum($math));

        return $data;
    }

    public function func_linechart($reg) {
        $this->load->model('trans_functionality_model');
        $trans = $this->trans_functionality_model->get_transactions(array('id' => $reg));
        $result = array();
        foreach ($trans as $i => $v) {
            if(isset($result[$v['fi_id']])) {
                $result[$v['fi_id']]['perform'] += (($v['items'] - $v['defects']) / $v['items']) * 100;
                $result[$v['fi_id']]['num']++; 
                //$result['chart'][$v['fi_id']]['real_perform'] = parsing_float($result['chart'][$v['fi_id']]['perform'] / $result['chart'][$v['fi_id']]['num']);
            }
            else {
                $result[$v['fi_id']] = $v;
                $result[$v['fi_id']]['num'] = 1;
                $result[$v['fi_id']]['perform'] = parsing_float((($v['items'] - $v['defects']) / $v['items']) * 100);
            }
        }
        $chart_result = array_values($result);
        return $chart_result;
    }
    public function func_io($type, $reg) {
        $this->load->model('AircraftReg_model');
        $this->load->model('trans_functionality_model');

        $data_ac_reg = $this->AircraftReg_model->find($reg, 'name_ac_reg');

        $trans = $this->trans_functionality_model->get_transactions($data_ac_reg);
        //print_r($trans); exit();
        $result['chart'] = array();
        $result['detail'] = array();
        $chart = array();
        foreach ($trans as $i => $v) {
            $result['detail'][] = array(
                    'itemID' => $v['fi_id'],
                    'itemName' => $v['fi_name'],
                    'subID' => $v['fis_id'],
                    'subName' => $v['fis_name'],
                    'subItems' => $v['items'],
                    'subDefects' => $v['defects'],
                    'subRemark' => $v['remark'],
                    'perform' => parsing_float((($v['items'] - $v['defects']) / $v['items']) * 100)
                );

            if(isset($result['chart'][$v['fi_id']])) {
                $result['chart'][$v['fi_id']]['perform'] += (($v['items'] - $v['defects']) / $v['items']) * 100;
                $result['chart'][$v['fi_id']]['num']++; 
                //$result['chart'][$v['fi_id']]['real_perform'] = parsing_float($result['chart'][$v['fi_id']]['perform'] / $result['chart'][$v['fi_id']]['num']);
            }
            else {
                $result['chart'][$v['fi_id']] = $v;
                $result['chart'][$v['fi_id']]['num'] = 1;
                $result['chart'][$v['fi_id']]['perform'] = parsing_float((($v['items'] - $v['defects']) / $v['items']) * 100);
            }   
        }
        $chart_result = array_values($result['chart']);
        /*
        | Old Chart
        */
        //print_r($chart); exit();
        /*foreach ($chart_result as $i => $v) {
            $count = parsing_float($v['perform'] / $v['num']); 
            $chart['rawData'][] = array($count, $i);
            $chart['ticks'][] = array($i, $v['fi_name']);
        }
        */
        $targets = $this->trans_functionality_model->get_targets();
        //print_r($targets); exit();
        foreach ($chart_result as $v) {
            $chart['performances'][] = parsing_float($v['perform'] / $v['num']);
            $chart['categories'][] = $v['fi_name'];
            $chart['targets'][] = $targets[$v['fi_id']];
        }
        $data['performance'] = $chart;
        $data['detail'] = $result['detail'];
        //print_r($data['detail']); exit();
        $data['type'] = $type;
        $data['reg'] = array('regName' => $reg, 'regID' => $data_ac_reg['id']);

        return $data;
    }

    public function performance_io($type, $reg) {
        $this->load->model('AircraftReg_model');
        $this->load->model('trans_interior_new_model');
        $this->load->model('trans_functionality_model');
        $this->load->helper('formula_helper');
        //get id ac reg
        $data_ac_reg = $this->AircraftReg_model->find($reg, 'name_ac_reg');
        $regID = $data_ac_reg['id'];
        $items = $this->get_items($regID);
        //functionality
        $trans_func = $this->trans_functionality_model->get_transactions($data_ac_reg);
        $perform_per_reg = 0;
        foreach ($trans_func as $i => $v) {
            $perform_per_reg += (($v['items'] - $v['defects']) / $v['items']) * 100;
        }
        //echo($perform_per_reg); exit();
        //generate interior cabin performance
        $params['acReg'] = $regID;
        $int['sum'] = 0;
        $int['num'] = 0;

        if(count($items) > 0) {
            foreach ($items as $val) {
                $params['cabinArea'] = $val->ini_id;
                $res = $this->trans_interior_new_model->get_transactions($params);
                $cabin = $this->global_performance_area($res);
                $weight = $this->get_items($params['acReg'], TRUE, $params['cabinArea']);
                $countIT = ($cabin['performance'] * $weight[0]->weight);
                $int['sum'] += $countIT;
                $int['num'] += $weight[0]->weight;
            }
            $data['int'] = parsing_float($int['sum'] / $int['num']);
        }
        else {
            $data['int'] = 100;
        }
        $ext = $this->get_exterior_performance($regID);
        if($perform_per_reg > 0) {
            $data['func'] = parsing_float($perform_per_reg / count($trans_func));
        }
        else {
            $data['func'] = 100;   
        }
        //print_r($data['func']); exit();
        $data['ext'] = $ext['scoring'];
        //$data['func'] = 
        //print_r($data); exit();
        $data['typeac'] = $type;
        $data['typereg'] = $reg;

        return $data;
    }

    public function get_ac_reg_io($param) {
        $this->load->model('AircraftReg_model');
        $this->load->model('trans_interior_new_model');
        $this->load->model('trans_functionality_model');
     
        //$param['param'] = array('acType' => '1', 'acTypeName' => 'CRJ1000');
        $data = $this->AircraftReg_model->list_by($param['param']);
        //print_r($this->get_items(120)); exit();
        foreach ($data['result'] as $value) {
            $items = $this->get_items($value['id']);
            //functionality
            $trans_func = $this->trans_functionality_model->get_transactions(array('id' => $value['id']));
            //return $trans_func;
            if(count($trans_func)) {
                $perform_per_reg = 0;
                foreach ($trans_func as $i => $v) {
                    $perform_per_reg += (($v['items'] - $v['defects']) / $v['items']) * 100;
                }
                $result['func'] = $perform_per_reg / count($trans_func);   
            }
            else {
                $result['func'] = 100;
            }
            //end functionality
            $params['acReg'] = $value['id'];
            $int['sum'] = 0;
            $int['num'] = 0;
            //print_r($items); exit();
            if(count($items) > 0) {
                foreach ($items as $val) {
                    $params['cabinArea'] = $val->ini_id;
                    $res = $this->trans_interior_new_model->get_transactions($params);
                    $cabin = $this->global_performance_area($res);
                    $weight = $this->get_items($params['acReg'], TRUE, $params['cabinArea']);
                    $countIT = ($cabin['performance'] * $weight[0]->weight);
                    $int['sum'] += $countIT;
                    $int['num'] += $weight[0]->weight;
                }
                $result['int'] = parsing_float($int['sum'] / $int['num']);
            }
            else {
                $result['int'] = 100;   
            }
            $ext = $this->get_exterior_performance($value['id']);
            $result['ext'] = $ext['scoring']; 

            $performances[] = array(
                'id' => $value['id'],
                'name_ac_reg' => $value['name_ac_reg'],
                'performance' => parsing_float(($result['ext'] + $result['int'] + $result['func']) / 3)
            );       
        }
        $data['result'] = array();
        $data['result'] = $performances;
        return $data;
    }

    public function items_performance($data) {
        $result = array();
        foreach($data as $v) {
            $result[] = array(
                'inisID' => $v->inis_id,
                'inisName' => $v->inis_name,
                'iniID' => $v->ini_id,
                'iniName' => $v->ini_name,
                'total' => $v->total_item,
                'defect' => $v->total_defect,
                'dirty' => $v->total_dirty,
                'defectPerform' => parsing_float((($v->total_item - $v->total_defect) / $v->total_item) * 100),
                'dirtyPerform' => parsing_float((($v->total_item - $v->total_dirty) / $v->total_item) * 100),
                'remark' => $v->remark,
                'num' => 1
            );
        }
        return $result;
    }

    public function cabin_performance($data) {
        $result = array();
        foreach ($data as $key => $val) {
            if(isset($result[$val['iniID']])) {
                $result[$val['iniID']]['defectPerform'] += $val['defectPerform'];
                $result[$val['iniID']]['dirtyPerform'] += $val['dirtyPerform'];
                $result[$val['iniID']]['num'] += $val['num'];
            }
            else {
                $result[$val['iniID']] = $val;
            }
        }
        return array_values($result);
    }
}