<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ac_delivery_report extends CI_Model {
	
	private $table 			= 'ac_delivery_report';
	private $column_order 	= array('aircraft_registry','model','msn','original_export_date','acceptence','lessor','pn_engine1','sn_engine1','pn_apu','sn_apu','pn_nlg','sn_nlg',null);
	private $column_search 	= array('aircraft_registry','model','msn','original_export_date','acceptence','lessor','pn_engine1','sn_engine1','pn_apu','sn_apu','pn_nlg','sn_nlg');  
	private $order 			= array('id_ac_delivery' => 'desc'); 
	public	$nama  	  		= '';
	public	$uri  	  		= '';
	public	$id_menu_induk  = '';
	public	$aktif 	  	  	= '';
	
	private function _get_query() {
		$this->db->from($this->table);
		$this->db->join('users', 'ac_delivery_report.id_users_fk = users.id_users', 'left');
		$this->db->where('flag','1');

		$i = 0;
		foreach ($this->column_search as $item) {
			if($_POST['search']['value']) {
				if($i===0){ 
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				
				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end();
			}
			$i++;
		}
		
		if(isset($_POST['order'])){
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	public function get_ac_delivery_report() {
		$aircraft_registry 	= $this->input->post('aircraft_registry');
		$model				= $this->input->post('model');
		$msn				= $this->input->post('msn');
		$original_start		= $this->input->post('original_start_date');
		$original_end		= $this->input->post('original_end_date');
		$acceptance_start	= $this->input->post('acceptance_start_date');
		$acceptance_end		= $this->input->post('acceptance_end_date');
		$lessor				= $this->input->post('lessor');
		$pn_engine			= $this->input->post('pn_engine');
		$sn_engine			= $this->input->post('sn_engine');
		$pn_apu				= $this->input->post('pn_apu');
		$sn_apu				= $this->input->post('sn_apu');
		$pn_nlg				= $this->input->post('pn_nlg');
		$sn_nlg				= $this->input->post('sn_nlg');
		
		
        
		//$this->_get_query();
		//if($_POST['length'] != -1)
		//$this->db->limit($_POST['length'], $_POST['start']);
	
        $this->db->from($this->table);
		$this->db->join('users', 'ac_delivery_report.id_users_fk = users.id_users', 'left');
		$this->db->where('flag','1');
		if($original_start <> '' AND $original_end <> ''){
			$this->db->where('original_export_date >=', $original_start);
			$this->db->where('original_export_date <=', $original_end);
			//$this->db->where("original_export_date BETWEEN {$original_start} AND {$original_end}, NULL, FALSE");
		}
		if(!empty($acceptance_start) AND !empty($acceptance_end)){
			$this->db->where('acceptence BETWEEN "'. date('Y-m-d', strtotime($acceptance_start)). '" AND "'. date('Y-m-d', strtotime($acceptance_end)).'"');
        }
        if(!empty($aircraft_registry)){
			$this->db->like('aircraft_registry', $aircraft_registry);
        }
        if(!empty($model)){
			$this->db->like('model', $model);
        }
        if(!empty($msn)){
			$this->db->like('msn', $msn);
        }
        if(!empty($lessor)){
			$this->db->like('lessor', $lessor);
        }
        if(!empty($pn_engine)){
			$this->db->like('pn_engine1', $pn_engine);
        }
        if(!empty($sn_engine)){
			$this->db->like('sn_engine2', $sn_engine);
        }
        if(!empty($pn_apu)){
			$this->db->like('pn_apu', $pn_apu);
        }
        if(!empty($sn_apu)){
			$this->db->like('sn_apu', $sn_apu);
        }
        if(!empty($pn_nlg)){
			$this->db->like('pn_nlg', $pn_nlg);
        }
        if(!empty($sn_nlg)){
			$this->db->like('sn_nlg', $sn_nlg);
        }
		
		if(isset($_POST['order'])){
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
		$query = $this->db->get();
		
		return $query->result();
	}

	public function count_filtered() {
		$this->_get_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	public function search_ac_delivery_report(){
		$aircraft_registry 	= $this->input->post('aircraft_registry');
		$model				= $this->input->post('model');
		$msn				= $this->input->post('msn');
		$original_start		= $this->input->post('original_start');
		$original_end		= $this->input->post('original_end');
		$acceptance_start	= $this->input->post('acceptance_start');
		$acceptance_end		= $this->input->post('acceptance_end');
		$lessor				= $this->input->post('lessor');
		$pn_engine			= $this->input->post('pn_engine');
		$sn_engine			= $this->input->post('sn_engine');
		$pn_apu				= $this->input->post('pn_apu');
		$sn_apu				= $this->input->post('sn_apu');
		$pn_nlg				= $this->input->post('pn_nlg');
		$sn_nlg				= $this->input->post('sn_nlg');
		
		$and_ar = '';
        if(!empty($aircraft_registry)){	$and_ar = " AND aircraft_registry LIKE '%{$aircraft_registry}%' "; }
		
		$and_mo = '';
        if(!empty($model)){	$and_mo = " AND model LIKE '%{$model}%' "; }
		
		$and_ms = '';
        if(!empty($msn)){ $and_ms = " AND msn LIKE '%{$msn}%' "; }
		
		$and_oed = '';
		if(!empty($original_start) AND !empty($original_end)){ $and_oed = " AND original_export_date BETWEEN '{$original_start}' AND '{$original_end}' "; }
		
		$and_as = '';
		if(!empty($acceptance_start) AND !empty($acceptance_end)){ $and_as = " AND acceptence BETWEEN '{$acceptance_start}' AND '{$acceptance_end}' "; }
		
		$and_ls = '';
        if(!empty($lessor)){ $and_ls = "AND lessor LIKE '%{$lessor}%' "; }
		
		$and_pn = '';
        if(!empty($pn_apu)){$and_pn = " AND pn_apu LIKE '%{$pn_apu}%'"; }
		
		$and_sn = '';
        if(!empty($sn_apu)){ $and_sn = "  AND sn_apu LIKE '%{$sn_apu}%'"; }
		
		$and_pn_nlg = '';
        if(!empty($pn_nlg)){ $and_pn_nlg = " AND pn_nlg LIKE '%{$pn_nlg}%'"; }
		
		$and_sn_nlg = '';
        if(!empty($sn_nlg)){ $and_sn_nlg = " AND sn_nlg LIKE '%{$sn_nlg}%'"; }
		
		$ord_by = '';
		if(isset($_POST['order'])){
			$ord_by = "ORDER BY '{$this->column_order([$_POST[order][0][column]], $_POST[order][0][dir])}' ";
		} 
		else if(isset($this->order)){
			$order = $this->order;
			$ord_by = $this->db->order_by(key($order), $order[key($order)]);
		}
		
		$query = "
			SELECT * 
			FROM (
				SELECT *
				FROM ac_delivery_report
				WHERE flag = '1' 
				{$and_ar}
				{$and_mo}
				{$and_ms}
				{$and_oed}
				{$and_as}
				{$and_ls}
				{$and_pn}
				{$and_sn}
				{$and_pn_nlg}
				{$and_sn_nlg}
			) AS adr
			LEFT JOIN users AS u
				ON adr.id_users_fk = id_users 
		";
		return $this->db->query($query)->result();
	}
	
	public function show_group_engine(){
		$query = "
			SELECT pn_engine1,
				pn_engine2,
				pn_engine3,
				pn_engine4
			FROM ac_delivery_report
			WHERE flag = '1'
		";
		
		return $this->db->query($query);	
	}
	
}

/* End of file Model_ac_delivery_report.php */
/* Location: ./application/modules/aircraft_status/models/Model_ac_delivery_report.php */