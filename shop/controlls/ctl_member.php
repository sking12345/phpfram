<?php
namespace shop\controlls;
use snow\tpl;

class ctl_member {
	public function login() {
		tpl::display("member.login.tpl");
	}
	public function register() {

	}
	public function out() {
		tpl::display("member.login.tpl");
	}
}