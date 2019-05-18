<?php
namespace shop\controlls;
use snow\tpl;

class ctl_index {
	public function index() {
		tpl::display("index.index.tpl");
	}

	public function index1() {

		tpl::display("index.index1.tpl");
	}
}