<?php

namespace app\controlls;
use snow\bases\cls_pages;
use snow\db;
use snow\req;
use snow\tpl;
use snow\util;

class ctl_coding {

	public function __construct() {
		$query = req::item("query");
		if (!empty($query)) {
			$act = req::item("act");
			switch ($act) {
			case 'add_business_unit':
				$kind_id = req::item("kind_id");
				$info = db::select("code", "id,code")->where(["id" => $kind_id])->one();
				$info = db::select("code", "max(code) code")->where(["type" => 2])
					->where(["code" => ["like", "{$info["code"]}%"]])
					->one();
				if (empty($info["code"])) {

					$code = '00';
					tpl::assign("data", $code);
				} else {
					$code = $info["code"] + 1;
					tpl::assign("data", substr($code, 1, 2));
				}
				tpl::response(1, "success");
				break;
			case 'add_big_cate':
				$business_units = req::item("business_units");
				$info = db::select("code", "id,code")->where(["id" => $business_units])->one();
				$info = db::select("code", "max(code) code")->where(["type" => 3])
					->where(["code" => ["like", "{$info["code"]}%"]])
					->one();
				if (empty($info["code"])) {

					$code = '00';
					tpl::assign("data", $code);
				} else {
					$code = $info["code"] + 1;
					tpl::assign("data", substr($code, 3, 2));
				}
				tpl::response(1, "success");
				break;
			case 'add_small_cate':
				$big_cate = req::item("big_cate");
				$info = db::select("code", "id,code")->where(["id" => $big_cate])->one();
				$info = db::select("code", "max(code) code")->where(["type" => 4])
					->where(["code" => ["like", "{$info["code"]}%"]])
					->one();
				if (empty($info["code"])) {

					$code = '00';
					tpl::assign("data", $code);
				} else {
					$code = $info["code"] + 1;
					tpl::assign("data", substr($code, 5, 2));
				}
				tpl::response(1, "success");
				break;
				break;
			}
			exit();
		}
	}
	public function kind() {
		$keyword = req::item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$where["delete_time"] = 0;
		$where["type"] = 1;
		$row = db::select("code", "count(*) count")->where($where)->echo_sql(0)->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("code", "*")->where($where)->order_by("id desc")->limit($page["start"], $page["num"])->all();
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::display("coding.kind.tpl");
	}
	public function add_kind() {
		if (req::is_post()) {
			$post_data = req::post_data();
			$post_data["id"] = util::create_uniqid();
			$info = db::select("code", "*")->where(["code" => $post_data["code"]])
				->or_where(["name" => $post_data["name"]])->one();
			if (!empty($info)) {
				tpl::redirect(-1, "编码或名称已存在");
			}
			$post_data["type"] = "1";
			db::insert("code")->set($post_data)->execute();
			tpl::redirect("?ctl=coding&act=add_kind", "添加成功");
		}
		$info = db::select("code", "max(code) code")->where(["type" => 1])->one();
		if (empty($info)) {
			$code = "1";
		} else {
			$code = $info["code"] + 1;
		}
		tpl::assign("code", $code);
		tpl::display("coding.add_kind.tpl");
	}
	public function edit_kind() {
		$id = req::item("id");
		if (req::is_post()) {
			$post_data = req::post_data();
			$post_data["id"] = util::create_uniqid();
			$info = db::select("code", "*")->where(["id" => ["!=", $id]])
				->or_where(["name" => $post_data["name"], "code" => $post_data["code"]], true)
				->echo_sql(0)
				->one();
			if (!empty($info)) {
				tpl::redirect(-1, "编码或名称已存在");
			}
			$post_data["type"] = "1";
			db::update("code")->set($post_data)->where(["id" => $id])->execute();
			tpl::redirect("?ctl=coding&act=kind", "编辑成功");
		}
		$info = db::select("code", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $info);
		tpl::display("coding.edit_kind.tpl");
	}

	public function business_unit() {
		$keyword = req::item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$kind = req::item("kind");
		if (!empty($kind)) {
			$where["code"] = ["like", "{$kind}%"];
		}
		$where["type"] = 2;
		$row = db::select("code", "count(*) count")->where($where)->echo_sql(0)->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("code", "id,code,name,SUBSTRING(code,1,1) kinds")->where($where)->order_by("id desc")
			->limit($page["start"], $page["num"])
			->all();
		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all("code");
		tpl::assign("kinds", $kinds);
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::display("coding.business_unit.tpl");
	}

