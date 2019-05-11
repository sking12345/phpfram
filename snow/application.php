<?php

namespace snow;
use snow\config;
use snow\log;
use snow\req;
use snow\tpl;
use snow\user;

error_reporting("E_ALL");

class application {
	private $_configs;
	private $app_path;
	public function __construct($config) {
		$snow_config = require_once __DIR__ . "/configs/config.php";

		$ctl = req::item("ctl", "index");
		$act = req::item("act", "login");
		if (!empty($snow_config["ctls_app"]["{$ctl}_*"])) {
			$this->app_path = $snow_config["ctls_app"]["{$ctl}_*"];
		} else if (!empty($snow_config["ctls_app"]["{$ctl}_{$act}"])) {
			$this->app_path = $snow_config["ctls_app"]["{$ctl}_{$act}"];
		} else {
			$domain = $_SERVER["SERVER_NAME"];
			$this->app_path = $config["domain_app"][$domain];
		}
		$domain = $_SERVER["SERVER_NAME"];
		$app_path = $config["domain_app"][$domain];
		$configs = require_once __DIR__ . "/../{$app_path}/configs/web.php";
		$configs["view_path"] = __DIR__ . "/../{$this->app_path}/views/";
		if (file_exists(__DIR__ . "/../{$app_path}/configs/menus.xml")) {
			$configs["menus_xml_file"] = __DIR__ . "/../{$app_path}/configs/menus.xml";
		}
		$configs["app"]["path"] = $app_path;
		$this->_configs = array_merge($configs, $snow_config);
		config::init($this->_configs);
		$this->error_handler();
		$this->exception_handler();
	}

	public function run() {
		$ctl = req::item("ctl");
		$act = req::item("act");
		date_default_timezone_set($this->_configs["timezone"]);
		ob_start();
		if (user::is_login() == false) {
			if (!empty($this->_configs["public"][$ctl])) {
				$public_acts = $this->_configs["public"][$ctl];
				if (in_array($act, $public_acts)) {
					goto call;
				}
			}
			$login_verify = $this->_configs["app"]["login_verify"]; //登录验证
			if ($login_verify == true) {
				echo "<script>top.location.href='{$this->_configs["app"]["default_url"]}'</script>";
				exit;
			}
		}
		$purview_check = $this->_configs["app"]["purview_check"];
		if (!empty($purview_check) && call_user_func($purview_check)) {
			if (req::is_browser()) {
				tpl::redirect(-1, "权限不足(Insufficient permissions)");
			} else {
				echo json_encode(["code" => "-1", "msg" => "权限不足(Insufficient permissions)"]);
			}
			exit;
		}
		call:

		$call_ctl = "\\{$this->app_path}\\controlls\\ctl_{$ctl}";
		(new $call_ctl())->$act();
	}

	public function error_handler() {
		set_error_handler(function ($error_level, $error_message, $file, $line) {
			$EXIT = FALSE;
			switch ($error_level) {
			case E_NOTICE:
			case E_USER_NOTICE:
				$error_type = 'Notice';
				break;
			case E_WARNING:
			case E_USER_WARNING:
				$error_type = 'Warning';
				break;
			case E_ERROR:
			case E_USER_ERROR:
				$error_type = 'Fatal Error';
				$EXIT = TRUE;
				break;
			default:
				$error_type = 'Unknown';
				$EXIT = TRUE;
				break;
			}
			log::set_errr($error_message, $file, $line);
		});
	}
	public function exception_handler() {
		set_exception_handler(function ($e) {
			$info = $e->getTrace();
			log::set_errr($e->getMessage(), $info[0]["file"], $info[0]["line"], $e->getTrace());
		});
		register_shutdown_function(function () {
			if (!empty($this->_configs["shutdown_call"])) {
				$call_function = $this->_configs["shutdown_call"];
				if (!empty($call_function)) {
					call_user_func($call_function);
				}
			}
		});
	}
	public function __destruct() {

	}

}
