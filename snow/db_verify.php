<?php
namespace snow;
use snow\db;

class db_verify {
	protected static $obj = null;
	protected $table_name;
	protected $unique_where;
	protected $err_info = [];
	protected $field = '';
	protected $err_call;
	public static function table(string $table_name = "") {
		if (self::$obj == null) {
			self::$obj = new db_verify($table_name);
		}
		return self::$obj;
	}

	public function set_err_call($call_function) {
		$this->err_call = $call_function;
		return $this;
	}

	public static function verify($rule, $value) {
		if (self::$obj == null) {
			self::$obj = new db_verify();
		}
		$data_types = explode("|", $rule[0]);

		if (empty($rule["message"])) {
			$rule["message"] = "Abnormal data";
		}
		if (in_array('required', $data_types) && empty($value)) {
			if (!empty($rule["default"])) {
				$value = $rule["default"];
			} elseif (!empty($value["call"])) {
				$value = call_user_func($_call[0], $_call[1]);
			} else {
				self::$obj->err_info = $rule["message"];
				return false;
			}
		} else {
			self::$obj->verify_field('0', $value, $rule);
		}
		if (!empty(self::$obj->err_info)) {
			self::$obj->err_info = $rule["message"];
			return false;
		}
		self::$obj->err_info = [];
		return $value;
	}
	public static function get_err() {
		$err_info = self::$obj->err_info;
		self::$obj->err_info = [];
		return $err_info;
	}
	public function __construct($table_name = "") {
		$this->table_name = $table_name;
	}

	public function unique_where(array $unique_where) {
		$this->unique_where = $unique_where;
		return $this;
	}

	public function update(array $db_datas) {
		$tables_rules = config::$obj->tables_rules->get($this->table_name);

		if (empty($tables_rules)) {
			return $db_datas;
		}
		$data_rules = $tables_rules;
		foreach ($db_datas as $key => $value) {
			if (empty($data_rules[$key])) {
				$err_str = "<span  style='color:red'>{$key}</span> does not exist in the <span  style='color:red'>{$this->table_name}</span> table";
				throw new \Exception($err_str, 2);
			}
			if (!empty($data_rules[$key]["message"])) {
				$data_rules[$key]["message"] = "Abnormal data";
			}
			if (!empty($value)) {
				$this->verify_field($key, $value, $data_rules[$key]);
			}

		}
		if (!empty($this->err_info)) {
			if (!empty($this->err_call)) {
				call_user_func($this->err_call, $this->err_info);
			}
			return false;
		}
		$this->err_info = [];
		return $db_datas;
	}

	public function field(string $field, string $value) {
		$tables_rules = config::$obj->tables_rules->get($this->table_name);
		if (empty($tables_rules)) {
			return false;
		}
		$table_rules = $tables_rules;
		if (empty($table_rules[$field])) {
			$err_str = "<span  style='color:red'>{$key}</span> does not exist in the <span  style='color:red'>{$this->table_name}</span> table";
			throw new \Exception($err_str, 2);
		}

		$data_types = explode("|", $table_rules[$field][0]);
		$this->verify_field($field, $value, $table_rules[$field]);
		if (!empty($this->err_info)) {
			if (!empty($this->err_call)) {
				call_user_func($this->err_call, $this->err_info);
			}
			return false;
		}
		$this->err_info = [];
		return true;
	}

