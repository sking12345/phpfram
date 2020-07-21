<?php

return [
	"app_name" => "测试开发",
	"short_name" => "测试",
	"log" => "",
	"xml_menus" => ROOT_PATH . "app/configs/menus.xml",
	"tpl_path" => ROOT_PATH . "app/template/",
	"default_url" => "?model=app&ct=index&ac=index",
	"run_before" => "", //程序开始执行前调用的程序
	"run_after" => "", //程序结束后调用程序

	'user' => [
		'identityClass' => 'common\model\mod_user', // User must implement the IdentityInterface
		'enableAutoLogin' => true,
		'required_login' => true,
		'loginUrl' => ['ct' => "index", "ac" => "login"],
	],
	"dbs" => require __DIR__ . '/db.php',
	"table_db" => [ //数据表在哪些库里，默认为default配置的库中
		// "default" => [],
		"usercenter" => ["admin", "admin_group", "system_language"],
	],
	/**
	 * 不需要验证登录的方法
	 */
	"public" => [
		'index' => ['login', 'logout', 'main', 'security'],
	],

	"security" => [
		'validate' => [
			'image_code' => true,
			'mfa_code' => false,
			'third_login' => false,
		],
		"path" => "?model=app&ct=index&ac=security",
	],

	"common" => ["index-*", "admin-*", "features-*", "file-*"],

	"cookieValidationKey" => "123456", //session id 关键字
	"session_key" => false, //存session_id 的key值,如果是app 应用程序设置xxx,如果是web,可设置为false,用于兼容多个场景的用户登录验证
	"tables_rules" => require __DIR__ . '/tables_rules.php',
	"db_verify_call" => "common\model\mod_verify::err_call", //数据库验证发现错误后的回调函数
	/**
	 * 缓存
	 */
	'cache' => [
		"class" => "vendor\libs\cache_file",
		// "class" => "snow\bases\cache_redis",
		"redis" => [
			"open_slave" => false, //是否开启从服务器配置
			"master" => [
				"host" => "127.0.0.1",
				"port" => "6379",
				"password" => "",
			],
			"savle" => [
				"host" => ["127.0.0.1", "127.0.0.1"],
				"port" => "6379",
				"password" => "",
			],
		],
	],
	"static_url" => [
		'select2_css' => 'static/frame/css/select2.css',
		'select2_js' => 'static/frame/js/select2.min.js',
		'orgchart_js' => 'static/js/jquery.orgchart.js',
		'orgchart_css' => 'static/css/jquery.orgchart.css',
		'datetimepicker_js' => 'static/frame/js/datetimepicker.min.js',
		'datetimepicker_css' => "static/frame/css/plugins/datapicker/bootstrap-datetimepicker.min.css",
		'treetable_js' => 'static/js/jquery.treetable.js',
		'treetable_css' => 'static/css/jquery.treetable.css',
	],
	'language' => ['1' => "简体中文", '2' => "繁体中文", "3" => "English"],
	// 'language' => ['1' => "简体中文"],
	'default_language' => "1",

];
?>






