<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Link_report extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}
	
	public function index() {
		$src = '';
		$title = '';
		$link_report = $this->uri->segment(3);
		
		if($link_report == 'component_reliability_report'){
			$src = 'http://192.168.40.101/reliability/Compremoval/bin-debug/reliability.html';
			$title = 'Component Reliability Report';
		}
		else if($link_report == 'weekly_reliability_report'){
			$src = 'http://192.168.40.101/reliability/TLPreport/weekly-real.php';
			$title = 'Weekly Reliability Report';
		}
		else if($link_report == 'monthly_reliability_report'){
			$src = 'http://192.168.40.101/reliability/TLPreport/index3.php';
			$title = 'Monthly Reliability Report';
		}
		else if($link_report == 'cabin_reliability_report'){
			$src = 'http://192.168.40.101/reliability/Cabin/bin/Cabin.html';
			$title = 'Cabin Reliability Report';
		}
		else if($link_report == 'aircraft_maintenance_status'){
			$src = 'http://intra.gmf-aeroasia.co.id/ams_sda/';
			$title = 'Aircraft Maintenance Status';
		}
		else if($link_report == 'aircraft_engine_ad_report' || $link_report == 'aircraft_engine_sb_report'){
			if($this->session->userdata('users')->id_users_group_fk == 2){
				$src = 'http://portal.gmf-aeroasia.co.id/Aplikasi01/AD_Worthy/App_AD_GA_ShareLink/ADGA_App.html';
				$title = 'Aircraft Engine AD Report';
			}
			else if($this->session->userdata('users')->id_users_group_fk == 3){
				$src = 'http://portal.gmf-aeroasia.co.id/Aplikasi01/AD_Worthy/App_AD_CT_ShareLink/ADCT_App.html';
				$title = 'Aircraft Engine AD Report';
			}
		}
		else if($link_report == 'hil_report'){
			$src = 'http://intra-02.gmf-aeroasia.co.id/App_Realmon/frame.php?uname=dc.setyadi';
			$title = 'HIL Report';
		}
		
		$this->page->view('link_report_index', array(
			'src'	=> $src,
			'ttl'	=> $title
		));
	}
	
	public function component_reliability_report(){
		$this->index();
	}

	public function weekly_reliability_report(){
		$this->index();
	}
	
	public function monthly_reliability_report(){
		$this->index();
	}
	
	public function cabin_reliability_report(){
		$this->index();
	}
	
	public function aircraft_maintenance_status(){
		$this->index();
	}
	
	public function aircraft_engine_ad_report(){
		$this->index();
	}	
	
	public function aircraft_engine_sb_report(){
		$this->index();
	}
	
	public function hil_report(){
		$this->index();
	}
	
}

/* End of file link_report.php */
/* Location: ./application/modules/master/controllers/link_report.php */