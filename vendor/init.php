<?php
namespace vendor;
use vendor\App;
use vendor\configs;
use vendor\req;
use vendor\tpl;

class init {

	private $base_configs = [];

	public static function _init() {
		//echo "ddd";
	}
	public function __construct() {
		//echo "xx";
	}
	public function load_base_config($base_configs) {
		$this->base_configs = $base_configs;
		return $this;
	}
	public function start_run() {

		if ($this->base_configs["url_model"] == "1") {
			$model = req::$instance->item("model");
			$ct = req::$instance->item("ct");
			$ac = req::$instance->item("ac");
		} else if ($this->base_configs["url_model"] == "2") {
			$model = $this->$base_configs["app_model"];
			$ct = req::$instance->item("ct");
			$ac = req::$instance->item("ac");
		} else if ($this->base_configs["url_model"] == "3") {

		} else if ($this->base_configs["url_model"] == "4") {

		}
		configs::$instance->load_config(ROOT_PATH . "{$model}/configs/web.php");
		configs::$instance->url_model = $this->base_configs["url_model"];
		configs::$instance->model_name = $model;
		if (configs::$instance->user->get('required_login') == true) {
			$public_function = configs::$instance->public->get();
			if (!empty($public_function[$ct])) {
				if (in_array($ac, $public_function[$ct]) == false && in_array("*", $public_function[$ct]) == false) {
					if (App::$user->is_login() == false) {
						$loginUrl = App::$config->user->get('loginUrl');
						tpl::show($loginUrl);
					}
				}
			} else {
				if (App::$user->is_login() == false) {
					$loginUrl = App::$config->user->get('loginUrl');
					tpl::show($loginUrl);
				}
			}
		}
		if (!empty($this->base_configs["run_before"])) {
			call_user_func($this->base_configs["run_before"]);
		}
		$app_run_before = configs::$instance->run_before->get();
		if (!empty($app_run_before)) {
			call_user_func($app_run_before);
		}
		$common_arr = configs::$instance->common->get();
		if (in_array("{$ct}-*", $common_arr) || in_array("{$ct}-{$ac}", $common_arr)) {
			$model = "common";
		}
		$controller = "{$model}\\controller\\ctl_{$ct}";
		$ctl_obj = new $controller();
		if (method_exists($ctl_obj, $ac) == false) {
			if (!empty($this->base_configs["run_error"])) {
				call_user_func($this->base_configs["run_error"]);
			} else {
				throw new \Exception("{$model}/{$ct}:{$ac} not exists", 1);

			}
			return true;
		}
		$ctl_obj->$ac();
		$app_run_after = configs::$instance->run_after->get();
		if (!empty($app_run_after)) {
			call_user_func($app_run_after);
		}
		if (!empty($this->base_configs["run_after"])) {
			call_user_func($this->base_configs["run_after"]);
		}
		return true;
	}

}
?>













