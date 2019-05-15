<?php
namespace shop\controlls;
use shop\models\mod_cate_msg;
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
		$list = db::select("merchandise", "*")->all();
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
			if (!empty($data["product_details"])) {
				$product_details = $data["product_details"];
				print_r($product_details);

				unset($data["product_details"]);
				exit();
			}
			$data = db_verify::table("merchandise")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			$data["promotion_end_time"] = strtotime($data["promotion_end_time"]);
			$data["promotion_start_time"] = strtotime($data["promotion_start_time"]);
			if (!empty($_FILES["imgs"])) {
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
				$data["img"] = $product_imgs[0];
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
		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("merchandise.infos.tpl");
	}

	public function edit() {
		tpl::display("merchandise.edit.tpl");
	}
}
?>






