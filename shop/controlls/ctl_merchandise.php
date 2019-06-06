<?php
namespace shop\controlls;
use snow\cache;
use snow\cookie;
use snow\db;
use snow\req;
use snow\tpl;
use snow\user;
use snow\util;

class ctl_merchandise {

	public function index() {

		$id = req::item("id");
		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		tpl::assign("infos", $infos);
		tpl::display("merchandise.index.tpl");
	}

	public function buy() {

		$id = req::item("id");
		if (user::is_login() == false) {
			$uniqid = util::create_uniqid();
			cookie::set("unqin_id", $uniqid);
			cache::set($uniqid, $id);
			tpl::redirect("?ctl=member&act=login", "请先登录");
		}
		$id = req::item("id");
		if (empty($id)) {
			goto End;
		}

		$infos = db::select("merchandise", "*")->where(["id" => $id])->one();
		$cart_data["id"] = util::create_uniqid();
		$cart_data["name"] = $infos['name'];
		$cart_data["price"] = $infos["shop_price"];
		$cart_data["number"] = req::item("number", 1);
		$cart_data["merchandise_id"] = $id;
		$cart_data["member_id"] = user::$instance->get("id");
		$cart_data["total_price"] = $infos["shop_price"] * $cart_data["number"];
		$cate_info = db::select("category", "id,parents")->where(["id" => $infos["cate_id"]])->one();
		$cate_arr = explode(",", $cate_info["parents"]);
		if (!empty($cate_arr[1])) {
			$cart_data["cate_id"] = $cate_arr[1];
		} else {
			$cart_data["cate_id"] = $infos["cate_id"];
		}
		$cart_data["create_time"] = time();
		$minfo = db::select("shop_cart", "*")
			->where(["member_id" => user::$instance->get("id"), "merchandise_id" => $id, "status" => 1, "delete_time" => "0"])
			->one();

		if (empty($minfo)) {
			db::insert("shop_cart")->set($cart_data)->execute();
		} else {
			db::update("shop_cart")->set($cart_data)->where(["id" => $minfo["id"]])->execute();
		}
		End:
		$infos = db::select("shop_cart", "*")->where(["member_id" => user::$instance->get("id"), "status" => 1, "delete_time" => "0"])->all();
		$total_price = db::select("shop_cart", "sum(total_price) price")
			->where(["member_id" => user::$instance->get("id"), "status" => 1, "delete_time" => "0"])
			->one();
		tpl::assign("list", $infos);
		tpl::assign("total_price", $total_price["price"]);
		tpl::display("merchandise.buy.tpl");
	}

	public function del_merchandise() {
		$id = req::item("id");
		if (user::is_login() == false) {
			$uniqid = util::create_uniqid();
			cookie::set("unqin_id", $uniqid);
			cache::set($uniqid, $id);
			tpl::redirect("?ctl=member&act=login", "请先登录");
		}
		db::update("shop_cart")->set(["delete_time" => time()])
			->where(["id" => $id, "member_id" => user::$instance->get("id")])->echo_sql(1)->execute();
		tpl::redirect("?ctl=merchandise&act=buy");
	}

	public function clear_cart() {
		db::update("shop_cart")->set(["delete_time" => time()])
			->where(["member_id" => user::$instance->get("id")])
			->where(["id" => ["!=", null]])->execute();
		tpl::redirect("?ctl=index&act=index1");
	}

	/**
	 * 结算
	 */
	public function checkout() {
		if (user::is_login() == false) {
			$uniqid = util::create_uniqid();
			cookie::set("unqin_id", $uniqid);
			cache::set($uniqid, $id);
			tpl::redirect("?ctl=member&act=login", "请先登录");
		}
		if (req::is_post()) {
			db::update("shop_cart")->set(["status" => "3"])
				->where(["member_id" => user::$instance->get("id"), "status" => 1, "delete_time" => "0"])
				->where(["id" => ["!=", null]])
				->execute();
			tpl::redirect("?ctl=merchandise&act=checkouted");
		}
		db::update("shop_cart")->set(["status" => "2"])
			->where(["member_id" => user::$instance->get("id"), "status" => 1, "delete_time" => "0"])
			->where(["id" => ["!=", null]])
			->execute();
		$infos = db::select("shop_cart", "sum(total_price) price")
			->where(["member_id" => user::$instance->get("id"), "status" => 2, "delete_time" => "0"])
			->one();

		tpl::assign("total_price", $infos["price"]);
		tpl::display("merchandise.checkout.tpl");
	}

	public function checkouted() {

		tpl::display("merchandise.checkouted.tpl");
	}
}
?>



















