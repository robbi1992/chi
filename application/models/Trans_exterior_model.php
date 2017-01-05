<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Trans_exterior_model extends CI_Model {
	
	public function performance_list($id, $week = NULL) {
		$this->db->select('a.*');
		$this->db->from('trans_exterior a');
		
		$this->db->where('a.acr_id', $id);
		if (! is_null($week)) {
			$this->db->where('te_week', $week);
		}
		else {
			$this->db->join('(SELECT acr_id, exis_id, max(te_date) AS newest_date
				FROM trans_exterior
				GROUP BY acr_id, exis_id)
			b', 'a.acr_id = b.acr_id AND a.exis_id = b.exis_id AND a.te_date = b.newest_date');
		}
		$get = $this->db->get();
		return $get->result();
	}

	public function sub_items_list() {
		$this->db->join('ex_items', 'ex_items.exi_id = ex_items_sub.exi_id');
		$this->db->order_by('ex_items_sub.exi_id');
		$list = $this->db->get('ex_items_sub');
		return $list->result();
	}

	public function get_targets() {
		$this->db->where('year', date('Y'));
		$get = $this->db->get('ex_targets');
		$result = array();
		foreach ($get->result_array() as $value) {
			$result[$value['exi_id']] = $value['value'];
		}
		return $result;
	}

	public function toDo($params) {
		$this->db->where('acr_id', $params['acReg']);
		$this->db->where('exis_id', $params['subItem']);
		$this->db->where('te_date', date('Y-m-d'));
		$get = $this->db->get('trans_exterior');

		$this->db->set('te_value', $params['val']);
		$this->db->set('te_week', count_weeks());
		if($get->num_rows() > 0) {
			$this->db->where('acr_id', $params['acReg']);
			$this->db->where('exis_id', $params['subItem']);
			$this->db->where('te_date', date('Y-m-d'));
			$action = $this->db->update('trans_exterior');
		}
		else {
			$this->db->set('acr_id', $params['acReg']);
			$this->db->set('exis_id', $params['subItem']);
			$this->db->set('te_date', date('Y-m-d'));
			$this->db->set('te_by', $_SESSION['users_logged_in']->id);
			$action = $this->db->insert('trans_exterior');
		}

		if ($action) return TRUE;
		return FALSE;
	}
	//images upload
	public function get_images($param) {
		$this->db->where('acr_id', $param);
		$this->db->order_by('exi_id');
		$get = $this->db->get('ex_image_files');

		return $get->result();
	}
	public function insert($params) {
		$this->db->set('eif_url', $params['url']);
		$this->db->set('acr_id', $params['acReg']);
		$this->db->set('exi_id', $params['exiID']);
		$get = $this->db->insert('ex_image_files');
		if($get) return TRUE;
		return FALSE;
	}

	public function is_image_exist($params) {
		$this->db->where('acr_id', $params['acReg']);
		$this->db->where('exi_id', $params['exiID']);
		$get = $this->db->get('ex_image_files');
		if($get->num_rows() > 0) {
			$this->db->where('acr_id', $params['acReg']);
			$this->db->where('exi_id', $params['exiID']);
			
			$this->db->set('eif_url', $params['url']);
			$this->db->update('ex_image_files');
			return TRUE;
		}
		else {
			return $this->insert($params);
		}
	}
	public function get_id($acReg = NULL) {
		$this->db->select('id');
		$this->db->from('m_aircraft_reg');
		$this->db->where('name_ac_reg', $acReg);

		return $this->db->get()->row();
	}

	public function delete($url) {
		$this->db->where('eif_url', $url);
		$delete = $this->db->delete('ex_image_files');
		if($delete) return TRUE;
		return FALSE;
	}
	//end images upload

	public function get_trans_yearly($year) {
		$this->db->where('YEAR(te_date)', $year);
		$get = $this->db->get('trans_exterior');
		return $get->result_array();
	}
}