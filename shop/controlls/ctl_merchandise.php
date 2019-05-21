<?php
namespace shop\controlls;
use snow\tpl;

class ctl_merchandise {

	public function index() {

		tpl::display("merchandise.index.tpl");
	}
}
?>