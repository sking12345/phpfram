<?php

namespace vendor;
use vendor\configs;
use vendor\req;

class App {

	public static $user;
	public static $config;
	public static $req;
	public static function _init() {
		self::$config = configs::$instance;
		self::$req = req::$instance;
		if (configs::$instance->user->required_login->get() == true) {
			$identityClass = configs::$instance->user->identityClass->get();
			if ($identityClass::$instance == null) {
				self::$user = new $identityClass();
			} else {
				self::$user = $identityClass::$instance;
			}
		}
	}
}
?>