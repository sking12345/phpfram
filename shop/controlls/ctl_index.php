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
		$recommends = db::select("category", "id,cat_name")->where(["parents" => "0"])->all();
		$merchandise = db::select("merchandise", "id,name,shop_price,img")->all();
		tpl::assign("recommends", $recommends);
		tpl::assign("merchandise", $merchandise);
		tpl::display("index.recommends.tpl");
	}

}