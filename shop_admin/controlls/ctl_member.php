<?php
/**
 * 会员管理
 */

namespace shop_admin\controlls;
use snow\bases\cls_pages;
use snow\db;
use snow\db_verify;
use snow\req;
use snow\tpl;

class ctl_member {

	public function index() {
		$row = db::select("member", "count(*) count")->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("member", "*")->limit($page["start"], $page["num"])->all("id");
		$member_level = db::select("member_level", "id,name")->all("id");
		tpl::assign("list", $list);
		tpl::assign("member_level", $member_level);
		tpl::assign("pages", $page);
		tpl::display("member.index.tpl");
	}
	public function add() {
		if (req::is_post()) {
			$data = req::post_data();
			if ($data["password"] != $data["password1"]) {
				tpl::redirect("-1", "两次密码不一致");
			}
			unset($data["password1"]);
			$data["create_time"] = time();
			$data = db_verify::table("member")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			db::insert("member")->set($data)->execute();
			tpl::redirect("?ctl=member&act=index", "会员添加成功");
		}
		$sex = db::get_table_enum("member", "sex");
		$member_level = db::select("member_level", "id,name")->all();
		tpl::assign("sex", $sex);
		tpl::assign("member_level", $member_level);
		tpl::display("member.add.tpl");
	}

	public function infos() {
		$id = req::item("id");
		$infos = db::select("member", "*")->where(["id" => $id])->one();
		$member_level = db::select("member_level", "id,name")->where(["id" => $infos["level"]])->one();
		$infos["level"] = $member_level["name"];
		$sex = db::get_table_enum("member", "sex");
		$infos["sex"] = $sex[$infos["sex"]];
		tpl::assign("infos", $infos);
		tpl::display("member.infos.tpl");
	}
	public function edit() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("member")->set_err_call("shop\models\mod_err_hander::err_hander")->update($data);
			db::update('member')->set($data)->where(["id" => $id])->execute();
			tpl::redirect("?ctl=member&act=index", "会员编辑成功");
		}
		$sex = db::get_table_enum("member", "sex");
		$member_level = db::select("member_level", "id,name")->all();
		tpl::assign("sex", $sex);
		tpl::assign("member_level", $member_level);
		$infos = db::select("member", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("member.edit.tpl");
	}
}
?>












