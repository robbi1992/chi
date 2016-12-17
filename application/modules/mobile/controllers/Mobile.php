
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends MY_Controller {
	
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
		$this->load->model('AircraftReg_model');
		$this->load->model('trans_interior_new_model');
		//get id ac reg
		$data_ac_reg = $this->AircraftReg_model->find($reg, 'name_ac_reg');
        $regID = $data_ac_reg['id'];
        //end get id ac reg

        //get items
        $data['items'] = $this->get_items($regID);
        //print_r($items); exit();
        //end get items
		$data['title'] = 'Input interior ' . $type . ' : ' . $reg;
		$data['type'] = $type;
		$data['reg'] = array('regName' => $reg, 'regID' => $regID);
		$this->load->view('input_interior', $data);
	}

	public function get_sub_items() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$this->load->model('trans_interior_new_model');
		$result = $this->trans_interior_new_model->get_transactions($params);
		
		$formula['result'] = $this->performance_area($result);
		$formula['result']['weight'] = $this->get_items($params['acReg'], TRUE, $params['cabinArea']);

		$this->json_output($formula);
	}

	public function update_interior() {
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
}