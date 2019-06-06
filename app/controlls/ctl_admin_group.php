<?php
namespace app\controlls;
use snow\bases\cls_pages;
use snow\bases\cls_purview;
use snow\db;
use snow\db_verify;
use snow\req;
use snow\tpl;
use snow\user;
use snow\util;

class ctl_admin_group {

	public function index() {
		$name = req::item("name");
		if (!empty($name)) {
			$where["name"] = ["like", "%{$name}%"];
		}
		$where["delete_time"] = 0;
		$row = db::select("admin_group", "count(*) count")->where($where)->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("admin_group", "*")->where($where)->order_by("id desc")->limit($page["start"], $page["num"])->all();
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::display("admin_group.index.tpl");
	}

	public function add() {
		if (req::is_post()) {
			$data = req::post_data();
			if (db_verify::verify(["required|string"], $data["name"]) == false) {
				tpl::redirect("-1", "请填写用户组名");
			}
			$data["purviews"] = implode(",", array_keys($data["purviews"]));
			$data["create_time"] = time();
			$data["id"] = util::create_uniqid();
			db::insert("admin_group")->set($data)->execute();
			tpl::redirect("?ctl=admin_group&act=index", "成功添加用户组");
		}
		$purview = cls_purview::get_menus(false);
		tpl::assign("purview", $purview);
		tpl::display("admin_group.add.tpl");
	}
	public function infos() {
		$id = req::item("id");
		$info = db::select("admin_group", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $info);
		tpl::display("admin_group.infos.tpl");
	}

	public function del() {
		$id = req::item("id");
		$time = time();
		$set_data = ["delete_time" => $time, "delete_user" => user::$instance->get("id")];
		db::update("admin_group")->set($set_data)->set(["admin_num" => "0"])->where(["id" => $id])->echo_sql(1)->execute();
		db::update("admin")->set($set_data)->where(["id" => ["!=", NULL], "groups" => $id])->echo_sql(1)->execute();
		tpl::redirect("?ctl=admin_group&act=index", "成功删除用户组");
	}
	public function edit() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			if (db_verify::verify(["required|string"], $data["name"]) == false) {
				tpl::redirect("-1", "请填写用户组名");
			}
			$data["purviews"] = implode(",", array_keys($data["purviews"]));
			db::update("admin_group")->set($data)->where(["id" => $id])->execute();
			tpl::redirect("?ctl=admin_group&act=infos&id={$id}", "成功编辑用户组");
		}
		$info = db::select("admin_group", "*")->where(["id" => $id])->one();
		$group_purview = explode(",", $info["purviews"]);
		$purview = cls_purview::get_menus(false);
		tpl::assign("purview", $purview);
		tpl::assign("group_purview", $group_purview);
		tpl::assign("infos", $info);
		tpl::display("admin_group.edit.tpl");
	}

}
