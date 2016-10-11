<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ac_delivery_report extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_ac_delivery_report');
	}
	
	public function index() {
		$this->page->view('ac_delivery_report_form_search', array (
			'act'		=> $this->page->base_url("/list_search"),
			'add'		=> $this->page->base_url('/add')
		));
	}
	
	public function list_search() {		
		$this->page->view('ac_delivery_report_index', array (
			'add'				=> $this->page->base_url('/add'),
			'back'				=> $this->page->base_url("/index"),
			'aircraft_registry' => $this->input->post('aircraft_registry'),
			'model'				=> $this->input->post('model'),
			'msn'				=> $this->input->post('msn'),
			'original_start'	=> $this->input->post('original_start_date'),
			'original_end'		=> $this->input->post('original_end_date'),
			'acceptance_start'	=> $this->input->post('acceptance_start_date'),
			'acceptance_end'	=> $this->input->post('acceptance_end_date'),
			'lessor'			=> $this->input->post('lessor'),
			'pn_engine'			=> $this->input->post('pn_engine'),
			'sn_engine'			=> $this->input->post('sn_engine'),
			'pn_apu'			=> $this->input->post('pn_apu'),
			'sn_apu'			=> $this->input->post('sn_apu'),
			'pn_nlg'			=> $this->input->post('pn_nlg'),
			'sn_nlg'			=> $this->input->post('sn_nlg')
		));
	}
	
	public function ajax_ac_delivery_report(){
		$list = $this->model_ac_delivery_report->search_ac_delivery_report();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $grid->aircraft_registry;
			$row[] = $grid->model;
			$row[] = $grid->msn;
			$row[] = $grid->original_export_date;
			$row[] = $grid->acceptence;
			$row[] = $grid->lessor;
			$row[] = $grid->pn_engine1;
			$row[] = $grid->sn_engine1;
			$row[] = $grid->pn_apu;
			$row[] = $grid->sn_apu;
			$row[] = $grid->pn_nlg;
			$row[] = $grid->sn_nlg;
			$row[] = '<a href="'.site_url('/aircraft_status/ac_delivery_report/view_detail_data/'.$grid->id_ac_delivery).'" title="View Detail Data"><span class="fa fa-eye" aria-hidden="true"></span></a> &nbsp;
					<a class="red" href="'.site_url('/aircraft_status/ac_delivery_report/download/'.$grid->id_ac_delivery).'" target="_blank" title="Download PDF"><span class="fa fa-file-pdf-o" aria-hidden="true"></span></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_ac_delivery_report->count_all(),
			"recordsFiltered" 	=> $this->model_ac_delivery_report->count_filtered(),
			"data" 				=> $data,
		);
		
		//output to json format
		echo json_encode($output);
	}
	
	private function form($action = 'insert', $id = ''){
		if ($this->agent->referrer() == '') redirect($this->page->base_url());
		
		$title = '';
		if($this->uri->segment(3) == 'add'){ 
			$title = 'Add';
		} else {
			$title = 'Edit';
		}

		$this->page->view('ac_delivery_report_form', array (
			'ttl'		=> $title,
			'back'		=> $this->agent->referrer(),
			'list'		=> $this->page->base_url('/list_search'),
			'act'		=> $this->page->base_url("/{$action}/{$id}")
		));
	}
	
	public function add(){
		$this->form();
	}
	
	public function insert(){	
		//if ( ! $this->input->post()) show_404(); 

		$config['upload_path'] = './assets/file_excel/';
		$config['allowed_types'] = 'xls';
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()){
			$data = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_file', 'failed');		
			redirect($this->page->base_url('/add'));
		}	
		else{
			$this->session->set_flashdata('upload_file', 'success');	
			$data = array('error' => false);
			$upload_data = $this->upload->data(); 
			
			$this->load->library('excel_reader');
				
			$file =  $upload_data['full_path'];
			$this->excel_reader->read($file);
				
			$data = $this->excel_reader->sheets[0];	
			error_reporting(E_ALL ^ E_NOTICE);			
			
			for ($i = 1; $i <= $data['numRows']; $i++) {
				if($data['cells'][$i][1] == '') break;
				
				$dataexcel[$i-1]['operator'] = $data['cells'][$i][1];
				$dataexcel[$i-1]['aircraft_registry'] = $data['cells'][$i][2];
				$dataexcel[$i-1]['model'] = $data['cells'][$i][3];
				$dataexcel[$i-1]['msn'] = $data['cells'][$i][4];
				$dataexcel[$i-1]['original_export_date'] = tgl_sql_export($data['cells'][$i][5]);
				$dataexcel[$i-1]['last_export_date'] = tgl_sql_export($data['cells'][$i][6]);
				$dataexcel[$i-1]['act_delivery_date'] = tgl_sql_export($data['cells'][$i][7]);
				$dataexcel[$i-1]['acceptence'] = tgl_sql_export($data['cells'][$i][8]);
				$dataexcel[$i-1]['previous_registry'] = $data['cells'][$i][9];
				$dataexcel[$i-1]['lessor'] = $data['cells'][$i][10];
				$dataexcel[$i-1]['owner'] = $data['cells'][$i][11];
				$dataexcel[$i-1]['owner_address'] = $data['cells'][$i][12];
				$dataexcel[$i-1]['engine1_mnf'] = $data['cells'][$i][13];
				$dataexcel[$i-1]['date_engine1_mnf'] = tgl_sql_export($data['cells'][$i][14]);
				$dataexcel[$i-1]['pn_engine1'] = $data['cells'][$i][15];
				$dataexcel[$i-1]['sn_engine1'] = $data['cells'][$i][16];
				$dataexcel[$i-1]['engine2_mnf'] = $data['cells'][$i][17];
				$dataexcel[$i-1]['date_engine2_mnf'] = tgl_sql_export($data['cells'][$i][18]);
				$dataexcel[$i-1]['pn_engine2'] = $data['cells'][$i][19];
				$dataexcel[$i-1]['sn_engine2'] = $data['cells'][$i][20];
				$dataexcel[$i-1]['engine3_mnf'] = $data['cells'][$i][21];
				$dataexcel[$i-1]['date_engine3_mnf'] = tgl_sql_export($data['cells'][$i][22]);
				$dataexcel[$i-1]['pn_engine3'] = $data['cells'][$i][23];
				$dataexcel[$i-1]['sn_engine3'] = $data['cells'][$i][24];
				$dataexcel[$i-1]['engine4_mnf'] = $data['cells'][$i][25];
				$dataexcel[$i-1]['date_engine4_mnf'] = tgl_sql_export($data['cells'][$i][26]);
				$dataexcel[$i-1]['pn_engine4'] = $data['cells'][$i][27];
				$dataexcel[$i-1]['sn_engine4'] = $data['cells'][$i][28];
				$dataexcel[$i-1]['apu_mnf'] = $data['cells'][$i][29];
				$dataexcel[$i-1]['date_apu_mnf'] = tgl_sql_export($data['cells'][$i][30]);
				$dataexcel[$i-1]['apu_model'] = $data['cells'][$i][31];
				$dataexcel[$i-1]['pn_apu'] = $data['cells'][$i][32];
				$dataexcel[$i-1]['sn_apu'] = $data['cells'][$i][33];
				$dataexcel[$i-1]['nlg_mnf'] = $data['cells'][$i][34];				
				$dataexcel[$i-1]['date_nlg_mnf'] = tgl_sql_export($data['cells'][$i][35]);
				$dataexcel[$i-1]['pn_nlg'] = $data['cells'][$i][36];				
				$dataexcel[$i-1]['sn_nlg'] = $data['cells'][$i][37];				
				$dataexcel[$i-1]['mlg_lg_mnf'] = $data['cells'][$i][38];
				$dataexcel[$i-1]['date_mlg_lg_mnf'] = tgl_sql_export($data['cells'][$i][39]);
				$dataexcel[$i-1]['pn_mlg_lh'] = $data['cells'][$i][40];
				$dataexcel[$i-1]['sn_mlg_lh'] = $data['cells'][$i][41];
				$dataexcel[$i-1]['mlg_rh_mnf'] = $data['cells'][$i][42];
				$dataexcel[$i-1]['date_mlg_rh_mnf'] = $data['cells'][$i][43];
				$dataexcel[$i-1]['pn_mlg_rh'] = $data['cells'][$i][44];
				$dataexcel[$i-1]['sn_mlg_rh'] = $data['cells'][$i][45];
			}
			
			delete_files($upload_data['file_path']);
			
			for($j=1;$j<count($dataexcel);$j++){

				$data = array(
					'operator'				=> $dataexcel[$j]['operator'],
					'aircraft_registry'		=> $dataexcel[$j]['aircraft_registry'],
					'model'					=> $dataexcel[$j]['model'],
					'msn'					=> $dataexcel[$j]['msn'],
					'original_export_date'	=> $dataexcel[$j]['original_export_date'],
					'last_export_date'		=> $dataexcel[$j]['last_export_date'],
					'act_delivery_date'		=> $dataexcel[$j]['act_delivery_date'],
					'acceptence'			=> $dataexcel[$j]['acceptence'],
					'previous_registry'		=> $dataexcel[$j]['previous_registry'],
					'lessor'				=> $dataexcel[$j]['lessor'],
					'owner'					=> $dataexcel[$j]['owner'],
					'owner_address'			=> $dataexcel[$j]['owner_address'],
					'engine1_mnf'			=> $dataexcel[$j]['engine1_mnf'],
					'date_engine1_mnf'		=> $dataexcel[$j]['date_engine1_mnf'],
					'pn_engine1'			=> $dataexcel[$j]['pn_engine1'],
					'sn_engine1'			=> $dataexcel[$j]['sn_engine1'],
					'engine2_mnf'			=> $dataexcel[$j]['engine2_mnf'],
					'date_engine2_mnf'		=> $dataexcel[$j]['date_engine2_mnf'],
					'pn_engine2'			=> $dataexcel[$j]['pn_engine2'],
					'sn_engine2'			=> $dataexcel[$j]['sn_engine2'],
					'engine3_mnf'			=> $dataexcel[$j]['engine3_mnf'],
					'date_engine3_mnf'		=> $dataexcel[$j]['date_engine3_mnf'],
					'pn_engine3'			=> $dataexcel[$j]['pn_engine3'],
					'engine4_mnf'			=> $dataexcel[$j]['engine4_mnf'],
					'date_engine4_mnf'		=> $dataexcel[$j]['date_engine4_mnf'],
					'pn_engine4'			=> $dataexcel[$j]['pn_engine4'],
					'sn_engine4'			=> $dataexcel[$j]['sn_engine4'],
					'apu_mnf'				=> $dataexcel[$j]['apu_mnf'],
					'date_apu_mnf'			=> $dataexcel[$j]['date_apu_mnf'],
					'apu_model'				=> $dataexcel[$j]['apu_model'],
					'pn_apu'				=> $dataexcel[$j]['pn_apu'],
					'sn_apu'				=> $dataexcel[$j]['sn_apu'],
					'nlg_mnf'				=> $dataexcel[$j]['nlg_mnf'],					
					'date_nlg_mnf'			=> $dataexcel[$j]['date_nlg_mnf'],
					'pn_nlg'				=> $dataexcel[$j]['pn_nlg'],
					'sn_nlg'				=> $dataexcel[$j]['sn_nlg'],					
					'mlg_lg_mnf'			=> $dataexcel[$j]['mlg_lg_mnf'],
					'date_mlg_lg_mnf'		=> $dataexcel[$j]['date_mlg_lg_mnf'],
					'pn_mlg_lh'				=> $dataexcel[$j]['pn_mlg_lh'],
					'sn_mlg_lh'				=> $dataexcel[$j]['sn_mlg_lh'],
					'mlg_rh_mnf'			=> $dataexcel[$j]['mlg_rh_mnf'],
					'date_mlg_rh_mnf'		=> $dataexcel[$j]['date_mlg_rh_mnf'],
					'pn_mlg_rh'				=> $dataexcel[$j]['pn_mlg_rh'],
					'sn_mlg_rh'				=> $dataexcel[$j]['sn_mlg_rh'],
					'change_date' 	   		=> date('Y-m-d'),
					'change_time'	 		=> date('H:i:s'),
					'id_users_fk'			=> $this->session->userdata('users')->id_users
				);
				$this->db->insert('ac_delivery_report', $data);
			}
		}	
			
		redirect($this->page->base_url('/add'));
		
	}
	
	public function view_detail_data($id){		
		$this->page->view('ac_delivery_report_detail_data', array (
			'back'		=> $this->agent->referrer(),
			'pdf'		=> $this->page->base_url('/download/'.$id),
			'rc' 		=> $this->db->get_where('ac_delivery_report', array('id_ac_delivery' => $id))->row()
		));
	}
	
	public function pdf($id){		
		$this->load->library('pdf');
		$content = $this->load->view('ac_delivery_report_pdf', array (
			'rc' 	=> $this->db->get_where('ac_delivery_report', array('id_ac_delivery' => $id))->row(),
		), TRUE);
		$this->pdf->create($content, 'ac_delivery_report_pdf');
	}
	
	public function download($id) {
		$this->load->helper('download');
		$data = file_get_contents(site_url('/aircraft_status/ac_delivery_report/pdf/'.$id));
		force_download('ac_delivery_report_pdf_'.$id.'.pdf', $data); 
	}
	
	public function options_ac_registry(){
		$ac_registry = $this->db->query("SELECT DISTINCT aircraft_registry FROM ac_delivery_report ORDER BY aircraft_registry ASC");
		return options($ac_registry, 'aircraft_registry', '', 'aircraft_registry');
	}
	
	public function options_model(){
		$model = $this->db->query("SELECT DISTINCT model FROM ac_delivery_report ORDER BY model ASC");
		return options($model, 'model', '', 'model');
	}
	
	public function ajax_group_engine(){
		$pn_engine = $this->input->post('pn_engine', TRUE);
		$keyword = $this->uri->segment(4);
		$query = $this->model_ac_delivery_report->show_group_engine();
		
		$arr_engine = array();
		foreach($query->result() as $row) {
			$arr_engine[] = array(
				'label'	=> $row->pn_engine1
			);
		}
		//var_dump($arr); die();
		echo json_encode($arr_engine);
	}

}

/* End of file Ac_delivery_report.php */
/* Location: ./application/modules/aircraft_status/controllers/Ac_delivery_report.php */