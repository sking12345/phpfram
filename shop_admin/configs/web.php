<?php

return [
	"app" => [
		"purview_check" => "", //权限验证
		"login_verify" => true, //token 验证
		'short_title' => "商城", //项目名称简写
		"title" => "shop商城", //项目名称
		"default_url" => "?ctl=index&act=login",
		'login_status_time' => '600', //登录多长时间就退出，秒 ,0 永久
		'session_key' => false, //存session_id 的key值,如果是app 应用程序设置xxx,如果是web,可设置为false,用于兼容多个场景的用户登录验证
		"index_tpl" => "index.tpl",
	],
	"icon_path" => "./public/icon/shop.ico",
	'timezone' => "Asia/Phnom_Penh",
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
		"user_center" => ["admin", "admin_group", "admin_logs"],
	],
	"tables_rules" => [
		'category' => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 18]],
		],
		'genre' => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 18]],
		],
		'genre_attr' => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 18]],
		],
		'brand' => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 18]],
		],
		'supplier' => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 18]],
		],
		'supplier_status' => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 18]],
		],
		'merchandise' => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 18]],
			"name" => ["required", 'max' => 24, 'message' => '请输入25个字符内的名称'],
			'promotion_start_time' => ['date', "message" => '请输入日期',
				'name' => '促销开始日期',
			],
			'promotion_start_time' => ['date', "message" => '请输入日期',
				'name' => '促销结束日期',
			],
			'weight_type' => ["enum|required", "values" => ["1" => "千克", "2" => "克"]],
			'recommend' => ["enum", "values" => ["1" => "精品", "2" => "最新", "3" => "热门"]],
		],
		'member' => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 18]],
			'sex' => ['required|enum', "values" => ["1" => "男", "2" => "女", "3" => "保密"], "default" => "1", "message" => "请正确选择"],
		],
		'member_level' => [
			'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 18]],
		],
	],
	// "shutdown_call" => "call:func", //end call function
	// 公开方法
	'public' => [
		'index' => ["login", 'out'],
	],
];