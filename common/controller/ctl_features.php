<?php
namespace common\controller;
use app\controller\ctl_base;
use vendor\configs;
use vendor\db;
use vendor\libs\cls_matrix;
use vendor\libs\cls_menus;
use vendor\req;
use vendor\tpl;
use vendor\util;

class ctl_features extends ctl_base {
	/**
	 * [add 新增功能]
	 */
	public function add_from() {
		tpl::display("features.add_from.html", true);
	}

	public function table_list() {
		$dbs = configs::$instance->dbs->get();
		$table_list = [];
		foreach ($dbs as $key => $value) {
			$restult = db::query("select * from information_schema.tables where TABLE_SCHEMA='{$value['db_name']}'");
			while ($row = mysqli_fetch_assoc($restult)) {
				$row_info = [];
				foreach ($row as $key => $value) {
					$_key = strtolower($key);
					$row_info[$_key] = $value;
				}
				$table_list[] = $row_info;
			}
		}
		tpl::assign("table_list", $table_list);
		tpl::display("features.table_list.html", true);
	}

	public function table_descs() {
		$table_name = req::$instance->item("table_name");
		$db_keys = configs::$instance->table_db->get();

		$db_key = "default";
		foreach ($db_keys as $key => $value) {
			if (in_array($table_name, $value)) {
				$db_key = $key;
				break;
			}
		}
		$db_info = configs::$instance->dbs->get($db_key);
		$db_name = $db_info["db_name"];
		$restult = db::query("select * from INFORMATION_SCHEMA.Columns where TABLE_SCHEMA='{$db_name}' and TABLE_NAME='{$table_name}'");
		$table_infos = [];
		while ($row = mysqli_fetch_assoc($restult)) {
			$row_info = [];
			foreach ($row as $key => $value) {
				$_key = strtolower($key);
				$row_info[$_key] = $value;
			}
			$table_infos[] = $row_info;
		}
		db::select("system_language", "language,language_key,field_name,placeholder")
			->where(["db_name" => $db_name])
			->where(["table_name" => $table_name])
			->set_call(function ($row) {
				cls_matrix::$instance->matrix_data[$row["field_name"]][$row["language_key"]]["language"] = $row["language"];
				cls_matrix::$instance->matrix_data[$row["field_name"]][$row["language_key"]]["placeholder"] = $row["placeholder"];
			})
			->all();
		$system_language = cls_matrix::$instance->matrix_data;
		$tables_rules = configs::$instance->tables_rules->get($table_name);
		$language = configs::$instance->language->get();
		tpl::assign("language", $language);
		tpl::assign("system_language", $system_language);
		tpl::assign("table_infos", $table_infos);
		tpl::assign("tables_rules", $tables_rules);
		tpl::display("features.table_descs.html", true);
	}

	public function set_field() {
		$table_name = req::$instance->item("table_name");
		$name = req::$instance->item("column_name");
		$db_keys = configs::$instance->table_db->get();
		$db_key = "default";
		foreach ($db_keys as $key => $value) {
			if (in_array($table_name, $value)) {
				$db_key = $key;
				break;
			}
		}
		$db_info = configs::$instance->dbs->get($db_key);
		$db_name = $db_info["db_name"];
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$save_data["db_name"] = $db_name;
			$save_data["table_name"] = $table_name;
			$save_data["field_name"] = $name;
			$save_data["combination"] = "{$table_name}-{$name}";
			foreach ($post_data["language"] as $key => $value) {
				if (empty($value)) {
					continue;
				}
				$save_data["language_key"] = $key;
				$save_data["language"] = $value;
				$save_data["placeholder"] = $post_data["placeholder"][$key];
				$where["combination"] = $save_data["combination"];
				$where["language_key"] = $save_data["language_key"];
				$where["field_name"] = $save_data["field_name"];
				$info = db::select("system_language", "id")->where($where)->one();
				if (empty($info)) {
					$save_data["id"] = util::create_uniqid(19);
					db::insert("system_language")->set($save_data)->echo_sql(0)->execute();
				} else {
					db::update("system_language")->set($save_data)->echo_sql(0)->where(["id" => $info["id"]])->execute();
				}

			}
			unset($save_data["placeholder"]);

			foreach ($post_data["enums"] as $key => $value) {
				foreach ($value as $key_l => $val) {
					if (empty($val)) {
						continue;
					}
					$save_data["combination"] = "{$table_name}-{$name}-{$key}-{$key_l}";
					$save_data["field_name"] = "{$name}-{$key}";
					$save_data["language_key"] = $key_l;
					$save_data["language"] = $val;
					$where["combination"] = $save_data["combination"];
					$where["language_key"] = $save_data["language_key"];
					$where["field_name"] = $save_data["field_name"];
					$info = db::select("system_language", "id")->where($where)->one();

					if (empty($info)) {
						$save_data["id"] = util::create_uniqid(19);
						db::insert("system_language")->set($save_data)->echo_sql(1)->execute();
					} else {
						db::update("system_language")->set($save_data)->echo_sql(1)->where(["id" => $info["id"]])->execute();
					}
				}
			}

			echo json_encode(["status" => "1", "msg" => "设置成功"]);
			exit;
		}

