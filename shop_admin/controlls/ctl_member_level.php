<?php
/**
 * 会员管理等级
 */
namespace shop_admin\controlls;
use snow\bases\cls_pages;
use snow\db;
use snow\db_verify;
use snow\req;
use snow\tpl;

class ctl_member_level {

	public function index() {
		$row = db::select("member_level", "count(*) count")->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("member_level", "*")->limit($page["start"], $page["num"])->all("id");
		tpl::assign("list", $list);
		tpl::assign("pages", $page);
		tpl::display("member_level.index.tpl");
	}

	public function add() {
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("member_level")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			db::insert("member_level")->set($data)->execute();
			tpl::redirect("?ctl=member_level&act=index", "会员等级添加成功");
		}
		tpl::display("member_level.add.tpl");
	}

	public function infos() {
		$id = req::item("id");
		$infos = db::select("member_level", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("member_level.infos.tpl");
	}
	public function edit() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("member_level")->set_err_call("shop\models\mod_err_hander::err_hander")->update($data);
			db::update("member_level")->set($data)->where(["id" => $id])->execute();
			$back_act = req::item("back", "index");
			tpl::redirect("?ctl=member_level&act=index", "会员等级编辑成功");
		}
		$infos = db::select("member_level", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("member_level.edit.tpl");
	}
	public function del() {
		$id = req::item("id");
		db::delete("member_level")->where(["id" => $id])->execute();
		tpl::redirect("?ctl=member_level&act=index", "会员等级删除成功");

	}
}
?>








