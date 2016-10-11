<?php defined('BASEPATH') OR exit('No direct script access allowed');

class plane extends MX_Controller {

    var $data;
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form','captcha'));
		$this->page->use_directory();

	}
    
    public function index() {
        
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
		$this->page->view('heatlh_view_plane_registry', $data);
        
	}
    
}