		$restult = db::query("select * from INFORMATION_SCHEMA.Columns where TABLE_SCHEMA='{$db_name}' and TABLE_NAME='{$table_name}' and COLUMN_NAME='{$name}'");
		$table_infos = [];
		$row_info = [];
		$row = mysqli_fetch_assoc($restult);
		foreach ($row as $key => $value) {
			$row_info[$key] = $value;
		}

		$field_languages = db::select("system_language", "language,language_key,placeholder,field_name")
			->where(["db_name" => $db_name])
			->where(["table_name" => $table_name])
			->where(["field_name" => ["like", "%{$name}%"]])
			->set_call(function ($row) {
				cls_matrix::$instance->matrix_data[$row["field_name"]][$row["language_key"]] = $row;
			})
			->all();
		// print_r($field_languages);

		$language = configs::$instance->language->get();
		tpl::assign("language", $language);
		tpl::assign("field_languages", cls_matrix::$instance->matrix_data);
		tpl::assign("info", $row_info);
		echo tpl::$instance->get_json();
		exit;
	}

	public function menu_index() {
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$alias = req::$instance->item("alias");
			$language = $post_data["language"];
			foreach ($language as $key => $value) {
				if (empty($value)) {
					continue;
				}
				$save_data["language_key"] = $key;
				$save_data["combination"] = $alias;
				$save_data["language"] = $value;
				$save_data["type"] = 2;
				$where["combination"] = $save_data["combination"];
				$where["language_key"] = $save_data["language_key"];
				$where["type"] = 2;
				$info = db::select("system_language", "id")->where($where)->one();
				if (empty($info)) {
					$save_data["id"] = util::create_uniqid(19);
					db::insert("system_language")->set($save_data)->echo_sql(1)->execute();
				} else {
					db::update("system_language")->set($save_data)->echo_sql(1)->where(["id" => $info["id"]])->execute();
				}
			}
			echo json_encode(["status" => "1", "msg" => "设置成功"]);
			exit;

		}
		$menu_list = cls_menus::$instance->get_menu_infos();
		db::select("system_language", "language,combination,language_key")->where(["type" => "2"])
			->set_call(function ($row) {
				cls_matrix::$instance->matrix_data[$row["combination"]][$row["language_key"]] = $row["language"];
			})
			->all();
		$language = configs::$instance->language->get();
		tpl::assign("language", $language);
		tpl::assign("menu_list", $menu_list);
		tpl::assign("menu_language", cls_matrix::$instance->matrix_data);
		tpl::display("features.menu_index.html", true);
	}

	public function language_index() {

		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["language"] = ["like", "%{$keyword}%"];
		}

		$show_fields = "id,language_key,language,db_name,table_name,field_name,combination,data_type,placeholder,type,sort";
		$table_data = $this->pub_index("system_language", $show_fields, $where);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("features.language_index.html", true);
	}
	public function del_language() {
		$id = req::$instance->item("id");
		db::delete("system_language")->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "features", "ac" => "language_index"]);
	}
}

?>







