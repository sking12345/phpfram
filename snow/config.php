<?php
namespace snow;

class config {
	public static $obj = null;
	private $_configs = [];
	private $_keys = [];
	public function __construct($configs) {
		$this->_configs = $configs;
	}

	public static function init($configs) {
		if (empty(self::$obj)) {
			self::$obj = new config($configs);
		}
		return self::$obj;
	}
	/**
	 * [get_config 获取某个配置]
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	public function get_config($key) {
		if (empty($this->_configs[$key])) {
			return false;
		}
		$this->_configs[$key];
	}
	public function __get($key) {
		$this->_keys[] = $key;
		return $this;
	}
	public function get(string $key = '') {
		if (!empty($key)) {
			$this->_keys[] = $key;
		}
		$configs = $this->_configs;
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
}
