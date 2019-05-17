<?php
/**
 * 品牌管理
 */
namespace shop_admin\controlls;
use snow\bases\cls_pages;
use snow\db;
use snow\db_verify;
use snow\req;
use snow\tpl;
use snow\util;

class ctl_brand_msg {

	public function index() {
		$row = db::select("brand", "count(*) count")->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("brand", "*")->limit($page["start"], $page["num"])->all("id");
		tpl::assign("list", $list);
		tpl::assign("pages", $page);
		tpl::display("brand_msg.index.tpl");
	}

	public function add() {
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("brand")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			if (!empty($_FILES["logo"]["tmp_name"])) {
				$tmp_name = $_FILES["logo"]["tmp_name"];
				$name = $_FILES["logo"]["name"];
				$uploads_dir = "./upload/img/" . util::create_uniqid(16) . substr($name, strripos($name, "."));
				if (move_uploaded_file($tmp_name, $uploads_dir) == false) {
					tpl::redirect(-1, "文件上传失败");
				}
				$data["logo"] = $uploads_dir;
			}
			db::insert("brand")->set($data)->execute();
			tpl::redirect("?ctl=brand_msg&act=index", "品牌添加成功");
		}
		tpl::display("brand_msg.add.tpl");
	}
	public function infos() {
		$id = req::item("id");
		$infos = db::select("brand", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("brand_msg.infos.tpl");
	}
	public function edit() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("brand")->set_err_call("shop\models\mod_err_hander::err_hander")->update($data);
			if (!empty($_FILES["logo"]["tmp_name"])) {
				$tmp_name = $_FILES["logo"]["tmp_name"];
				$name = $_FILES["logo"]["name"];
				$uploads_dir = "./upload/img/" . util::create_uniqid(16) . substr($name, strripos($name, "."));
				if (move_uploaded_file($tmp_name, $uploads_dir) == false) {
					tpl::redirect(-1, "文件上传失败");
				}
				$data["logo"] = $uploads_dir;
			}
			$back = req::item("back", "index");
			db::update("brand")->set($data)->where(["id" => $id])->execute();
			tpl::redirect("?ctl=brand_msg&act={$back}&&id={$id}", "品牌编辑成功");
		}
		$infos = db::select("brand", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("brand_msg.edit.tpl");
	}

	public function del() {
		$id = req::item("id");
		db::delete("brand")->where(["id" => $id])->execute();
		tpl::redirect("?ctl=brand_msg&act=index", "品牌删除成功");
	}

}
?>
















