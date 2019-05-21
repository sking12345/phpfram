<?php
namespace shop\controlls;
use snow\db;
use snow\req;
use snow\tpl;
use snow\user;

class ctl_merchandise {

	public function index() {
		$id = req::item("id");
		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("merchandise.index.tpl");
	}

	public function buy() {
		$id = req::item("id");
		if (user::is_login()) {
			echo "xx";
		} else {
			tpl::redirect("?ctl=member&act=login", "请先登录");
		}
	}
}
?>