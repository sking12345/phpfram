<?php
namespace finance\controlls;
use snow\db;
use snow\tpl;
use snow\util;

class ctl_currencys {

	private $import_url = "http://api.k780.com/?app=finance.rate_curlist&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4";
	private $rate_url = "http://api.k780.com/?app=finance.rate&scur=#scur&tcur=#tcur&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4"; //汇率接口
	public function index() {
		tpl::display("currencys.index.tpl");
	}
	/**
	 * 倒入币别
	 */
	public function import() {
		$currencys_str = util::http_get($this->import_url);
		if (empty($currencys_str)) {
			echo "获取币别失败";
			exit();
		}
		$currencys_arr = json_decode($currencys_str, true);
		$add_arr = [];
		foreach ($currencys_arr["result"]["lists"] as $key => $value) {
			$add_arr = ["id" => util::create_uniqid(), "curNo" => addslashes($value["curNo"]),
				"curNm" => addslashes($value["curNm"]), "curNmEn" => addslashes($value["curNmEn"]),
				"status" => 1];
			$info = db::select("currencys", "*")->where(["curNo" => $value["curNo"]])->one();
			if (empty($info)) {
				db::insert("currencys")->set($add_arr)->echo_sql(0)->execute();
			}
		}

	}
}