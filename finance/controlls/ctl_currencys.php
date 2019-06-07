<?php
namespace finance\controlls;
use snow\bases\cls_pages;
use snow\db;
use snow\req;
use snow\tpl;
use snow\util;

class ctl_currencys {

	private $import_url = "http://api.k780.com/?app=finance.rate_curlist&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4";
	private $rate_url = "http://api.k780.com/?app=finance.rate&scur=#scur&tcur=#tcur&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4"; //汇率接口
	public function index() {
		$keyword = req::item("keyword");
		if (!empty($keyword)) {
			$or_where["curNo"] = $keyword;
			$or_where["curNm"] = $keyword;
			$or_where["curNmEn"] = $keyword;
		}
		$where["delete_time"] = "0";
		$obj = db::select("currencys", "count(*) count")->where($where);
		if (!empty($or_where)) {
			$obj->or_where($or_where, true);
		}
		$row = $obj->echo_sql(0)->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$obj = db::select("currencys", "*")->where($where);
		if (!empty($or_where)) {
			$obj->or_where($or_where, true);
		}
		$list = $obj->order_by("status desc")->limit($page["start"], $page["num"])->echo_sql(0)->all();
		$status = db::get_table_enum("currencys", "status");
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::assign("status_enum", $status);
		tpl::display("currencys.index.tpl");
	}
	public function enable() {
		$id = req::item("id");
		db::update("currencys")->set(["status" => 2])->where(["id" => $id])->execute();
		tpl::redirect("?ctl=currencys&act=index");
	}
	public function stop() {
		$id = req::item("id");
		db::update("currencys")->set(["status" => 1])->where(["id" => $id])->execute();
		tpl::redirect("?ctl=currencys&act=index");
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