	public function add_business_unit() {

		if (req::is_post()) {
			$post_data = req::post_data();
			$kind_info = db::select("code", "id,code")->where(["id" => $post_data["kind_id"]])->one();
			$code = $kind_info["code"] . $post_data["code"];
			$info = db::select("code", "*")->where(["type" => "2", "id" => ["!=", $id]])
				->or_where(["code" => $code, "name" => $post_data["name"]], true)
				->echo_sql(0)
				->one();
			if (!empty($info)) {
				tpl::redirect(-1, "编码或名称已存在");
			}
			$post_data["id"] = util::create_uniqid();
			$post_data["type"] = "2";
			$info = db::select("code", "*")->where(["id" => $post_data["kind_id"]])->one();
			unset($post_data["kind_id"]);
			$post_data["code"] = $info["code"] . $post_data["code"];
			db::insert("code")->set($post_data)->execute();
			tpl::redirect("?ctl=coding&act=add_business_unit", "添加成功");
		}
		$kinds = db::select("code", "id,name")->where(["type" => "1"])->all();
		$infos = db::select("code", "max(code) code")->where(["type" => "2"])->echo_sql(0)->one();
		if (empty($infos["code"])) {
			$code = "00";
		} else {
			$code = $infos["code"] + 1;
			$code = substr($code, 1);
		}
		tpl::assign("code", $code);
		tpl::assign("kinds", $kinds);
		tpl::display("coding.add_business_unit.tpl");
	}
	public function edit_business_unit() {
		$id = req::item("id");
		if (req::is_post()) {
			$post_data = req::post_data();
			$kind_info = db::select("code", "id,code")->where(["id" => $post_data["kind_id"]])->one();
			$code = $kind_info["code"] . $post_data["code"];
			$info = db::select("code", "*")->where(["type" => "2", "id" => ["!=", $id]])
				->or_where(["code" => $code, "name" => $post_data["name"]], true)
				->echo_sql(0)
				->one();
			if (!empty($info)) {
				tpl::redirect(-1, "编码或名称已存在");
			}
			unset($post_data["kind_id"]);
			$post_data["code"] = $code;
			db::update("code")->set($post_data)->where(["id" => $id])->execute();
			tpl::redirect("?ctl=coding&act=business_unit", "编辑成功");
		}
		$where["id"] = $id;
		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all();
		$infos = db::select("code", "id,name,SUBSTRING(code,1,1) kinds,SUBSTRING(code,2,2) code")
			->where(["type" => "2"])->where($where)
			->echo_sql(0)->one();
		tpl::assign("infos", $infos);
		tpl::assign("kinds", $kinds);
		tpl::display("coding.edit_business_unit.tpl");
	}

	public function big_cate() {
		$keyword = req::item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$usiness_unit = req::item("unit_list");
		if (!empty($usiness_unit)) {
			$where["code"] = ["like", "%{$usiness_unit}%"];
		}
		$where["type"] = 3;
		$row = db::select("code", "count(*) count")->where($where)->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("code", "id,code,name,SUBSTRING(code,1,1) kinds,SUBSTRING(code,1,3) unit")
			->where($where)->order_by("id desc")
			->limit($page["start"], $page["num"])
			->all();
		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all("code");
		$unit_list = db::select("code", "id,name,code,SUBSTRING(code,1,1) kinds")->where(["type" => "2"])->all("code");
		tpl::assign("kinds", $kinds);
		tpl::assign("unit_list", $unit_list);
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::display("coding.big_cate.tpl");
	}

	public function add_big_cate() {
		if (req::is_post()) {
			$post_data = req::post_data();
			$info = db::select("code", "id,code")->where(["id" => $post_data["big_cate"]])->one();
			$code = $info["code"] . $$post_data["code"];
			$info = db::select("code", "*")->where(["type" => "2", "id" => ["!=", $id]])
				->or_where(["code" => $code, "name" => $post_data["name"]], true)
				->echo_sql(0)
				->one();
			if (!empty($info)) {
				tpl::redirect(-1, "编码或名称已存在");
			}
			$post_data["id"] = util::create_uniqid();
			$info = db::select("code", "id,code")->where(["id" => $post_data["business_units"]])->one();
			unset($post_data["business_units"]);
			unset($post_data["kind_id"]);
			$post_data["type"] = 3;
			$post_data["code"] = $info["code"] . $post_data["code"];
			db::insert("code")->set($post_data)->execute();
			tpl::redirect("?ctl=coding&act=add_big_cate", "添加成功");
		}
		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all();
		$business_units = db::select("code", "id,name,SUBSTRING(code,1,1) kind_id")
			->where(["type" => "2"])->all();
		$infos = db::select("code", "max(code) code")->where(["type" => "3"])->echo_sql(0)->one();
		if (empty($infos["code"])) {
			$code = "00";
		} else {
			$code = $infos["code"] + 1;
			$code = substr($code, 3);
		}
		tpl::assign("code", $code);
		tpl::assign("kinds", $kinds);
		tpl::assign("business_units", $business_units);
		tpl::display("coding.add_big_cate.tpl");
	}

