<?php
namespace app\controller;
use app\controller\ctl_base;
use app\model\mod_organization;
use common\model\mod_language;
use vendor\db;
use vendor\db_verify;
use vendor\req;
use vendor\tpl;
use vendor\util;

class ctl_organization extends ctl_base {

	public function __construct() {
		// $arr = mod_organization::get_mechanism();
		// print_r($arr);
	}
	/**
	 * [mechanism_index 机构管理]
	 * @return [type] [description]
	 */
	public function mechanism_index() {

		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}

		$show_fields = "id,name,create_time,number,code,is_sub_company,is_sub_store,parent_name,principal,phone";
		$table_data = $this->pub_index("organization_mechanism", $show_fields, $where);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);

		tpl::display("organization.mechanism_index.html");
	}
	/**
	 * [add_mechanism 添加机构]
	 */
	public function add_mechanism() {
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$insert_data = db_verify::table("organization_mechanism")->where(['delete_time' => "0"])->insert($post_data);
			if (!empty($insert_data["parent_id"])) {
				$parent_info = db::select("organization_mechanism", "id,name")->where(["id" => $insert_data["parent_id"]])->one();
				$insert_data["parent_name"] = $parent_info['name'];
			}
			if ($insert_data) {
				$insert_data["id"] = util::create_uniqid(19);
				db::insert("organization_mechanism")->set($insert_data)->execute();
				tpl::show("添加成功", true, ["ct" => "organization", 'ac' => "mechanism_index"]);
			}
		}
		$language = mod_language::$instance->get_language("organization_mechanism");
		$table_enum = mod_language::$instance->get_all_enum_language("organization_mechanism", "is_sub_company,is_sub_store");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		$list = mod_organization::get_mechanism();
		tpl::assign("list", $list);
		tpl::display("organization.mechanism_from.html");
	}

	public function edit_mechanism() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$update_data = db_verify::table("organization_mechanism")->where(['delete_time' => "0", "id" => ["!=", $id]])->update($post_data);
			if (!empty($update_data["parent_id"])) {
				$parent_info = db::select("organization_mechanism", "id,name")->where(["id" => $update_data["parent_id"]])->one();
				$update_data["parent_name"] = $parent_info['name'];
			}
			if ($update_data) {
				db::update("organization_mechanism")->set($update_data)->where(["id" => $id])->execute();
				tpl::show("添加成功", true, ["ct" => "organization", 'ac' => "mechanism_index"]);
			}
		}
		$info = db::select("organization_mechanism", "id, name, parent_id, number, code, is_sub_company, is_sub_store,phone,principal")
			->where(["delete_time" => "0"])
			->where(["id" => $id])
			->one();
		tpl::assign("info", $info);
		$language = mod_language::$instance->get_language("organization_mechanism");
		$table_enum = mod_language::$instance->get_all_enum_language("organization_mechanism", "is_sub_company,is_sub_store");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		$list = mod_organization::get_mechanism();
		tpl::assign("list", $list);
		tpl::display("organization.mechanism_from.html");
	}

	public function del_mechanism() {
		$id = req::$instance->item("id");
		db::update("organization_mechanism")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "organization", 'ac' => "mechanism_index"]);

	}

	public function job_level_index() {
		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id, name,number, code,level";
		$table_data = $this->pub_index("organization_jobs_level", $show_fields, $where);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);

		tpl::display("organization.job_level_index.html");
	}

	public function add_job_level() {
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$insert_data = db_verify::table("organization_jobs_level")->where(['delete_time' => "0"])->insert($post_data);
			if ($insert_data) {
				$insert_data["id"] = util::create_uniqid(19);
				db::insert("organization_jobs_level")->set($insert_data)->execute();
				tpl::show("添加成功", true, ["ct" => "organization", 'ac' => "job_level_index"]);
			}
		}
		$language = mod_language::$instance->get_language("organization_jobs_level");
		tpl::assign("table_language", $language);
		tpl::display("organization.job_level_from.html");
	}

	public function edit_job_level() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$update_data = db_verify::table("organization_jobs_level")->where(['delete_time' => "0", "id" => ["!=", $id]])->update($post_data);

			if ($update_data) {
				$update_data["id"] = util::create_uniqid(19);
				db::update("organization_jobs_level")->set($update_data)->where(["id" => $id])->execute();
				tpl::show("添加成功", true, ["ct" => "organization", 'ac' => "job_level_index"]);
			}
		}
		$info = db::select("organization_jobs_level", "id, name, number, code,level")
			->where(["delete_time" => "0"])
			->where(["id" => $id])
			->one();
		$language = mod_language::$instance->get_language("organization_jobs_level");
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("organization.job_level_from.html");
	}

	public function del_job_level() {
		$id = req::$instance->item("id");
		db::update("organization_jobs_level")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "organization", 'ac' => "job_level_index"]);

	}

	/**
	 * [job_index 岗位管理]
	 * @return [type] [description]
	 */
	public function job_index() {
		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}

		$show_fields = "id,name,mechanism_id,number,people_num,onboarding_num,is_crucial,level_id";
		$table_data = $this->pub_index("organization_jobs", $show_fields, $where);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("organization.job_index.html");
	}

	public function add_job() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$post_datas["duties"] = implode(",", $post_datas["duties"]);
			$post_datas["id"] = util::create_uniqid(19);
			$insert_data = db_verify::table("organization_jobs")->where(["delete_time" => "0"])->insert($post_datas);
			if ($insert_data) {
				db::insert("organization_jobs")->set($insert_data)->execute();
				tpl::show("添加成功", true, ["ct" => "organization", 'ac' => "job_index"]);
			}
		}
		$where["delete_time"] = "0";
		$level_list = db::select("organization_jobs_level", "id, name,number")
			->where($where)
			->all();
		$mechanism_list = db::select("organization_mechanism", "id, name,number")
			->where($where)
			->all();
		$language = mod_language::$instance->get_language("organization_jobs");
		$table_enum = mod_language::$instance->get_all_enum_language("organization_jobs", "is_crucial");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("level_list", $level_list);
		tpl::assign("mechanism_list", $mechanism_list);
		tpl::display("organization.job_from.html");
	}
	public function edit_job() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$post_datas["duties"] = implode(",", $post_datas["duties"]);
			$post_datas["id"] = util::create_uniqid(19);
			$insert_data = db_verify::table("organization_jobs")->where(["delete_time" => "0", "id" => ["!=", $id]])->update($post_datas);
			if ($insert_data) {
				db::update("organization_jobs")->set($insert_data)->where(["id" => $id])->execute();
				tpl::show("添加成功", true, ["ct" => "organization", 'ac' => "job_index"]);
			}

		}
		$info = db::select("organization_jobs", "id, name, mechanism_id, number, people_num, is_crucial, level_id, remark,duties")
			->where(["id" => $id])->one();
		$info["duties"] = explode(",", $info["duties"]);
		$where["delete_time"] = "0";
		$level_list = db::select("organization_jobs_level", "id, name,number")
			->where(["delete_time" => "0"])
			->all();
		$mechanism_list = db::select("organization_mechanism", "id, name,number")
			->where(["delete_time" => "0"])
			->all();
		$language = mod_language::$instance->get_language("organization_jobs");
		$table_enum = mod_language::$instance->get_all_enum_language("organization_jobs", "is_crucial");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::assign("level_list", $level_list);
		tpl::assign("mechanism_list", $mechanism_list);
		tpl::display("organization.job_from.html");
	}

	public function info_job() {
		$id = req::$instance->item("id");
		$info = db::select("organization_jobs", "id, name, mechanism_id, number, people_num, is_crucial, level_id, remark,duties")
			->where(["id" => $id])->one();
		$info["duties"] = explode(",", $info["duties"]);
		$where["delete_time"] = "0";
		$level_info = db::select("organization_jobs_level", "id, name,number")
			->where(["delete_time" => "0"])
			->where(["id" => $info["level_id"]])
			->one();
		$mechanism_info = db::select("organization_mechanism", "id, name,number")
			->where(["delete_time" => "0"])
			->where(["id" => $info["mechanism_id"]])
			->one();
		$info["mechanism_id"] = $mechanism_info["name"];
		$info["level_id"] = $level_info["name"];
		$where["delete_time"] = "0";
		$where["org_jobs_id"] = $id;
		$row = db::select("personnel_archives", "count(*) count")->where($where)->one();
		$pagess = db::make_page($row["count"], 10);
		$pages = db::make_page($row["count"], 10);
		$list = db::select("personnel_archives", "id, name, remark")
			->where($where)
			->order_by("create_time desc")
			->limit($pages["offset"], $pages["limt"])
			->echo_sql(0)
			->all();
		$language = mod_language::$instance->get_language("organization_jobs");
		$table_enum = mod_language::$instance->get_all_enum_language("organization_jobs", "is_crucial");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("list", $list);
		tpl::assign("pages", $pages);
		tpl::assign("info", $info);
		tpl::display("organization.info_job.html");
	}

	public function structure_diagram() {
		$structure_children = mod_organization::get_mechanism_structure("0", "id,name,principal title");
		$structure["id"] = "0";
		$structure["name"] = "xxx公司";
		$structure["title"] = "";
		$structure["relationship"]["children_num"] = count($structure_children);
		$structure["children"] = $structure_children;
		tpl::assign("structure", $structure);
		tpl::display("organization.structure_diagram.html");
	}

	public function structure_diagram_info() {
		$id = req::$instance->item("id");
		$structure = db::select("organization_mechanism", "id,name,principal title,parent_id")->where(["id" => $id])->one();

		$structure_children = mod_organization::get_mechanism_structure($id, "id,name,principal title,parent_id");
		if ($structure_children) {
			$structure["relationship"]["children_num"] = count($structure_children);
			$structure["children"] = $structure_children;

		} else {
			$structure["relationship"]["children_num"] = "0";

		}
		tpl::assign("structure", $structure);
		tpl::display("organization.structure_diagram_info.html");
	}

}

?>











