<?php
namespace shop\controlls;
use snow\db;
use snow\req;
use snow\tpl;
use snow\user;
use snow\util;

class ctl_member {
	public function login() {
		echo user::get("id");
		if (req::is_post()) {
			$data = req::post_data();
			$info = db::select("member", "*")->where(["name" => $data["username"]])->one();
			user::set_info($info);
			tpl::redirect("?ctl=merchandise&act=index");
		}
		tpl::display("member.login.tpl");
	}
	public function register() {
		if (req::is_post()) {
			$ver_data["name"] = req::item("username");
			$ver_data["password"] = req::item("confirm_password");
			if (req::item("password") != $ver_data["password"]) {
				tpl::redirect("-1", "两次密码不一值!");
			}
			$ver_data["id"] = util::create_uniqid();
			db::insert("member")->set($ver_data)->execute();
			tpl::redirect("?ctl=member&act=login");
		}
		tpl::display("member.register.tpl");
	}
	public function out() {
		tpl::display("member.login.tpl");
	}
}