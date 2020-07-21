<?php
namespace common\controller;
use app\controller\ctl_base;
use common\model\mod_language;
use vendor\db;
use vendor\db_verify;
use vendor\libs\cls_menus;
use vendor\req;
use vendor\tpl;
use vendor\util;

class ctl_admin extends ctl_base {

	public function index_group() {
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$where["delete_time"] = "0";

		$show_fields = "id,name,safety_ip";
		$table_data = $this->pub_index("admin_group", $show_fields, $where);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("admin.index_group.html", true);
	}
	public function add_group() {
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			if (!empty($post_data["purviews"])) {
				$post_data["purviews"] = implode(",", $post_data["purviews"]);
			}
			$post_data["id"] = util::create_uniqid(19);
			$post_data["create_time"] = time();
			$insert_data = db_verify::table("admin_group")->where(["delete_time" => "0"])->insert($post_data);
			if ($insert_data) {
				db::insert("admin_group")->set($insert_data)->execute();
				tpl::show("添加成功", true, ["ct" => "admin", "ac" => "index_group"]);
			}
			$error_info = db_verify::get_err();
			//tpl::show("添加失败", false);
		}

		$all_menus = cls_menus::$instance->get_menus(true);
		$language_list = mod_language::$instance->get_language("admin_group", "name,purviews,safety_ip,is_root");
		tpl::assign("language", $language_list);
		tpl::assign("all_menus", $all_menus);
		tpl::display("admin.group_form.html", true);
	}

	public function edit_group() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			if (!empty($post_data['purviews'])) {
				$post_data["purviews"] = implode(",", $post_data["purviews"]);
			}
			$insert_data = db_verify::table("admin_group")->where(["delete_time" => '0', 'id' => ['!=', $id]])->update($post_data);
			if ($insert_data) {
				db::update("admin_group")->set($insert_data)->where(["id" => $id])->execute();
				tpl::show("添加成功", true, ["ct" => "admin", "ac" => "index_group"]);
			}
		}
		$group_info = db::select("admin_group", "purviews,name,safety_ip,is_root")->where(["id" => $id])->one();
		$all_menus = cls_menus::$instance->get_menus(true);
		$language_list = mod_language::$instance->get_language("admin_group", "name,purviews,safety_ip,is_root");
		tpl::assign("language", $language_list);
		tpl::assign("all_menus", $all_menus);
		tpl::assign("group_info", $group_info);
		tpl::display("admin.group_form.html", true);
	}

	public function del_group() {
		$id = req::$instance->item("id");
		db::update("admin_group")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "admin", "ac" => "index_group"]);
	}

	public function index() {
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$where["delete_time"] = "0";
		$show_fields = "id,name,safety_ip,group_id,email";
		$table_data = $this->pub_index("admin", $show_fields, $where);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("admin.index.html", true);
	}

	public function add() {
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$post_data = db_verify::table("admin")->insert($post_data);
			$post_data["create_time"] = time();
			$post_data["id"] = util::create_uniqid(19);
			db::insert("admin")->set($post_data)->execute();
			tpl::show("添加成功", true, ["ct" => "admin", "ac" => "index"]);

		}
		$language_list = mod_language::$instance->get_language("admin", "name,safety_ip,group_id,email");
		tpl::assign("language", $language_list);
		$group_list = db::select("admin_group", "id,name")->where(["delete_time" => "0"])->all();
		tpl::assign("group_list", $group_list);
		tpl::display("admin.form.html", true);
	}

	public function edit() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$update_data = db_verify::table("admin")->where(["delete_time" => '0', 'id' => ['!=', $id]])->update($post_data);
			if ($update_data) {
				db::update("admin")->set($update_data)->where(["id" => $id])->execute();
				tpl::show("编辑成功", true, ["ct" => "admin", 'ac' => "index"]);
			}

		}
		$admin_info = db::select("admin", "id,name,safety_ip,email,group_id")->where(["id" => $id])->one();
		$group_list = db::select("admin_group", "id,name")->where(["delete_time" => "0"])->all();
		$language_list = mod_language::$instance->get_language("admin", "name,safety_ip,group_id,email");
		tpl::assign("language", $language_list);
		tpl::assign("group_list", $group_list);
		tpl::assign("admin_info", $admin_info);
		tpl::display("admin.form.html", true);
	}

	public function del() {
		$id = req::$instance->item("id");
		db::update("admin")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "admin", "ac" => "index"]);
	}

	public function set_purview() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			if (!empty($post_data["purviews"])) {
				$purviews = implode(",", $post_data["purviews"]);
				db::update("admin")->set(["purviews" => $purviews])->where(["id" => $id])->execute();
				tpl::show("设置成功", true, ["ct" => "admin", "ac" => "index"]);
			}
		}
		$admin_info = db::select("admin", "group_id,purviews,name,safety_ip")->where(["id" => $id])->one();
		$group_info = db::select("admin_group", "purviews,is_root,safety_ip,name")->where(["id" => $admin_info["group_id"]])->one();
		if ($group_info["is_root"] == _NO_) {
			$MenuData = cls_menus::$instance->get_menus(true, explode(",", $group_info["purviews"]));
		} else {
			$MenuData = cls_menus::$instance->get_menus(true);
		}
		tpl::assign("MenuData", $MenuData);
		tpl::assign("group_info", $group_info);
		tpl::assign("admin_info", $admin_info);
		tpl::display("admin.set_purview.html", true);
	}
}
?>









