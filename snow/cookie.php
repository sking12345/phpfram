<?php
namespace snow;

class cookie {

	public static function set(string $key, $val, int $time = 0) {
		if ($time == 0) {
			setcookie($key, $val, NULL, NULL, NULL, NULL);
		} else {
			setcookie($key, $val, time() + $time, NULL, NULL, NULL);
		}
	}

	public static function get(string $key) {
		return empty($_COOKIE[$key]) ? false : $_COOKIE[$key];
	}

	public static function del(string $key) {
		setcookie($key, '', time() - 1);
	}
}