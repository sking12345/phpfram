<?php
namespace shop\controlls;
use snow\tpl;

/**
 * 商品管理
 */
class ctl_merchandise {

	public function index() {

		tpl::display("merchandise.index.tpl");
	}
}