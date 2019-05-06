<?php
namespace snow\bases;
use snow\cache;
use snow\config;

class cls_captcha {

	/**
	 * [create 创建验证码]
	 * @return [type] [description]
	 */
	/**
	 * [create 创建验证码]
	 * @param  [type] $unique [编号]
	 * @return [type]         [description]
	 */
	public static function create($unique) {
		$captcha = config::$obj->captcha->get();
		if ($captcha["img"] == true) {
			self::create_img($unique);
		}

	}
	public static function verify($unique, $val) {
		$captcha = config::$obj->captcha->get();
		if ($captcha["img"] == true) {
			return self::verify_img($unique, $val);
		}
	}

	private static function create_img($unique) {
		ob_clean();
		header("content-type:image/png");
		$validateLength = 4;
		$strToDraw = "";
		$chars = [
			"0", "1", "2", "3", "4",
			"5", "6", "7", "8", "9",
			"a", "b", "c", "d", "e", "f", "g",
			"h", "i", "j", "k", "l", "m", "n",
			"o", "p", "q", "r", "s", "t",
			"u", "v", "w", "x", "y", "z",
			"A", "B", "C", "D", "E", "F", "G",
			"H", "I", "J", "K", "L", "M", "N",
			"O", "P", "Q", "R", "S", "T",
			"U", "V", "W", "X", "Y", "Z",
		];
		$imgW = 80;
		$imgH = 25;
		$imgRes = imagecreate($imgW, $imgH);
		$imgColor = imagecolorallocate($imgRes, 255, 255, 100);
		$color = imagecolorallocate($imgRes, 0, 0, 0);
		$code_str = "";
		for ($i = 0; $i < $validateLength; $i++) {
			$rand = rand(1, 58);
			$strToDraw = $strToDraw . " " . $chars[$rand];
			$code_str .= $chars[$rand];
		}
		cache::get_instance("captcha")->set($unique, strtolower($code_str), 180);
		ob_clean();
		imagestring($imgRes, 5, 0, 5, $strToDraw, $color);
		for ($i = 0; $i < 100; $i++) {
			imagesetpixel($imgRes, rand(0, $imgW), rand(0, $imgH), $color);
		}
		imagepng($imgRes);
		imagedestroy($imgRes);
	}
	private static function verify_img($unique, $val) {
		$str = cache::get_instance("captcha")->get($unique);
		if (strtolower($val) == $str) {
			return true;
		}
		return false;
	}
}
