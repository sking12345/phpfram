<?php
namespace shop\controlls;
use shop\models\mod_cate_msg;
use snow\tpl;

class ctl_index {
	public function index() {
		tpl::display("index.index.tpl");
	}

	public function index1() {
		$cates = mod_cate_msg::get_cates();
		tpl::assign("list", $cates);
		tpl::display("index.index1.tpl");
	}

}