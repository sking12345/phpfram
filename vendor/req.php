<?php

namespace vendor;

class req {

	public static $instance = null;
	private $get_parames = [];
	private $post_parames = [];
	private $parames = [];
	private $session_key;

	public static function _init() {
		if (empty(self::$instance)) {
			self::$instance = new self();
		}
	}

	public function __construct() {
		$this->get_parames = $_GET;
		$this->post_parames = $_POST;
		$this->parames = $_REQUEST;
		unset($_GET);
		unset($_POST);
		unset($_REQUEST);
		self::$instance = $this;
	}

	public function get($key, $default = "") {
		if (empty($this->get_parames[$key])) {
			return $default;
		}
		$str = $this->get_parames[$key];
		if (!get_magic_quotes_gpc()) {
			return addslashes(htmlspecialchars(trim($str), ENT_NOQUOTES));
		} else {
			return htmlspecialchars(trim($str));
		}
	}

	public function get_url() {
		$parames = [];

		foreach ($this->get_parames as $key => $value) {
			$parames[] = "{$key}={$value}";
		}

		return $_SERVER["SCRIPT_NAME"] . "?" . implode("&", $parames);
	}

	public function post($key, $default = "") {
		if (empty($this->post_parames[$key])) {
			return $default;
		}
		$str = $this->post_parames[$key];
		if (!get_magic_quotes_gpc()) {
			return addslashes(htmlspecialchars(trim($str), ENT_NOQUOTES));
		} else {
			return htmlspecialchars(trim($str));
		}
	}

	public function item($key, $default = "") {

		if (empty($this->parames[$key])) {
			return $default;
		}
		$str = $this->parames[$key];
		if (!get_magic_quotes_gpc()) {
			return addslashes(htmlspecialchars(trim($str), ENT_NOQUOTES));
		} else {
			return htmlspecialchars(trim($str));
		}
		return null;
	}

	public function get_datas(array $data = []) {
		if (empty($data)) {
			$data = $this->get_parames;
		}
		$_data = [];
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$_data[$key] = self::get_data($value);
			} else {

				if (!get_magic_quotes_gpc()) {
					$_data[$key] = addslashes(htmlspecialchars(trim($value), ENT_NOQUOTES));
				} else {
					$_data[$key] = htmlspecialchars(trim($value));
				}
			}
		}
		return $_data;
	}

	public function post_datas(array $data = []) {
		if (empty($data)) {
			$data = $this->post_parames;
		}
		$_data = [];
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$_data[$key] = self::post_datas($value);
			} else {

				if (!get_magic_quotes_gpc()) {
					$_data[$key] = addslashes(htmlspecialchars(trim($value), ENT_NOQUOTES));
				} else {
					$_data[$key] = htmlspecialchars(trim($value));
				}
			}
		}
		return $_data;
	}

	public static function is_post() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return true;
		}
		return false;
	}

	public static function is_ajax() {
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return true;
		} else {
			return false;
		}
	}

	public function create_url(array $url_arr) {
		$url_parames = [];
		$url_model = configs::$instance->get("url_model");
		$model_name = configs::$instance->get("model_name");
		if ($url_model == "1" || $url_model == "2") {
			foreach ($url_arr as $key => $value) {
				$url_parames[] = "{$key}={$value}";
			}
			$url_str = "?model={$model_name}&";
			$url_str .= implode("&", $url_parames);
		} else {
			if (!empty($url_arr["model"])) {
				$url_str = "/{$url_arr["model"]}";
			}
			$url_str .= "/{$url_arr["ct"]}/{$url_arr["ac"]}";
			foreach ($url_arr as $key => $value) {
				$url_parames[] = "{$key}={$value}";
			}
			$url_str .= implode("?", $url_parames);
		}
		return $url_str;
	}

	/**
	 *  用于session_id
	 */
	public function get_session_id() {
		if (!empty($this->session_key)) {
			return $this->session_key;
		}
		$session_key = configs::$instance->get("session_key");
		if ($session_key == false) {
			$cookie_key = configs::$instance->get("cookieValidationKey");
			$ip = util::get_ip();
			$this->session_key = md5($ip . $cookie_key);
		} else {
			$this->session_key = $session_key;
		}
		return $this->session_key;
	}
}
?>

















