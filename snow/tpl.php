<?php
namespace snow;
use snow\cache;
use snow\config;
use snow\req;
use snow\util;

class tpl {

	private static $assign_data = [];

	public static function assign(string $key, $val) {
		self::$assign_data[$key] = $val;
	}
	public static function get_assign(string $key) {
		if (empty(self::$assign_data[$key])) {
			return false;
		}
		return self::$assign_data[$key];
	}
	/**
	 *	用于接口回复消息
	 */
	public static function response($msg, $code = 1) {
		if ($code > 0) {
			echo json_encode(["code" => $code, "msg" => $msg, "data" => self::$assign_data]);
		} else {
			echo json_encode(["code" => $code, "msg" => $msg]);
		}
		exit();
	}
	/**
	 * [get_json_assign 返回jsong格式数据]
	 * @return [type] [description]
	 */
	public static function get_json_assign() {
		return json_encode(self::$assign_data);
	}
	public static function run_controller(string $ctl, string $act, $args = null) {
		$path = config::$obj->app->get("path");
		req::set_call_args($args);
		$call_ctl = "\\{$path}\\controlls\\ctl_{$ctl}";
		(new $call_ctl())->$act();
	}
	/**
	 * [redirect 重定向]
	 * @param  [type] $url  [description]
	 * @param  string $info [description]
	 * @return [type]       [description]
	 */
	public static function redirect($url, string $info = "") {
		if (!empty($info)) {
			cookie::set("msg", $info, 10);
		}
		if (is_numeric($url)) {
			cookie::set("msg_status", "-1", 10);
			echo "<script>history.go({$url});</script>";
			exit;
		} else {
			cookie::set("msg_status", 1, 10);
			header("Location:{$url}");
		}
		exit;
	}
	/**
	 * [require_tpl 应用包含/获取显示其他模版]
	 * args:传入页面的参数
	 * @return [type] [description]
	 */
	public static function display(string $file) {
		$view_path = config::$obj->view_path->get();
		if (file_exists($view_path . $file) == false) {
			throw new \Exception($view_path . $file . " 不存在", 1);
		}
		require_once $view_path . $file;
	}
	public static function from_token() {
		$ctl = req::item("ctl");
		$act = req::item("act");
		$token = util::create_uniqid(32);
		$browser_id = req::browser_id();
		cache::set($token, $browser_id, 600);
		$html_str = "<input type='hidden' name='ctl' value='{$ctl}'>";
		$html_str .= "<input type='hidden' name='act' value='{$act}'>";
		$html_str .= "<input type='hidden' name='_crsh_token_' value='{$token}'>";
		return $html_str;
	}
}