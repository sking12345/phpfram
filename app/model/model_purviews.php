<?php
namespace app\model;
use snow\req;
use snow\user;

class model_purviews {

	public static function check() {
		$purviews = user::$instance->group_info->get("purviews");
		if ($purviews == "*") {
			return true;
		}
		if (empty($purviews)) {
			return false;
		}
		$purviews_arr = explode(",", $purviews);
		$ct_ac = req::item("ctl") . "_" . req::item("act");
		if (in_array($ct_ac, $purviews_arr)) {
			return true;
		}
		return false;
	}
}