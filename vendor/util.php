<?php
namespace vendor;

class util {
	/**
	 * [create_uniqid 创建唯一值]
	 * @param  int|integer $len [description]
	 * @return [type]           [description]
	 */
	public static function create_uniqid(int $len = 16) {
		$pid = getmypid(); //进程id
		$pid_str = "{$pid}";
		$_number_str = "qwertyuiopasdfghjklzxcvbnm123456789";
		$uniqid_str = '';
		for ($i = 0; $i < strlen($pid_str); $i++) {
			$uniqid_str .= $_number_str[$i];
		}
		if ($len > 16) {
			$uniqid_str .= uniqid();
			for ($i = strlen($uniqid_str); $i < $len; $i++) {
				$uniqid_str .= $_number_str[rand() % strlen($_number_str)];
			}
		} else {
			$uniqid_str .= substr(uniqid(), 13 - ($len - strlen($uniqid_str)));
		}
		return $uniqid_str;
	}

	/**
	 * [get_ip 获取ip]
	 * @return [type] [description]
	 */
	public static function get_ip() {
		return $_SERVER["REMOTE_ADDR"];
	}
}