<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Swift extends MX_Controller {

	public function index() {
		$this->load->library('swift_lib');
		$data = $this->swift_lib->get_data();
		$this->swift_lib->matching_data($data); 
	}
}