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
		tpl::assign("pages", $page);
		tpl::display("merchandise.index.tpl");
	}

	public function add() {
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("merchandise")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			$data["promotion_end_time"] = strtotime($data["promotion_end_time"]);
			$data["promotion_start_time"] = strtotime($data["promotion_start_time"]);
			if (!empty($_FILES["img"]["tmp_name"])) {
				$tmp_name = $_FILES["img"]["tmp_name"];
				$name = $_FILES["img"]["name"];
				$uploads_dir = "./upload/img/" . util::create_uniqid(16) . substr($name, strripos($name, "."));
				if (move_uploaded_file($tmp_name, $uploads_dir) == false) {
					tpl::redirect(-1, "文件上传失败");
				}
				$data["img"] = $uploads_dir;
			}
			db::insert("merchandise")->set($data)->execute();
			tpl::redirect("?ctl=merchandise&act=index", "商品添加成功");
			//print_r($data);
		}
		$genre = db::select("genre", "id,name")->all();
		$suppliers = db::select("supplier", "id,name")->all();
		$brands = db::select("brand", "id,name")->order_by("sort asc")->all();
		$cate_infos = mod_cate_msg::get_cates("0", "id,cat_name", true);
		tpl::assign("genre", $genre);
		tpl::assign("suppliers", $suppliers);
		tpl::assign("brands", $brands);
		tpl::assign("cate_infos", $cate_infos);
		tpl::display("merchandise.add.tpl");
	}
}