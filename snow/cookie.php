<?php
namespace snow;

class cookie {

	public static function set(string $key, $val, int $time = 0) {
		if ($time == 0) {
			setcookie($key, $val);
		} else {
			setcookie($key, $val, time() + 3600);
		}
	}

	public static function get(string $key) {
		return empty($_COOKIE[$key]) ? false : $_COOKIE[$key];
	}

	public static function del(string $key) {
		setcookie($key, '', time() - 1);
	}
}