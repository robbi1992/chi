<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Swift_lib {

	private $_ci = NULL;

	private function explode_fic($fic) {
		$result['num'] = preg_replace('/[^0-9]+/', '', $fic);
		$result['alp'] = str_replace($result['num'], "", $fic);
		return $result;
	}

	private function matching_fic($param) {
		$this->_ci->db->select('fName, fis_id');
		$this->_ci->db->where('fCode', $param);
		$this->_ci->db->where('fis_id !=', NULL);
		$check = $this->_ci->db->get('m_faultCodeItemDtl');
		return $check->row_array();
	}

	private function matching_num($param) {
		$this->_ci->db->select('fName');
		$this->_ci->db->where('fCode', $param);
		$check = $this->_ci->db->get('m_faultType');
		return $check->row_array();
	}

	private function get_fi_id($param) {
		$fi_id = $param;
		if ($param == 7 || $param == 8 || $param == 9) $fi_id = 7;
		else if($param == 10) $fi_id = 8;
		return $fi_id;
	}

	private function get_description($param) {
		$vals = explode('-', $param);
		return $vals[1];
	}

	private function get_items($reg, $fis) {
		$this->_ci->db->select('a.items');
		$this->_ci->db->from('trans_functionality a');
		$this->_ci->db->join('(SELECT acr_id, fis_id, max(modified_date) AS newest_date
			FROM trans_functionality
			GROUP BY acr_id, fis_id) b', 'a.acr_id = b.acr_id AND a.fis_id = b.fis_id AND a.modified_date = b.newest_date');
		$this->_ci->db->where('a.acr_id', $reg);
		$this->_ci->db->where('a.fis_id', $fis);
		$get = $this->_ci->db->get();
		return $get->row_array();
	}

	private function check_if_exist($params) {
		$this->_ci->db->select('defects');
		$this->_ci->db->where('acr_id', $params['acr_id']);
		$this->_ci->db->where('fis_id', $params['fis_id']);
		$this->_ci->db->where('items', $params['items']);
		$this->_ci->db->where('modified_date', $params['modified_date']);
		$this->_ci->db->where('week', $params['week']);
		$get = $this->_ci->db->get('trans_functionality');
		if ($get->row_array() > 0) return $get->row_array();
		return FALSE;
	}

	private function update_functionality($params) {
		$this->_ci->db->where('acr_id', $params['acr_id']);
		$this->_ci->db->where('fis_id', $params['fis_id']);
		$this->_ci->db->where('modified_date', $params['modified_date']);
		$this->_ci->db->where('week', $params['week']);

		$this->_ci->db->set('defects', $params['defect']);
		$this->_ci->db->update('trans_functionality');
	}

	private function insert_functionality($params) {
		$this->_ci->db->set('acr_id', $params['acr_id']);
		$this->_ci->db->set('fis_id', $params['fis_id']);
		$this->_ci->db->set('items', $params['items']);
		$this->_ci->db->set('defects', $params['defect']);
		$this->_ci->db->set('remark', $params['remark']);
		$this->_ci->db->set('fi_id', $params['fi_id']);
		$this->_ci->db->set('modified_date', $params['modified_date']);
		$this->_ci->db->set('week', $params['week']);
		$this->_ci->db->set('description', $params['ficDesc']);
		$this->_ci->db->set('additional', $params['additional']);
		
		$this->_ci->db->insert('trans_functionality');
	}

	private function get_defects_item() {
		$this->_ci->db->where('defects >', 0);
		$get = $this->_ci->db->get('trans_functionality');
		return $get->result_array();
	}

	private function trans_closed($params) {
		if ($params['modified_date'] == date('Y-m-d')) {
			$this->_ci->db->where('acr_id', $params['acr_id']);
			$this->_ci->db->where('fis_id', $params['fis_id']);
			$this->_ci->db->where('fi_id', $params['fi_id']);
			$this->_ci->db->where('items', $params['items']);
			$this->_ci->db->where('modified_date', date('Y-m-d'));
			$this->_ci->db->set('defects', 0);
			$this->_ci->db->update('trans_functionality');
		}
		else {
			$this->_ci->db->set('acr_id', $params['acr_id']);
			$this->_ci->db->set('fis_id', $params['fis_id']);
			$this->_ci->db->set('items', $params['items']);
			$this->_ci->db->set('fi_id', $params['fi_id']);
			$this->_ci->db->set('defects', 0);
			$this->_ci->db->set('modified_date', date('Y-m-d'));
			$this->_ci->db->set('week', count_weeks());
		
			$this->_ci->db->insert('trans_functionality');
		}
	}

	/*
	hil process
	*/
	private function get_hil_id($ac_type) {
		$this->_ci->db->select('hil_id');
		$this->_ci->db->where('ac_type', $ac_type);
		$get = $this->_ci->db->get('hil_items');
		return $get->row_array();
	}

	private function check_if_hil_exist($params) {
		$this->_ci->db->select('hil');
		$this->_ci->db->where('hil_id', $params['hil_id']);
		$this->_ci->db->where('date', $params['date']);
		$this->_ci->db->where('week', $params['week']);
		$get = $this->_ci->db->get('trans_hil');
		if ($get->row_array() > 0) return $get->row_array();
		return FALSE;
	}

	private function insert_hil($vals) {
		$this->_ci->db->set('hil_id', $vals['hil_id']);
		$this->_ci->db->set('hil', $vals['hil']);
		$this->_ci->db->set('date', $vals['date']);
		$this->_ci->db->set('week', $vals['week']);
		$this->_ci->db->insert('trans_hil');
	}

	private function update_hil($vals) {
		$this->_ci->db->where('hil_id', $vals['hil_id']);
		$this->_ci->db->where('date', $vals['date']);
		$this->_ci->db->where('week', $vals['week']);
		$this->_ci->db->set('hil', $vals['hil']);
		$this->_ci->db->update('trans_hil');
	}

	public function __construct() {
		$this->_ci =& get_instance();
		$this->_ci->load->helper('formula');
	}

	public function get_data() {
		$this->_ci->db->where('date', date('Y-m-d'));
		$get = $this->_ci->db->get('swift');
		return $get->result_array();
	}

	public function matching_data($data = array()) {
		$this->_ci->load->model('AircraftReg_model');
		if (count($data) > 0) {
			foreach ($data as $key => $value) {
				$fic = $this->explode_fic($value['fault_code']);
				$check_fic = $this->matching_fic($fic['alp']);
				if (count($check_fic) > 0) {
					$alp_fic = $this->matching_num($fic['num']);
					$acreg = $this->_ci->AircraftReg_model->find($value['reg'], 'name_ac_reg');
					/*
					hil process
					*/
					$ac_type = $acreg['id_aircraft_type_fk'];
					$hil_data = $this->get_hil_id($ac_type);
					$hil['hil_id'] = $hil_data['hil_id'];
					$hil['date'] = date('Y-m-d');
					$hil['week'] = count_weeks();
					$hil['hil'] = 1;

					$is_hil_exist = $this->check_if_hil_exist($hil);
					if ($is_hil_exist !== FALSE) {
						$hil['hil'] = $is_hil_exist['hil'] + 1;
						//print_r($params); exit();
						$this->update_hil($hil);
					}
					else {
						$this->insert_hil($hil);	
					}
					
					//data for insert
					$params['acr_id'] = $acreg['id'];
					$params['fis_id'] = $check_fic['fis_id'];
					//data processing
					$items_data = $this->get_items($params['acr_id'], $params['fis_id']);	
					//
					$params['items'] = $items_data['items'];
					$params['defect'] = 1;
					$params['remark'] = $this->get_description($value['description']);
					$params['fi_id'] = $this->get_fi_id($params['fis_id']);
					$params['modified_date'] = date('Y-m-d');
					$params['week'] =  count_weeks();
					$params['ficDesc'] = $check_fic['fName'] . ' ' . $alp_fic['fName'];
					$params['additional'] = $value['notification_d3'] . ';' . $value['notification_d2'];
					//print_r($params); exit();
					$is_exist = $this->check_if_exist($params);
					if ($is_exist !== FALSE) {
						$params['defect'] = $is_exist['defects'] + 1;
						//print_r($params); exit();
						$this->update_functionality($params);
					}
					else {
						$this->insert_functionality($params);	
					}
				}
			}// end foreach

			$defects_item = $this->get_defects_item(); // item defects to matching closed problem
			if (count($defects_item) > 0) {
				foreach ($defects_item as $item) {
					if (count($data) > 0) {
						$closed = TRUE;
						foreach ($data as $key => $value) {
							$fic = $this->explode_fic($value['fault_code']);
							$check_fic = $this->matching_fic($fic['alp']);
							if (count($check_fic) > 0) {
								$alp_fic = $this->matching_num($fic['num']);
								$acreg = $this->_ci->AircraftReg_model->find($value['reg'], 'name_ac_reg');

								$params['acr_id'] = $acreg['id'];
								$params['fis_id'] = $check_fic['fis_id'];
								//data processing
								$items_data = $this->get_items($params['acr_id'], $params['fis_id']);	
								//
								$params['items'] = $items_data['items'];
								//$params['fi_id'] = $this->get_fi_id($params['fis_id']);

								if ($params['acr_id'] === $item['acr_id'] && $params['fis_id'] === $item['fis_id'] && $params['items'] === $item['items']) {
									$closed = FALSE;
									break;
								}
							}
						}
						if ($closed) {
							$this->trans_closed($item);
						}
					}
					else {
						$this->trans_closed($item);
					}
				}
			}

		} // if data from swift > 0
	}
}