	public function edit_big_cate() {
		$id = req::item("id");
		if (req::is_post()) {
			$post_data = req::post_data();
			$info = db::select("code", "id,code")->where(["id" => $post_data["big_cate"]])->one();
			$code = $info["code"] . $$post_data["code"];
			$info = db::select("code", "*")->where(["type" => "2", "id" => ["!=", $id]])
				->or_where(["code" => $code, "name" => $post_data["name"]], true)
				->echo_sql(0)
				->one();
			if (!empty($info)) {
				tpl::redirect(-1, "编码或名称已存在");
			}
			unset($post_data["business_units"]);
			unset($post_data["kind_id"]);
			unset($post_data["big_cate"]);
			$post_data["type"] = 3;
			$post_data["code"] = $code;
			db::update("code")->set($post_data)->where(["id" => $id])->execute();
			tpl::redirect("?ctl=coding&act=small_cate", "添加成功");
		}
		$infos = db::select("code", "*,SUBSTRING(code,1,1) kind_id,SUBSTRING(code,1,3) business_units,SUBSTRING(code,1,5) big_cate")
			->where(["id" => $id])
			->one();
		$infos["code"] = substr($infos["code"], 3);
		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all();
		$business_units = db::select("code", "id,name,code,SUBSTRING(code,1,1) kind_id")
			->where(["type" => "2"])->all();
		$big_cates = db::select("code", "id,name,code,SUBSTRING(code,1,3) big_cate")
			->where(["type" => "3"])->all();
		tpl::assign("kinds", $kinds);
		tpl::assign("business_units", $business_units);
		tpl::assign("big_cates", $big_cates);
		tpl::assign("infos", $infos);
		print_r($infos);
		tpl::display("coding.edit_big_cate.tpl");
	}

