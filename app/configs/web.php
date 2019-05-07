<?php

return [
	"app" => [
		"purview_check" => "", //权限验证
		"login_verify" => true, //token 验证
		'short_title' => "snow", //项目名称简写
		"title" => "snow测试", //项目名称
		"login" => "?ctl=index&act=login",
		'login_status_time' => '600', //登录多长时间就退出，秒 ,0 永久
		'session_key' => false, //存session_id 的key值,如果是app 应用程序设置xxx,如果是web,可设置为false,用于兼容多个场景的用户登录验证
	],
	"cookieValidationKey" => "123456",
	"view_path" => __DIR__ . "/../views/",
	'menus_xml_file' => __DIR__ . "/menus.xml", //菜单配置文件
	'cache' => [
		"class" => "snow\bases\cache_file",
		// "class" => "snow\bases\cache_redis",
		"file" => [
			"path" => __DIR__ . "/../../cache", //文件缓存路径
		],
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
	//验证码配置
	'captcha' => [
		'class' => 'snow\bases\cls_captcha',
		'img' => true,
		'google' => false,
	],
	//文件上传配置
	'upload' => [
		'max_size' => 1024 * 1024,
		'min_size' => 0,
		'path' => '',
		'extensions' => 'png|jpg|gif',
	],
	"open_multi_db" => false, //是否开启多个主库操作
	"dbs" => require __DIR__ . '/db.php',
	"table_db" => [
		"default" => [],
		"user_center" => [],
	],
	"tables_rules" => [
		"admin" => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 21]],
			'username' => ['required|string|unique', 'max' => 24, 'min' => 4, 'default' => '1', 'message' => '请输入4-24个字符', 'name' => '用户名'],
			'groups' => ['table|required|string', 'field' => 'id', 'table' => "admin_group", 'message' => "请选择分组", 'name' => '分组'],
			'sex' => ['enum|required', 'values' => [1 => "男", 2 => "女"], 'default' => '1', 'name' => '性别', 'message' => "请正确选择性别"],
			'url' => ['url|required', 'message' => "请正确填写url", 'name' => "url"],
			'email' => ['email|required', 'message' => '请正确填写email', 'name' => 'email'],
			'number' => ['required|number', 'max' => '200', 'min' => '100', "message" => '请输入number', 'name' => 'number'],
			'double' => ['required|double', 'max' => '200', 'min' => '100', "message" => '请输入double', 'name' => 'double'],
			'integer' => ['required|integer', 'max' => '200', 'min' => '100', "message" => '请输入integer', 'name' => 'double'],
			'date' => ['required|date', 'format' => 'Y-m-d H:i:s', "message" => '请输入日期', 'name' => 'date'],
			'match' => ["match|required", 'pattern' => '/^[a-z]\w*$/i', "message" => '正则验证', 'name' => '正则验证'],
			'file' => ['file', 'path' => '', 'extensions' => 'png|jpg|gif', 'max' => 1024 * 1024,
				'min' => 1024, 'max_files' => 3, 'message' => 'error:[_name_]请选择png|jpg|gif文件',
			],
		],
	],
	// "shutdown_call" => "call:func", //end call function
	// 公开方法
	'public' => [
		'index' => ["login", 'out'],
	],
];
