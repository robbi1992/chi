<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
for php 5.3 >
function count_weeks() {
	$startDate = date_create('2015-12-28');
	$endDate = date_create(date('Y-m-d'));
	$diff = date_diff($startDate, $endDate);
	$weeks = ceil($diff->days / 7);
	return $weeks;
}*/

function count_weeks() {
	$startDate = '2015-12-28';
	$endDate = date('Y-m-d');
	$diff = abs(strtotime($endDate) - strtotime($startDate));
	$weeks = ceil(($diff / (60 * 60 * 24) / 7));
	return $weeks;
}

function year_report() {
	$years = array(
			date('Y'), date('Y') - 1
		);
	return $years;
}
function formula_trans_ext($data) {
	if(count($data) > 0) {
		foreach ($data as $key => $value) {
			if(isset($result[$value['itemId']])) {
				$result[$value['itemId']]['persen'] += $value['persen'];
				$result[$value['itemId']]['num'] += 1;
			}
			else {
				$result[$value['itemId']] = $value;
				$result[$value['itemId']]['num'] = 1;
			}
		}
		return array_values($result);
	}
	return array();
}
function persentase_exterior($id) {
	$value = array(
			4 => 100,
			3 => 98,
			2 => 85,
			1 => 75
		);
	if (array_key_exists($id, $value)) return $value[$id];
}

function bg_exterior($value) {
	if($value > 98 && $value <= 100) {
		$bg = 'progress-bar-aqua';
	}
	elseif($value > 87 && $value <= 98) {
		$bg = 'progress-bar-green';
	}
	elseif($value > 74 && $value <= 87) {
		$bg = 'progress-bar-yellow';
	}
	elseif($value >= 0 && $value <= 74) {
		$bg = 'progress-bar-red';
	}
	else {
		$bg = 'undefined';	
	}
	return $bg;
}

function bg_pt_exterior($value) {
	if($value > 98 && $value <= 100) {
		$bg = 'bg-aqua';
	}
	elseif($value > 87 && $value <= 98) {
		$bg = 'bg-green';
	}
	elseif($value > 74 && $value <= 87) {
		$bg = 'bg-yellow';
	}
	elseif($value >= 0 && $value <= 74) {
		$bg = 'bg-red';
	}
	else {
		$bg = 'undefined';	
	}
	return $bg;
}

function distinct_array($array, $parent) {
	if(count($array) > 0) {
		foreach ($array as $val) {
			if(isset($res[$val[$parent]])) {
			}
			else {
				$res[$val[$parent]] = array(
					'itemID' => $val['itemId'],
					'itemName' => $val['item']
				);
			}
		}
		return array_values($res);
	}
	return array();
}

function get_month() {
	$month = date('m');

	$months = array(
		'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'
	);
	$get = array_slice($months, 0, ($month));
	return $get;
}