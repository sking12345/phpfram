<?php
namespace shop\controlls;
use snow\tpl;

class ctl_index {
	public function index() {
		tpl::display("index.index.tpl");
	}
}