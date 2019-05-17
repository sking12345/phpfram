<?php

namespace shop_admin\controlls;
use snow\bases\cls_pages;
use snow\db;
use snow\db_verify;
use snow\req;
use snow\tpl;

class ctl_supplier {

	public function index() {
		$row = db::select("supplier", "count(*) count")->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("supplier", "*")->limit($page["start"], $page["num"])->all("id");
		tpl::assign("list", $list);
		tpl::assign("pages", $page);
		tpl::display("supplier.index.tpl");
	}

	public function add() {
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("supplier")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			db::insert("supplier")->set($data)->execute();
			tpl::redirect("?ctl=supplier&act=index", "供应商添加成功");
		}
		tpl::display("supplier.add.tpl");
	}

	public function infos() {
		$id = req::item("id");
		$infos = db::select("supplier", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("supplier.infos.tpl");

	}

	public function edit() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("supplier")->set_err_call("shop\models\mod_err_hander::err_hander")->update($data);
			db::update("supplier")->set($data)->where(["id" => $id])->execute();
			$back_act = req::item("back", "index");
			tpl::redirect("?ctl=supplier&act={$back_act}&id={$id}", "供应商编辑成功");
		}
		$infos = db::select("supplier", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("supplier.edit.tpl");
	}

	public function stop_use() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			$data["supplier_id"] = req::item("id");
			$data["status"] = 2;
			$data["create_time"] = time();
			$data = db_verify::table("supplier_status")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			db::start();
			db::insert("supplier_status")->set($data)->execute();
			db::update("supplier")->set(["status" => "2"])->where(["id" => $id])->execute();
			db::commit();
			tpl::redirect("?ctl=supplier&act=infos&id={$id}", "修改成功");
		}
		$infos = db::select("supplier", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::assign("active_info", "暂停供应商使用");
		tpl::display("supplier.status.tpl");
	}
	public function restore_use() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			$data["supplier_id"] = req::item("id");
			$data["status"] = 1;
			$data["create_time"] = time();
			$data = db_verify::table("supplier_status")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			db::start();
			db::insert("supplier_status")->set($data)->execute();
			db::update("supplier")->set(["status" => "1"])->where(["id" => $id])->execute();
			db::commit();
			tpl::redirect("?ctl=supplier&act=infos&id={$id}", "修改成功");
		}
		$infos = db::select("supplier", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::assign("active_info", "恢复供应商使用");
		tpl::display("supplier.status.tpl");
	}
	/**
	 * 状态列表
	 */
	public function status_list() {
		$id = req::item("id");
		$row = db::select("supplier_status", "count(*) count")->where(["supplier_id" => $id])->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("supplier_status", "*")->where(["supplier_id" => $id])->order_by("create_time desc")->limit($page["start"], $page["num"])->all();
		tpl::assign("list", $list);
		tpl::assign("pages", $page);
		tpl::display("supplier.status_list.tpl");
	}
}
?>














