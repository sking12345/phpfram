<?php

namespace app\controlls;
use snow\config;
use snow\util;

class ctl_test {

	/**
	 * 测试邮箱
	 */
	public function test1() {
		/*发送邮箱*/
		util::send_mail("1281099078@qq.com", "xxx", "<h1>sdfsdf</h>");
	}

	public function test_mq() {

		util::mq_publish("e_linvo", "key_1", "xxx");
}