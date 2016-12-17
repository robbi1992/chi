<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_functionality_model extends CI_Model {

	public function get_func_items() {
		$this->db->order_by('fi_id');
		$get = $this->db->get('fun_items');
		return $get->result();
	}

	public function get_func_items_sub() {
		$this->db->order_by('fi_id');
		$get = $this->db->get('fun_items_sub');
		return $get->result();
	}

	public function insert_trans($data, $update = FALSE) {
		if($update) {
			$this->db->where('acr_id', $data['acReg']);
			$this->db->delete('trans_functionality');
		}
		foreach ($data['itemsSub'] as $iis => $vis) {
			$this->db->select('fi_id');
			$this->db->where('fis_id', $vis);
			$row = $this->db->get('fun_items_sub')->row();
			$fi_id = $row->fi_id;

			$this->db->set('acr_id', $data['acReg']);
			$this->db->set('fis_id', $vis);
			$this->db->set('fi_id', $fi_id);
			$this->db->set('items', $data['itemSubTotal'][$iis]);
			$this->db->insert('trans_functionality');
		}
	}

	public function get_transactions($params, $week = NULL) {
		$this->db->select('a.*, fi_name, fis_name');
		$this->db->from('trans_functionality a');
		if (! is_null($week)) $this->db->where('week', $week);
		else {
			$this->db->join('(SELECT acr_id, fis_id, max(modified_date) AS newest_date
			FROM trans_functionality
			GROUP BY acr_id, fis_id) b', 'a.acr_id = b.acr_id AND a.fis_id = b.fis_id AND a.modified_date = b.newest_date');
		}
		$this->db->join('fun_items_sub', 'a.fis_id = fun_items_sub.fis_id');
		$this->db->join('fun_items', 'a.fi_id = fun_items.fi_id');
		$this->db->where('a.acr_id', $params['id']);
		$get = $this->db->get();
		return $get->result_array();
		/*$this->db->where('acr_id', $params['id']);
		$this->db->join('fun_items_sub', 'trans_functionality.fis_id = fun_items_sub.fis_id');
		$this->db->join('fun_items', 'trans_functionality.fi_id = fun_items.fi_id');
		$get = $this->db->get('trans_functionality');
		return $get->result_array();*/
	}

	public function get_trans_yearly($year) {
		$this->db->where('YEAR(modified_date)', $year);
		$get = $this->db->get('trans_functionality');
		return $get->result_array();
	}
	
	public function get_targets() {
		$this->db->where('year', date('Y'));
		$get = $this->db->get('fun_targets');
		$result = array();
		foreach ($get->result_array() as $value) {
			$result[$value['fi_id']] = $value['value'];
		}
		return $result;
	}

	public function get_transactions_area() {
		$this->db->select('a.*, fi_name');
		$this->db->from('trans_functionality a');
		$this->db->join('(SELECT acr_id, fis_id, max(modified_date) AS newest_date
			FROM trans_functionality
			GROUP BY acr_id, fis_id) b', 'a.acr_id = b.acr_id AND a.fis_id = b.fis_id AND a.modified_date = b.newest_date');
		$this->db->join('fun_items', 'a.fi_id = fun_items.fi_id');
		$this->db->where_not_in('a.fi_id', array(7, 8));

		/*$this->db->select('items, defects, trans_functionality.fi_id, fi_name');
		$this->db->from('trans_functionality');
		$this->db->join('fun_items', 'trans_functionality.fi_id = fun_items.fi_id');
		$this->db->where_not_in('trans_functionality.fi_id', array(7, 8));*/
		$get = $this->db->get();
		return $get->result_array();
	}

	public function get_trans_chart($regs = array(), $area = '', $galley = '') {
		$this->db->select('acr_id, name_ac_reg, items, defects, remark, fi_id');
		$this->db->from('trans_functionality');
		if (count($regs) > 0) $this->db->where_in('acr_id', $regs);
		$this->db->where('defects >', 0);
		if (!empty($area)) $this->db->where('fi_id', $area);
		$this->db->join('m_aircraft_reg', 'trans_functionality.acr_id = m_aircraft_reg.id');
		if (!empty($galley)) $this->db->like('remark', $galley);
		$get = $this->db->get();
		return $get->result_array();
	}

	public function list_data_table(){
		$this->db->select('a.acr_id, b.name_ac_reg');
		$this->db->distinct();
		$this->db->from('trans_functionality a');
		$this->db->join('m_aircraft_reg b', 'a.acr_id = b.id');
		$this->db->limit($_POST['length'], $_POST['start']);
		$get = $this->db->get();

		return $get->result();
	}

	public function num_rows() {
		$this->db->select('acr_id');
		$this->db->distinct();
		$get = $this->db->get('trans_functionality');
		return $get->num_rows();
	}

	public function get_custom_trans($acReg) {
		$this->db->select('fis_id, items');
		$this->db->from('trans_functionality');
		$this->db->where('acr_id', $acReg);
		$get = $this->db->get();
		$result = array();
		foreach ($get->result_array() as $key => $value) {
			$result[$value['fis_id']] = $value['items'];
		}
		return $result;
	}

	public function get_name($acReg) {
		$this->db->select('id, name_ac_reg');
		$this->db->from('m_aircraft_reg');
		$this->db->where('id', $acReg);
		$get = $this->db->get();
		return $get->result();
	}

	public function get_trans_items($acReg) {
		$this->db->select('fi_id, items');
		$this->db->distinct();
		$this->db->from('trans_functionality');
		$this->db->where('acr_id', $acReg);
		$get = $this->db->get();
		$result = array();
		foreach ($get->result_array() as $key => $value) {
			$result[$value['fi_id']] = $value['items'];
		}
		return $result;
	}
}