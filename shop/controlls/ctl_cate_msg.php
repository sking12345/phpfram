<?php
namespace shop\controlls;
use app\controlls\ctl_base;
use snow\bases\cls_pages;
use snow\tpl;

class ctl_cate_msg extends ctl_base {

	/**分类管理*/
	public function index() {

		$page = cls_pages::get_pages(0, 10);
		tpl::assign("pages", $page);
		tpl::display("cate_msg.index.tpl");
	}
	/**
	 * 添加分类
	 */
	public function add() {
		tpl::display("cate_msg.add.tpl");
	}
}
