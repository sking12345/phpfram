<?php
header("Content-type: text/html; charset=utf8");

require_once __DIR__ . '/../vendor/autoload.php';
define("ROOT_PATH", __DIR__ . "/../");
define("DEBUG", true);
define("_YES_", 1);
define("_NO_", 2);

$app_config = [
	"run_before" => "common\model\mod_verify::run_before", //程序开始执行前调用的程序
	"run_after" => "", //程序结束后调用程序
	"run_error" => "", //异常回调方法
	"url_model" => "1", //url 模式
	/**
	 * ?model=app&ct=test&ac=index
	 * 模式1 ： model=>"模块",ct="控制器","ac=" 方法
	 *
	 * ct=test&ac=index
	 * 模式2 : ct 控制器 ac= 方法,需要指定某个app_path 路径
	 *
	 * app/test/index
	 * 模式3:  配置文件强制转换到某个入口文件
	 * app 模块
	 * test 控制器
	 * index: 方法
	 * 模式4: test/index 需要指定某个app_path 路径
	 * test: 控制器
	 * index:方法
	 *
	 */
	"app_model" => "app", //模块路径

];

$init = new \vendor\init();
$init->load_base_config($app_config);
$init->start_run();
