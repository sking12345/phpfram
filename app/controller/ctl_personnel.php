<?php
namespace app\controller;
use app\model\mod_organization;
use app\model\mod_personnel;
use common\model\mod_language;
use vendor\App;
use vendor\db;
use vendor\db_verify;
use vendor\libs\cls_matrix;
use vendor\libs\mod_base;
use vendor\req;
use vendor\tpl;
use vendor\util;

class ctl_personnel extends ctl_base {

	/**
	 * [archives_index 人员档案]
	 * @return [type] [description]
	 */

	// private $
	public function archives_index() {

		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,name,org_jobs_id,org_mechanism_id,entry_date,positive_date,departure_date,phone,email,status";
		$table_data = $this->pub_index("personnel_archives", $show_fields, $where);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.archives_index.html");
	}

	/**
	 * [add_archives 新增人员档案]
	 */
	public function add_archives() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$post_datas["entry_date"] = strtotime($post_datas["entry_date"]);
			$post_datas["positive_date"] = strtotime($post_datas['positive_date']);
			$post_datas['departure_date'] = strtotime($post_datas['departure_date']);
			$post_datas["education_experience"] = addslashes(json_encode($post_datas["education_experience"]));
			$post_datas["work_experience"] = addslashes(json_encode($post_datas["work_experience"]));
			$post_datas["skill"] = addslashes(json_encode($post_datas["skill"]));
			$insert_data = db_verify::table("personnel_archives")->where(["delete_time" => "0"])->insert($post_datas);
			if ($insert_data) {
				$insert_data["id"] = util::create_uniqid(19);
				db::insert("personnel_archives")->set($insert_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "archives_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$mechanism = mod_organization::get_mechanism("0", "id,name");
		$interviewer_list = mod_base::$instance->table("personnel_archives")->all("id,name", ["delete_time" => "0"]);
		$language = mod_language::$instance->get_language("personnel_archives");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_archives");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);

		tpl::assign("mechanism", $mechanism);
		tpl::assign("interviewer_list", $interviewer_list);
		tpl::display("personnel.archives_from.html");
	}
	public function archives_info() {
		$id = req::$instance->item("id");
		$info = db::select("personnel_archives", "*")
			->where(["id" => $id])
			->one();
		$info["education_experience"] = json_decode($info["education_experience"], true);
		$info["work_experience"] = json_decode($info["work_experience"], true);
		$info["skill"] = json_decode($info["skill"], true);

		$mechanism_one = mod_base::$instance->table("organization_mechanism")->one("id,name", ["id" => $info["org_mechanism_id"]]);
		$jobs_one = mod_base::$instance->table("organization_jobs")->one("id,name", ["id" => $info["org_jobs_id"]]);
		$info["org_mechanism_id"] = $mechanism_one["name"];
		$info["org_jobs_id"] = $jobs_one["name"];
		$info['sex'] = mod_personnel::$instance->sexs->get($info['sex']);
		$info['education'] = mod_personnel::$instance->education->get($info['education']);
		$info['status'] = mod_personnel::$instance->status->get($info['status']);
		$info['cate'] = mod_personnel::$instance->cates->get($info['cate']);
		$info['certificate_type'] = mod_personnel::$instance->certificate_type->get($info['certificate_type']);
		$info['marital_status'] = mod_personnel::$instance->marital_status->get($info['marital_status']);
		$info['political_cate'] = mod_personnel::$instance->political_cate->get($info['political_cate']);
		$info['health_status'] = mod_personnel::$instance->health_status->get($info['health_status']);
		$info['hukou_nature'] = mod_personnel::$instance->hukou_nature->get($info['hukou_nature']);
		$interviewer = mod_base::$instance->table("personnel_archives")->one("id,name", ["id" => $info["interviewer"]]);
		$info["interviewer"] = $interviewer["name"];

		$language = mod_language::$instance->get_language("personnel_archives");
		// $table_enum = mod_language::$instance->get_all_enum_language("organization_jobs", "is_crucial");
		// tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);

		tpl::assign("info", $info);
		tpl::display("personnel.archives_info.html");
	}
	public function edit_archives() {
		$id = req::$instance->item("id");
		if (req::is_post()) {

			$post_datas = req::$instance->post_datas();
			$post_datas["entry_date"] = strtotime($post_datas["entry_date"]);
			$post_datas["positive_date"] = strtotime($post_datas['positive_date']);
			$post_datas['departure_date'] = strtotime($post_datas['departure_date']);
			$post_datas["education_experience"] = addslashes(json_encode($post_datas["education_experience"]));
			$post_datas["work_experience"] = addslashes(json_encode($post_datas["work_experience"]));
			$post_datas["skill"] = addslashes(json_encode($post_datas["skill"]));
			$update_data = db_verify::table("personnel_archives")->where(["delete_time" => "0"])->verify_table($post_datas);
			if ($update_data) {
				db::update("personnel_archives")->set($update_data)->where(["id" => $id])->echo_sql(1)->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "archives_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$info = db::select("personnel_archives", "*")
			->where(["id" => $id])
			->one();
		$info["education_experience"] = json_decode($info["education_experience"], true);
		$info["work_experience"] = json_decode($info["work_experience"], true);
		$info["skill"] = json_decode($info["skill"], true);
		$mechanism = mod_organization::get_mechanism("0", "id,name");
		$interviewer_list = mod_base::$instance->table("personnel_archives")->all("id,name", ["delete_time" => "0"]);
		$language = mod_language::$instance->get_language("personnel_archives");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_archives");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("mechanism", $mechanism);
		tpl::assign("interviewer_list", $interviewer_list);
		tpl::assign("info", $info);
		tpl::display("personnel.archives_from.html");
	}

	public function del_archives() {
		$id = req::$instance->item("id");
		db::update("personnel_archives")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "archives_index"]);
	}
	/**
	 * [contract_index 合同列表]
	 * @return [type] [description]
	 */
	public function contract_index() {
		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,archives_id,number,name,type,effective_date,end_date,status";
		$table_data = $this->pub_index("personnel_contract", $show_fields, $where);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.contract_index.html");
	}

	public function add_contract() {

		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$post_data["effective_date"] = strtotime($post_data["effective_date"]);
			$post_data["end_date"] = strtotime($post_data["end_date"]);

			$insert_data = db_verify::table("personnel_contract")
				->where(["org_mechanism_id" => $post_data["org_mechanism_id"], "archives_id" => $post_data["archives_id"]])
				->verify_table($post_data);
			if ($insert_data) {
				$insert_data["id"] = util::create_uniqid(19);
				db::insert("personnel_contract")->set($insert_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "contract_index"]);
			}

		}

