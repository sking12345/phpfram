<?php

namespace common\model;
use vendor\cache;
use vendor\libs\cls_user;
use vendor\libs\interface_user;
use vendor\req;

class mod_user extends cls_user implements interface_user {

	public static $instance = null;

	public function __construct() {
		$session_id = req::$instance->get_session_id();
		$language = cache::get("language");
		if (empty($language)) {
			$language = "1";
		}

		$this->user_data = [
			"id" => "qwert5e4971ddd3803v",
			"name" => "ppp",
			"use_language" => "1",
			"language" => $language,
		];
	}

	public function is_login() {
		return true;
	}
	public function logout() {

	}
	public function login() {

	}
	public function get($key = "") {

	}
	public function set($key, $value) {

	}

}