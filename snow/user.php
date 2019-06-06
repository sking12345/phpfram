<?php
namespace snow;
use snow\cache;
use snow\config;
use snow\cookie;
use snow\req;
use snow\util;

class user {
	protected static $auth = [];
	public static $instance = null;
	private $_keys = [];
	public static function _init() {
		if (empty(self::$instance)) {
			self::$instance = new user();
		}
		if (empty(self::$auth)) {
			self::is_login();
		}
	}
	public static function is_login() {
		$browser_id = req::browser_id();
		$session_id = req::item($browser_id); //如果访问参数中没有broser_id 则获取cookie 中获取id
		if (empty($session_id)) {
			$session_id = cookie::get($browser_id);
		}

		if (empty($session_id)) {
			return false;
		}

		$user_info = cache::get($session_id);

		if (empty($user_info)) {
			return false;
		}
		self::$auth = json_decode($user_info, true);
		self::$auth["browser_id"] = $browser_id;
		self::$auth["session_id"] = $session_id;
		$time = config::$obj->app->get("login_status_time");
		cookie::set($browser_id, $session_id, $time);
		cache::set($session_id, $user_info, $time);
		return true;
	}
	public static function set_info($info) {
		$browser_id = req::browser_id();
		$session_id = util::create_uniqid(16);
		$info["browser_id"] = $browser_id;
		$info["session_id"] = $session_id;
		$time = config::$obj->app->get("login_status_time");
		cookie::set($browser_id, $session_id, $time);
		cache::set($session_id, json_encode($info), $time);
		self::$auth = $info;
		return true;
	}

	public static function out() {
		$browser_id = req::browser_id();
		$session_id = req::item($browser_id); //如果访问参数中没有broser_id 则获取cookie 中获取id
		if (empty($session_id)) {
			$session_id = cookie::get($browser_id);
		}
		if (empty($session_id)) {
			return true;
		}
		cookie::del($browser_id);
		return cache::del($session_id);
	}

	public function get(string $key = '') {
		if (!empty($key)) {
			$this->_keys[] = $key;
		}
		$configs = self::$auth;
		foreach ($this->_keys as $key => $value) {
			if (empty($configs[$value])) {
				$this->_keys = [];
				return null;
			}
			$configs = $configs[$value];
		}

		$this->_keys = [];
		return $configs;
	}

	public function __get($key) {
		$this->_keys[] = $key;
		return $this;
	}

}
