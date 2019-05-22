<?php
namespace shop\controlls;
use snow\cache;
use snow\cookie;
use snow\db;
use snow\req;
use snow\tpl;
use snow\user;
use snow\util;

class ctl_merchandise {

	public function index() {
		$id = req::item("id");
		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("merchandise.index.tpl");
	}

	public function buy() {
		$id = req::item("id");
		if (user::is_login() == false) {
			$uniqid = util::create_uniqid();
			cookie::set("unqin_id", $uniqid);
			cache::set($uniqid, $id);
			tpl::redirect("?ctl=member&act=login", "请先登录");
		}
		$id = req::item("id");
		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		tpl::display("merchandise.buy.tpl");
	}
}
?>



















