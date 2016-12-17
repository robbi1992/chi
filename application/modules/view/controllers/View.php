<?php defined('BASEPATH') OR exit('No direct script access allowed');

class View extends MY_Controller {

	/*
    | old chart
    private function chart_data($data) {
		$result = array();
		foreach ($data as $i => $val) {
			$count = parsing_float((($val['defectPerform'] / $val['num']) * 0.6) + (($val['defectPerform'] / $val['num']) * 0.4)); 
			$result['rawData'][] = array($count, $i);
			$result['ticks'][] = array($i, $val['iniName']);
		}
		return $result;
	}*/
	
    private function chart_data($data) {
        $result = array();
        $targets = $this->trans_interior_new_model->get_targets();
        foreach ($data as $val) {
            $chart['performances'][] = parsing_float((($val['defectPerform'] / $val['num']) * 0.6) + (($val['defectPerform'] / $val['num']) * 0.4)); 
            $chart['categories'][] = $val['iniName'];
            $chart['targets'][] = $targets[$val['iniID']];
        }
        return $chart;
    }

	public function index($type, $reg) {
		$this->load->model('AircraftReg_model');
		$this->load->model('trans_interior_new_model');
		//get id ac reg
		$data_ac_reg = $this->AircraftReg_model->find($reg, 'name_ac_reg');
        $regID = $data_ac_reg['id'];
        //end get id ac reg
        $params = array('acReg' => $regID);
        $items = $this->trans_interior_new_model->get_transactions($params, TRUE);
		$items_performance = $this->items_performance($items);
		$cabin_performance = $this->cabin_performance($items_performance);
		$chart = $this->chart_data($cabin_performance);
		//print_r($cabin_performance); exit();
		$data['performance'] = $chart;
		$data['items'] = $items_performance;
		//print_r($chart); exit();
		$data['type'] = $type;
		$data['reg'] = array('regName' => $reg, 'regID' => $regID);
		$this->page->view('view_interior', $data);
	}

    public function functionality($type, $reg) {
        $data = $this->func_io($type, $reg);
        //print_r($data); exit();
        $this->page->view('view_functionality', $data);   
    }

	public function exterior($type, $reg) {
		$this->load->model('AircraftReg_model');
		$this->load->model('trans_exterior_model');

        $data_ac_reg = $this->AircraftReg_model->find($reg, 'name_ac_reg');
        $id_ac_reg = $data_ac_reg['id'];
        
        $result = $this->get_exterior_performance($id_ac_reg, TRUE);

        $data['scoring'] = $result['scoring'];
        //print_r($math); exit();
        $data['result'] = $result['result'];
        $data['items'] = distinct_array($data['result'], 'itemId');
        $data['images'] = $this->trans_exterior_model->get_images($id_ac_reg);

        //print_r($result); exit();
        $data['typeac'] = $type;
        $data['typereg'] = $reg;
        $data['idAcReg'] = $id_ac_reg;

        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
        $this->page->view('view_exterior', $data);
	}

    public function aircraft_type() {
        $this->load->model('AircraftType_model');
        $data['list'] = $this->AircraftType_model->list_name();
        
        $this->page->view('view_ac_type', $data);  
    }

    public function performance($type, $reg) {
        $data = $this->performance_io($type, $reg);
        $this->page->view('view_performance', $data);
    }
    //get acreg performance
    public function get_ac_reg() {
        $param = json_decode($this->input->raw_input_stream, TRUE);   
        $data = $this->get_ac_reg_io($param);
        //print_r($data); exit();
        $this->json_output($data);
    }
    // end get acreg performance
}