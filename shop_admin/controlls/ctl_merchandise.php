<?php
namespace shop_admin\controlls;
use shop_admin\models\mod_cate_msg;
use snow\bases\cls_pages;
use snow\db;
use snow\db_verify;
use snow\req;
use snow\tpl;
use snow\util;

/**
 * 商品管理
 */
class ctl_merchandise {

	public function index() {
		$row = db::select("merchandise", "count(*) count")->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("merchandise", "*")->order_by("id desc")->all();
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::display("merchandise.index.tpl");
	}

	public function add() {
		$query = req::item("query");
		if ($query == "get_genre_attr") {
			$genre_id = req::item("genre");
			$genre_attr_infos = db::select("genre_attr", "id,name,input_type")->where(["genre_id" => $genre_id])->all("");
			$attr_list = db::select("genre_attr_list", "id,name,attr_id")->where(["genre_id" => $genre_id])->all();
			$attr_list_arr = [];
			foreach ($attr_list as $key => $value) {
				$attr_list_arr[$value["attr_id"]][] = $value;
			}
			tpl::assign("attr_infos", $genre_attr_infos);
			tpl::assign("attr_list", $attr_list_arr);
			tpl::response("sucess", 1);
		}
		if (req::is_post()) {
			$data = req::post_data();
			if (!empty($data["attr_list"])) {
				$attr_list = $data["attr_list"];
				unset($data["attr_list"]);
			}
			if (!empty($data["img_remarks"])) {
				$img_remarks = $data["img_remarks"];
				unset($data["img_remarks"]);
			}
			$data = db_verify::table("merchandise")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			if (!empty($data["promotion_end_time"])) {
				$data["promotion_end_time"] = strtotime($data["promotion_end_time"]);
			}
			if (!empty($data["promotion_start_time"])) {
				$data["promotion_start_time"] = strtotime($data["promotion_start_time"]);
			}

			if (!empty($_FILES["imgs"]["name"][0])) {
				$product_imgs = [];
				foreach ($_FILES["imgs"]["name"] as $key => $value) {
					$tmp_name = $_FILES["imgs"]["tmp_name"][$key];
					$name = $_FILES["imgs"]["name"][$key];
					$uploads_dir = "./upload/product_imgs/" . util::create_uniqid(16) . substr($name, strripos($name, "."));
					if (move_uploaded_file($tmp_name, $uploads_dir) == false) {
						tpl::redirect(-1, "文件上传失败");
					}
					$product_imgs[] = [
						"id" => util::create_uniqid(16),
						"merchandise_id" => $data["id"],
						"url" => $uploads_dir,
						"remarks" => $img_remarks[$key],
					];
				}
				$data["img"] = $product_imgs[0]["url"];
				db::insert("merchandise_imgs")->set($product_imgs, true)->execute();
			}
			$recommend = 0;
			if (!empty($data["recommend"])) {
				foreach ($data["recommend"] as $key => $value) {
					$recommend = $recommend | $value;
				}
				$data["recommend"] = $recommend;
			}
			if (empty($data["number"])) {
				$data["number"] = util::create_uniqid(18);
			}
			if (!empty($attr_list)) {
				$add_attr_list = [];
				foreach ($attr_list as $key => $value) {
					if (is_array($value)) {
						$str = implode(",", $value);
					} else {
						$str = $value;
					}
					$add_attr_list[] = ["id" => util::create_uniqid(), "merchandise_id" => $data["id"], "attr_id" => $key, "attr_val" => $str];
				}
				db::start();
				db::insert("merchandise")->set($data)->execute();
				db::insert("merchandise_attr")->set($add_attr_list, true)->execute();
				db::commit();
			} else {
				db::start();
				db::insert("merchandise")->set($data)->execute();
				db::commit();
			}

			tpl::redirect("?ctl=merchandise&act=index", "商品添加成功");
		}
		$recommend = db::get_table_enum("merchandise", "recommend");
		$weight_type = db::get_table_enum("merchandise", "weight_type");
		$genre = db::select("genre", "id,name")->all();
		$suppliers = db::select("supplier", "id,name")->all();
		$brands = db::select("brand", "id,name")->order_by("sort asc")->all();
		$cate_infos = mod_cate_msg::get_cates("0", "id,cat_name", true);
		tpl::assign("recommend", $recommend);
		tpl::assign("weight_type", $weight_type);
		tpl::assign("genre", $genre);
		tpl::assign("suppliers", $suppliers);
		tpl::assign("brands", $brands);
		tpl::assign("cate_infos", $cate_infos);
		tpl::display("merchandise.add.tpl");
	}

