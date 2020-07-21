<?php
namespace common\controller;
use vendor\req;

class ctl_file {

	public function upload() {
		$name = req::$instance->post("name");
		$destination = "/Users/sking/code/web/phpframe/web/upload/{$name}";
		move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
		echo json_encode([
			"code" => "0",
			"msg" => "sucess",
			"data" => [
				"realname" => $name,
				"filename" => $name,
				"filelink" => $destination,
			],
		]);
	}
}