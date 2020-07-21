<?php
namespace app\model;
use vendor\libs\mod_base;

class mod_personnel extends mod_base {

	public static $instance;
	public $const_data = [
		"sexs" => ["1" => "男", "2" => "女"],
		"education" => ["1" => "初中", "2" => "高中", "3" => "大专", "4" => "本科", "5" => "研究生", "6" => "博士", "7" => "博士后"],
		"status" => ["1" => "试用期", "2" => "正式", "4" => "离职"],
		"cates" => ["1" => "临时工", "2" => "合同工", "3" => "兼职", "4" => "实习生"],
		"certificate_type" => ["1" => "身份证", "2" => "护照号"],
		"marital_status" => ["1" => "已婚", "2" => "未婚"],
		"political_cate" => ["1" => "党员", "2" => "预备党员", "3" => "群众"],
		"health_status" => ["1" => "良好", "2" => "一般", "3" => '较差', "4" => "残疾"],
		"hukou_nature" => ["1" => "城镇", "2" => "乡村"],
	];

}