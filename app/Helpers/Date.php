<?php
if (!function_exists('get_time_miliseconds')) {
	function get_time_miliseconds() {
        $micro_time = microtime(true);
        $milliseconds = round($micro_time * 1000);
        return $milliseconds;
    }
}

if (!function_exists('get_range_date')) {
	function get_range_date($from_date = null,$to_date = null) {
		$total_range = ((abs(strtotime ($to_date) - strtotime ($from_date)))/(60*60*24));
		return $total_range + 1;
	}
}

if (!function_exists('get_addition_date')) {
	function get_addition_date($from_date,$total) {
		$total = $total-1;
		$from_date = $from_date;// start of definition
		$to_date = date('Y-m-d', strtotime("+$total days", strtotime($from_date)));
		return $to_date;
	}
}