	public function infos() {
		$id = req::item("id");
		$recommend = db::get_table_enum("merchandise", "recommend");
		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		$cate_info = db::select("category", "id,cat_name name")->where(["id" => $infos["cate_id"]])->one();
		$infos["cate_id"] = $cate_info["name"];
		$brand_info = db::select("brand", "id,name")->where(["id" => $infos["brand_id"]])->one();
		$infos["brand_id"] = $brand_info["name"];
		$supplier_info = db::select("supplier", "id,name")->where(["id" => $infos["supplier_id"]])->one();
		$infos["supplier_id"] = $brand_info["name"];
		$weight_type = db::get_table_enum("merchandise", "weight_type");
		$infos["weight_type"] = $weight_type[$infos["weight_type"]];
		$genre_infos = db::select("genre", "id,name")->where(["id" => $infos["genre_id"]])->echo_sql(0)->one();
		$infos["genre_id"] = $genre_infos["name"];
		$merchandise_attrs = db::select("merchandise_attr", "attr_id,attr_val")->where(["merchandise_id" => $id])->all();
		$attr_ids = db::get_resource_fields($merchandise_attrs, "attr_id");
		$genre_attrs = db::select("genre_attr", "id,name")->where(["id" => ["in", $attr_ids]])->all("id");
		$merchandise_imgs = db::select("merchandise_imgs", "url,remarks")->where(["merchandise_id" => $id])->all();
		$infos["details"] = htmlspecialchars_decode($infos["details"]);
		tpl::assign("recommend", $recommend);
		tpl::assign("merchandise_attrs", $merchandise_attrs);
		tpl::assign("genre_attrs", $genre_attrs);
		tpl::assign("merchandise_imgs", $merchandise_imgs);
		tpl::assign("infos", $infos);
		tpl::display("merchandise.infos.tpl");
	}

