
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class health_input extends MX_Controller {
    
    private function get_exterior_performance($id_ac_reg, $all = FALSE) {
        $this->load->model('trans_exterior_model');
        $this->load->helper('formula');

        $performance = $this->trans_exterior_model->performance_list($id_ac_reg);
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
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->page->use_directory();
    }

    public function index() {
        $this->load->model('AircraftType_model');
        $data['list'] = $this->AircraftType_model->list_name();
        //print_r($list); exit();
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
        $this->page->view('health_input', $data);
    }

    public function cabin($typeac,$typereg) {
        $this->load->model('trans_interior_model');
        $this->load->model('AircraftReg_model');
        //find template from cabin
        $data_ac_reg = $this->AircraftReg_model->find($typereg, 'name_ac_reg');
        $id_ac_reg = $data_ac_reg['id'];

        $interior_performance_values = $this->trans_interior_model->list_performance('', $id_ac_reg);
        $n = count($interior_performance_values);
        $zero = 0;
        if(count($interior_performance_values) > 0) {
            foreach ($interior_performance_values as $i => $v) {
                $total = $zero + $v['value'];
                $zero = $total;
            }
            $data['interior_value'] = parsing_float($total /$n);
        }
        else {
            $data['interior_value'] = 100;   
        }
        $data['exterior_performance'] = $this->get_exterior_performance($id_ac_reg);
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
        $this->page->view('kpi_cabin', $data);
    }

    public function get_ac_reg() {
        $this->load->model('AircraftReg_model');
        $this->load->model('trans_interior_model');

        $param = json_decode($this->input->raw_input_stream, TRUE);     
        //$param['param'] = array('acType' => '1', 'acTypeName' => 'CRJ1000');
        $data = $this->AircraftReg_model->list_by($param['param']);
        
        foreach ($data['result'] as $key => $value) {
            $scoring = $this->get_exterior_performance($value['id']);
            
            $result[$key] = $value['id'];
            $exterior[] = array(
                    'acReg' => $value['id'],
                    'value' => $scoring['scoring']
                ); 
        }
        //print_r($exterior); exit();
        // get interior value, filter by aircraft type
        $interior_value = $this->trans_interior_model->list_performance_acType($result);
        // create new value for support formula
        $new_interior_value = formula_by_acReg($interior_value);
        //print_r($new_interior_value); exit();
        //create new return (add index performance value)
        foreach ($data['result'] as $key => $value) {
            $print = TRUE;
            foreach ($new_interior_value as $i => $v) {
                if($value['id'] == $v['acReg']) {
                    $performance_result[] = array(
                        'id' => $value['id'],
                        'name_ac_reg' => $value['name_ac_reg'],
                        'performance_interior' => parsing_float($v['value'] / $v['num'])
                    );
                    $print = FALSE;
                }
            }
            if($print) {
                $performance_result[] = array(
                    'id' => $value['id'],
                    'name_ac_reg' => $value['name_ac_reg'],
                    'performance_interior' => 100
                );
            }
        }
        foreach ($performance_result as $key => $value) {
            if($value['id'] === $exterior[$key]['acReg']) {
                $performances[] = array(
                        'id' => $value['id'],
                        'name_ac_reg' => $value['name_ac_reg'],
                        'performance_interior' => $value['performance_interior'],
                        'performance_exterior' => floatval($exterior[$key]['value'])
                    );
            }
        }
        //print_r($performances); exit();
        //print_r($performance_result); exit();
        $data['result'] = $performances;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function functionality($typeac,$typereg) {
        
        //die($typereg);
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
        $this->page->view('kpi_cabin', $data);
        
    }
    
    public function interior($typeac,$typereg, $cabin_item='') {
        //redirect(site_url('mobile/input/interior/' . $typeac . '/' . $typereg));
        //exit();
        $this->load->library('user_agent');
        if($this->agent->is_mobile()) {
            redirect(site_url('mobile/input/interior/' . $typeac . '/' . $typereg));
            exit();
        }
        $this->load->model('AircraftReg_model');
        $this->load->model('AircraftTemplateH_model');
        $this->load->model('AircraftTemplateD_model');
        $this->load->model('CabinItems_model');
        $this->load->model('FaultCodeItems_model');
        $this->load->model('FaultTypes_model');
        $this->load->model('FaultCodeItemsDetail_model');
        $this->load->model('trans_interior_model');

        //find template from cabin
        $data_ac_reg = $this->AircraftReg_model->find($typereg, 'name_ac_reg');
        $id_ac_reg = $data_ac_reg['id'];

        if (empty($cabin_item)) {
            $cabin_selected = $this->CabinItems_model->set_default();
        }
        else {
            $cabin_selected = $cabin_item;
        }
        //echo $id_ac_reg . $cabin_selected; exit();
        $data['cabin_template'] = $this->AircraftTemplateH_model->get_data_by($id_ac_reg, $cabin_selected);
        $data['cabin_selected'] = $this->CabinItems_model->find($cabin_selected, 'id');
        
        //performance things
        $data['item_performance'] = $this->FaultCodeItemsDetail_model->list_performance($cabin_selected);

        $data['value_performance'] = $this->trans_interior_model->list_performance($cabin_selected, $id_ac_reg);
        $data['all_value_performance'] = $this->trans_interior_model->list_performance('', $id_ac_reg);

        //only for mode input
        $data['fault_by_performance'] = $this->FaultCodeItems_model->get_data_by($cabin_selected);
        $data['fault_types'] = $this->FaultTypes_model->get_all();
        //end
        //print_r($data['fault_by_performance']); exit();
        if (count($data['cabin_template']) > 0) {
            $data['cabin_template_detail'] = $this->AircraftTemplateD_model->get_data_by($data['cabin_template'][0]->id);    
        }
        else $data['cabin_template_detail'] = array();
        //print_r($data['cabin_template_detail']); exit();
        //
        $data['cabins'] = $this->CabinItems_model->get_all();
        //print_r($data); exit();
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
        $this->page->view('interior_view', $data);
    }
    
    public function exterior($typeac,$typereg) {
        $this->load->model('AircraftReg_model');

        $data_ac_reg = $this->AircraftReg_model->find($typereg, 'name_ac_reg');
        $id_ac_reg = $data_ac_reg['id'];
        
        $result = $this->get_exterior_performance($id_ac_reg, TRUE);

        $data['scoring'] = $result['scoring'];
        //print_r($math); exit();
        $data['result'] = $result['result'];
        //die($typereg);
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['idAcReg'] = $id_ac_reg;

        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
        $this->page->view('exterior_view', $data);
    }

    //methods for ajax request
    public function updateExteriorValue() {
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
    
    public function get_fault_code_detail() {
        $this->load->model('FaultCodeItemsDetail_model');
        $param = json_decode($this->input->raw_input_stream, TRUE);
        
        $result = $this->FaultCodeItemsDetail_model->get_data_by($param['param']);
        //print_r($result); exit();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function interior_save() {
        $this->load->model('trans_interior_model');
        $params = json_decode($this->input->raw_input_stream, TRUE);
        $save = $this->trans_interior_model->performance_value($params);

        $result = array('code' => 500);
        if($save) {
            $result = array('code' => 200);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
    //end ajax request
}