	public function insert(array $db_datas) {
		$tables_rules = config::$obj->tables_rules->get($this->table_name);
		if (empty($tables_rules)) {
			return $db_datas;
		}
		$data_rules = $tables_rules;
		foreach ($data_rules as $key => $value) {
			$data_types = explode("|", $value[0]);
			if (in_array('required', $data_types)) {
				if (empty($db_datas[$key])) {
					if (!empty($value["call"])) {
						$_call = $value['call'];
						$db_datas[$key] = call_user_func($_call[0], $_call[1]);
					} elseif (!empty($value["default"])) {
						$db_datas[$key] = $value["default"];
						continue;
					} else {
						$this->err_info[$key] = $value["message"];
						continue;
					}
				}
			} else if (!empty($db_datas[$key])) {
				$this->verify_field($key, $db_datas[$key], $value);
			}
		}
		if (!empty($this->err_info)) {
			return false;
		}
		$this->err_info = [];
		return $db_datas;
	}
	public function execute($db_datas, bool $is_insert = false) {
		$tables_rules = config::$obj->tables_rules->get($this->table_name);
		if (empty($tables_rules)) {
			return $db_datas;
		}
		if (is_array($db_datas)) {
			//新增 更新的验证
			$data_rules = $tables_rules;
			if ($is_insert == true) {
				foreach ($data_rules as $key => $value) {
					if (!empty($value["message"])) {
						$value["message"] = "Abnormal data";
					}
					$data_types = explode("|", $value[0]);
					if (in_array('required', $data_types)) {
						if (empty($db_datas[$key])) {
							if (!empty($value["call"])) {
								$_call = $value['call'];
								$db_datas[$key] = call_user_func($_call[0], $_call[1]);
							} elseif (!empty($value["default"])) {
								$db_datas[$key] = $value["default"];
								continue;
							} else {
								$this->err_info[$key] = $value["message"];
								continue;
							}
						}
					} else {
						$this->verify_field($key, $db_datas[$key], $value);
					}
				}
			} else {
				foreach ($db_datas as $key => $value) {
					if (empty($data_rules[$key])) {
						$err_str = "<span  style='color:red'>{$key}</span> does not exist in the <span  style='color:red'>{$this->table_name}</span> table";
						throw new \Exception($err_str, 2);
					}
					if (!empty($data_rules[$key]["message"])) {
						$data_rules[$key]["message"] = "Abnormal data";
					}
					if (!empty($value)) {
						$this->verify_field($key, $value, $data_rules[$key]);
					}
				}
			}
		} else {

		}

		if (!empty($this->err_info)) {
			return false;
		}
		$this->err_info = [];
		return $db_datas;
	}
	/**
	 * [verify 验证数据]
	 * @param  [type] $key      [字段]
	 * @param  [type] $value    [字段值]
	 * @param  [type] $field_rule [指定的规则]
	 * @return [type]           [description]
	 */
	private function verify_field($key, $value, $field_rule) {
		$data_where = explode("|", $field_rule[0]);
		if (in_array('string', $data_where)) {

			$str_len = mb_strlen($value);
			if (!empty($field_rule['max']) && $str_len > $field_rule['max']) {
				$this->err_info[$key] = $field_rule["message"];
			}
			if (!empty($field_rule['min']) && $str_len < $field_rule['min']) {
				$this->err_info[$key] = $field_rule["message"];
			}
		}
		if (in_array('unique', $data_where)) {
			$info = db::select($this->table_name, $key)->where($this->unique_where)
				->where([$key => $value])->one();
			if (!empty($info[$key])) {
				$this->err_info[$key] = "{$field_rule["name"]}[$value]已存在";
			}
		}
		if (in_array('table', $data_where)) {
			$table_name = $field_rule["table"];
			$field = $field_rule["field"];
			$info = db::select($table_name, $field)->where([$field => $value])->one();
			if (empty($info)) {
				$this->err_info[$key] = "{$field_rule["name"]}[$value]不存在";
			}
		}
		if (in_array('enum', $data_where)) {
			$enum_vals = $field_rule["values"];
			if (empty($enum_vals[$value])) {
				$this->err_info[$key] = $field_rule["message"];
			}
		}

		if (in_array('url', $data_where)) {
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value)) {
				$this->err_info[$key] = $field_rule["message"];
			}
		}
		if (in_array('email', $data_where)) {
			if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
				$this->err_info[$key] = $field_rule["message"];
			}
		}
		if (in_array('number', $data_where)) {
			if (is_numeric($value) == false) {
				$this->err_info[$key] = $field_rule["message"];
			} else {
				if (!empty($field_rule['max']) && $value > $field_rule['max']) {
					$this->err_info[$key] = $field_rule["message"];
				}
				if (!empty($field_rule['min']) && $value < $field_rule['min']) {
					$this->err_info[$key] = $field_rule["message"];
				}
			}
		}
		if (in_array('double', $data_where)) {
			if (is_float($value) == false) {
				$this->err_info[$key] = $field_rule["message"];
			} else {
				if (!empty($field_rule['max']) && $value > $field_rule['max']) {
					$this->err_info[$key] = $field_rule["message"];
				}
				if (!empty($field_rule['min']) && $value < $field_rule['min']) {
					$this->err_info[$key] = $field_rule["message"];
				}
			}
		}
		if (in_array('integer', $data_where)) {
			if (is_int($value) == false) {
				$this->err_info[$key] = $field_rule["message"];
			} else {
				if (!empty($field_rule['max']) && $value > $field_rule['max']) {
					$this->err_info[$key] = $field_rule["message"];
				}
				if (!empty($field_rule['min']) && $value < $field_rule['min']) {
					$this->err_info[$key] = $field_rule["message"];
				}
			}
		}
		if (in_array('date', $data_where)) {
			if (strtotime($value) == false) {
				$this->err_info[$key] = $field_rule["message"];
			} else {
				if (!empty($field_rule["format"])) {
					$db_datas[$key] = date($field_rule["format"], strtotime($value));
				}
			}
		}
		if (in_array('match', $data_where)) {
			if (preg_match($field_rule['pattern'], $value) == false) {
				$this->err_info[$key] = $field_rule["message"];
			}
		}
		if (in_array('file', $data_where)) {
			if (empty($field_rule['path'])) {
				$path = config::$obj->upload->get('path');
			} else {
				$path = $field_rule['path'];
			}
			if (empty($field_rule['min'])) {
				$min_size = config::$obj->upload->get('min_size');
			} else {
				$min_size = $field_rule['min'];
			}
			if (empty($field_rule['max'])) {
				$max_size = config::$obj->upload->get('max_size');
			} else {
				$max_size = $field_rule['max'];
			}
			if (empty($field_rule['extensions'])) {
				$extensions = explode("|", config::$obj->upload->get('extensions'));
			} else {
				$extensions = explode("|", $field_rule['extensions']);
			}
			if (!empty($field_rule['max_files']) && count($value) > $field_rule['max_files']) {
				$this->err_info[$key] = "请选择{$field_rule['max_files']}个文件";
				return false;
			}
			if (is_array($value)) //多个文件
			{
				foreach ($value as $index => $name) {
					if ($this->verify_field_file("{$path}/{$name}", $min_size, $max_size) == false) {
						$this->err_info[$key][] = str_replace('_name_', $name, $field_rule["message"]);
					}
				}
			} else {
				if ($this->verify_field_file("{$path}/{$value}", $min_size, $max_size) == false) {
					$this->err_info[$key] = str_replace('_name_', $value, $field_rule["message"]);
				}
			}
		}
		return true;
	}

	public function verify_file(string $file, $min_size, $max_size, $extensions) {
		if (file_exists($file) == false) {
			return false;
		}
		$_extensions = util::file_type($file);
		if (in_array($_extensions, $extensions) == false) {
			return false;
		}
		$file_size = filesize($file);
		if ($file_size > $max_size || $file_size < $min_size) {
			return false;
		}

	}
}
