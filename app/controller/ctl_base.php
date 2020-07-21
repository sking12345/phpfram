<?php
namespace app\controller;
use app\controller\ctl_base;
use common\model\mod_language;
use vendor\configs;
use vendor\db;
use vendor\libs\cls_matrix;
use vendor\libs\mod_base;
use vendor\req;

/**
 *
 */
class ctl_base {

	public $global_data;
	public $_keys = [];

	public function __get($key) {
		$this->_keys[] = $key;
		// echo $key;
		return $this;
	}
	public function __set($key, $val) {
		$this->global_data[$key] = $val;
	}

	public function get(string $key = '') {
		$configs = $this->global_data;
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

	public function ajax_get($function_name, $class_name) {
		$ajax_name = req::$instance->item("ajax_name");
		if (empty($ajax_name)) {
			return null;
		}
		if ($function_name == "edit_archives" || $function_name == "add_archives" || $function_name == "add_interview" || $function_name == "add_turn_right") {

			$ajax_val = req::$instance->item("ajax_val");
			$data = mod_base::$instance->table("organization_jobs")->all("id value,name", ["mechanism_id" => $ajax_val, "delete_time" => "0"]);
			if ($data) {
				echo json_encode(["status" => "1", "data" => $data]);
			} else {
				echo json_encode(["status" => "-1", "msg" => '暂无职位']);
			}
			exit;
		} else if ($function_name == "add_resignation_letter") {

		}
	}

	public function pub_index($table_name, $show_fields, $where = []) {
		$row = db::select($table_name, "count(*) count")->where($where)->one();
		$show_header = mod_language::$instance->get_language($table_name, $show_fields);

		if ($row["count"] <= 0) {
			$this->global_data = ["related_data" => "", "list" => "", "pages" => "", "show_header" => $show_header];
			return $this->global_data;
		}
		$pages = db::make_page($row["count"], 10);

		$show_arr = explode(",", $show_fields);
		$table_rules = configs::$instance->tables_rules->get($table_name);
		foreach ($show_arr as $key => $value) {
			$field_str = trim($value);
			if (!empty($table_rules[$field_str]["table"])) {
				cls_matrix::$instance->matrix_data["other_table"][$value] = ["table" => $table_rules[$field_str]["table"],
					"table_unique" => $table_rules[$field_str]["table_unique"],
					"field" => $table_rules[$field_str]["field"],
				];
			} else if (!empty($table_rules[$field_str])) {
				$arr = explode("|", $table_rules[$field_str][0]);
				if (in_array("enum", $arr) == true) {
					cls_matrix::$instance->matrix_data["enum"][$value] = $table_rules[$field_str]["values"];
				}
			}
		}
		$related_data = [];
		$obj = db::select($table_name, $show_fields)->where($where)
			->order_by("create_time desc")
			->limit($pages["offset"], $pages["limt"])
			->echo_sql();
		if (!empty(cls_matrix::$instance->matrix_data["other_table"]) || !empty(cls_matrix::$instance->matrix_data["enum"])) {
			$obj->set_call(function ($row) {
				if (!empty(cls_matrix::$instance->matrix_data["other_table"])) {
					foreach (cls_matrix::$instance->matrix_data["other_table"] as $key => $value) {
						if (!empty($row[$key])) {
							cls_matrix::$instance->matrix_data["other_table"][$key]["field_val"][] = $row[$key];
						}
					}
				}
				if (!empty(cls_matrix::$instance->matrix_data["enum"])) {
					foreach (cls_matrix::$instance->matrix_data["enum"] as $key => $value) {
						if (!empty($row[$key])) {
							$row[$key] = $value[$row[$key]];
						}
					}
				}
				return $row;
			});
		}
		$list = $obj->all();
		if (!empty(cls_matrix::$instance->matrix_data["other_table"])) {
			foreach (cls_matrix::$instance->matrix_data["other_table"] as $key => $value) {
				if (empty($value["field_val"])) {
					continue;
				}
				$where[$value["field"]] = ["in", $value["field_val"]];
				$related_data[$key] = db::select($value["table"], "{$value["field"]},{$value["table_unique"]} crucial_val")
					->where($where)
					->all($value["field"]);

			}
		}
		$this->global_data = ["related_data" => $related_data, "list" => $list, "pages" => $pages, "show_header" => $show_header];
		return $this->global_data;
	}

	public function pub_infos($table_name, $show_fields, $where = []) {
		if ($show_fields == "*") {
			$fields_arr = db::desc($table_name);
			$show_arr = array_keys($fields_arr);
		} else {
			$show_arr = explode(",", $show_fields);
		}

		$table_rules = configs::$instance->tables_rules->get($table_name);
		foreach ($show_arr as $key => $value) {
			$field_str = trim($value);
			if (!empty($table_rules[$field_str]["table"])) {
				cls_matrix::$instance->matrix_data["other_table"][$value] = ["table" => $table_rules[$field_str]["table"],
					"table_unique" => $table_rules[$field_str]["table_unique"],
					"field" => $table_rules[$field_str]["field"],
				];
			} else if (!empty($table_rules[$field_str])) {
				$arr = explode("|", $table_rules[$field_str][0]);
				if (in_array("enum", $arr) == true) {
					cls_matrix::$instance->matrix_data["enum"][$value] = $table_rules[$field_str]["values"];
				}
			}
		}
		$related_data = [];
		$obj = db::select($table_name, $show_fields)->where($where)
			->echo_sql();
		$one_info = $obj->one();
		if (!empty(cls_matrix::$instance->matrix_data["other_table"])) {
			foreach (cls_matrix::$instance->matrix_data["other_table"] as $key => $value) {
				$where[$value["field"]] = $one_info[$key];
				$info = db::select($value["table"], "{$value["field"]},{$value["table_unique"]} crucial_val")
					->where($where)
					->echo_sql()
					->one($value["field"]);

				$one_info[$key] = $info["crucial_val"];

			}
		}

		if (!empty(cls_matrix::$instance->matrix_data["enum"])) {
			foreach (cls_matrix::$instance->matrix_data["enum"] as $key => $value) {
				if (!empty($value[$one_info[$key]])) {
					$one_info[$key] = $value[$one_info[$key]];
				} else {
					throw new \Exception("{$key} not is exists", 1);
				}

			}
		}
		return $one_info;
	}

}
?>




















