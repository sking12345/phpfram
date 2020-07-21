<?php

namespace vendor;
use vendor\cache;
use vendor\configs;
use vendor\req;

class tpl {

	private static $assign_data = [];

	public static $instance;
	private $_keys = [];

	public function __get($key) {
		$this->_keys[] = $key;
		// echo $key;
		return $this;
	}

	public static function _init() {
		self::$instance = new tpl();
		$show_msg = cache::get(req::$instance->get_session_id());
		self::$assign_data["show_msg"] = json_decode($show_msg, true);
		cache::del(req::$instance->get_session_id());

	}

	public function get($key = "", $defalut = "") {
		if (!empty($key)) {
			$this->_keys[] = $key;
		}

		$assign_data = self::$assign_data;
		foreach ($this->_keys as $key => $value) {
			if (empty($assign_data[$value])) {
				$this->_keys = [];
				return null;
			}
			$assign_data = $assign_data[$value];
		}

		$this->_keys = [];
		if (empty($assign_data)) {
			return $defalut;
		}
		return $assign_data;
	}

	public function get_json($key = "", $defalut = '') {
		if (!empty($key)) {
			$this->_keys[] = $key;
		}
		$assign_data = self::$assign_data;
		foreach ($this->_keys as $key => $value) {
			if (empty($assign_data[$value])) {
				$this->_keys = [];
				return json_encode($defalut);
			}
			$assign_data = $assign_data[$value];
		}
		$this->_keys = [];
		if (empty($assign_data)) {

			return json_encode($defalut);
		}
		return json_encode($assign_data);
	}

	public static function assign($key, $data) {
		self::$assign_data[$key] = $data;
	}

	public static function get_assign($key = "", $defalut = "") {
		if (!empty($key)) {
			if (!empty(self::$assign_data[$key])) {
				return self::$assign_data[$key];
			}
			return $defalut;
		}
		return self::$assign_data;
	}
	public static function get_assign_json($key = "", $defalut = "") {

		if (!empty($key)) {
			if (!empty(self::$assign_data[$key])) {

				return json_encode(self::$assign_data[$key]);

			}
			return json_encode($defalut);

		}
		return json_encode(self::$assign_data);
	}

	public static function display($tpl, bool $common = false) {
		if ($common == false) {
			$template_path = configs::$instance->get("tpl_path");
			require_once $template_path . $tpl;
		} else {
			require_once ROOT_PATH . "common/template/{$tpl}";
		}
	}

	public static function include_tpl($tpl, bool $common = false, $other_parames = []) {
		if ($common == false) {
			$template_path = configs::$instance->get("tpl_path");
			require_once $template_path . $tpl;
		} else {
			require_once ROOT_PATH . "common/template/{$tpl}";
		}
	}

	public static function back_show($go = "-1", $msg = "") {
		echo "<script>history.go(-1);</script>";
		exit;
	}

	public static function show(string $msg = "", bool $status = true, $url_arr = "") {

		$url_parames = [];
		if (empty($url_arr)) {
			$url_str = "";
		} else {
			if (empty($url_arr["ct"])) {
				$url_arr["ct"] = req::$instance->item("ct");
			}
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
		}
		if (req::is_ajax() == true) {
			echo json_encode(["url" => $url_str, "msg" => $msg, "status" => $status]);
		} else {
			cache::set(req::$instance->get_session_id(), json_encode(["msg" => $msg, "status" => $status]));
			header("Location:{$url_str}");
		}
		exit;
	}
}
?>






















