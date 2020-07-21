<?php

spl_autoload_register(function ($class_name) {
	$classname = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
	$file_path = ROOT_PATH . "{$classname}.php";

	if (file_exists($file_path) == false) {

		throw new \Exception("extends '{$classname}' not exists", 1);
	}

	require_once $file_path;
	if (property_exists($class_name, "instance") == true) {
		try {
			$class_name::$instance = new $class_name();
		} catch (Exception $e) {
			print_r($e);
			exit;
		}
	}
	if (method_exists($class_name, "_init")) {
		call_user_func("{$class_name}::_init");

	}

	return true;
}, true, true); /*第一个true,如果加载错误，抛出异常,第二个表示添加函数到队列之首*/
