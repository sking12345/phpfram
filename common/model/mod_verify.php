<?php

namespace common\model;

class mod_verify {

	public static function err_call($err_info) {
		print_r($err_info);
		//tpl::show($url_arr, $msg, $status)

		return;
	}

	/*
		 * 验证是否登录
	*/
	public static function run_before() {

	}

	public static function run_after() {

	}
}