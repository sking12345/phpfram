<?php
namespace vendor;
use vendor\configs as config;
use vendor\req;

class db {
	protected static $objs;
	protected static $open_tran = false;
	protected static $verify_err_info = [];
	private static function get_configs(string $tables_name, string $select_db = "") {
		if (empty($select_db)) {
			$dbs_key = "default";
			$dbs = config::$instance->table_db->get();
			if (!empty($dbs)) {
				foreach ($dbs as $key => $value) {
					if (in_array($tables_name, $value)) {
						$dbs_key = $key;
						break;
					}
				}
			}

		} else {
			$dbs_key = $select_db;
		}
		if (!empty(self::$objs[$dbs_key])) {
			$obj = self::$objs[$dbs_key]["obj"];
		} else {
			$db_config = config::$instance->dbs->get($dbs_key);
			$obj = new $db_config["class"]($db_config);
			self::$objs[$dbs_key]["obj"] = $obj;
			self::$objs[$dbs_key]["open_tran"] = false;
		}
		if (self::$open_tran == true) {
			foreach (self::$objs as $key => $value) {
				if ($value["open_tran"] == false) {
					$_obj = $value["obj"];
					$_obj->start();
					self::$objs[$key]["open_tran"] = true;
				}
			}
		}
		return $obj;
	}

	/**
	 * [query 提供query 是为了特殊情况使用,比如联表查询, 联表查询采用的时候卡迪尔算法,所以一般不采用列表查询机制]
	 * @param  string $sql     [description]
	 * @param  string $dbs_key [description]
	 * @return [type]          [description]
	 */
	public static function query(string $sql, $dbs_key = "default") {
		$db_config = config::$instance->dbs->get($dbs_key);
		if (!empty(self::$objs[$dbs_key])) {
			$obj = self::$objs[$dbs_key]["obj"];
		} else {
			$obj = new $db_config["class"]($db_config);
			self::$objs[$dbs_key]["obj"] = $obj;
			self::$objs[$dbs_key]["open_tran"] = false;
		}
		return $obj->clear_sql()->query($sql);
	}
	public static function select(string $tables_name, string $fields = "*") {
		$obj = self::get_configs($tables_name);
		return $obj->clear_sql()->from($tables_name)->select($fields);
	}
	public static function update(string $tables_name) {
		$obj = self::get_configs($tables_name);
		return $obj->clear_sql()->update($tables_name);
	}
	public static function insert(string $tables_name) {
		$obj = self::get_configs($tables_name);
		return $obj->clear_sql()->insert($tables_name);
	}
	public static function replace(string $tables_name) {
		$obj = self::get_configs($tables_name);
		return $obj->clear_sql()->replace($tables_name);
	}
	public static function delete(string $tables_name) {
		$obj = self::get_configs($tables_name);
		return $obj->clear_sql()->delete($tables_name);
	}
	/**
	 * [desc 表结构]
	 * @param  string $tables_name [description]
	 * @return [type]              [description]
	 */
	public static function desc(string $tables_name) {
		$obj = self::get_configs($tables_name);
		return $obj->clear_sql()->desc($tables_name);
	}

	public static function start() {
		self::$open_tran = true;
	}
	public static function commit() {
		if (self::$open_tran == true) {
			foreach (self::$objs as $key => $value) {
				if ($value["open_tran"] == true) {
					$_obj = $value["obj"];
					$_obj->clear_sql()->commit();
					self::$objs[$key]["open_tran"] = false;
				}
			}
		}
		self::$open_tran = false;
		return true;
	}
	public static function ranback() {
		if (self::$open_tran == true) {
			foreach (self::$objs as $key => $value) {
				if ($value["open_tran"] == true) {
					$_obj = $value["obj"];
					$_obj->clear_sql()->ranback();
					self::$objs[$key]["open_tran"] = false;
				}
			}
		}
		self::$open_tran = false;
		return true;
	}
	public static function get_resource_fields(array $data_arr, $fields) {
		if (empty($data_arr)) {
			if (is_array($fields)) {
				$data = [];
				foreach ($fileds as $key => $value) {
					$data[$value] = [];
				}
				return $data;
			} else {
				return [];
			}
		}
		$data = [];
		if (is_array($fields)) {
			foreach ($data_arr as $key => $value) {
				foreach ($fields as $key1 => $value1) {
					$data[$value1][] = $value[$value1];
				}
			}
		} else {
			foreach ($data_arr as $key => $value) {
				$data[] = $value[$fields];
			}
		}
		return $data;
	}
	/**
	 * 获取数据表中配置的enum
	 */
	public static function get_table_enum(string $tables_name, string $field, array $default = []) {
		$tables_rules = config::$instance->tables_rules->get($tables_name);
		if (empty($tables_rules[$field]["values"])) {
			if (empty($default)) {
				return [];
			}
			return $default;
		}
		return $tables_rules[$field]["values"];
	}
	/**
	 * [get_table_default 获取默认值]
	 * @param  string $tables_name [description]
	 * @param  string $field       [description]
	 * @param  string $default     [description]
	 * @return [type]              [description]
	 */
	public static function get_table_default(string $tables_name, string $field, $default = "") {
		$tables_rules = config::$instance->tables_rules->get($tables_name);
		if (empty($tables_rules[$field]["default"])) {
			return $default;
		}
		return $tables_rules[$field]["default"];
	}
	/**
	 * 获取某个字段rule
	 */
	public static function get_table_rules(string $tables_name, string $field = "") {
		$rules = config::$instance->tables_rules->get($tables_name);
		if (empty($field)) {
			return $rules;
		}
		return empty($rules[$field]) ? [] : $rules[$field];
	}
	/**
	 * 创建分页
	 */
	public static function make_page($total_count, $num = 10) {
		$page_num = ceil($total_count / $num);
		$show_page = req::$instance->item("show_page", 1);
		if ($show_page > $page_num && $page_num > 0) {
			$show_page = $page_num;
		}
		if ($show_page - 3 > 1) {
			$start_page = $show_page - 3;
		} else {
			$start_page = 1;
		}
		if ($show_page + 3 < $page_num) {
			$end_page = $show_page + 3;
		} else {
			$end_page = $page_num;
		}
		$start = ($show_page - 1) * $num;

		return ["page_num" => $page_num, "offset" => $start, "limt" => $num, "show_page" => $show_page, "total_num" => $total_count];
	}
}
?>












