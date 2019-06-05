<?php

return [
	"default" => [
		"class" => "snow\bases\mysql",
		"user_name" => "root",
		"password" => "123456",
		'charset' => 'utf8',
		"db_name" => "phpframe",
		"prefix" => "",
		"open_slave" => false, //是否开启从服务器配置
		"master" => "127.0.0.1:3306",
		"slave" => ["127.0.0.1:3306", "127.0.0.1:3306", "127.0.0.1:3306"],
	],
	"user_center" => [
		"class" => "snow\bases\mysql",
		"user_name" => "root",
		"password" => "123456",
		'charset' => 'utf8',
		"db_name" => "phpframe",
		"prefix" => "",
		"open_slave" => false,
		"master" => "127.0.0.1:3306",
		"slave" => ["127.0.0.1:3306", "127.0.0.1:3306", "127.0.0.1:3306"],
	],

];