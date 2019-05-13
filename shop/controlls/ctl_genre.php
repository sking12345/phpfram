<?php
/**
 * 商品类型添加,类型属性
 */
namespace shop\controlls;
use app\controlls\ctl_base;
use snow\bases\cls_pages;
use snow\db;
use snow\db_verify;
use snow\req;
use snow\tpl;
use snow\util;

class ctl_genre extends ctl_base {

	public function index() {
		$row = db::select("genre", "count(*) count")->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("genre", "id, name, attr_num, enabled")->limit($page["start"], $page["num"])->all("id");
		tpl::assign("list", $list);
		tpl::assign("pages", $page);
		tpl::display("genre.index.tpl");
	}

	public function add() {
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("genre")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			db::insert("genre")->set($data)->execute();
			tpl::redirect("?ctl=genre&act=index", "类型添加成功");
		}
		tpl::display("genre.add.tpl");
	}

	public function infos() {
		$id = req::item("id");
		$infos = db::select("genre", "*")->where(["id" => $id])->one();
		$row = db::select("genre_attr", "count(*) count")->where(["genre_id" => $id])->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$attr_list = db::select("genre_attr", "*")->where(["genre_id" => $id])->limit($page["start"], $page["num"])->all();
		tpl::assign("infos", $infos);
		tpl::assign("attr_list", $attr_list);
		tpl::assign("pages", $page);
		tpl::display("genre.infos.tpl");
	}

	public function edit() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("genre")->set_err_call("shop\models\mod_err_hander::err_hander")->update($data);
			db::update("genre")->set($data)->where(["id" => $id])->execute();
			$back_act = req::item("back", "index");
			tpl::redirect("?ctl=genre&act={$back_act}&id={$id}", "类型编辑成功");
		}
		$infos = db::select("genre", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("genre.edit.tpl");
	}
	/**
	 * [add_attr 添加属性]
	 */
	public function add_attr() {
		$id = req::item("id");
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("genre_attr")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			$attr_list_arr = [];
			foreach (explode("|", $data["select_list"]) as $key => $value) {
				$attr_list_arr[] = ["id" => util::create_uniqid(18), "attr_id" => $data["id"], "name" => $value];
			}

			db::start();
			db::insert("genre_attr")->set($data)->execute();
			db::insert("genre_attr_list")->set($attr_list_arr, true)->execute();
			db::update("genre")->set(["attr_num" => ["+", "1"]])->where(["id" => $data["genre_id"]])->execute();
			db::commit();
			tpl::redirect("?ctl=genre&act=infos&id={$id}", "属性添加成功");
		}
		$infos = db::select("genre", "id,name")->where(["id" => $id])->one();
		tpl::assign("name", $infos["name"]);
		tpl::display("genre.add_attr.tpl");
	}

	public function edit_attr() {
		$id = req::item("id");
		$genre_id = req::item("genre_id");
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("genre_attr")->set_err_call("shop\models\mod_err_hander::err_hander")->update($data);
			$attr_list_arr = [];
			foreach (explode("|", $data["select_list"]) as $key => $value) {
				$attr_list_arr[] = ["id" => util::create_uniqid(18), "attr_id" => $id, "name" => $value];
			}
			db::delete("genre_attr_list")->where(["id" => ["!=", null], "attr_id" => $id])->execute();
			db::start();
			db::update("genre_attr")->set($data)->where(["id" => $id])->execute();
			db::insert("genre_attr_list")->set($attr_list_arr, true)->execute();
			db::commit();
			tpl::redirect("?ctl=genre&act=infos&id={$genre_id}", "属性编辑成功");
		}
		$infos = db::select("genre_attr", "*")->where(["id" => $id])->one();
		$genre_info = db::select("genre", "id,name")->where(["id" => $infos["genre_id"]])->one();
		tpl::assign("name", $genre_info["name"]);
		tpl::assign("infos", $infos);
		tpl::display("genre.edit_attr.tpl");
	}
	public function del_attr() {
		$id = req::item("id");
		$genre_id = req::item("genre_id");
		db::start();
		db::delete("genre_attr")->where(["id" => $id])->execute();
		db::update("genre")->set(["attr_num" => ["-", "1"]])->where(["id" => $genre_id])->execute();
		db::commit();
		tpl::redirect("?ctl=genre&act=infos&id={$genre_id}", "属性删除成功");

	}

	public function attr_index() {
		$row = db::select("genre_attr", "count(*) count")->one();
		$page = cls_pages::get_pages($row["count"], 10);
		$list = db::select("genre_attr", "*")->limit($page["start"], $page["num"])->all("id");
		$genre_ids = db::get_resource_fields($list, "genre_id");
		$genre_infos = db::select("genre", "id,name")->where(["id" => ["in", $genre_ids]])->all("id");
		tpl::assign("pages", $page);
		tpl::assign("list", $list);
		tpl::assign("genre_infos", $genre_infos);
		tpl::display("genre.attr_index.tpl");
	}
}
?>























