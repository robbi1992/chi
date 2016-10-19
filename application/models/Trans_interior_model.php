<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Trans_interior_model extends CI_Model {
	
	//method for insert and update value
	public function performance_value($data) {
		$nums = count($data);
		$success = 0;
		foreach ($data as $i => $v) {
			$this->db->where('fcid_fault_code', $v['fcid_fault_code']);
			$this->db->where('ft_fault_type', $v['ft_fault_type']);
			$this->db->where('catd_id', $v['catd_id']);
			$this->db->where('ac_reg_id', $v['ac_reg_id']);
			$this->db->where('pt_id', $v['pt_id']);
			$num = $this->db->get('trans_interior');

			if($num->num_rows() > 0) {
				$this->db->where('fcid_fault_code', $v['fcid_fault_code']);
				$this->db->where('ft_fault_type', $v['ft_fault_type']);
				$this->db->where('catd_id', $v['catd_id']);
				$this->db->where('ac_reg_id', $v['ac_reg_id']);
				$this->db->where('pt_id', $v['pt_id']);
				$this->db->set('value', $v['value']);
				$this->db->update('trans_interior');
				$success = $success + 1;
			}
			else {
				$this->db->set('fcid_fault_code', $v['fcid_fault_code']);
				$this->db->set('ft_fault_type', $v['ft_fault_type']);
				$this->db->set('catd_id', $v['catd_id']);
				$this->db->set('value', $v['value']);
				$this->db->set('ac_reg_id', $v['ac_reg_id']);
				$this->db->set('pt_id', $v['pt_id']);
				$this->db->insert('trans_interior');
				$success = $success + 1;
			}
		}
		if($success < $nums) return FALSE; 
		return TRUE;
	}

	/*
		$pt as performance type
	*/
	public function list_performance($pt = '', $acreg = '') {
		$this->db->select();
		$this->db->from('trans_interior');
		if(!empty($pt)) {
			$this->db->where('pt_id', $pt);
		}
		if(!empty($acreg)) {
			$this->db->where('ac_reg_id', $acreg);
		}
		$get = $this->db->get();

		$result = array();
		foreach($get->result() as $v) {
			$result[] = array(
				'faultCode' => $v->fcid_fault_code,
				'faultType' => $v->ft_fault_type,
				'cabinTemplate' => $v->catd_id,
				'acReg' => $v->ac_reg_id,
				'cabin' => $v->pt_id,
				'value' => $v->value,
				'num'	=> 1
			);
		}
		return $result;
	}

	public function list_performance_acType($params = array()) {
		$result = array();

		if(count($params) > 0) {
			$this->db->where_in('ac_reg_id', $params);
			$get = $this->db->get('trans_interior');
			foreach ($get->result() as $v) {
				$result[] = array(
					'faultCode' => $v->fcid_fault_code,
					'faultType' => $v->ft_fault_type,
					'cabinTemplate' => $v->catd_id,
					'acReg' => $v->ac_reg_id,
					'cabin' => $v->pt_id,
					'value' => $v->value,
					'num'	=> 1
				);
			}
		}
		return $result;
	}
}