	public function small_cate() {
		$keyword = req::item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$unit = req::item("big_cate");
		if (!empty($unit)) {
			$where["code"] = ["like", "%{$unit}%"];
		}
		$where["type"] = 4;
		$row = db::select("code", "count(*) count")->where($where)->echo_sql(0)->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("code", "id,code,name,SUBSTRING(code,1,1) kinds,SUBSTRING(code,1,3) unit,SUBSTRING(code,1,5) big_cate")->where($where)->order_by("id desc")
			->limit($page["start"], $page["num"])
			->all();

		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all("code");
		$unit_list = db::select("code", "id,name,code,SUBSTRING(code,1,1) kinds")->where(["type" => "2"])->all("code");
		$big_cate = db::select("code", "id,name,code,SUBSTRING(code,1,3) unit")->where(["type" => "3"])->all("code");
		tpl::assign("kinds", $kinds);
		tpl::assign("unit_list", $unit_list);
		tpl::assign("big_cate", $big_cate);
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::display("coding.small_cate.tpl");
	}
	public function add_small_cate() {
		if (req::is_post()) {
			$post_data = req::post_data();

			$info = db::select("code", "id,code")->where(["id" => $post_data["big_cate"]])->one();
			$code = $info["code"] . $$post_data["code"];
			$info = db::select("code", "*")->where(["type" => "2", "id" => ["!=", $id]])
				->or_where(["code" => $code, "name" => $post_data["name"]], true)
				->echo_sql(0)
				->one();
			if (!empty($info)) {
				tpl::redirect(-1, "编码或名称已存在");
			}
			$post_data["id"] = util::create_uniqid();
			$info = db::select("code", "id,code")->where(["id" => $post_data["big_cate"]])->one();
			unset($post_data["business_units"]);
			unset($post_data["kind_id"]);
			unset($post_data["big_cate"]);
			$post_data["type"] = 4;
			$post_data["code"] = $info["code"] . $post_data["code"];
			db::insert("code")->set($post_data)->execute();
			tpl::redirect("?ctl=coding&act=add_small_cate", "添加成功");
		}
		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all();
		$business_units = db::select("code", "id,name,code,SUBSTRING(code,1,1) kind_id")
			->where(["type" => "2"])->all();
		$big_cates = db::select("code", "id,name,code,SUBSTRING(code,1,3) big_cate")
			->where(["type" => "3"])->all();
		$infos = db::select("code", "max(code) code")->where(["type" => "4"])->echo_sql(0)->one();
		if (empty($infos["code"])) {
			$code = "00";
		} else {
			$code = $infos["code"] + 1;
			$code = substr($code, 5);
		}
		tpl::assign("code", $code);
		tpl::assign("kinds", $kinds);
		tpl::assign("business_units", $business_units);
		tpl::assign("big_cates", $big_cates);
		tpl::display("coding.add_small_cate.tpl");
	}
	public function edit_small_cate() {
		$id = req::item("id");
		if (req::is_post()) {
			$post_data = req::post_data();

			$info = db::select("code", "id,code")->where(["id" => $post_data["big_cate"]])->one();
			$code = $info["code"] . $$post_data["code"];
			$info = db::select("code", "*")->where(["type" => "2", "id" => ["!=", $id]])
				->or_where(["code" => $code, "name" => $post_data["name"]], true)
				->echo_sql(0)
				->one();
			if (!empty($info)) {
				tpl::redirect(-1, "编码或名称已存在");
			}
			unset($post_data["business_units"]);
			unset($post_data["kind_id"]);
			unset($post_data["big_cate"]);
			$post_data["type"] = 4;
			$post_data["code"] = $code;
			db::update("code")->set($post_data)->where(["id" => $id])->execute();
			tpl::redirect("?ctl=coding&act=small_cate", "添加成功");
		}
		$infos = db::select("code", "*,SUBSTRING(code,1,1) kind_id,SUBSTRING(code,1,3) business_units,SUBSTRING(code,1,5) big_cate")
			->where(["id" => $id])
			->one();
		$infos["code"] = substr($infos["code"], 5);
		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all();
		$business_units = db::select("code", "id,name,code,SUBSTRING(code,1,1) kind_id")
			->where(["type" => "2"])->all();
		$big_cates = db::select("code", "id,name,code,SUBSTRING(code,1,3) big_cate")
			->where(["type" => "3"])->all();
		tpl::assign("kinds", $kinds);
		tpl::assign("business_units", $business_units);
		tpl::assign("big_cates", $big_cates);
		tpl::assign("infos", $infos);
		tpl::display("coding.edit_small_cate.tpl");
	}

	public function product_name() {
		$keyword = req::item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$small_cate = req::item("small_cate");
		if (!empty($small_cate)) {
			$where["code"] = ["like", "%{$small_cate}%"];
		}
		$where["delete_time"] = "0";
		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all("code");
		$unit_list = db::select("code", "id,name,code")->where(["type" => "2"])->all("code");
		$big_cate = db::select("code", "id,name,code")->where(["type" => "3"])->all("code");
		$small_cate = db::select("code", "id,name,code,SUBSTRING(code,1,5) big_cate")
			->where(["type" => "4"])->all("code");
		$row = db::select("product_name", "count(*) count")->where($where)->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("product_name", "*")->where($where)->order_by("attr_status asc,id desc")
			->limit($page["start"], $page["num"])->all();
		tpl::assign("kinds", $kinds);
		tpl::assign("unit_list", $unit_list);
		tpl::assign("big_cate", $big_cate);
		tpl::assign("small_cate", $small_cate);
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::display("coding.product_name.tpl");
	}

