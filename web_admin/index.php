<?php
header("Content-type: text/html; charset=utf8");
defined('_DEBUG_') or define('_DEBUG_', true);
defined('_ENV_') or define('_ENV_', 'dev');

require __DIR__ . '/../snow/autoload.php';

$configs["domain"] = [
	"www.phpframe.com" => "app",
];

(new \snow\application($configs))->run();

?>











