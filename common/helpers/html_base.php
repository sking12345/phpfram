<?php
namespace common\helpers;
use vendor\libs\cls_menus;
use vendor\req;
use vendor\tpl;

class html_base {

	public static $instance;
	private $parames = [];
	private $language = "1";
	public static function _init() {
		self::$instance = new html_base();
	}
	/**
	 * [menu_navigation 菜单导航]
	 * @return [type] [description]
	 */
	public function menu_navigation(array $menus, bool $add_current = false) {

		foreach ($menus as $key => $value) {
			if (is_array($value)) {
				$menu_infos[$key] = cls_menus::$instance->get_menu_infos($key);
				$parames_arr = [];

				foreach ($value as $key1 => $value1) {
					$parames_arr[] = "{$key1}=" . req::$instance->item($value1);
				}
				if (strrpos("?", $menu_infos[$key]["url"])) {
					$menu_infos[$key]["url"] .= "?" . implode("&", $parames_arr);
				} else {
					$menu_infos[$key]["url"] .= "&" . implode("&", $parames_arr);
				}
			} else {
				$menu_infos[$value] = cls_menus::$instance->get_menu_infos($value);
			}
		}
		if ($add_current == true) {
			$ct = req::$instance->item("ct");
			$ac = req::$instance->item("ac");
			$menu_infos["{$ct}-{$ac}"] = cls_menus::$instance->get_menu_infos("{$ct}-{$ac}");
			$menu_infos["{$ct}-{$ac}"]["url"] = $_SERVER["REQUEST_URI"];
		}
		tpl::assign("menu_infos", $menu_infos);
		tpl::display("helpers/html.menu_naviger.html", true);
	}

	public function create_link($alias, $parames = [], $button_style = "btn btn-outline btn-info") {
		$menu_infos = cls_menus::$instance->get_menu_infos($alias);
		$parames_arr = [];
		foreach ($parames as $key1 => $value1) {
			$parames_arr[] = "{$key1}={$value1}";
		}
		if (!empty($parames)) {
			if (strrpos("?", $menu_infos["url"])) {
				$menu_infos["url"] .= "?" . implode("&", $parames_arr);
			} else {
				$menu_infos["url"] .= "&" . implode("&", $parames_arr);
			}
		}
		if (empty($menu_infos['class'])) {
			$menu_infos['class'] = "";
		}
		return "<a href='{$menu_infos['url']}' class='{$button_style}'><i class='{$menu_infos['class']}'></i>{$menu_infos['name']}</a>";
	}

	public function table_header(array $header) {
		if (is_array($header) == false) {
			$list = tpl::get_assign($header);
			tpl::assign("theader", $list);
		} else {
			tpl::assign("theader", $header);
		}
		return $this;
	}
	public function table_body($tbody) {
		if (is_array($tbody) == false) {
			$list = tpl::get_assign($tbody);
			tpl::assign("tbody", $list);
		} else {
			tpl::assign("tbody", $tbody);
		}
		return $this;
	}
	public function table_pages($pages_label = "") {
		$pages_data = tpl::get_assign($pages_label);
		tpl::assign("pages_data", $pages_data);
		return $this;
	}

	public function create($operates = [], $parames = "") {
		$operates_arr = [];
		foreach ($operates as $key => $value) {
			$operates_arr[$key] = cls_menus::$instance->get_menu_infos($key);
			if (!empty($parames)) {
				if (strrpos("?", $operates_arr[$key]["url"])) {
					$operates_arr[$key]["url"] .= "?{$parames}=";
				} else {
					$operates_arr[$key]["url"] .= "&{$parames}=";
				}
			}
			$operates_arr[$key]["style"] = "btn btn-outline {$value} btn-sm";
		}
		tpl::assign("operates", $operates_arr);
		tpl::assign("parames", $parames);
		tpl::display("helpers/html.table.html", true);
	}

	public function create_pages(string $pages_label) {
		$pages_data = tpl::get_assign($pages_label);
		tpl::assign("pages_data", $pages_data);
		tpl::display("helpers/html.table_pages.html", true);
	}

	public function create_link1($alias, $parames = [], $button_class = "btn-info") {
		$menu_infos = cls_menus::$instance->get_menu_infos($alias);
		$parames_arr = [];
		foreach ($parames as $key1 => $value1) {
			$parames_arr[] = "{$key1}=\${{$value1}.{$key1}}";
		}
		if (!empty($parames)) {
			if (strrpos("?", $menu_infos["url"])) {
				$menu_infos["url"] .= "?" . implode("&", $parames_arr);
			} else {
				$menu_infos["url"] .= "&" . implode("&", $parames_arr);
			}
		}

		if (empty($menu_infos['class'])) {
			$menu_infos['class'] = "";
		}
		$str = "<i class='{$menu_infos['class']}'></i>{$menu_infos['name']}";
		return "<a :href='`{$menu_infos['url']}`' class='btn btn-outline {$button_class}'>{$str}</a>";
	}

	/**
	 * create_btn("personnel-info_interview","test",['id','this']) 多个参数的时候
	 * create_btn("personnel-info_interview","test",'id'） 一个参数的时候
	 */

	public function create_btn($alias, $call_function = "", $parames = '', $button_class = "btn-info") {
		$menu_infos = cls_menus::$instance->get_menu_infos($alias);
		if (is_array($parames)) {
			$parames_arr = [];
			foreach ($parames as $key1 => $value1) {
				if (is_string($key1)) {
					$parames_arr[] = "{$value1}.{$key1}";
				} else {
					if ($value1 != "this") {
						$parames_arr[] = "'{$value1}'";
					} else {
						$parames_arr[] = $value1;
					}
				}
			}
			if (empty($menu_infos['class'])) {
				$menu_infos['class'] = "";
			}
			$parames_str = implode(",", $parames_arr);
		} else {
			if ($parames != "this") {
				$parames_str = "'{$parames}'";
			} else {
				$parames_str = $parames;
			}
		}
		$str = "<i class='{$menu_infos['class']}'></i>{$menu_infos['name']}";
		return "<a click=\"{$call_function}({$parames_str})\" class='btn btn-outline {$button_class}'>{$str}</a>";
	}

}

?>































