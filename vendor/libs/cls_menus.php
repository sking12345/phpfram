<?php
namespace vendor\libs;
use vendor\cache;
use vendor\configs;

class cls_menus {

	public static $instance = null;
	private $menus_arr = [];
	private $exclude_menus = [];
	private $show_all = false;
	private static $menus_index = 0;
	private static $level = 0;
	private static $top_id = 0;
	private $cache_menus = [];
	private $save_cache = false;
	public static function _init() {
		self::$instance = new self();
	}

	public function get_menu_infos($alias = "", $lable = "") {
		if (DEBUG == true) {
			$this->get_menus();
		}
		if (empty($alias)) {
			return $this->cache_menus;
		}

		if (empty($this->cache_menus)) {
			$menus_md5_key = configs::$instance->get("model_name");
			$cache_menus = cache::get("{$menus_md5_key}_menus_json");
			$this->cache_menus = json_decode($cache_menus, true);
		}
		if (empty($lable)) {
			return $this->cache_menus[$alias];
		}

		if (empty($this->cache_menus[$alias][$lable])) {
			return false;
		}

		return $this->cache_menus[$alias][$lable];
	}

	public function get_menus(bool $show_all = false, $include_menus = []) {

		$this->exclude_menus = $include_menus;
		$this->show_all = $show_all;
		$menu_file = configs::$instance->get("xml_menus");
		$menus_md5_key = configs::$instance->get("model_name");
		$file_str = file_get_contents($menu_file);
		$file_str_md5 = md5($file_str);
		$cache_menus_md5 = cache::get("{$menus_md5_key}_menus");
		if (empty($cache_menus_md5)) {
			$this->save_cache = true;
			cache::set("{$menus_md5_key}_menus", $file_str_md5);
		} elseif ($cache_menus_md5 != $file_str_md5) {
			$this->save_cache = true;
			cache::set("{$menus_md5_key}_menus", $file_str_md5);
		}
		$this->save_cache = true;
		$xml_content = simplexml_load_file($menu_file);
		$this->menu_arr = $this->_menus_to_array($xml_content);
		if ($this->save_cache == true) {
			cache::set("{$menus_md5_key}_menus_json", json_encode($this->cache_menus));
		}
		return $this->menu_arr;
	}

	private function _menus_to_array($xml_obj, $parentid = 0, $topid = 0) {
		$menu_arr = [];
		self::$level++;
		foreach ($xml_obj->children() as $key => $child_obj) {
			self::$menus_index++;
			$item = ["id" => self::$menus_index, "parentid" => "{$parentid}", "topid" => $topid];
			foreach ($child_obj->attributes() as $key1 => $value) {
				$item[$key1] = "{$value}";
			}
			if (empty($item["url"]) && !empty($item["ct"])) {
				$url_model = configs::$instance->get("url_model");
				if (isset($item["model"])) {
					$model_name = $item["model"];
				} else {
					$model_name = configs::$instance->get("model_name");
				}

				if ($url_model == "1" || $url_model == "2") {
					$item["url"] = "?";
					if (!empty($model_name)) {
						$item["url"] .= "model={$model_name}&";
					}
					$item["url"] .= "ct={$item['ct']}&ac={$item['ac']}";
				} else {
					if (!empty($model_name)) {
						$item["url"] = "/{$model_name}";
					}
					$item["url"] .= "/{$url_arr["ct"]}/{$url_arr["ac"]}";
				}
				if (!empty($this->exclude_menus)) {
					if (in_array("{$item['ct']}-{$item['ac']}", $this->exclude_menus) == false) {
						continue;
					}
				}
			}
			if ($this->save_cache == true) {
				if (!empty($item["alias"])) {
					$cache_menus_key = $item["alias"];
					$this->cache_menus[$cache_menus_key] = $item;
				} else if (!empty($item["ct"])) {
					$cache_menus_key = "{$item["ct"]}-{$item["ac"]}";
					$item["alias"] = $cache_menus_key;
					$this->cache_menus[$cache_menus_key] = $item;
				}
			}
			if ($this->show_all == false) {
				if (isset($item["display"]) && $item["display"] == "0") {
					continue;
				}
			}
			if (self::$level <= 1) {
				self::$top_id = self::$menus_index;
			}
			$children = $this->_menus_to_array($child_obj, self::$menus_index, self::$top_id);
			if (!empty($children)) {
				$item["children"] = $children;
				$menu_arr[] = $item;
			} else if (!empty($item['ct'])) {
				$menu_arr[] = $item;
			}

		}
		return $menu_arr;
	}

}
