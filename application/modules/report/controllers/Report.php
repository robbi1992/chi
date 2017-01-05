<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

	public function __construct() {
        parent::__construct();
       ini_set('max_execution_time', 1800);
    }

	private function get_performance_exterior($data, $week = NULL) {
		foreach ($data['list'] as  $val) {
			$perf['ext'] = 0;
			$params = array('acType' => $val->id, 'acTypeName' => $val->name_aircraft);
			$list_reg = $this->AircraftReg_model->list_by($params);
			
			foreach ($list_reg['result'] as $value) { //exterior value by ac registered
				$ext = $this->get_exterior_performance($value['id'], FALSE, $week);
           		$perf['ext'] += $ext['scoring'];
			}
			$data['categories'][] = $val->name_aircraft;
			$data['performances'][] = parsing_float($perf['ext'] / (count($list_reg['result'])));
			$data['targets'][] = 92.76; 
		}
		return $data;
	}

	private function get_performance_interior($data, $week = NULL) {
		$this->load->model('trans_interior_new_model');
		foreach ($data['list'] as  $type) {
			$params = array('acType' => $type->id, 'acTypeName' => $type->name_aircraft);
			$list_reg = $this->AircraftReg_model->list_by($params);
			$int['sumType'] = 0;
			foreach ($list_reg['result'] as $value) { //interior value by ac registered
				$items = $this->get_items($value['id']);
			    $params['acReg'] = $value['id'];
			    $int['sum'] = 0;
			    $int['num'] = 0;
			            
			    //print_r($items); exit();
			    if(count($items) > 0) {
			        foreach ($items as $val) {
			            $params['cabinArea'] = $val->ini_id;
			            $res = $this->trans_interior_new_model->get_transactions($params, FALSE, $week);
			            if (count($res) > 0) {
			            	$cabin = $this->global_performance_area($res);
			            	$weight = $this->get_items($params['acReg'], TRUE, $params['cabinArea']);
			            	$countIT = ($cabin['performance'] * $weight[0]->weight);
			            	$int['sum'] += $countIT;
			            	$int['num'] += $weight[0]->weight;	
			            }
			            else {
			            	$int['sum'] = 100;
			            	$int['num'] = 1;	
			            } 
			            
			        }
			        $perf['int'] = parsing_float($int['sum'] / $int['num']);
			    }
			    else {
			        $perf['int'] = 100;   
			    }
			    $int['sumType'] += $perf['int'];   
			}

			$data['categories'][] = $type->name_aircraft;
			$data['performances'][] = parsing_float($int['sumType'] / (count($list_reg['result']))); 
			$data['targets'][] = 96.30;
		}

		return $data;
	}

	private function get_performance_function($data, $week = NULL) {
		$this->load->model('trans_functionality_model');
		foreach ($data['list'] as  $type) {
			$params = array('acType' => $type->id, 'acTypeName' => $type->name_aircraft);
			$list_reg = $this->AircraftReg_model->list_by($params);//get list of acreg by type
			$func_type_perf = 0;
			foreach ($list_reg['result'] as $value) {
				$trans_func = $this->trans_functionality_model->get_transactions(array('id' => $value['id']), $week);//get per reg
				//print_r($trans_func); exit();
            	if(count($trans_func)) {
            	    $perform_per_reg = 0;
            	    foreach ($trans_func as $i => $v) { //perform per reg
            	        $perform_per_reg += (($v['items'] - $v['defects']) / $v['items']) * 100;
            	    }
            	    $perf['func'] = $perform_per_reg / count($trans_func);   
            	}
            	else {
            	    $perf['func'] = 100;
            	}
            	$func_type_perf += $perf['func'];//perfom per type
			}

			$data['categories'][] = $type->name_aircraft;
			$data['performances'][] = parsing_float($func_type_perf / count($list_reg['result']));
			$data['targets'][] = 99.72;
		}
		return $data;
	}
    // public function beginning
	public function index() {
		$this->load->model('AircraftType_model');
		$this->load->model('trans_functionality_model');
		$this->load->helper('formula');
		$data['func_items'] = $this->trans_functionality_model->get_func_items();
        $data['list'] = $this->AircraftType_model->list_name();

        $func_per_area = $this->trans_functionality_model->get_transactions_area();
        //print_r($func_per_area); exit();
        foreach ($func_per_area as $value) {
        	if(isset($result[$value['fi_id']])) {
				$result[$value['fi_id']]['perform'] += (($value['items'] - $value['defects']) / $value['items']) * 100;
				$result[$value['fi_id']]['num'] += 1;
			}
			else {
				$result[$value['fi_id']] = $value;
				$result[$value['fi_id']]['perform'] = (($value['items'] - $value['defects']) / $value['items']) * 100;
				$result[$value['fi_id']]['num'] = 1;
			}
        }
        $next_area = array_values($result);
        //print_r($next_area); exit();
        $zero = 0;
        foreach ($next_area as $v) {
        	if($v['fi_id'] == 1 OR $v['fi_id'] == 2 OR $v['fi_id'] == 3) {
        		$zero += $v['perform'] / $v['num'];
        		$array_push[0] = array(
        				'funcName' => 'Seat',
        				'funcPerform' => parsing_float($zero / 3)
        			);
        	}
        	else {
        		$new_array[] = array(
        			'funcName' => $v['fi_name'],
        			'funcPerform' => parsing_float($v['perform'] / $v['num'])
        		);
        	} 
        }
        $data['func_status'] = array_merge($new_array, $array_push);
        //print_r($data['func_status']); exit();
		$this->load->view('bar_chart', $data);
		//$this->page->view('dashboard');
		//$this->page->view('report');
	}

	public function cabin_performance_dashboard() {
		$this->load->model('AircraftType_model');
        $view['type'] = $this->AircraftType_model->list_name();

		if($this->input->is_ajax_request()) {
			//s$this->load->model('AircraftType_model');
			$this->load->model('AircraftReg_model');

        	$data['list'] = $this->AircraftType_model->list_name();

			$param = json_decode($this->input->raw_input_stream, TRUE); 
			
			if($param['type'] == 1) {
				$final_result = $this->get_performance_function($data);
			}
			elseif($param['type'] == 2) {
				$final_result = $this->get_performance_interior($data);
				//print_r($data['list']); exit();
			}
			elseif($param['type'] == 3) {
				$final_result = $this->get_performance_exterior($data);	
			}

			$result['performances'] = $final_result['performances'];
			$result['categories'] = $final_result['categories'];
			$result['targets'] = $final_result['targets'];

			$this->json_output($result);
		}
		else {
			$this->page->view('cabin_chart', $view);	
		}
	}

	public function cabin_per_registered() {
		$param = json_decode($this->input->raw_input_stream, TRUE);
		$categories = array();
		$performances = array();
		$targets = array();
		
		if($param['type'] == 3) {
			$ext = $this->get_exterior_performance($param['acReg'], TRUE);
            $new_ext = formula_trans_ext($ext['result']);
            //print_r($new_ext); exit();
            $this->load->model('trans_exterior_model');
            $targets_real = $this->trans_exterior_model->get_targets();
            foreach ($new_ext as $v) {
            	$categories[] = $v['item'];
				$performances[] = parsing_float($v['persen'] / $v['num']);
				$targets[] = $targets_real[$v['itemId']]; 
            }
		}
		elseif($param['type'] == 2) {
			$this->load->model('trans_interior_new_model');
			//$params = array('acReg' => $regID);
        	$items = $this->trans_interior_new_model->get_transactions($param, TRUE);
        	$items_performance = $this->items_performance($items);
        	$cabin_performance = $this->cabin_performance($items_performance);
        	//print_r($cabin_performance); exit();
        	$targets_real = $this->trans_interior_new_model->get_targets();
        	foreach ($cabin_performance as $vals) {
        		$categories[] = $vals['iniName'];
        		$performances[] = parsing_float((($vals['defectPerform'] / $vals['num']) * 0.6) + (($vals['defectPerform'] / $vals['num']) * 0.4)); 
        		$targets[] = $targets_real[$vals['iniID']]; 
        	}
		}
		elseif($param['type'] == 1) {
			$func_result = $this->func_linechart($param['acReg']);
			$targets_real = $this->trans_functionality_model->get_targets();
			//print_r($func_result); exit();
			foreach ($func_result as $vals) {
				$performances[] = parsing_float($vals['perform'] / $vals['num']);
				$categories[] = $vals['fi_name'];
				$targets[] = $targets_real[$vals['fi_id']];
			}
		}
		$result['performances'] = $performances;
		$result['categories'] = $categories;
		$result['targets'] = $targets;

		$this->json_output($result);
	}

	public function get_ac_reg() {
		$this->load->model('AircraftReg_model');
		$param = json_decode($this->input->raw_input_stream, TRUE); 
		$list_reg = $this->AircraftReg_model->list_by($param);		
		
		$this->json_output($list_reg['result']);
	}

	public function get_type_data() {
		$this->load->model('AircraftReg_model');
		$this->load->model('trans_interior_new_model');
		$this->load->model('trans_functionality_model');

		$param = json_decode($this->input->raw_input_stream, TRUE); 
		$list_reg = $this->AircraftReg_model->list_by($param);
		
		foreach ($list_reg['result'] as $value) {
			$categories[] = $value['name_ac_reg']; //categories for chart
			//functionality
            $trans_func = $this->trans_functionality_model->get_transactions(array('id' => $value['id']));
            if(count($trans_func)) {
                $perform_per_reg = 0;
                foreach ($trans_func as $i => $v) {
                    $perform_per_reg += (($v['items'] - $v['defects']) / $v['items']) * 100;
                }
                $result['func'] = $perform_per_reg / count($trans_func);   
            }
            else {
                $result['func'] = 100;
            }
            //end functionality
			$items = $this->get_items($value['id']);
            $params['acReg'] = $value['id'];
            $int['sum'] = 0;
            $int['num'] = 0;
            //print_r($items); exit();
            if(count($items) > 0) {
                foreach ($items as $val) {
                    $params['cabinArea'] = $val->ini_id;
                    $res = $this->trans_interior_new_model->get_transactions($params);
                    $cabin = $this->global_performance_area($res);
                    $weight = $this->get_items($params['acReg'], TRUE, $params['cabinArea']);
                    $countIT = ($cabin['performance'] * $weight[0]->weight);
                    $int['sum'] += $countIT;
                    $int['num'] += $weight[0]->weight;
                }
                $result['int'] = parsing_float($int['sum'] / $int['num']);
            }
            else {
                $result['int'] = 100;   
            }
            $ext = $this->get_exterior_performance($value['id']);
            $result['ext'] = $ext['scoring']; 

            $performances[] = parsing_float(($result['ext'] + $result['int'] + $result['func']) / 3);
		}
		$sort = FALSE;
		if ($param['acTypeSort'] == 0) $sort = TRUE;

		$sorted = $this->type_sort_by(array('performances' => $performances, 'categories' => $categories), $sort);
		//print_r($sorted); exit();
		$data['performances'] = $sorted['performances'];
		$data['categories'] = $sorted['categories'];
		$this->json_output($data);
	}

	private function type_sort_by($data = array(), $low = FALSE) {
		arsort($data['performances'], SORT_NUMERIC);
		if ($low) sort($data['performances'], SORT_NUMERIC);
		foreach ($data['performances'] as $i => $v) {
			$new['categories'][$i] = $data['categories'][$i];
		}

		$result['performances'] = array_slice($data['performances'], 0, 5);
		$result['categories'] = array_slice($new['categories'], 0, 5);
		return $result;
	}

	public function gauge() {
		$this->load->model('AircraftType_model');
		$this->load->model('AircraftReg_model');
        $data['list'] = $this->AircraftType_model->list_name();

        $param = json_decode($this->input->raw_input_stream, TRUE); 

        $func = $this->get_performance_function($data, $param['valWeek']);
        $int = $this->get_performance_interior($data, $param['valWeek']);
        $ext = $this->get_performance_exterior($data, $param['valWeek']);
        $perform = parsing_float(((array_sum($func['performances']) / count($func['performances']))
        		+ (array_sum($int['performances']) / count($int['performances']))
        		+ (array_sum($ext['performances']) / count($ext['performances']))
        	) / 3);
        //print_r($ext); exit();
        $result['perform'][] = $perform;
        $this->json_output($result);
	}

	public function hil() {
		$this->load->model('trans_hil_model');
		$param = json_decode($this->input->raw_input_stream, TRUE);

		$trans = $this->trans_hil_model->get_transactions($param['valWeek']);
		//print_r($trans);
		if (count($trans) > 0) {
			foreach ($trans as $vals) {
				$rows_ac = $this->trans_hil_model->get_rows_actype($vals['ac_type']);
				if(isset($temp[$vals['type']])) {
					$temp[$vals['type']]['ratio'] += $vals['hil'] / $rows_ac;
					//$temp[$vals['type']]['num'] += 1;
					$temp[$vals['type']]['ratio'] = parsing_float($temp[$vals['type']]['ratio'] / 2);
					$ratios[$vals['type']] = $temp[$vals['type']]['ratio'];
				}
				else {
					$temp[$vals['type']] = $vals;
					$temp[$vals['type']]['ratio'] = parsing_float($vals['hil'] / $rows_ac);
					//$temp[$vals['type']]['num'] = 1;
					$ratios[$vals['type']] = $temp[$vals['type']]['ratio'];
				}
				//$ratios[] = parsing_float($vals['hil'] / $rows_ac);
			}
			//print_r(array_values($temp)); exit();
			$result['ratios'] = array_values($ratios); 
			$result['targets'] = array(3.5, 1.5);
		}
		else {
			$result['ratios'] = array(0, 0); 
			$result['targets'] = array(3.5, 1.5);
		}
		$this->json_output($result);
	}

	private function function_yearly($array = array()) {
		if ($array > 0) {
			$a = array();
			foreach ($array as $val) {
				$month = date('m', strtotime($val['modified_date']));
				if (isset($a[$month])) {
					$a[$month][] = $val;
				}
				else {
					$a[$month] = array($val);
				}
			}
			if (count($a) > 0) {
				foreach ($a as $key => $value) {
					$sum = 0;
					foreach ($a[$key] as $v) {
						$sum += (($v['items'] - $v['defects']) / $v['items']) * 100;
					}
					$perf[] = parsing_float($sum / count($a[$key]));
				}
			}
			else {
				$perf[] = 100;
			}
		}
		else {
			$months = get_month();
			foreach ($months as $value) {
				$perf[] = 100;
			}
		} 
		return $perf;
	}

	private function interior_yearly($year) {
		$this->load->model('trans_interior_new_model');
		$data = $this->trans_interior_new_model->get_trans_yearly($year);
		if (count($data) > 0) {
			foreach ($data as $val) {
				$month = date('m', strtotime($val['modified_date']));
				if (isset($a[$month])) {
					$a[$month][] = $val;
				}
				else {
					$a[$month] = array($val);
				}
			}
		
			foreach ($a as $key => $value) {
				$sum = 0;
				foreach ($a[$key] as $v) {
					$defect = (($v['total_item'] - $v['total_defect']) / $v['total_item']) * 100;
					$dirty = (($v['total_item'] - $v['total_dirty']) / $v['total_item']) * 100;
					$sum += ($defect * 0.6) + ($dirty * 0.4);
				}
				$perf[] = parsing_float($sum / count($a[$key]));
			}
		}
		else {
			$months = get_month();
			foreach ($months as $value) {
				$perf[] = 100;
			}
		}
		
		return $perf;
	}

	private function exterior_yearly($year) {
		$this->load->model('trans_exterior_model');
		$data = $this->trans_exterior_model->get_trans_yearly($year);
		if (count($data) > 0) {
			foreach ($data as $val) {
				$month = date('m', strtotime($val['te_date']));
				if (isset($a[$month])) {
					$a[$month][] = $val;
				}
				else {
					$a[$month] = array($val);
				}
			}

			foreach ($a as $key => $value) {
				$sum = 0;
				foreach ($a[$key] as $v) {
					$sum += persentase_exterior($v['te_value']);
				}
				$perf[] = parsing_float($sum / count($a[$key]));
			}	
		}
		else {
			$months = get_month();
			foreach ($months as $value) {
				$perf[] = 100;
			}	
		}
		
		return $perf;
	}

	public function hil_yearly($data) {
		if (count($data) > 0) {
			foreach ($data as $val) {
				$month = date('m', strtotime($val['date']));
				if (isset($a[$month])) {
					$a[$month][] = $val;
				}
				else {
					$a[$month] = array($val);
				}
			}

			foreach ($a as $key => $value) {
				$sumWB = 0;
				$sumNB = 0;
				$numWB = 0;
				$numNB = 0;
				foreach ($a[$key] as $v) {
					$rows_ac = $this->trans_hil_model->get_rows_actype($v['ac_type']);
					if ($v['type'] == 1) {
						$sumWB += $v['hil'] / $rows_ac;
						$numWB++; 	
					} 
					else {
						$sumNB += $v['hil'] / $rows_ac;
						$numNB++;	
					}
				}
				if ($numWB == 0 ) $numWB = 1;
				if ($numNB == 0) $numNB = 1;
				$result['WB'][] = parsing_float($sumWB / $numWB);
				$result['NB'][] = parsing_float($sumNB / $numNB);
			}	
		}
		else {
			$months = get_month();
			foreach ($months as $value) {
				$result['WB'][] = 0;
				$result['NB'][] = 0;
			}
		}
		return $result;			
	}

	public function trend_kpi_cabin() {
		$param = json_decode($this->input->raw_input_stream, TRUE);
		$this->load->helper('formula');
		if($param['typeTrend'] == 1) {
			$this->load->model('trans_functionality_model');
			
			$func = $this->trans_functionality_model->get_trans_yearly($param['timeTrend']);
			$monthly_func = $this->function_yearly($func);
			$monthly_int = $this->interior_yearly($param['timeTrend']);
			$monthly_ext = $this->exterior_yearly($param['timeTrend']);

			$result['performances']['functionality'] = $monthly_func;
			$result['performances']['interior'] = $monthly_int;
			$result['performances']['Exterior'] = $monthly_ext;
			$result['categories'] = get_month();
			$result['type'] = 'non-hil';
		}
		else {
			$this->load->model('trans_hil_model');
			$hil_yearly = $this->trans_hil_model->get_trans_yearly($param['timeTrend']);
			$hils = $this->hil_yearly($hil_yearly);
			$result['performances']['HLWB'] = $hils['WB'];
			$result['performances']['HLNB'] = $hils['NB'];
			$result['categories'] = get_month();
			$result['type'] = 'hil';
		}

		$this->json_output($result);
	}

	public function func_area_performance() {
		$this->load->model('trans_functionality_model');
		$this->load->model('AircraftReg_model');

		$param = json_decode($this->input->raw_input_stream, TRUE); 
		$acType = $param['acTypeFunc'];
		$cabin = $param['cabinFunc'];
		$list_reg = array();
		if (!empty($acType)) $list_reg = $this->AircraftReg_model->get_params($acType);
		if (isset($param['galleyArea'])) {
			$galley = $param['galleyArea'];
		}
		else $galley = '';
		$trans = $this->trans_functionality_model->get_trans_chart($list_reg, $cabin, $galley);
		$result['data'] = array();
		foreach ($trans as $value) {
			$result['data'][] = array(
					'acReg' => $value['name_ac_reg'],
					//'performance' => parsing_float((($value['items'] - $value['defects']) / $value['items']) * 100),
					'ca' => $value['corrective_action'],
					'desc' => $value['remark']
				);	
		}
		$this->json_output($result);
	}

	public function kcms_performance() {
		$this->load->model('AircraftType_model');
		$this->load->model('AircraftReg_model');
		$data['list'] = $this->AircraftType_model->list_name();

		$param = json_decode($this->input->raw_input_stream, TRUE);

		$result = array();
		$func = $this->get_performance_function($data, $param['valWeek']);
		$perf_func = parsing_float(array_sum($func['performances']) / count($func['performances']));
		$int = $this->get_performance_interior($data, $param['valWeek']);
        $perf_int = array_sum($int['performances']) / count($int['performances']);
        $ext = $this->get_performance_exterior($data, $param['valWeek']);
        $perf_ext = array_sum($ext['performances']) / count($ext['performances']);

		$result['categories'] = array('Function', 'Interior', 'Exterior');
		$result['performances'] = array($perf_func, $perf_int, $perf_ext);
		$result['targets'] = array(99.72, 96.30, 92.76);
		$this->json_output($result);
	}
}