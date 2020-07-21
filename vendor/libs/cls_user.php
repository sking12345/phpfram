<?php
namespace vendor\libs;

class cls_user {

	public $user_data = [];
	public function __get($key) {
		if (empty($this->user_data[$key])) {
			echo "xx";
			return null;
		}
		return $this->user_data[$key];
	}

	public function __set($key, $val) {
		$this->user_data[$key] = $val;
	}
}