<?php
namespace snow;
use snow\cache;
use snow\config;
use snow\util;

class req {

	protected static $call_args;
	protected static function addslashes($str) {
		if (!get_magic_quotes_gpc()) {
			return addslashes(trim($str));
		} else {
			return trim($str);
		}
	}
	public static function action() {
		return $_SERVER["HTTP_REFERER"];
	}
	/**
	 * [session_id 为每个访问浏览器 分配一个ID]
	 * @return [type] [description]
	 */
	public static function browser_id() {
		$session_name = config::$obj->app->get("session_key");
		if (!empty($session_name)) {
			return $session_name;
		}
		return md5(util::get_ip());
	}

	/**
	 * [is_browser 是否为浏览器访问]
	 * @return boolean [description]
	 */
	public static function is_browser() {
		return empty(util::get_browser()) ? false : true;
	}

	/**
	 * [is_get 是否为get请求]
	 * @return boolean [description]
	 */
	public static function is_get() {
		return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
	}
	/**
	 * [is_get 是否为get请求]
	 * @return boolean [description]
	 */
	public static function is_post() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$crsh_token = self::item("_crsh_token_");
			$crsh_token_val = cache::get($crsh_token);
			if ($crsh_token_val == false) {
				return false;
			}
			$browser_id = req::browser_id();
			if ($crsh_token_val != $browser_id) {
				return false;
			}
			return true;
		}
		return false;
	}
	/**
	 * [isAjax 是否为ajax 请求]
	 * @return boolean [description]
	 */
	public static function is_ajax() {
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * [set_call_args 设置模版里的调用其他方法的参数]
	 * @param [type] $val [description]
	 */
	public static function set_call_args($val) {
		self::$call_args = $val;
	}
	/**
	 * [get_call_args 获取模版回调模块的参数]
	 * @param  string $key [如果不等于空，返回键值=key 的值,否则返回call_args]
	 * @return [type]      [description]
	 */
	public static function get_call_args(string $key = '') {
		if (empty($key)) {
			return self::$call_args;
		}
		if (empty(self::$call_args[$key])) {
			return false;
		}
		return self::$call_args[$key];
	}

	public static function item($key, $default = null) {
		if (empty($_REQUEST[$key])) {
			return $default;
		}
		return self::addslashes($_REQUEST[$key]);
	}

	public static function get_data(array $data = []) {
		if (empty($data)) {
			$data = $_GET;
		}
		$_data = [];
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$_data[$key] = self::get_data($value);
			} else {
				$_data[$key] = self::addslashes($value);
			}
		}
		return $_data;
	}
	/**
	 * [get_post_data 获取表post单数据]
	 * @return [type] [description]
	 */
	public static function post_data(array $data = []) {
		if (empty($data)) {
			$data = $_POST;
			unset($data["ctl"]);
			unset($data["act"]);
			unset($data["_crsh_token_"]);
		}
		$_data = [];
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$_data[$key] = self::post_data($value);
			} else {
				$_data[$key] = self::addslashes($value);
			}
		}
		return $_data;
	}
}
