<?php

namespace snow;
use snow\config;

class cache {
	public static $cache_class;
	/**
	 * [select_db 选择缓存类型]
	 * @param  [type] $key [如果是文件类型，就表示文件名,如果是redis，表示库]
	 * @return [type]      [description]
	 */
	public static function get_instance($db_name = "") {
		if (empty(self::$cache_class)) {
			$class = config::$obj->cache->class->get();
			self::$cache_class = new \snow\bases\cache_file();
		}
		return self::$cache_class->select_db($db_name);
	}

	public static function set(string $key, string $val, int $time = 0) {
		$obj = self::get_instance();
		return $obj->set($key, $val, $time);
	}

	public static function get(string $key) {
		$obj = self::get_instance();
		return $obj->get($key);
	}

	public static function del(string $key) {
		$obj = self::get_instance();
		return $obj->del($key);
	}

}