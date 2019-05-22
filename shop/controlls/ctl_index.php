<?php
namespace shop\controlls;
use shop\models\mod_cate_msg;
use snow\db;
use snow\tpl;

class ctl_index {
	public function index() {
		tpl::display("index.index.tpl");
	}

	public function index1() {
		$cates = mod_cate_msg::get_cates();
		tpl::assign("cates", $cates);
		tpl::display("index.index1.tpl");
	}

	/**
	 * 推荐项
	 */
	public function recommends() {

		$merchandise = db::select("merchandise", "id,name,shop_price,img,cate_id")->all();
		$merchandise_arr = [];
		$recommends_id = [];
		foreach ($merchandise as $key => $value) {
			$merchandise_arr[$value["cate_id"]][] = $value;
			$recommends_id[] = $value["cate_id"];
		}
		$recommends = db::select("category", "id,cat_name")
			->where(["parents" => "0"])
			->where(["id" => ["in", $recommends_id]])
			->all();
		tpl::assign("recommends", $recommends);
		tpl::assign("merchandise", $merchandise_arr);
		tpl::display("index.recommends.tpl");
	}

}