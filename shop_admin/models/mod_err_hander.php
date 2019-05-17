<?php
namespace shop_admin\models;
use snow\tpl;

class mod_err_hander {

	public static function err_hander($err_info) {
		tpl::redirect(-1, "error");
		return true;
	}
}