		$language = mod_language::$instance->get_language("personnel_contract");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_contract");
		$signatory_list = mod_base::$instance->table("admin")->all("id,name");
		$mechanism = mod_organization::get_mechanism();
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name");
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("mechanism", $mechanism);
		tpl::assign("signatory_list", $signatory_list);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::display("personnel.contract_from.html");
	}

	public function edit_contract() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_data = req::$instance->post_datas();
			$post_data["effective_date"] = strtotime($post_data["effective_date"]);
			$post_data["end_date"] = strtotime($post_data["end_date"]);

			$insert_data = db_verify::table("personnel_contract")
				->where(["org_mechanism_id" => $post_data["org_mechanism_id"], "archives_id" => $post_data["archives_id"]])
				->verify_table($post_data);
			if ($insert_data) {
				$insert_data["id"] = util::create_uniqid(19);
				db::update("personnel_contract")->set($insert_data)->where(['id' => $id])->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "contract_index"]);
			}

		}
		$info = mod_base::$instance->table("personnel_contract")->one("*", ["id" => $id]);

		$language = mod_language::$instance->get_language("personnel_contract");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_contract");
		$signatory_list = mod_base::$instance->table("admin")->all("id,name");
		$mechanism = mod_organization::get_mechanism();
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name");
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("mechanism", $mechanism);
		tpl::assign("signatory_list", $signatory_list);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("personnel.contract_from.html");
	}

	public function contract_info() {
		$id = req::$instance->item("id");
		$info = mod_base::$instance->table("personnel_contract")->one("*", ["id" => $id]);
		$language = mod_language::$instance->get_language("personnel_contract");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_contract");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("personnel.contract_info.html");
	}

	public function del_contract() {
		$id = req::$instance->item("id");
		db::update("personnel_contract")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "contract_index"]);
	}

	public function analysis() {
		$show_option = [
			"org_mechanism_id" => "部门",
			"sex" => "性别",
			"org_jobs_id" => "职位",
			"education" => "学历",
			"status" => "状态",
			"cate" => "类型",
			"hukou_nature" => "户籍性质",
		];
		tpl::assign("show_option", $show_option);
		tpl::display("personnel.analysis.html");
	}

	public function demand() {

		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,job_name,org_mechanism_id,salary,num,applicant,reviewer_status";
		$table_data = $this->pub_index("personnel_demand", $show_fields, $where);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_demand");
		$table_data["table_enums"] = $table_enum;
		tpl::assign("table_enums", $table_enum);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.demand.html");
	}

	public function add_demand() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			print_r($post_datas);
			$insert_data = db_verify::table("personnel_demand")->verify_table($post_datas);
			if ($insert_data) {
				$insert_data["id"] = util::create_uniqid(19);
				db::insert("personnel_demand")->set($insert_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "demand"]);
			}

		}
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$language = mod_language::$instance->get_language("personnel_demand");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_demand");

		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::display("personnel.demand_from.html");
	}
	public function edit_demand() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$insert_data = db_verify::table("personnel_demand")->where(["id" => ["!=", $id]])->verify_table($post_datas);
			if ($insert_data) {
				$insert_data["id"] = util::create_uniqid(19);
				db::update("personnel_demand")->set($insert_data)->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "demand"]);
			}

		}
		$info = db::select("personnel_demand", "*")->where(["id" => $id])->one();

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$language = mod_language::$instance->get_language("personnel_demand");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_demand");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("info", $info);
		tpl::display("personnel.demand_from.html");
	}
	public function del_demand() {
		$id = req::$instance->item("id");
		db::update("personnel_demand")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "demand"]);
	}

	public function info_demand() {
		$id = req::$instance->item("id");
		$info = db::select("personnel_demand", "*")->where(["id" => $id])->one();
		$personnel_archives = mod_base::$instance->table("personnel_archives")
			->one("id,name,org_mechanism_id", ["id" => $info["applicant"]]);

		$mechanism = mod_base::$instance->table("organization_mechanism")
			->one("id,name", ["id" => $info["org_mechanism_id"]]);
		$info["org_mechanism_id"] = $mechanism["name"];

		$language = mod_language::$instance->get_language("personnel_demand");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_demand");

		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("personnel.info_demand.html");
	}

	public function interview_index() {
		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,name,date,org_mechanism_id,org_jobs_id,personnel_archives_id,resume,status";
		$table_data = $this->pub_index("personnel_interview", $show_fields, $where);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_interview");

		$table_data["table_enums"] = $table_enum;
		tpl::assign("table_enums", $table_enum);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.interview_index.html");
	}

	public function add_interview() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			print_r($post_datas);
			$insert_data = db_verify::table("personnel_interview")->verify_table($post_datas);
			if ($insert_data) {
				$insert_data["id"] = util::create_uniqid(19);
				db::insert("personnel_interview")->set($insert_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "interview_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$language = mod_language::$instance->get_language("personnel_interview");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_interview");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::display("personnel.interview_from.html");
	}

	public function edit_interview() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$save_data = db_verify::table("personnel_interview")->where(["id" => ["!=", $id]])->verify_table($post_datas);
			if ($save_data) {
				db::update("personnel_interview")->set($save_data)->where(["id" => $id])->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "interview_index"]);
			}

		}

		$info = db::select("personnel_interview", "*")->where(["id" => $id])->one();
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs_list = mod_base::$instance->table("organization_jobs")->all("id,name", ["mechanism_id" => $info["org_mechanism_id"]]);
		$language = mod_language::$instance->get_language("personnel_interview");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_interview");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("info", $info);
		tpl::assign("jobs_list", $jobs_list);
		tpl::display("personnel.interview_from.html");
	}

	public function info_interview() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			if (!empty($post_datas["date"])) {
				$post_datas["date"] = strtotime($post_datas["date"]);
			}
			db::update("personnel_interview")->set($post_datas)->where(["id" => $id])->execute();
			tpl::show("操作成功", true, ["ct" => "personnel", "ac" => "interview_index"]);

		}

		$info = $this->pub_infos("personnel_interview", "*", ["id" => $id]);
		$language = mod_language::$instance->get_language("personnel_interview");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_interview");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("personnel.info_interview.html");

	}

	public function del_interview() {
		$id = req::$instance->item("id");
		db::update("personnel_interview")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "interview_index"]);
	}

	/**
	 * 转正申请单
	 * @return [type] [description]
	 */
	public function turn_right_index() {

		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,archives_id,org_mechanism_id,org_jobs_id,entry_date,trial_expired_start,trial_expired_end,remark,files,status,date";
		$table_data = $this->pub_index("personnel_turn_right", $show_fields, $where);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_turn_right");
		$table_data["table_enums"] = $table_enum;
		tpl::assign("table_enums", $table_enum);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.turn_right_index.html");

	}
	public function add_turn_right() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();

			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);

			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["entry_date"] = $archives_info["entry_date"];
			$post_datas["trial_expired_start"] = $archives_info["trial_expired_start"];
			$post_datas["trial_expired_end"] = $archives_info["trial_expired_end"];
			$post_datas["date"] = strtotime($post_datas["date"]);

			$save_data = db_verify::table("personnel_turn_right")->verify_table($post_datas);

			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::insert("personnel_turn_right")->set($save_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "turn_right_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$language = mod_language::$instance->get_language("personnel_turn_right");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_turn_right");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);

		tpl::display("personnel.turn_right_from.html");
	}
	public function edit_turn_right() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();

			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_end", ["id" => $post_datas["archives_id"]]);

			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["entry_date"] = $archives_info["entry_date"];
			$post_datas["trial_expired_start"] = $archives_info["trial_expired_start"];
			$post_datas["trial_expired_end"] = $archives_info["trial_expired_end"];
			$post_datas["date"] = strtotime($post_datas["date"]);
			$save_data = db_verify::table("personnel_turn_right")->verify_table($post_datas);

			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::update("personnel_turn_right")->set($save_data)->where(["id" => $id])->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "turn_right_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$info = mod_base::$instance->table("personnel_turn_right")->one("*", ["id" => $id]);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_base::$instance->table("organization_mechanism")->one("id,name", ["id" => $info["org_mechanism_id"]]);
		$jobs_info = mod_base::$instance->table("organization_jobs")->one("id,name", ["id" => $info["org_jobs_id"]]);
		$info["org_mechanism_id"] = $mechanism["name"];
		$info["org_jobs_id"] = $jobs_info["name"];
		$language = mod_language::$instance->get_language("personnel_turn_right");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_turn_right");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("info", $info);

		tpl::display("personnel.turn_right_from.html");
	}
	public function info_turn_right() {
		$id = req::$instance->item("id");
		$info = $this->pub_infos("personnel_turn_right", "*", ["id" => $id]);
		$language = mod_language::$instance->get_language("personnel_turn_right");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_turn_right");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		// print_r($info);
		tpl::display("personnel.info_turn_right.html");
	}
	public function del_turn_right() {
		$id = req::$instance->item("id");
		db::update("personnel_turn_right")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "turn_right_index"]);
	}

	public function resignation_letter_index() {

		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,archives_id,org_mechanism_id,org_jobs_id,type,date,reason,remark,status";
		$table_data = $this->pub_index("personnel_resignation_letter", $show_fields, $where);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_resignation_letter");
		$table_data["table_enums"] = $table_enum;
		tpl::assign("table_enums", $table_enum);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);

		tpl::display("personnel.resignation_letter_index.html");
	}

	public function add_resignation_letter() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["entry_date"] = $archives_info["entry_date"];
			$post_datas["date"] = strtotime($post_datas["date"]);
			$save_data = db_verify::table("personnel_resignation_letter")->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::insert("personnel_resignation_letter")->set($save_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "resignation_letter_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$language = mod_language::$instance->get_language("personnel_resignation_letter");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_resignation_letter");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);

		tpl::display("personnel.resignation_letter_from.html");
	}
	public function edit_resignation_letter() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["entry_date"] = $archives_info["entry_date"];
			$post_datas["date"] = strtotime($post_datas["date"]);
			$save_data = db_verify::table("personnel_resignation_letter")->where(["id" => ["!=", $id]])->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::update("personnel_resignation_letter")->set($save_data)->where(["id" => $id])->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "resignation_letter_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$info = mod_base::$instance->table("personnel_resignation_letter")->one("*", ["id" => $id]);
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$language = mod_language::$instance->get_language("personnel_resignation_letter");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_resignation_letter");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("info", $info);
		tpl::display("personnel.resignation_letter_from.html");
	}
	public function info_resignation_letter() {
		$id = req::$instance->item("id");
		$info = $this->pub_infos("personnel_resignation_letter", "*", ["id" => $id]);
		$language = mod_language::$instance->get_language("personnel_resignation_letter");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_resignation_letter");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("personnel.info_resignation_letter.html");
	}
	public function del_resignation_letter() {
		$id = req::$instance->item("id");
		db::update("personnel_resignation_letter")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "resignation_letter_index"]);
	}
	/**
	 * 人事调动
	 */
	public function transfer_index() {

		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,archives_id,org_mechanism_id,org_jobs_id,org_mechanism1_id,org_jobs1_id,type,date,status";
		$table_data = $this->pub_index("personnel_transfer", $show_fields, $where);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_transfer");
		$table_data["table_enums"] = $table_enum;
		tpl::assign("table_enums", $table_enum);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.transfer_index.html");
	}

	public function add_transfer() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["date"] = strtotime($post_datas["date"]);
			$save_data = db_verify::table("personnel_transfer")->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::insert("personnel_transfer")->set($save_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "transfer_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();

		$language = mod_language::$instance->get_language("personnel_transfer");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_transfer");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::display("personnel.transfer_from.html");
	}
	public function edit_transfer() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["date"] = strtotime($post_datas["date"]);
			$save_data = db_verify::table("personnel_transfer")->where(["id" => ["!=", $id]])->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::update("personnel_transfer")->set($save_data)->where(["id" => $id])->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "transfer_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$info = mod_base::$instance->table("personnel_transfer")->one("*", ["id" => $id]);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();
		$language = mod_language::$instance->get_language("personnel_transfer");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_transfer");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::assign("info", $info);
		tpl::display("personnel.transfer_from.html");
	}
	public function info_transfer() {
		$id = req::$instance->item("id");
		$info = $this->pub_infos("personnel_transfer", "*", ["id" => $id]);
		$language = mod_language::$instance->get_language("personnel_transfer");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_transfer");
		$jobs = mod_organization::get_jobs();
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::assign("jobs", $jobs);
		tpl::display("personnel.info_transfer.html");
	}
	public function del_transfer() {
		$id = req::$instance->item("id");
		db::update("personnel_transfer")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "transfer_index"]);
	}

	/**
	 * 人事调动
	 */
	public function adjustment_index() {

		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,archives_id,org_mechanism_id,org_jobs_id,salary_defore,salary_after,effective_date,take_effect,status";
		$table_data = $this->pub_index("personnel_adjustment", $show_fields, $where);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_adjustment");
		$table_data["table_enums"] = $table_enum;
		tpl::assign("table_enums", $table_enum);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.adjustment_index.html");
	}

	public function add_adjustment() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["effective_date"] = strtotime($post_datas["effective_date"]);
			$save_data = db_verify::table("personnel_adjustment")->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::insert("personnel_adjustment")->set($save_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "adjustment_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();
		$language = mod_language::$instance->get_language("personnel_adjustment");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_adjustment");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::display("personnel.adjustment_from.html");
	}
	public function edit_adjustment() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["effective_date"] = strtotime($post_datas["effective_date"]);
			$save_data = db_verify::table("personnel_adjustment")->where(["id" => ["!=", $id]])->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::update("personnel_adjustment")->set($save_data)->where(["id" => $id])->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "adjustment_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$info = mod_base::$instance->table("personnel_adjustment")->one("*", ["id" => $id]);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();
		$language = mod_language::$instance->get_language("personnel_adjustment");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_adjustment");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::assign("info", $info);
		tpl::display("personnel.adjustment_from.html");
	}
	public function info_adjustment() {
		$id = req::$instance->item("id");
		$info = $this->pub_infos("personnel_adjustment", "*", ["id" => $id]);
		$language = mod_language::$instance->get_language("personnel_adjustment");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_adjustment");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("personnel.info_adjustment.html");
	}
	public function del_adjustment() {
		$id = req::$instance->item("id");
		db::update("personnel_adjustment")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "adjustment_index"]);
	}

	public function rewards_punishments_index() {
		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,archives_id,org_mechanism_id,org_jobs_id,occurrence_time,occurrence_location,type,result,amount,status,review_time";
		$table_data = $this->pub_index("personnel_rewards_punishments", $show_fields, $where);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_rewards_punishments");
		$table_data["table_enums"] = $table_enum;
		tpl::assign("table_enums", $table_enum);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.rewards_punishments_index.html");
	}

	public function add_rewards_punishments() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["occurrence_time"] = strtotime($post_datas["occurrence_time"]);

			$save_data = db_verify::table("personnel_rewards_punishments")->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::insert("personnel_rewards_punishments")->set($save_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "rewards_punishments_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();
		$language = mod_language::$instance->get_language("personnel_rewards_punishments");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_rewards_punishments");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::display("personnel.rewards_punishments_from.html");
	}
	public function edit_rewards_punishments() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["occurrence_time"] = strtotime($post_datas["occurrence_time"]);
			$save_data = db_verify::table("personnel_rewards_punishments")->where(["id" => ["!=", $id]])->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::update("personnel_rewards_punishments")->set($save_data)->where(["id" => $id])->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "rewards_punishments_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$info = mod_base::$instance->table("personnel_rewards_punishments")->one("*", ["id" => $id]);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();
		$language = mod_language::$instance->get_language("personnel_rewards_punishments");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_rewards_punishments");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::assign("info", $info);
		tpl::display("personnel.rewards_punishments_from.html");
	}
	public function info_rewards_punishments() {
		$id = req::$instance->item("id");
		$info = $this->pub_infos("personnel_rewards_punishments", "*", ["id" => $id]);
		$language = mod_language::$instance->get_language("personnel_rewards_punishments");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_rewards_punishments");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("personnel.info_rewards_punishments.html");
	}
	public function del_rewards_punishments() {
		$id = req::$instance->item("id");
		db::update("personnel_rewards_punishments")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "rewards_punishments_index"]);
	}

	public function care_index() {
		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,archives_id,org_mechanism_id,org_jobs_id,status,review_time,type,date,amount,days";
		$table_data = $this->pub_index("personnel_care", $show_fields, $where);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_care");
		$table_data["table_enums"] = $table_enum;
		tpl::assign("table_enums", $table_enum);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.care_index.html");
	}

	public function add_care() {
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["date"] = strtotime($post_datas["date"]);

			$save_data = db_verify::table("personnel_care")->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::insert("personnel_care")->set($save_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "care_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();
		$language = mod_language::$instance->get_language("personnel_care");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_care");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::display("personnel.care_from.html");
	}
	public function edit_care() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["date"] = strtotime($post_datas["date"]);
			$save_data = db_verify::table("personnel_care")->where(["id" => ["!=", $id]])->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::update("personnel_care")->set($save_data)->where(["id" => $id])->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "care_index"]);
			}
		}
		$this->ajax_get(__FUNCTION__, __CLASS__);
		$info = mod_base::$instance->table("personnel_care")->one("*", ["id" => $id]);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();
		$language = mod_language::$instance->get_language("personnel_care");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_care");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::assign("info", $info);
		tpl::display("personnel.care_from.html");
	}
	public function info_care() {
		$id = req::$instance->item("id");
		$info = $this->pub_infos("personnel_care", "*", ["id" => $id]);
		$language = mod_language::$instance->get_language("personnel_care");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_care");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("personnel.info_care.html");
	}
	public function del_care() {
		$id = req::$instance->item("id");
		db::update("personnel_care")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "care_index"]);
	}

	public function work_report_index() {
		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$show_fields = "id,archives_id,org_mechanism_id,org_jobs_id,type,date_start,date_end";
		$table_data = $this->pub_index("personnel_work_report", $show_fields, $where);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_work_report");
		$table_data["table_enums"] = $table_enum;
		tpl::assign("table_enums", $table_enum);
		tpl::assign("table_data", $table_data);
		tpl::assign("pages", $table_data["pages"]);
		tpl::display("personnel.work_report_index.html");
	}

	public function add_work_report() {

		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$post_datas["archives_id"] = App::$user->id;
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["date_start"] = strtotime($post_datas["date_start"]);
			$post_datas["date_end"] = strtotime($post_datas["date_end"]);
			$save_data = db_verify::table("personnel_work_report")->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::insert("personnel_work_report")->set($save_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "work_report_index"]);
			}
		}
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();
		$language = mod_language::$instance->get_language("personnel_work_report");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_work_report");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::display("personnel.work_report_from.html");
	}
	public function edit_work_report() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$post_datas = req::$instance->post_datas();
			$post_datas["archives_id"] = App::$user->id;
			$archives_info = mod_base::$instance->table("personnel_archives")
				->one("org_jobs_id,org_mechanism_id,entry_date,trial_expired_start,trial_expired_end", ["id" => $post_datas["archives_id"]]);
			$post_datas["org_jobs_id"] = $archives_info["org_jobs_id"];
			$post_datas["org_mechanism_id"] = $archives_info["org_mechanism_id"];
			$post_datas["date_start"] = strtotime($post_datas["date_start"]);
			$post_datas["date_end"] = strtotime($post_datas["date_end"]);
			$save_data = db_verify::table("personnel_work_report")->where(["id" => ["!=", $id]])->verify_table($post_datas);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::update("personnel_work_report")->set($save_data)->where(["id" => $id])->execute();
				tpl::show("编辑成功", true, ["ct" => "personnel", "ac" => "work_report_index"]);
			}
		}

		$info = mod_base::$instance->table("personnel_work_report")->one("*", ["id" => $id]);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$mechanism = mod_organization::get_mechanism();
		$jobs = mod_organization::get_jobs();
		$language = mod_language::$instance->get_language("personnel_work_report");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_work_report");
		tpl::assign("mechanism", $mechanism);
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("jobs", $jobs);
		tpl::assign("info", $info);
		tpl::display("personnel.work_report_from.html");
	}
	public function info_work_report() {
		$id = req::$instance->item("id");
		$info = $this->pub_infos("personnel_work_report", "*", ["id" => $id]);
		$language = mod_language::$instance->get_language("personnel_work_report");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_work_report");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("info", $info);
		tpl::display("personnel.info_work_report.html");
	}
	public function del_work_report() {
		$id = req::$instance->item("id");
		db::update("personnel_work_report")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "work_report_index"]);
	}
	/**
	 * 报告统计
	 * @return [type] [description]
	 */
	public function work_report_statistics() {
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$where["delete_time"] = "0";
		$row = db::select("personnel_archives", "count(*) count")->where($where)->one();
		$pages = db::make_page($row["count"], 10);
		$show_fields = "id,name";
		$show_header = mod_language::$instance->get_language("personnel_archives", $show_fields);

		$archives = db::select("personnel_archives", $show_fields)
			->where($where)
			->limit($pages["offset"], $pages["limt"])
			->set_call(function ($row) {
				cls_matrix::$instance->matrix_data[$row["id"]] = $row["id"];
			})->all();
		$date = req::$instance->item("date", date("Y-m-d", time()));
		db::select("personnel_work_report", "id,archives_id,date_start")
			->where(["archives_id" => ["in", cls_matrix::$instance->matrix_data]])
			->where(["delete_time" => "0"])
			->set_call(function ($rows) {
				$n = date("d", $rows["date_start"]);
				$n = (int) $n;
				cls_matrix::$instance->matrix_data["work_report"][$rows["archives_id"]][$n] = $rows["id"];
			})->all();
		if (!empty(cls_matrix::$instance->matrix_data["work_report"])) {
			tpl::assign("work_report", cls_matrix::$instance->matrix_data["work_report"]);
		}
		tpl::assign("archives", $archives);
		tpl::assign("show_header", $show_header);
		tpl::assign("pages", $pages);
		tpl::assign("days", date("t", strtotime($date)));
		tpl::display("personnel.work_report_statistics.html");
	}

	/**
	 * [work_report_analysis 报告统计分析]
	 * @return [type] [description]
	 */
	public function work_report_analysis() {

	}
	/**
	 * [assessment_index 考核项目]
	 * @return [type] [description]
	 */
	public function assessment_index() {
		$where["delete_time"] = "0";
		$keyword = req::$instance->item("keyword");
		if (!empty($keyword)) {
			$where["name"] = ["like", "%{$keyword}%"];
		}
		$row = db::select("personnel_assessment", "count(*) count")->where($where)->one();
		$pages = db::make_page($row["count"], 10);

		$show_fields = "id,name,start_date,end_date,archives_ids,frequency,highest_score,status,build_time";
		$list = db::select("personnel_assessment", $show_fields)
			->where($where)
			->order_by("id desc")
			->limit($pages["offset"], $pages["limt"])
			->set_call(function ($row) {
				// if (!empty($row["archives_ids"])) {
				// 	$archives_ids = explode(",", $row["archives_ids"]);
				// } else {
				// 	$archives_ids = [];
				// }

				// $archives = array_keys($archives_ids, $rating_archives);
				// if (empty(cls_matrix::$instance->matrix_data["archives_id"])) {
				// 	cls_matrix::$instance->matrix_data["archives_id"] = $archives;
				// } else {
				// 	cls_matrix::$instance->matrix_data["archives_id"] = array_keys($archives, cls_matrix::$instance->matrix_data["archives_id"]);
				// }
			})->all();
		$show_header = mod_language::$instance->get_language("personnel_assessment", $show_fields);
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_assessment");

		tpl::assign("table_enums", $table_enum);
		tpl::assign("show_header", $show_header);
		tpl::assign("pages", $pages);
		tpl::assign("list", $list);
		tpl::display("personnel.assessment_index.html");
	}

	public function add_assessment() {

		if (req::is_post()) {
			$save_data = req::$instance->post_datas();
			$save_data["start_date"] = strtotime($save_data["start_date"]);
			$save_data["end_date"] = strtotime($save_data["end_date"]);
			$save_data["build_time"] = strtotime($save_data["build_time"]);
			$save_data["archives_ids"] = implode(",", $save_data["archives_ids"]);
			$save_data["project_description"] = json_encode($save_data["project_description"]);
			$save_data["rating_content"] = json_encode($save_data["rating_content"]);
			$save_data = db_verify::table("personnel_assessment")->where(["delete_time" => "0"])->insert($save_data);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::insert("personnel_assessment")->set($save_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "assessment_index"]);
			}
		}
		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$language = mod_language::$instance->get_language("personnel_assessment");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_assessment");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);

		tpl::display("personnel.assessment_from.html");
	}

	public function edit_assessment() {
		$id = req::$instance->item("id");
		if (req::is_post()) {
			$save_data = req::$instance->post_datas();
			$save_data["start_date"] = strtotime($save_data["start_date"]);
			$save_data["end_date"] = strtotime($save_data["end_date"]);
			$save_data["build_time"] = strtotime($save_data["build_time"]);
			$save_data["archives_ids"] = implode(",", $save_data["archives_ids"]);
			$save_data["project_description"] = json_encode($save_data["project_description"]);
			$save_data["rating_content"] = json_encode($save_data["rating_content"]);
			$save_data = db_verify::table("personnel_assessment")->where(["delete_time" => "0"])->insert($save_data);
			if ($save_data) {
				$save_data["id"] = util::create_uniqid(19);
				db::insert("personnel_assessment")->set($save_data)->execute();
				tpl::show("添加成功", true, ["ct" => "personnel", "ac" => "assessment_index"]);
			}
		}
		$info = db::select("personnel_assessment", "id,name,start_date,end_date,archives_ids,frequency,highest_score,passing_score,status, build_time,project_description,proportion,rating_content,rating_type,rating_archives,weights, files")
			->where(["id" => $id])->one();
		$info["project_description"] = json_decode($info["project_description"], true);
		$info["rating_content"] = json_decode($info["rating_content"], true);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id");
		$language = mod_language::$instance->get_language("personnel_assessment");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_assessment");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("info", $info);
		tpl::display("personnel.assessment_from.html");
	}
	public function info_assessment() {
		$id = req::$instance->item("id");
		$info = db::select("personnel_assessment", "id,name,start_date,end_date,archives_ids,frequency,highest_score,passing_score,status, build_time,project_description,proportion,rating_content,rating_type,rating_archives,weights, files")
			->where(["id" => $id])->one();
		$info["project_description"] = json_decode($info["project_description"], true);
		$info["rating_content"] = json_decode($info["rating_content"], true);

		$personnel_archives = mod_base::$instance->table("personnel_archives")->all("id,name,org_mechanism_id", ["delete_time" => "0"], "id");
		$language = mod_language::$instance->get_language("personnel_assessment");
		$table_enum = mod_language::$instance->get_all_enum_language("personnel_assessment");
		tpl::assign("table_enum", $table_enum);
		tpl::assign("table_language", $language);
		tpl::assign("personnel_archives", $personnel_archives);
		tpl::assign("info", $info);
		tpl::display("personnel.info_assessment.html");
	}
	public function del_assessment() {
		$id = req::$instance->item("id");
		db::update("personnel_assessment")->set(["delete_time" => time()])->where(["id" => $id])->execute();
		tpl::show("删除成功", true, ["ct" => "personnel", "ac" => "work_report_index"]);
	}

	public function assessment_score_index() {
		echo "待开发....";
		// tpl::display("personnel.assessment_score_index.html");
	}

}
?>






















