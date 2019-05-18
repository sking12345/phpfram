<?php

namespace shop_admin\models;
use snow\db;

class mod_cate_msg {

	private static $cate_info_arr = [];
	/**
	 * [get_cates 获取分类信息]
	 * @param  string       $parent_id [description]
	 * @param  string       $fileds    [description]
	 * @param  bool|boolean $is_level  [是否需要等级显示]
	 * @param  integer      $max_level [最大几级]
	 * @param  integer      $level     [当前第几级]
	 * @return [type]                  [description]
	 */
	public static function get_cates($parent_id = "0", $fileds = "id,cat_name", bool $is_level = true, $max_level = -1, $level = 0) {
		if ($is_level == true) {
			$str = "";
			$ii = $level;
			while ($ii-- > 0) {
				$str .= '&nbsp;&nbsp;';
			}
			$level++;
		}
		if ($max_level > 0) {
			if ($level > $max_level) {
				return false;
			}
		}
		$cate_info = db::select("category", $fileds)->where(["parent_id" => $parent_id])->order_by("sort_order asc")->echo_sql(0)->all();
		foreach ($cate_info as $key => $value) {
			$value["cat_name"] = $str . $value["cat_name"];
			self::$cate_info_arr[] = $value;
			self::get_cates($value["id"], $fileds, $is_level, $max_level, $level);

		}
		return self::$cate_info_arr;
	}

}
