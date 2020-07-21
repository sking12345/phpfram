<?php
namespace vendor;
class configs {

	public static $instance = null;
	public $configs_parames = [];
	private $_keys = [];

	public static function _init() {
		if (empty(self::$instance)) {
			self::$instance = new self();
		}
	}
	public function __construct() {
		self::$instance = $this;
	}

	public function load_config($app_config_path) {
		if (file_exists($app_config_path) == false) {
			return true;
		}
		$this->configs_parames = require_once $app_config_path;

	}

	public function __get($key) {
		$this->_keys[] = $key;
		// echo $key;
		return $this;
	}

	public function __set($key, $val) {
		$this->configs_parames[$key] = $val;
	}

	public function get(string $key = '') {
		$configs = $this->configs_parames;
		if (!empty($key)) {
			$this->_keys[] = $key;
		}
		if (!empty($this->_keys)) {
			foreach ($this->_keys as $key => $value) {
				if (empty($configs[$value])) {
					$this->_keys = [];
					return null;
				}
				$configs = $configs[$value];
			}
		}
		$this->_keys = [];
		return $configs;
	}

}
?>













