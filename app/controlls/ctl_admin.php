<?php
namespace app\controlls;
use snow\bases\cls_pages;
use snow\db;
use snow\db_verify;
use snow\req;
use snow\tpl;
use snow\user;
use snow\util;

class ctl_admin {
	public function index() {
		$name = req::item("username");
		if (!empty($name)) {
			$where["username"] = ["like", "%{$name}%"];
		}
		$where["delete_time"] = 0;
		$row = db::select("admin", "count(*) count")->where($where)->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$admin_list = db::select("admin", "*")->where($where)->limit($page["start"], $page["num"])->all();
		$groups_id = db::get_resource_fields($admin_list, "groups");
		$groups_info = db::select("admin_group", "id,name")->where(["id" => ["in", $groups_id]])->all("id");
		tpl::assign("groups_info", $groups_info);
		tpl::assign("pages", $page);
		tpl::assign("admin_list", $admin_list);
		tpl::display("admin.index.tpl");
	}
	public function infos() {
		$id = req::item("id");
		$infos = db::select("admin", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("admin.infos.tpl");
	}
	public function add() {
		if (req::is_post()) {
			$data = req::post_data();
			if ($data["password"] != $data["password1"]) {
				tpl::redirect(-1, "两次密码不一样");
			}
			if (!empty($_FILES["photo"]["tmp_name"])) {
				$tmp_name = $_FILES["photo"]["tmp_name"];
				$name = $_FILES["photo"]["name"];
				$uploads_dir = "./upload/img/" . util::create_uniqid(16) . substr($name, strripos($name, "."));
				if (move_uploaded_file($tmp_name, $uploads_dir) == false) {
					tpl::redirect(-1, "文件上传失败");
				}
				$data["img"] = $uploads_dir;
			}
			$data["id"] = util::create_uniqid();
			$data["create_time"] = time();
			unset($data["password1"]);
			db::insert("admin")->set($data)->execute();

			tpl::redirect("?ctl=admin&act=index", "用户添加成功");
		}
		$groups_info = db::select("admin_group", "id,name")->where(["delete_time" => "0"])->all();
		tpl::assign("groups_info", $groups_info);
		tpl::display("admin.add.tpl");
	}
	public function del() {
		$id = req::item("id");
		$user_info = db::select("admin", "id,groups")->where(["id" => $id])->one();
		db::start();
		db::update("admin")->set(["delete_time" => time(), "delete_user" => user::get("id")])
			->where(["id" => $id])->echo_sql(1)->execute();
		db::update("admin_group")->set(["admin_num" => ["-", "1"]])->where(["id" => $user_info["groups"]])->echo_sql(1)->execute();
		db::commit();
		tpl::redirect("?ctl=admin&act=index", "用户删除成功");
	}
	public function edit() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			$groups_val = db_verify::verify(["required", "message" => "请选择分组"], $data["groups"]);
			if ($groups_val == false) {
				$err_info = db_verify::get_err();
				tpl::redirect(-1, "请选择分组");
			}
			if (!empty($_FILES["photo"]["tmp_name"])) {
				$tmp_name = $_FILES["photo"]["tmp_name"];
				$name = $_FILES["photo"]["name"];
				$uploads_dir = "./upload/img/" . util::create_uniqid(16) . substr($name, strripos($name, "."));
				if (move_uploaded_file($tmp_name, $uploads_dir) == false) {
					tpl::redirect(-1, "文件上传失败");
				}
				$data["img"] = $uploads_dir;
			}
			$statu = db::update("admin")->set($data)->where(["id" => $id])->echo_sql(1)->execute();
			if ($statu == false) {
				tpl::redirect(-1, "编辑失败");
			}
			db::update("admin_group")->set(["admin_num" => ["+", "1"]])->where(["id" => $data["groups"]])->echo_sql(1)->execute();
			tpl::redirect("?ctl=admin&act=infos&id={$id}", "编辑成功");
		}
		$groups_info = db::select("admin_group", "id,name")->where(["delete_time" => "0"])->all();
		tpl::assign("groups_info", $groups_info);
		$infos = db::select("admin", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("admin.edit.tpl");
	}
}