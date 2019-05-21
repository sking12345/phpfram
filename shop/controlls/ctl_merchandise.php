<?php
namespace shop\controlls;
use snow\db;
use snow\req;
use snow\tpl;

class ctl_merchandise {

	public function index() {
		$id = req::item("id");
		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("merchandise.index.tpl");
	}
}
?>