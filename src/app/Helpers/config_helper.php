<?php

if (!function_exists('get_config')) {
	function get_config($key) {
		return service('configs')->getConfig($key);
	}
}

if (!function_exists('get_config_group')) {
	function get_config_group($group) {
		return service('configs')->getConfigByGroup($group);
	}
}