	public function add_product_name() {
		$smaill_cates = db::select("code", "id,name,code,SUBSTRING(code,1,5) big_cate")
			->where(["type" => "4"])->all("id");
		if (req::is_post()) {
			$post_data = req::post_data();
			$name_arr = explode("|", $post_data["name"]);
			$db_data = [];
			foreach ($name_arr as $key => $value) {
				$arr["code_id"] = $post_data["small_cate"];
				$arr["id"] = util::create_uniqid();
				$arr["name"] = $value;
				$arr["delete_time"] = "0";
				$arr["code"] = $smaill_cates[$post_data["small_cate"]]["code"];
				$db_data[] = $arr;
			}
			db::insert("product_name")->set($db_data, true)->execute();
			tpl::redirect("?ctl=coding&act=add_product_name", "添加成功");
		}
		$big_cates = db::select("code", "id,name,code,SUBSTRING(code,1,3) bunits_id")
			->where(["type" => "3"])->all();
		tpl::assign("big_cates", $big_cates);
		tpl::assign("smaill_cates", $smaill_cates);
		tpl::display("coding.add_product_name.tpl");
	}
	/**
	 * 编辑品名
	 */
	public function edit_product_name() {
		$id = req::item("id");
		if (req::is_post()) {
			$post_data = req::post_data();
			$db_data["name"] = $post_data["name"];
			$db_data["code_id"] = $post_data["small_cate"];
			$db_data["attrs"] = req::item("attrs");
			db::delete("product_attrs")->where(["pid" => $id, "id" => ["!=", NULL]])->execute();
			if (empty($db_data["attrs"])) {
				$db_data["attr_status"] = "0";
			} else {
				$db_data["attr_status"] = "1";
				$attr_arr = explode("|", $db_data["attrs"]);
				$attr_data = [];
				foreach ($attr_arr as $key => $value) {
					$val["pid"] = $id;
					$val["name"] = $value;
					$val["id"] = util::create_uniqid();
					$attr_data[] = $val;
				}
				db::insert("product_attrs")->set($attr_data, true)->execute();
			}
			$info = db::select("code", "id,code")->where(["id" => $db_data["code_id"]])->one();
			$db_data["code"] = $info["code"];
			db::update("product_name")->set($db_data)->where(["id" => $id])->execute();
			tpl::redirect("?ctl=coding&act=product_name", "编辑成功");
		}
		$smaill_cates = db::select("code", "id,name,code,SUBSTRING(code,1,5) big_cate")
			->where(["type" => "4"])->all("id");
		$big_cates = db::select("code", "id,name,code,SUBSTRING(code,1,3) bunits_id")
			->where(["type" => "3"])->all();
		tpl::assign("big_cates", $big_cates);
		tpl::assign("smaill_cates", $smaill_cates);
		$info = db::select("product_name", "*,SUBSTRING(code,1,5) big_cate")->where(["id" => $id])->one();
		tpl::assign("info", $info);
		tpl::display("coding.edit_product_name.tpl");
	}

	/**
	 * 品名属性
	 */
	public function add_attributes() {
		$id = req::item("id");
		$smaill_cates = db::select("code", "id,name,code,SUBSTRING(code,1,5) big_cate")
			->where(["type" => "4"])->all("id");
		$big_cates = db::select("code", "id,name,code,SUBSTRING(code,1,3) bunits_id")
			->where(["type" => "3"])->all();
		tpl::assign("big_cates", $big_cates);
		tpl::assign("smaill_cates", $smaill_cates);
		$info = db::select("product_name", "*,SUBSTRING(code,1,5) big_cate")->where(["id" => $id])->one();
		tpl::assign("info", $info);
		tpl::display("coding.add_attributes.tpl");
	}

	/**
	 * 流水号
	 */
	public function pipeline_coding() {
		$where["delete_time"] = 0;
		$row = db::select("pipeline_coding", "count(*) count")->where($where)->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("pipeline_coding", "*")->where($where)
			->order_by("id desc")->limit($page["start"], $page["num"])->all();
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::display("coding.pipeline_coding.tpl");
	}
	public function create_pipeline() {
		if (req::is_post()) {
			$small_cate = req::item("small_cate");
			$info_small = db::select("code", "id,code")->where(["id" => $small_cate])->one();
			$info = db::select("pipeline_coding", "max(code) code")
				->where(["code" => ["like", $info_small["code"]]])->one();
			if (empty($info["code"])) {
				$insert_data["code"] = $info_small["code"] . "00000";
			} else {
				$insert_data["code"] = $info["code"] + 1;
			}
			$insert_data["id"] = util::create_uniqid();
			$insert_data["create_time"] = time();
			$insert_data["delete_time"] = "0";
			db::insert("pipeline_coding")->set($insert_data)->execute();
			tpl::redirect("?ctl=coding&act=pipeline_coding", "流水生产成功");
		}
		$kinds = db::select("code", "id,name,code")->where(["type" => "1"])->all();
		$business_units = db::select("code", "id,name,code,SUBSTRING(code,1,1) kind_id")
			->where(["type" => "2"])->all();
		$big_cates = db::select("code", "id,name,code,SUBSTRING(code,1,3) big_cate")
			->where(["type" => "3"])->all();
		$small_cates = db::select("code", "id,name,code,SUBSTRING(code,1,5) small_cate")
			->where(["type" => "4"])
			->all();

		tpl::assign("kinds", $kinds);
		tpl::assign("business_units", $business_units);
		tpl::assign("big_cates", $big_cates);
		tpl::assign("small_cates", $small_cates);

		tpl::display("coding.create_pipeline.tpl");
	}
}
?>



























