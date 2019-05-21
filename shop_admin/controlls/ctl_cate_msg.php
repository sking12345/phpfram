<?php
namespace shop_admin\controlls;
use app\controlls\ctl_base;
use shop_admin\models\mod_cate_msg;
use snow\bases\cls_pages;
use snow\db;
use snow\db_verify;
use snow\req;
use snow\tpl;

class ctl_cate_msg extends ctl_base {

	/**分类管理*/
	public function index() {
		$row = db::select("category", "count(*) count")->one();
		$page = cls_pages::get_pages($row["count"], 10);

		$list = db::select("category", "id, cat_name, keywords, cat_desc, parent_id, sort_order, template_file, measure_unit, show_in_nav, style, is_show, grade, filter_attr, cat_recommend")->limit($page["start"], $page["num"])->all();
		$parent_ids = db::get_resource_fields($list, "parent_id");
		$parent_infos = db::select("category", "id,cat_name")->where(["id" => ["in", $parent_ids]])->all("id");
		tpl::assign("list", $list);
		tpl::assign("parent_infos", $parent_infos);
		tpl::assign("pages", $page);
		tpl::display("cate_msg.index.tpl");
	}
	/**
	 * 添加分类
	 */
	public function add() {
		$query = req::item("query");
		if ($query == "filter_attr") {
			$id = req::item("genre");
			if (empty($id)) {
				tpl::response("genre id is null", "-1");
			}
			$info = db::select("genre_attr", "id,name")->where(["genre_id" => $id])->all();
			tpl::assign("data", $info);
			tpl::response("sucuess", "1");
		}
		$recommend = db::get_table_enum("category", "cat_recommend");
		if (req::is_post()) {
			$data = req::post_data();
			/**
			 * [$data 如果设置了err_call]
			 * @var [type]
			 */
			$data = db_verify::table("category")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			$cat_recommend = 0;
			if (!empty($data["cat_recommend"])) {
				$arr = [];
				foreach ($data["cat_recommend"] as $key => $value) {
					$cat_recommend = $cat_recommend | $value;
					$arr[] = $recommend[$value];
				}
				$data["cat_recommer_val"] = implode(",", $arr);
			}
			if (!empty($data['parent_id'])) {
				$parent_infos = db::select("category", "id,parents")->where(["id" => $data["parent_id"]])->one();
				$arr = explode(",", $parent_infos["parents"]);
				$arr[] = $data["parent_id"];
				$data["parents"] = implode(",", $arr);

			}
			$data["cat_recommend"] = $cat_recommend;
			if (!empty($data["filter_attr"])) {
				$data["filter_attr"] = implode(",", $data["filter_attr"]);
				$data["genre_id"] = implode(",", $data["genre_id"]);
			}
			db::insert("category")->set($data)->execute();
			tpl::redirect("?ctl=cate_msg&act=index", "成功添加分类");
		}
		$genre_infos = db::select("genre", "id,name")->all();
		$cate_infos = mod_cate_msg::get_cates("0", "id,cat_name", true, 2);

		tpl::assign("genre_infos", $genre_infos);
		tpl::assign("cate_infos", $cate_infos);
		tpl::assign("recommend", $recommend);
		tpl::display("cate_msg.add.tpl");
	}

	public function infos() {
		$id = req::item("id");
		$infos = db::select("category", "*")->where(["id" => $id])->one();
		if ($infos["parent_id"] != "0") {
			$parent_info = db::select("category", "id,cat_name")->where(["id" => $infos["parent_id"]])->one();
			tpl::assign("parent_info", $parent_info);

		}
		tpl::assign("infos", $infos);
		tpl::display("cate_msg.infos.tpl");
	}
	public function edit() {
		$id = req::item("id");
		$query = req::item("query");

		if ($query == "filter_attr") {
			$id = req::item("genre");
			if (empty($id)) {
				tpl::response("genre id is null", "-1");
			}
			$info = db::select("genre_attr", "id,name")->where(["genre_id" => $id])->all();
			tpl::assign("data", $info);
			tpl::response("sucuess", "1");
		}
		$recommend = db::get_table_enum("category", "cat_recommend");
		if (req::is_post()) {
			$data = req::post_data();
			$data = db_verify::table("category")->set_err_call("shop\models\mod_err_hander::err_hander")->update($data);
			$cat_recommend = 0;
			$arr = [];
			foreach ($data["cat_recommend"] as $key => $value) {
				$cat_recommend = $cat_recommend | $value;
				$arr[] = $recommend[$value];
			}
			$data["cat_recommer_val"] = implode(",", $arr);
			if (!empty($data["filter_attr"])) {
				$data["filter_attr"] = implode(",", $data["filter_attr"]);
				$data["genre_id"] = implode(",", $data["genre_id"]);
			} else {
				$data["filter_attr"] = '';
				$data["genre_id"] = '';
			}
			if (!empty($data['parent_id'])) {
				$parent_infos = db::select("category", "id,parents")->where(["id" => $data["parent_id"]])->one();
				$arr = explode(",", $parent_infos["parents"]);
				$arr[] = $data["parent_id"];
				$data["parents"] = implode(",", $arr);

			}
			$data["cat_recommend"] = $cat_recommend;
			db::update("category")->set($data)->where(["id" => $id])->execute();
			$back_act = req::item("back", "index");
			tpl::redirect("?ctl=cate_msg&act={$back_act}&id={$id}", "成功添加分类");
		}
		$infos = db::select("category", "*")->where(["id" => $id])->one();
		$infos["filter_attr"] = explode(",", $infos["filter_attr"]);
		$infos["genre_id"] = explode(",", $infos["genre_id"]);
		if (!empty($infos["filter_attr"])) {
			$genre_attr = db::select("genre_attr", "id,name,genre_id")->where(["id" => ["in", $infos["filter_attr"]]])->all();
			$genre_attr_arr = [];
			foreach ($genre_attr as $key => $value) {
				$genre_attr_arr[$value["genre_id"]][] = ["id" => $value["id"], "name" => $value["name"]];
			}
			tpl::assign("genre_attr_arr", $genre_attr_arr);
		}
		$cate_infos = mod_cate_msg::get_cates("0", "id,cat_name", true, 2);
		$genre_infos = db::select("genre", "id,name")->all();
		tpl::assign("genre_infos", $genre_infos);
		tpl::assign("infos", $infos);
		tpl::assign("cate_infos", $cate_infos);
		tpl::assign("recommend", $recommend);
		tpl::display("cate_msg.edit.tpl");
	}
	public function del() {
		$id = req::item("id");
		db::delete("category")->where(["id" => $id])->execute();
		tpl::redirect("?ctl=cate_msg&act=index", "删除成功");

	}
}

?>









