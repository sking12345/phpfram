<?php

/**
 * snow 内核自动加载
 */

//内核加载
spl_autoload_register(function ($class) {
	$classname = str_replace('\\', DIRECTORY_SEPARATOR, $class);
	$file_path = __DIR__ . "/../{$classname}.php";
	if (file_exists($file_path) == false) {
		return false;
	} else {
		require_once $file_path;
	}
	$class_name = basename($class, ".php");
	if (method_exists($class_name, "_init")) {

		//如果有静态_init 方法则回调
		call_user_func("{$class_name}::_init");
	}
	return true;
});

//加载其他扩展类

spl_autoload_register(function ($class) {
	$classname = str_replace('\\', DIRECTORY_SEPARATOR, $class);
	$file_path = __DIR__ . "/exts/{$classname}.php";
	if (file_exists($file_path) == false) {
		return false;
	} else {
		require_once $file_path;
	}

});