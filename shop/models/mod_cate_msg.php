<?php
namespace shop\models;
use snow\db;

class mod_cate_msg {

	public static function get_cates($parent_id = "0", $fileds = "id,cat_name", $is_show = true, bool $is_level = true, $max_level = -1, $level = 0) {
		if ($is_show == true) {
			$is_show = 1;
		} else {
			$is_show = 2;
		}
		$cate_info = db::select("category", $fileds)->where(["parent_id" => $parent_id])->order_by("sort_order asc")->echo_sql(0)->all();
		foreach ($cate_info as $key => $value) {
			$childers = self::get_cates($value["id"], $fileds, $is_show, $is_level, $max_level, $level);
			if (!empty($childers)) {
				$cate_info[$key]["childers"] = $childers;
			}

		}
		return $cate_info;
	}
}