<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_hil_model extends CI_Model {

	public function get_transactions($week = NULL) {
		$this->db->select('a.*, hil_items.ac_type, hil_items.type');
		$this->db->from('trans_hil a');

		if (! is_null($week)) $this->db->where('week', $week);
		else {
			$this->db->join('(SELECT hil_id, max(date) AS newest_date FROM trans_hil
					GROUP BY hil_id
				) b', 'a.hil_id = b.hil_id AND a.date = b.newest_date');
		}
		$this->db->join('hil_items', 'hil_items.hil_id = a.hil_id');
		$get = $this->db->get();
		return $get->result_array();
	}

	public function get_rows_actype($param) {
		$this->db->where('id_aircraft_type_fk', $param);
		$q = $this->db->get('m_aircraft_reg');
		return $q->num_rows();
	}

	public function get_trans_yearly($year) {
		$this->db->select('trans_hil.*, hil_items.type, hil_items.ac_type');
		$this->db->where('YEAR(date)', $year);
		$this->db->join('hil_items', 'hil_items.hil_id = trans_hil.hil_id');
		$get = $this->db->get('trans_hil');
		return $get->result_array();
	}
}