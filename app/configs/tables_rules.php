<?php

return [

	// "admin1" => [
	// 	'id' => ['unique|required', 'call' => ['snow\util::create_uniqid', 21]],
	// 	'username' => ['required|string|unique', 'max' => 24, 'min' => 4, 'default' => '1', 'message' => '请输入4-24个字符', 'name' => '用户名'],
	// 	'groups' => ['table|required|string', 'field' => 'id', 'table' => "admin_group", 'message' => "请选择分组", 'name' => '分组'],
	// 	'sex' => ['enum|required', 'values' => [1 => "男", 2 => "女"], 'default' => '1', 'name' => '性别', 'message' => "请正确选择性别"],
	// 	'url' => ['url|required', 'message' => "请正确填写url", 'name' => "url"],
	// 	'email' => ['email|required', 'message' => '请正确填写email', 'name' => 'email'],
	// 	'number' => ['required|number', 'max' => '200', 'min' => '100', "message" => '请输入number', 'name' => 'number'],
	// 	'double' => ['required|double', 'max' => '200', 'min' => '100', "message" => '请输入double', 'name' => 'double'],
	// 	'integer' => ['required|integer', 'max' => '200', 'min' => '100', "message" => '请输入integer', 'name' => 'double'],
	// 	'date' => ['required|date', 'format' => 'Y-m-d H:i:s', "message" => '请输入日期', 'name' => 'date'],
	// 	'match' => ["match|required", 'pattern' => '/^[a-z]\w*$/i', "message" => '正则验证', 'name' => '正则验证'],
	// 	'file' => ['file', 'path' => '', 'extensions' => 'png|jpg|gif', 'max' => 1024 * 1024,
	// 		'min' => 1024, 'max_files' => 3, 'message' => 'error:[_name_]请选择png|jpg|gif文件',
	// 	],
	// ],

	"admin_group" => [
		'id' => ['unique|required', 'call' => ['vendor\util::create_uniqid', 19]],
		"name" => ['required|unique|string', 'max' => 10, 'min' => 1],
	],
	"admin" => [
		"group_id" => ['table|required|string', 'field' => 'id', "table_unique" => "name", 'table' => "admin_group"],
	],
	"organization_mechanism" => [
		"is_sub_company" => ['enum|required', 'values' => ["1" => "是", "2" => "否"], 'default' => '1'],
		"is_sub_store" => ['enum|required', 'values' => ["1" => "是", "2" => "否"], 'default' => '1'],
	],
	"personnel_archives" => [
		'height' => ['required|integer', 'default' => '160'],
		'weight' => ['required|integer', 'default' => '160'],
		'sex' => [
			'enum|required',
			'values' => ["1" => "男", "2" => "女"],
			'default' => '1',
		],
		'education' => [
			'enum',
			'values' => ["1" => "大专", "2" => "本科", "3" => "研究生", "4" => "博士", "8" => "其他"],
			'default' => '1',
		],
		'hukou_nature' => ['enum|required', 'values' => ["1" => "城镇", "2" => "乡村"], 'default' => '1'],
		'health_status' => ['enum|required', 'values' => ["1" => "良好", "2" => "一般", "3" => '较差', "4" => "残疾"], 'default' => '1'],
		'marital_status' => ['enum|required', 'values' => ["1" => "已婚", "2" => "未婚"], 'default' => '1'],
		'certificate_type' => ['enum|required', 'values' => ["1" => "身份证", "2" => "护照号"], 'default' => '1'],
		'cate' => ['enum|required', 'values' => ["1" => "临时工", "2" => "合同工", "3" => "兼职", "4" => "实习生"], 'default' => '1'],
		'status' => ['enum|required', 'values' => ["1" => "试用期", "2" => "正式", "4" => "离职"], 'default' => '1'],
		'org_jobs_id' => ['table|required|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism_id' => ['table|required|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],

	],
	"organization_jobs" => [
		"mechanism_id" => ['table|required|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		"level_id" => ['table|required|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs_level"],
		"is_crucial" => ['enum|required', 'values' => ["1" => "是", "2" => "否"], 'default' => '1'],
	],
	"personnel_contract" => [
		"type" => [
			'enum',
			'values' => ["1" => "劳动合同", "2" => "保密合同"],
			'default' => '1',
		],
		"status" => [
			'enum',
			'values' => ["1" => "有效合同", "2" => "失效合同"],
			'default' => '1',
		],
	],
	"personnel_demand" => [ //人员需求
		"status" => [
			'enum',
			'values' => ["1" => "是", "2" => "否"],
			'default' => '1',
		],
		"reviewer_status" => [
			'enum',
			'values' => ["1" => "待处理", "2" => "已审核", "3" => "作废", "4" => "退回"],
			'default' => '1',
		],
	],
	"personnel_interview" => [
		'org_jobs_id' => ['table|required|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism_id' => ['table|required|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		'personnel_archives_id' => ['table|required|string',
			'field' => 'id', "table_unique" => "name",
			'table' => "personnel_archives",
		],
		"status" => [
			'enum',
			'values' => ["1" => "待审核", "2" => "待面试", "3" => "合格", "4" => "不合格"],
			'default' => '1',
		],
	],
	"personnel_turn_right" => [
		'org_jobs_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		'archives_id' => ['table|required|string',
			'field' => 'id', "table_unique" => "name",
			'table' => "personnel_archives",
		],
		"status" => [
			'enum',
			'values' => ["1" => "待审核", "2" => "已审核", "3" => "不同意", "4" => "已作废", "5" => "退回"],
			'default' => '1',
		],
	],
	"personnel_resignation_letter" => [
		'org_jobs_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		'archives_id' => ['table|required|string',
			'field' => 'id', "table_unique" => "name",
			'table' => "personnel_archives",
		],
		"type" => [
			'enum',
			'values' => ["1" => "自动离职", "2" => "退休", "3" => "病辞", "4" => "辞退", "5" => "辞职"],
			'default' => '1',
		],
		"status" => [
			'enum',
			'values' => ["1" => "待审核", "2" => "已审核", "3" => "不同意", "4" => "已作废", "5" => "退回"],
			'default' => '1',
		],
	],
	"personnel_transfer" => [
		'org_jobs_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		'org_jobs1_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism1_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		'archives_id' => ['table|required|string',
			'field' => 'id', "table_unique" => "name",
			'table' => "personnel_archives",
		],
		"type" => [
			'enum',
			'values' => ["1" => "平调", "2" => "晋升", "3" => "降级"],
			'default' => '1',
		],
		"status" => [
			'enum',
			'values' => ["1" => "待审核", "2" => "已审核", "3" => "不同意", "4" => "已作废", "5" => "退回"],
			'default' => '1',
		],
	],
	"personnel_adjustment" => [
		'org_jobs_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		'archives_id' => ['table|required|string',
			'field' => 'id', "table_unique" => "name",
			'table' => "personnel_archives",
		],
		"status" => [
			'enum',
			'values' => ["1" => "待审核", "2" => "已审核", "3" => "不同意", "4" => "已作废", "5" => "退回"],
			'default' => '1',
		],
	],
	"personnel_rewards_punishments" => [
		'org_jobs_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		'archives_id' => ['table|required|string',
			'field' => 'id', "table_unique" => "name",
			'table' => "personnel_archives",
		],
		"type" => [
			'enum',
			'values' => ["1" => "奖励", "2" => "惩罚"],
			'default' => '1',
		],
		"result" => [
			'enum',
			'values' => ["1" => "奖励", "2" => "警告", "3" => "辞退", "4" => "降职"],
			'default' => '1',
		],
		"status" => [
			'enum',
			'values' => ["1" => "待当事人确认", "2" => "已确认", "3" => "驳回", "4" => "待人事确认", "5" => "人事确认", "6" => "驳回"],
			'default' => '1',
		],
	],
	"personnel_care" => [
		'org_jobs_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		'archives_id' => ['table|required|string',
			'field' => 'id', "table_unique" => "name",
			'table' => "personnel_archives",
		],
		"type" => [
			'enum',
			'values' => ["1" => "礼品", "2" => "生日", "3" => "其他"],
			'default' => '1',
		],
		"status" => [
			'enum',
			'values' => ["1" => "待确认", "2" => "已确认", "3" => "驳回", "4" => "待人事确认", "5" => "人事确认", "6" => "驳回"],
			'default' => '1',
		],
	],
	"personnel_work_report" => [
		'org_jobs_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_jobs"],
		'org_mechanism_id' => ['table|string', 'field' => 'id', "table_unique" => "name", 'table' => "organization_mechanism"],
		'archives_id' => ['table|required|string',
			'field' => 'id', "table_unique" => "name",
			'table' => "personnel_archives",
		],
		"type" => [
			'enum',
			'values' => ["1" => "日报", "2" => "周报", "3" => "月报"],
			'default' => '1',
		],
		"status" => [
			'enum',
			'values' => ["1" => "未读", "2" => "已读", "3" => "驳回", "4" => "确认"],
			'default' => '1',
		],
	],
	"personnel_assessment" => [
		"rating_type" => [
			'enum',
			'values' => ["1" => "自己", "2" => "直属上级", "3" => "其他人"],
			'default' => '1',
		],
		"frequency" => [
			'enum',
			'values' => ["1" => "年", "2" => "季度", "3" => "月"],
			'default' => '1',
		],
		"status" => [
			'enum',
			'values' => ["1" => "启用", "4" => "不启用"],
			'default' => '1',
		],

	],
];

?>









