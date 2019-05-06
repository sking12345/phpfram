<?php
namespace snow\bases;
use snow\config;

class cls_purview {

	private static $id = 1;
	public static function get_menus($show_status = true) {
		$menu_xml_file = config::$obj->get("menus_xml_file");
		$xml_content = simplexml_load_file($menu_xml_file);
		$menus = self::_menus_to_array($xml_content, $show_status, 0);
		return $menus;
	}
	private static function _menus_to_array($obj, $show_status, $top) {
		$menu_arr = [];
		foreach ($obj->children() as $key => $child_obj) {
			$item = ["id" => self::$id, "parent_id" => $top];
			self::$id++;
			$status = false;
			foreach ($child_obj->attributes() as $key1 => $value) {

				$item[$key1] = "{$value}";
				if ($show_status == true) {
					if ($key1 == "display" && $value == "0") {
						$status = true;
					}
				}
			}
			$item["children"] = self::_menus_to_array($child_obj, $show_status, $item["id"]);
			if ($status != true) {
				$menu_arr[] = $item;
			}
		}
		return $menu_arr;
	}
}