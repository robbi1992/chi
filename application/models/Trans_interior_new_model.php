<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_interior_new_model extends CI_Model {
	public function get_items($reg, $weight = FALSE, $cabin = '') {
		if($weight) {
			$this->db->select('weight');
			$this->db->where('acr_id', $reg);
			$this->db->where('ini_id', $cabin);
		}
		else {
			$this->db->where('acr_id', $reg);
			$this->db->join('in_items', 'in_items_weight.ini_id = in_items.ini_id');
		}
		$this->db->order_by('in_items_weight.ini_id');
		$get = $this->db->get('in_items_weight');
		return $get->result();
	}

	public function get_transactions($params, $all = FALSE, $week = NULL) {
		if(!$all) {
			$this->db->select('a.*, inis_name');
			$this->db->where('a.ini_id', $params['cabinArea']);
		}
		else {
			$this->db->select('a.*, ini_name, inis_name');
			$this->db->join('in_items', 'a.ini_id = in_items.ini_id');
		}
		$this->db->from('trans_interior_new a');
		if (! is_null($week)) $this->db->where('week', $week);
		else {
			$this->db->join('(SELECT acr_id, inis_id, max(modified_date) AS newest_date
			FROM trans_interior_new
			GROUP BY acr_id, inis_id) b', 'a.acr_id = b.acr_id AND a.inis_id = b.inis_id AND a.modified_date = b.newest_date');
		}
		$this->db->join('in_items_sub', 'a.inis_id = in_items_sub.inis_id');
		$this->db->where('a.acr_id', $params['acReg']);

		/*$this->db->where('acr_id', $params['acReg']);
		if(!$all) $this->db->where('trans_interior_new.ini_id', $params['cabinArea']);
		else $this->db->join('in_items', 'trans_interior_new.ini_id = in_items.ini_id');
		$this->db->join('in_items_sub', 'trans_interior_new.inis_id = in_items_sub.inis_id');
		//$this->db->order_by('trans_interior_new.ini_id');
		$get = $this->db->get('trans_interior_new');*/
		$get = $this->db->get();
		return $get->result();
	}

	public function get_trans_yearly($year) {
		$this->db->where('YEAR(modified_date)', $year);
		$get = $this->db->get('trans_interior_new');
		return $get->result_array();
	}
	
	public function get_custom_trans($acReg) {
		$this->db->select('inis_id, total_item');
		$this->db->from('trans_interior_new');
		$this->db->where('acr_id', $acReg);
		$get = $this->db->get();
		$result = array();
		foreach ($get->result_array() as $key => $value) {
			$result[$value['inis_id']] = $value['total_item'];
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

	public function update_transactions($params) {
		$this->db->where('acr_id', $params['acRID']);
		$this->db->where('inis_id', $params['inisID']);
		$this->db->where('ini_id', $params['iniID']);
		$this->db->where('total_item', $params['items']);
		$this->db->where('modified_date', date('Y-m-d'));
		$get = $this->db->get('trans_interior_new');
		
		$this->db->set('total_defect', $params['defect']);
		$this->db->set('total_dirty', $params['dirty']);
		$this->db->set('remark', $params['remark']);
		$this->db->set('week',count_weeks());

		if($get->num_rows() > 0) {
			$this->db->where('acr_id', $params['acRID']);
			$this->db->where('inis_id', $params['inisID']);
			$this->db->where('ini_id', $params['iniID']);
			$this->db->where('total_item', $params['items']);
			$this->db->where('modified_date', date('Y-m-d'));
			$do = $this->db->update('trans_interior_new');
		}
		else {
			$this->db->set('acr_id', $params['acRID']);
			$this->db->set('inis_id', $params['inisID']);
			$this->db->set('ini_id', $params['iniID']);
			$this->db->set('total_item', $params['items']);
			$this->db->set('modified_date', date('Y-m-d'));
	
			$do = $this->db->insert('trans_interior_new');
		}

		if($do) {
			return TRUE;
		}
		return FALSE;
	}

	public function get_interior_items() {
		$this->db->order_by('ini_id');
		$get = $this->db->get('in_items');
		return $get->result();
	}

	public function get_interior_items_sub() {
		$this->db->order_by('ini_id');
		$get = $this->db->get('in_items_sub');
		return $get->result();
	}

	public function get_trans_weight($param) {
		$this->db->select('ini_id, weight');
		$this->db->where('acr_id', $param);
		$this->db->order_by('ini_id');
		$get = $this->db->get('in_items_weight');
		$result = array();
		foreach ($get->result_array() as $key => $value) {
			$result[$value['ini_id']] = $value['weight'];
		}
		return $result;
	}

	public function insert_weight($data, $update = FALSE) {
		if($update) {
			$this->db->where('acr_id', $data['acReg']);
			$this->db->delete('in_items_weight');
		}

		foreach ($data['items'] as $it => $vt) {
			$this->db->set('acr_id', $data['acReg']);
			$this->db->set('ini_id', $vt);
			$this->db->set('weight', $data['itemWeight'][$it]);
			$this->db->insert('in_items_weight');
		}
	}

	public function insert_trans($data, $update = FALSE) {
		if($update) {
			$this->db->where('acr_id', $data['acReg']);
			$this->db->delete('Trans_interior_new');
		}

		foreach ($data['itemsSub'] as $iis => $vis) {
			$this->db->select('ini_id');
			$this->db->where('inis_id', $vis);
			$row = $this->db->get('in_items_sub')->row();
			$ini_id = $row->ini_id;

			$this->db->set('acr_id', $data['acReg']);
			$this->db->set('inis_id', $vis);
			$this->db->set('ini_id', $ini_id);
			$this->db->set('total_item', $data['itemSubTotal'][$iis]);
			$this->db->set('modified_date', date('Y-m-d'));
			$this->db->insert('Trans_interior_new');
		}
	}

	public function list_data_table(){
		$this->db->select('a.acr_id, b.name_ac_reg');
		$this->db->distinct();
		$this->db->from('trans_interior_new a');
		$this->db->join('m_aircraft_reg b', 'a.acr_id = b.id');
		$this->db->limit($_POST['length'], $_POST['start']);
		$get = $this->db->get();

		return $get->result();
	}

	public function num_rows() {
		$this->db->select('acr_id');
		$this->db->distinct();
		$get = $this->db->get('trans_interior_new');
		return $get->num_rows();
	}

	public function get_targets() {
		$this->db->where('year', date('Y'));
		$get = $this->db->get('in_targets');
		$result = array();
		foreach ($get->result_array() as $value) {
			$result[$value['ini_id']] = $value['value'];
		}
		return $result;
	}
}