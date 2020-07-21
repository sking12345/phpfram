<?php
namespace vendor\libs;

class cls_matrix {

	public static $instance = null;

	public $matrix_data = [];
	private $_keys = [];

	public static function _init() {
		self::$instance = new cls_matrix();
	}

	public function __get($key) {
		$this->_keys[] = $key;
		return $this;
	}

	public function get(string $key = '') {
		if (!empty($key)) {
			$this->_keys[] = $key;
		}
		$configs = $this->matrix_data;
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