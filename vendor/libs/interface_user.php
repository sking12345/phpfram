<?php
namespace vendor\libs;

interface interface_user {

	public function is_login();
	public function logout();
	public function login();
	public function get($key = "");
	public function set($key, $value);
	public function __get($key);

}