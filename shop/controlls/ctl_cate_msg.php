<?php
namespace shop\controlls;
use app\controlls\ctl_base;
use shop\models\mod_cate_msg;
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

		$list = db::select("category", "id, cat_name, keywords, cat_desc, parent_id, sort_order, template_file, measure_unit, show_in_nav, style, is_show, grade, filter_attr, cat_recommend")->limit($page["start"], $page["num"])->all("id");
		tpl::assign("list", $list);
		tpl::assign("pages", $page);

		tpl::display("cate_msg.index.tpl");
	}
	/**
	 * 添加分类
	 */
	public function add() {
		if (req::is_post()) {
			$data = req::post_data();

			/**
			 * [$data 如果设置了err_call]
			 * @var [type]
			 */
			$data = db_verify::table("category")->set_err_call("shop\models\mod_err_hander::err_hander")->insert($data);
			// $data["id"] = util::create_uniqid(18);
			$data["cat_recommend"] = implode(",", $data["cat_recommend"]);
			db::insert("category")->set($data)->echo_sql(1)->execute();
			tpl::redirect("?ctl=cate_msg&act=index", "成功添加分类");
		}
		$cate_infos = mod_cate_msg::get_cates("0", "id,cat_name", true, 2);
		tpl::assign("cate_infos", $cate_infos);
		tpl::display("cate_msg.add.tpl");
	}

	public function infos() {
		$id = req::item("id");
		$infos = db::select("category", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("cate_msg.infos.tpl");
	}
	public function edit() {
		$id = req::item("id");
		$infos = db::select("category", "*")->where(["id" => $id])->one();
		$cate_infos = mod_cate_msg::get_cates("0", "id,cat_name", true, 2);
		tpl::assign("infos", $infos);
		tpl::assign("cate_infos", $cate_infos);
		tpl::display("cate_msg.edit.tpl");
	}
	public function transfer() {

	}
}

?>









