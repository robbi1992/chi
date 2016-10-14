<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Trans_interior_model extends CI_Model {
	
	public function performance_value($data) {
		$insert = $this->db->insert_batch('trans_interior', $data);
		if($insert) return TRUE;
		return FALSE;
	}
}