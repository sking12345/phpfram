<?php
namespace common\controller;
use vendor\cache;
use vendor\libs\cls_captcha;
use vendor\libs\cls_menus;
use vendor\req;
use vendor\tpl;

class ctl_index {

	public function index() {
		$use_menu = cls_menus::$instance->get_menus(["admin_group" => ["add"]]);
	}

	public function login() {
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			print_r($post_data);
			tpl::show("登录成功", true, ["model" => "app", "ct" => "index", "ac" => "main"]);

		}
		tpl::display("login.html", true);
	}
	public function main() {
		$use_menu = cls_menus::$instance->get_menus();
		$language = req::$instance->item("language");
		if (!empty($language)) {
			$session_id = req::$instance->get_session_id();
			// App::$user->language = $language;
			cache::set("language", $language);
		}
		tpl::assign("use_menus", $use_menu);
		tpl::display("main.html", true);
	}

	public function logout() {
		tpl::show("退出成功", true, ["ct" => "index", "ac" => "login"]);
	}
	public function security() {
		cls_captcha::create("xxxx");
	}

}