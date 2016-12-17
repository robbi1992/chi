<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Root extends MY_Controller {
	public function index() {
		$data['add'] = site_url('/root/interior_add');
		$this->page->view('interior_list', $data);
	}

	public function functionality() {
		$data['add'] = site_url('/root/functionality_add');
		$this->page->view('func_list', $data);
	}

	public function functionality_add() {
		$this->load->model('trans_functionality_model');
		$this->load->model('AircraftType_model');
		$this->load->model('AircraftReg_model');

		$data['acType']  = $this->AircraftType_model->all();
        $data['acReg']  = $this->AircraftReg_model->all();
		$data['items'] = $this->trans_functionality_model->get_func_items();
		$data['items_sub'] = $this->trans_functionality_model->get_func_items_sub();

		$this->page->view('func_input', $data);
	}

	public function interior_add() {
		$this->load->model('trans_interior_new_model');
		$this->load->model('AircraftType_model');
		$this->load->model('AircraftReg_model');
		
		$data['acType']  = $this->AircraftType_model->all();
        $data['acReg']  = $this->AircraftReg_model->all();
		$data['items'] = $this->trans_interior_new_model->get_interior_items();
		$data['items_sub'] = $this->trans_interior_new_model->get_interior_items_sub();
		//print_r($data); exit();
		$this->page->view('interior_add', $data);
	}

	public function update_int($param = '') {
		$this->load->model('trans_interior_new_model');

		if ($this->input->is_ajax_request()) {
			$params = json_decode($this->input->raw_input_stream, TRUE);

			$this->trans_interior_new_model->insert_weight($params, TRUE);
			$this->trans_interior_new_model->insert_trans($params, TRUE);
			$result = array('status' => 'success');
		//print_r($result); exit();
			$this->json_output($result);
		}
		else {
			$data['items'] = $this->trans_interior_new_model->get_interior_items();
			$data['items_sub'] = $this->trans_interior_new_model->get_interior_items_sub();
			$data['trans'] = $this->trans_interior_new_model->get_custom_trans($param);
			$data['items_weight'] = $this->trans_interior_new_model->get_trans_weight($param);
			$data['name'] = $this->trans_interior_new_model->get_name($param);
		//print_r($data['trans']); exit();
			$this->page->view('interior_update', $data);
		}
	}

	public function update_func($param = '') {
		$this->load->model('trans_functionality_model');

		if ($this->input->is_ajax_request()) {
			$params = json_decode($this->input->raw_input_stream, TRUE);
			$this->trans_functionality_model->insert_trans($params, TRUE);
			$result = array('status' => 'success');
			$this->json_output($result);
		}
		else {
			$data['items'] = $this->trans_functionality_model->get_func_items();
			$data['items_sub'] = $this->trans_functionality_model->get_func_items_sub();
			$data['trans'] = $this->trans_functionality_model->get_custom_trans($param);
			$data['trans_items'] = $this->trans_functionality_model->get_trans_items($param);
			$data['name'] = $this->trans_functionality_model->get_name($param);
			//print_r($data['trans_items']); exit();
			$this->page->view('func_update', $data);
		}
	}

	public function int_data_table() {
		
		$this->load->model('trans_interior_new_model');
		$list = $this->trans_interior_new_model->list_data_table();
		//print_r($list); exit();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $grid) {
			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $grid->name_ac_reg;

			$row[] = '<div style="width:100%;text-align:center;">
                        <a class="btn btn-xs btn-flat btn-info" href="'.site_url('/root/update_int/'.$grid->acr_id).'" title="Update Data">Update</a> &nbsp;
                    </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->trans_interior_new_model->num_rows(),
			"recordsFiltered" 	=> $this->trans_interior_new_model->num_rows(),
			"data" 				=> $data
		);
		//output to json format
		echo json_encode($output);
	}

	public function func_data_table() {
		
		$this->load->model('trans_functionality_model');
		$list = $this->trans_functionality_model->list_data_table();
		//print_r($list); exit();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $grid) {
			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $grid->name_ac_reg;

			$row[] = '<div style="width:100%;text-align:center;">
                        <a class="btn btn-xs btn-flat btn-info" href="'.site_url('/root/update_func/'.$grid->acr_id).'" title="Update Data">Update</a> &nbsp;
                    </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->trans_functionality_model->num_rows(),
			"recordsFiltered" 	=> $this->trans_functionality_model->num_rows(),
			"data" 				=> $data
		);
		//output to json format
		echo json_encode($output);
	}

	public function save_interior() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$this->load->model('trans_interior_new_model');

		$this->trans_interior_new_model->insert_weight($params);
		$this->trans_interior_new_model->insert_trans($params);
		$result = array('status' => 'success');
		//print_r($result); exit();
		$this->json_output($result);
	}

	public function save_func() {
		$params = json_decode($this->input->raw_input_stream, TRUE);
		$this->load->model('trans_functionality_model');

		$this->trans_functionality_model->insert_trans($params);		
	}

}
?>