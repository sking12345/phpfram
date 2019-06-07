<?php
header("Content-type: text/html; charset=utf8");
defined('_DEBUG_') or define('_DEBUG_', true);
defined('_ENV_') or define('_ENV_', 'dev');

require __DIR__ . '/../snow/autoload.php';

$configs["domain_app"] = [
	"www.phpframe.com" => "app",
	"www.shop.com" => "shop_admin", //商城管理
	"www.shop1.com" => "shop", //商城
	"www.finance.com" => "finance", //财务管理
];
(new \snow\application($configs))->run();

?>