	public function edit() {
		$id = req::item("id");
		$query = req::item("query");
		if ($query == "get_genre_attr") {
			$genre_id = req::item("genre");
			$genre_attr_infos = db::select("genre_attr", "id,name,input_type")->where(["genre_id" => $genre_id])->all("");
			$attr_list = db::select("genre_attr_list", "id,name,attr_id")->where(["genre_id" => $genre_id])->all();
			$attr_list_arr = [];
			foreach ($attr_list as $key => $value) {
				$attr_list_arr[$value["attr_id"]][] = $value;
			}
			tpl::assign("attr_infos", $genre_attr_infos);
			tpl::assign("attr_list", $attr_list_arr);
			tpl::response("sucess", 1);
		}
		if (req::is_post()) {
			$data = req::post_data();
			if (!empty($data["attr_list"])) {
				$attr_list = $data["attr_list"];
				unset($data["attr_list"]);
			}
			if (!empty($data["img_remarks"])) {
				$img_remarks = $data["img_remarks"];
				unset($data["img_remarks"]);
			}
			if (empty($data["is_shelf"])) {
				$data["is_shelf"] = "2";
			}
			if (empty($data["is_general_goods"])) {
				$data["is_general_goods"] = "2";
			}
			if (empty($data["is_free_shipping"])) {
				$data["is_free_shipping"] = "2";
			}
			$data = db_verify::table("merchandise")->set_err_call("shop\models\mod_err_hander::err_hander")->update($data);
			if (!empty($data["promotion_end_time"])) {
				$data["promotion_end_time"] = strtotime($data["promotion_end_time"]);
			}
			if (!empty($data["promotion_start_time"])) {
				$data["promotion_start_time"] = strtotime($data["promotion_start_time"]);
			}
			if (!empty($data["imgs_ids"])) {
				db::delete("merchandise_imgs")->where(["id" => ["not in", $data["imgs_ids"]], "merchandise_id" => $id])->echo_sql(1)->execute();
				unset($data["imgs_ids"]);
			}
			if (count($_FILES["imgs"]["name"]) > 0) {
				$product_imgs = [];
				foreach ($_FILES["imgs"]["name"] as $key => $value) {
					$product_imgs = [
						"merchandise_id" => $id,
						"remarks" => $img_remarks[$key],
					];
					if (!empty($_FILES["imgs"]["tmp_name"][$key])) {
						$tmp_name = $_FILES["imgs"]["tmp_name"][$key];
						$name = $_FILES["imgs"]["name"][$key];
						$uploads_dir = "./upload/product_imgs/" . util::create_uniqid(16) . substr($name, strripos($name, "."));
						if (move_uploaded_file($tmp_name, $uploads_dir) == false) {
							tpl::redirect(-1, "文件上传失败");
						}
						$product_imgs["url"] = $uploads_dir;
					}
					if (!empty($data["img"])) {
						$data["img"] = $uploads_dir;
					}
					$infos = db::select("merchandise_imgs", "id")->where(["id" => $key])->one();
					if (empty($infos)) {
						$product_imgs["id"] = util::create_uniqid(16);
						db::insert("merchandise_imgs")->set($product_imgs)->execute();
					} else {
						db::update("merchandise_imgs")->set($product_imgs)->where(["id" => $key])->execute();
					}
				}
			}
			$recommend = 0;
			if (!empty($data["recommend"])) {
				foreach ($data["recommend"] as $key => $value) {
					$recommend = $recommend | $value;
				}
			}
			$data["recommend"] = $recommend;
			if (empty($data["number"])) {
				$data["number"] = util::create_uniqid(18);
			}
			db::delete("merchandise_attr")->where(["id" => ["!=", null], "merchandise_id" => $id])->execute();
			if (!empty($attr_list)) {
				$add_attr_list = [];
				foreach ($attr_list as $key => $value) {
					if (is_array($value)) {
						$str = implode(",", $value);
					} else {
						$str = $value;
					}
					$add_attr_list[] = ["id" => util::create_uniqid(), "merchandise_id" => $id, "attr_id" => $key, "attr_val" => $str];
				}
				db::start();
				db::update("merchandise")->set($data)->where(["id" => $id])->execute();
				db::insert("merchandise_attr")->set($add_attr_list, true)->execute();
				db::commit();
			} else {
				db::start();
				db::update("merchandise")->set($data)->where(["id" => $id])->execute();
				db::commit();
			}
			tpl::redirect("?ctl=merchandise&act=infos&id={$id}", "商品编辑成功");
		}
		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		$recommend = db::get_table_enum("merchandise", "recommend");
		$weight_type = db::get_table_enum("merchandise", "weight_type");
		$genre = db::select("genre", "id,name")->all();
		$suppliers = db::select("supplier", "id,name")->all();
		$brands = db::select("brand", "id,name")->order_by("sort asc")->all();
		$cate_infos = mod_cate_msg::get_cates("0", "id,cat_name", true);
		$merchandise_attrs = db::select("merchandise_attr", "attr_id,attr_val")->where(["merchandise_id" => $id])->all("attr_id");
		$merchandise_imgs = db::select("merchandise_imgs", "id,url,remarks")->where(["merchandise_id" => $id])->all();
		$genre_attr_infos = db::select("genre_attr", "id,name,input_type")->where(["genre_id" => $infos["genre_id"]])->all("");
		$attr_list = db::select("genre_attr_list", "id,name,attr_id")->where(["genre_id" => $infos["genre_id"]])->all();
		$attr_list_arr = [];
		foreach ($attr_list as $key => $value) {
			$attr_list_arr[$value["attr_id"]][] = $value;
		}
		tpl::assign("attr_infos", $genre_attr_infos);
		tpl::assign("attr_list", $attr_list_arr);
		tpl::assign("merchandise_attrs", $merchandise_attrs);
		tpl::assign("merchandise_imgs", $merchandise_imgs);
		tpl::assign("recommend", $recommend);
		tpl::assign("weight_type", $weight_type);
		tpl::assign("genre", $genre);
		tpl::assign("suppliers", $suppliers);
		tpl::assign("brands", $brands);
		tpl::assign("cate_infos", $cate_infos);
		tpl::assign("infos", $infos);
		tpl::display("merchandise.edit.tpl");
	}

	public function edit_details() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			db::update("merchandise")->set($data)->where(["id" => $id])->execute();
			tpl::redirect("?ctl=merchandise&act=infos&id={$id}", "商品详情编辑成功");
		}
		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("merchandise.edit_details.tpl");
	}
}
?>






