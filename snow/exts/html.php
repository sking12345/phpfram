<?php

use snow\config;

class html {

	public static function create_table_pages($file, $parames) {
		$view_path = config::$obj->view_path->get();
		if (file_exists($view_path . $file) == false) {
			throw new \Exception($view_path . $file . " 不存在", 1);
		}
		require_once $view_path . $file;

	}
}