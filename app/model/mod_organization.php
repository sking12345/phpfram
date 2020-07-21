<?php
namespace app\model;

use vendor\db;

class mod_organization {

	public static function get_mechanism($parent_id = "0", $fields = "id,name,parent_id,parent_name", $level = "0") {
		$list = db::select("organization_mechanism", $fields)->where(["parent_id" => $parent_id])
			->where(["delete_time" => "0"])
			->echo_sql(0)
			->all();
		if (empty($list)) {
			return false;
		}
		$level++;
		$mechanism_arr = [];
		foreach ($list as $key => $value) {
			$value["level"] = $level;
			$mechanism_arr[] = $value;
			$mechanism = self::get_mechanism($value["id"], $fields, $level);
			if ($mechanism != false) {
				$mechanism_arr = array_merge($mechanism_arr, $mechanism);

			}
		}
		return $mechanism_arr;
	}

	public static function get_mechanism_structure($parent_id = "0", $fields = "id,name,parent_id,parent_name", $level = "0") {
		$list = db::select("organization_mechanism", $fields)->where(["parent_id" => $parent_id])
			->where(["delete_time" => "0"])
			->echo_sql(0)
			->all();
		if (empty($list)) {
			return false;
		}
		$level++;
		$mechanism_arr = [];
		foreach ($list as $key => $value) {
			$value["relationship"]["children_num"] = "0";
			$mechanism = self::get_mechanism_structure($value["id"], $fields, $level);
			if ($mechanism != false) {
				$value["relationship"]["children_num"] = count($mechanism);
				$value["children"] = $mechanism;
			}
			$mechanism_arr[] = $value;
		}
		return $mechanism_arr;
	}
	/**
	 * [get_jobs 岗位]
	 * @param  [type] $mechanism_id [description]
	 * @param  string $fields       [description]
	 * @param  array  $where        [description]
	 * @param  string $index        [description]
	 * @return [type]               [description]
	 */
	public static function get_jobs($fields = "id,name", $where = ["delete_time" => "0"], $index = "id") {
		return db::select("organization_jobs", $fields)->where($where)->all($index);

	}
}
?>










