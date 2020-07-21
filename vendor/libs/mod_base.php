<?php
namespace vendor\libs;
use vendor\db;

class mod_base {

	public $const_data = [];
	public static $instance;
	protected $_keys;
	protected $table_name;

	public function __get($key) {
		$this->_keys[] = $key;
		// echo $key;
		return $this;
	}

	public function set_const_data($const_data) {
		$this->const_data = $const_data;
		return $this;
	}

	public function __set($key, $val) {
		$this->const_data[$key] = $val;
	}

	public function get(string $key = null) {
		if (!empty($key)) {
			$this->_keys[] = $key;
		}

		$const_data = $this->const_data;
		if (!empty($this->_keys)) {
			foreach ($this->_keys as $key => $value) {
				if (empty($const_data[$value])) {
					$this->_keys = [];
					return null;
				}
				$const_data = $const_data[$value];
			}
		}
		$this->_keys = [];
		return $const_data;
	}

	public function table($table_name) {
		$this->table_name = $table_name;
		return $this;
	}

	public function one($fields, array $where = ["delete_time" => "0"]) {
		$this->const_data = db::select($this->table_name, $fields)->where($where)->one();
		return $this->const_data;
	}

	public function all($fields, array $where = ["delete_time" => "0"], $index = "") {
		if (empty($index)) {
			$this->const_data = db::select($this->table_name, $fields)->where($where)->all();
		} else {
			$this->const_data = db::select($this->table_name, $fields)->where($where)->all($index);
		}
		return $this->const_data;
	}

}

?>







