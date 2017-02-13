<?php
if (!function_exists('get_time_miliseconds')) {
	function get_time_miliseconds() {
        $micro_time = microtime(true);
        $milliseconds = round($micro_time * 1000);
        return $milliseconds;
    }
}