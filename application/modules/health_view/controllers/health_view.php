
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class health_view extends MX_Controller {

    var $data;
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		//$this->load->library(array('form_validation'));
		//$this->load->helper(array('form','captcha'));
		$this->page->use_directory();

	}
    
    public function index() {
        $this->load->model('AircraftType_model');
		$data['list'] = $this->AircraftType_model->list_name();
		//print_r($list); exit();
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
		$this->page->view('heatlh_view_plane', $data);        
	}
    
    public function plane() {
        
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
		$this->page->view('heatlh_view_plane_registry', $data);
        
	}
    
     public function cabin($typeac,$typereg) {
        
        //die($typereg);
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
		$this->page->view('kpi_cabin', $data);
        
	}
    
    public function functionality($typeac,$typereg) {
        
        //die($typereg);
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
		$this->page->view('kpi_cabin', $data);
        
	}
    
    public function interior($typeac,$typereg) {
        
        //die($typereg);
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
		$this->page->view('interior_view', $data);
        
	}
    
    public function exterior($typeac,$typereg) {
        
        //die($typereg);
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
		$this->page->view('kpi_cabin', $data);
        
	}
    
    public function interior_seatcover($typeac,$typereg) {
        
        //die($typereg);
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
		$this->page->view('interior_seatcover_view', $data);
        
	}
    
    public function interior_carpet($typeac,$typereg) {
        
        //die($typereg);
        $data['typeac'] = $typeac;
        $data['typereg'] = $typereg;
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        
		$this->page->view('interior_carpet_view', $data);
        
	}
    
    public function get_ac_reg() {
		$param = json_decode($this->input->raw_input_stream, TRUE);
		$this->load->model('AircraftReg_model');
		$data = $this->AircraftReg_model->list_by($param['param']);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
    
}
