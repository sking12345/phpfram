<?php
namespace app\controlls;
use snow\config;
use snow\db;
use snow\req;
use snow\tpl;
use snow\user;

class ctl_index {
	private $id = 1;
	public function login() {
		if (req::is_post()) {

			$username = req::item("username");
			$password = req::item("password");
			$user_info = db::select("admin", "*")->where(["username" => $username])->one();

			if (empty($user_info)) {
				tpl::assign("err_info", "密码错误");
			} elseif ($password != $user_info["password"]) {
				tpl::assign("err_info", "密码错误");
			} else {
				user::set_info($user_info);
				tpl::redirect("?ctl=index&act=main", "登录成功");
			}
			exit;
		}
		tpl::display("login.tpl");
	}
	public function main() {
		$index_tpl = config::$obj->app->get("index_tpl");
		tpl::display($index_tpl);
	}
	public function out() {
		user::out();
		tpl::redirect("?ctl=index&act=login", "退出登录");
	}

	public function menus() {
		$menu_xml_file = config::$obj->get("menus_xml_file");
		$xml_content = simplexml_load_file($menu_xml_file);
		$menus = $this->_menus_to_array($xml_content, true, 0);
		tpl::assign("menus", $menus);
		tpl::display("index.menus.tpl");
	}

	public function _menus_to_array($obj, $show_status, $top) {
		$menu_arr = [];
		foreach ($obj->children() as $key => $child_obj) {
			$item = ["id" => $this->id, "parent_id" => $top];
			$this->id++;
			$status = false;
			foreach ($child_obj->attributes() as $key1 => $value) {

				$item[$key1] = "{$value}";
				if ($show_status == true) {
					if ($key1 == "display" && $value == "0") {
						$status = true;
					}
				}
			}
			$item["children"] = $this->_menus_to_array($child_obj, $show_status, $item["id"]);
			if ($status != true) {
				$menu_arr[] = $item;
			}
		}
		return $menu_arr;
	}
}
