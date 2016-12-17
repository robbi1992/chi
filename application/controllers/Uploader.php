<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploader extends MY_Controller {
	public function index() {
		@include(APPATH . 'library/UploadHandler.php');
		//sleep(1);
		$ac_reg_name = $this->input->post('acReg');
		$unique = $ac_reg_name[0] . '_' . time() . '_' . rand(0, 9);
		$upload_handler = new UploadHandler($unique);

		$this->load->model('trans_exterior_model');
		
		$result = array();
		if($this->input->method() === 'delete') {
			$isDelete = $this->trans_exterior_model->delete($this->input->get('file'));
			if($isDelete) $result = json_encode($upload_handler->response);
		}
		elseif($this->input->method() === 'post') {
			$id_ac_reg = $this->trans_exterior_model->get_id($ac_reg_name[0]);
			if(isset($upload_handler->response)) {
				$isInsert = $this->trans_exterior_model->insert(
					array(
							'url' => $upload_handler->response['files'][0]->name,
							'acReg' => $id_ac_reg->id
						)
				);
				if($isInsert) $result = json_encode($upload_handler->response);
			}	
		}
		elseif($this->input->method() === 'get') {
			$result_new = array('files' => $upload_handler->response);
			$result = json_encode($result_new);
		}
		$this->output
			->set_content_type('application/json')
			->set_output($result);
	}
}