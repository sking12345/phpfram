<?php
namespace snow;
use snow\config;

class db {
	protected static $objs;
	protected static $open_tran = false;
	protected static $verify_err_info = [];
	private static function get_configs(string $tables_name, string $select_db = "") {
		if (empty($select_db)) {
			$dbs_key = "default";
			$dbs = config::$obj->table_db->get();

			foreach ($dbs as $key => $value) {
				if (in_array($tables_name, $value)) {
					$dbs_key = $key;
					break;
				}
			}
		} else {
			$dbs_key = $select_db;
		}
		if (!empty(self::$objs[$dbs_key])) {
			$obj = self::$objs[$dbs_key]["obj"];
		} else {
			$db_config = config::$obj->dbs->get($dbs_key);
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
		$db_config = config::$obj->dbs->get($dbs_key);
		if (!empty(self::$objs[$dbs_key])) {
			$obj = self::$objs[$dbs_key]["obj"];
		} else {
			$obj = new $db_config["class"]($db_config);
			self::$objs[$dbs_key]["obj"] = $obj;
			self::$objs[$dbs_key]["open_tran"] = false;
		}
		return $obj->query($sql);
	}
	public static function select(string $tables_name, string $fields = "*") {
		$obj = self::get_configs($tables_name);
		return $obj->select($fields)->from($tables_name);
	}
	public static function update(string $tables_name) {
		$obj = self::get_configs($tables_name);
		return $obj->update($tables_name);
	}
	public static function insert(string $tables_name) {
		$obj = self::get_configs($tables_name);
		return $obj->insert($tables_name);
	}
	public static function delete(string $tables_name) {
		$obj = self::get_configs($tables_name);
		return $obj->delete($tables_name);
	}

	public static function start() {
		self::$open_tran = true;
	}
	public static function commit() {
		if (self::$open_tran == true) {
			foreach (self::$objs as $key => $value) {
				if ($value["open_tran"] == true) {
					$_obj = $value["obj"];
					$_obj->commit();
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
					$_obj->ranback();
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
}
?>












