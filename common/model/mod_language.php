<?php

namespace common\model;
use vendor\App;
use vendor\configs;
use vendor\db;

define("_CODE_BASE_INFO_", 100);
define("_CODE_SUBMIT_", 101);
define("_CODE_SAVE_", 102);
define("_CODE_PURVIEWS_", 103);
define("_CODE_YES_", 104);
define("_CODE_NO_", 105);
define("_CODE_SEARCH_", 106);
define("_CODE_INPUT_KEYWROD_", 107);
define("_CODE_MGT_", 108);
define("_CODE_INDEX_", 109);
define("_CODE_DEL_", 110);
define("_CODE_ADD_", 111);

class mod_language {

	public static $instance = null;
	private $language_key = "1";
	public $code_language = [
		"100" => ['1' => "基本信息", '3' => 'base info'],
		"101" => ['1' => "提交", '3' => 'submit'],
		'102' => ['1' => "保存", "3" => "save"],
		'103' => ['1' => '权限管理', '3' => 'purviews'],
		'104' => ["1" => "是", "3" => "YES"],
		'105' => ["1" => "否", "3" => "NO"],
		'106' => ["1" => "搜索", "3" => "search"],
		'107' => ["1" => "请输入关键字", "3" => "please input keyword"],
		'108' => ['1' => "管理", '3' => "mgt"],
		'109' => ['1' => "序号", '3' => "index"],
		'110' => ["1" => "删除"],
		'111' => ["1" => "新增"],
	];

	public static function _init() {
		// self::$instance = new mod_db();
		if (self::$instance == null) {
			self::$instance = new mod_db();
		}
		self::$instance->language_key = App::$user->language;
		//echo App::$user->language;
		// echo App::$user->language;
	}
	//public function
	//
	/**
	 * [get_db_size 获取数据库使用情况]
	 * @param  [type] $db_name [description]
	 * @return [type]          [data_size:数据大小,size：数据库大小]
	 */
	public function get_db_size($db_name) {
		db::query("use information_schema");
		$sql = "select concat(round(sum(data_length)/(1024*1024),2),'MB') as 'data_size' ,concat(round(sum(data_length)/(1024*1024),2) + round(sum(index_length)/(1024*1024),2),'MB') as size from tables where table_schema='{$db_name}'";
		$restult = db::query($sql);
		$row = mysqli_fetch_assoc($restult);
		return $row;
	}

	public function get_language($table_schema, $fields = "", $language_key = "") {
		$where["table_name"] = $table_schema;
		if (!empty($fields)) {
			if (is_array($fields)) {
				$where["field_name"] = ["in", $fields];
			} else {
				$fields = explode(",", $fields);
				$where["field_name"] = ["in", $fields];
			}
		}
		if (!empty($language_key)) {
			$where["language_key"] = $language_key;
		} else {
			$where["language_key"] = $this->language_key;
		}
		$languages = db::select("system_language", "language,placeholder,field_name")
			->where($where)
			->echo_sql()
			->order_by('sort asc')
			->all("field_name");
		if (empty($fields)) {
			$fields = db::desc($table_schema);
			$fields = array_keys($fields);
			// return $languages;
		}
		$languages_arr = [];
		foreach ($fields as $key => $value) {
			if (empty($languages[$value])) {
				$languages_arr[$value] = ["language" => $value, "placeholder" => "", "field_name" => $value];
			} else {
				$languages_arr[$value] = $languages[$value];
			}
		}
		// print_r($languages_arr);
		return $languages_arr;
	}

	public function get_all_enum_language(string $table_schema, string $field = "", $language_key = "") {
		$table_data = configs::$instance->tables_rules->get($table_schema);
		if (empty($table_data)) {
			return;
		}
		$tables_enum = [];
		if (!empty($field)) {
			$field = explode(",", $field);
			foreach ($field as $key => $value) {
				if (empty($table_data[$value]["values"])) {
					throw new Exception("{$table_schema}.{$value} in tables_rules not exits or valus not exeits!", 1);
				}
				$tables_enum[$value] = $this->get_enum_language($table_schema, $value, $language_key);
			}
		} else {
			foreach ($table_data as $key => $value) {
				if (!empty($value["values"])) {
					$tables_enum[$key] = $this->get_enum_language($table_schema, $key, $language_key);
				}
			}
		}

		return $tables_enum;
	}

	public function get_enum_language(string $table_schema, string $field, $language_key = "") {
		$table_data = configs::$instance->tables_rules->get($table_schema);
		if (!empty($language_key)) {
			$where["language_key"] = $language_key;
		} else {
			$where["language_key"] = $this->language_key;
		}
		$where["table_name"] = $table_schema;
		$where["field_name"] = ["like", "{$field}-%"];

		$languages = db::select("system_language", "language,placeholder,field_name")
			->where($where)
			->echo_sql()
			->order_by('sort asc')
			->all("field_name");
		$language_arr = [];
		foreach ($table_data[$field]["values"] as $key => $value) {
			if (empty($languages["{$field}-{$key}"])) {
				$language_arr[$key] = $value;
			} else {
				$language_arr[$key] = $languages["{$field}-{$key}"]["language"];
			}
		}
		return $language_arr;
	}

	public function get_system_language($code) {
		if (empty($this->code_language[$code][$this->language_key])) {
			return "";
		}
		return $this->code_language[$code][$this->language_key];
	}

	public function get_menu_language($alias) {

	}
}
?>





