<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Trans_interior_model extends CI_Model {
	
	public function performance_value($data) {
		$nums = count($data);
		$success = 0;
		foreach ($data as $i => $v) {
			$this->db->where('fcid_fault_code', $v['fcid_fault_code']);
			$this->db->where('ft_fault_type', $v['ft_fault_type']);
			$this->db->where('catd_id', $v['catd_id']);
			$num = $this->db->get('trans_interior');

			if($num->num_rows() > 0) {
				$this->db->set('value', $v['value']);
				$this->db->update('trans_interior');
				$success = $success + 1;
			}
			else {
				$this->db->set('fcid_fault_code', $v['fcid_fault_code']);
				$this->db->set('ft_fault_type', $v['ft_fault_type']);
				$this->db->set('catd_id', $v['catd_id']);
				$this->db->set('value', $v['value']);
				$this->db->insert('trans_interior');
				$success = $success + 1;
			}
		}
		if($success < $nums) return FALSE; 
		return TRUE;
	}
}