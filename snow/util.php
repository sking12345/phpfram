<?php

namespace snow;

class util {

	/**
	 * http:get请求
	 */
	public static function http_get($url, $param = "") {
		return file_get_contents($url);
	}

	/**
	 * 获取指定行内容
	 *
	 * @param $file 文件路径
	 * @param $line 行数
	 * @param $length 指定行返回内容长度
	 */
	public static function get_file_line($file, $line, $length = 1000) {
		$returnTxt = null; // 初始化返回
		$i = 1; // 行数

		$handle = @fopen($file, "r");
		if ($handle) {
			while (!feof($handle)) {
				$buffer = fgets($handle, $length);
				if ($line == $i) {
					$returnTxt = $buffer;
				}
				$i++;
			}
			fclose($handle);
		}
		return $returnTxt;
	}
	/**
	 * [file_head_type 根据文件头数据获取文件类型]
	 * @param  string $filename [description]
	 * @return [type]           [description]
	 */
	public static function file_head_type(string $filename) {
		$file = fopen($filename, "rb");
		$bin = fread($file, 2); //只读2字节
		fclose($file);
		$strInfo = @unpack("C2chars", $bin);
		$typeCode = intval($strInfo['chars1'] . $strInfo['chars2']);
		$fileType = '';
		switch ($typeCode) {
		case 7790:$fileType = 'exe';
			break;
		case 7784:$fileType = 'midi';
			break;
		case 8297:$fileType = 'rar';
			break;
		case 255216:$fileType = 'jpg';
			break;
		case 7173:$fileType = 'gif';
			break;
		case 6677:$fileType = 'bmp';
			break;
		case 13780:$fileType = 'png';
			break;
		default:echo 'unknown';
		}
		return $fileType;
	}

	public static function file_mime_type(string $filename) {
		$finfo = finfo_open(FILEINFO_MIME); // 返回 mime 类型
		// $filename = '/Users/sking/code/web/login.php';
		$mime_type = finfo_file($finfo, $filename);
		finfo_close($finfo);
		return $mime_type;
	}
	/**
	 * [file_type 获取文件尾缀名]
	 * @param  string $filename [description]
	 * @return [type]           [description]
	 */
	public static function file_type(string $filename) {
		return pathinfo($filename, PATHINFO_EXTENSION);
	}
	/**
	 * [create_uniqid 创建唯一的ID]
	 * @return [type] [description]
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
	/**
	 * [msectime 当前Unix 时间戳毫秒数]
	 * @return [type] [description]
	 */
	public static function get_msectime() {
		list($msec, $sec) = explode(' ', microtime());
		$msectime = (float) sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
		return $msectime;
	}
	//当前使用内存
	public static function get_usage() {
		return memory_get_usage();
	}
	/**
	 * [os_info 操作系统信息]
	 * @return [type] [description]
	 */
	public static function os_info() {
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$os = false;
		if (preg_match('/win/i', $agent) && strpos($agent, '95')) {
			$os = 'Windows 95';
		} else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90')) {
			$os = 'Windows ME';
		} else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent)) {
			$os = 'Windows 98';
		} else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent)) {
			$os = 'Windows Vista';
		} else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent)) {
			$os = 'Windows 7';
		} else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent)) {
			$os = 'Windows 8';
		} else if (preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent)) {
			$os = 'Windows 10'; #添加win10判断
		} else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent)) {
			$os = 'Windows XP';
		} else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent)) {
			$os = 'Windows 2000';
		} else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent)) {
			$os = 'Windows NT';
		} else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent)) {
			$os = 'Windows 32';
		} else if (preg_match('/linux/i', $agent)) {
			$os = 'Linux';
		} else if (preg_match('/unix/i', $agent)) {
			$os = 'Unix';
		} else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent)) {
			$os = 'SunOS';
		} else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent)) {
			$os = 'IBM OS/2';
		} else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent)) {
			$os = 'Macintosh';
		} else if (preg_match('/PowerPC/i', $agent)) {
			$os = 'PowerPC';
		} else if (preg_match('/AIX/i', $agent)) {
			$os = 'AIX';
		} else if (preg_match('/HPUX/i', $agent)) {
			$os = 'HPUX';
		} else if (preg_match('/NetBSD/i', $agent)) {
			$os = 'NetBSD';
		} else if (preg_match('/BSD/i', $agent)) {
			$os = 'BSD';
		} else if (preg_match('/OSF1/i', $agent)) {
			$os = 'OSF1';
		} else if (preg_match('/IRIX/i', $agent)) {
			$os = 'IRIX';
		} else if (preg_match('/FreeBSD/i', $agent)) {
			$os = 'FreeBSD';
		} else if (preg_match('/teleport/i', $agent)) {
			$os = 'teleport';
		} else if (preg_match('/flashget/i', $agent)) {
			$os = 'flashget';
		} else if (preg_match('/webzip/i', $agent)) {
			$os = 'webzip';
		} else if (preg_match('/offline/i', $agent)) {
			$os = 'offline';
		} else if (preg_match("/Mac OS/i", $agent)) {
			$os = "Mac OS";
		} else {
			$os = '未知操作系统';
		}
		return $os;
	}

	/**
	 * [is_mobile 判断是否为移动设备]
	 * @return boolean [如果是移动设备就返回移动设备信息]
	 */
	public static function is_mobile() {
		if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
			return $_SERVER['HTTP_X_WAP_PROFILE'];
		}
		if (isset($_SERVER['HTTP_VIA'])) {
			if (stristr($_SERVER['HTTP_VIA'], "wap")) {
				return $_SERVER['HTTP_VIA'];
			} else {
				return false;
			}
		}
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$mobile_browser = Array(
			"mqqbrowser", // 手机QQ浏览器
			"opera mobi", // 手机opera
			"juc", "iuc", // uc浏览器
			"fennec", "ios", "applewebKit/420", "applewebkit/525",
			"applewebkit/532", "ipad", "iphone", "ipaq", "ipod", "iemobile",
			"windows ce", // windows phone
			"240×320", "480×640", "acer", "android", "anywhereyougo.com",
			"asus", "audio", "blackberry", "blazer", "coolpad", "dopod", "etouch",
			"hitachi", "htc", "huawei",
			"jbrowser", "lenovo", "lg", "lg-", "lge-", "lge", "mobi", "moto", "nokia", "phone",
			"samsung", "sony", "symbian", "tablet", "tianyu", "wap", "xda", "xde", "zte",
		);
		if (preg_match("/(" . implode('|', $mobile_browser) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
			return $user_agent;
		}
		return false;
	}
	/**
	 * [is_robot 判断是否为机器爬虫]
	 * @return boolean [如果是爬虫，返回爬虫相关信息]
	 */
	public static function is_robot() {
		$agent = strtolower(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
		if (!empty($agent)) {
			$spiderSite = array(
				"TencentTraveler", "Baiduspider+", "BaiduGame", "Googlebot", "msnbot",
				"Sosospider+", "Sogou web spider", "ia_archiver", "Yahoo! Slurp",
				"YoudaoBot", "Yahoo Slurp", "MSNBot", "Java (Often spam bot)", "BaiDuSpider", "Voila", "Yandex bot",
				"BSpider", "twiceler", "Sogou Spider", "Speedy Spider", "Google AdSense",
				"Heritrix", "Python-urllib", "Alexa (IA Archiver)", "Ask",
				"Exabot", "Custo", "OutfoxBot/YodaoBot", "yacy", "SurveyBot", "legs",
				"lwp-trivial", "Nutch", "StackRambler", "The web archive (IA Archiver)", "Perl tool", "MJ12bot", "Netcraft",
				"MSIECrawler", "WGet tools", "larbin", "Fish search",
			);
			foreach ($spiderSite as $val) {
				$str = strtolower($val);
				if (strpos($agent, $str) !== false) {
					return $agent;
				}
			}
		}
		return false;
	}
	/**
	 * [get_browser 获取浏览器信息]
	 * @return [type] [description]
	 */
	public static function get_browser() {
		return $_SERVER["HTTP_USER_AGENT"];
	}
	/**
	 * [resizeImage 修改图片大小]
	 * @param  [type] $im        [description]
	 * @param  [type] $dest      [description]
	 * @param  [type] $maxwidth  [description]
	 * @param  [type] $maxheight [description]
	 * @return [type]            [description]
	 */
	public static function resizeImage($im, $dest, $maxwidth, $maxheight) {
		$img = getimagesize($im);
		switch ($img[2]) {
		case 1:
			$im = @imagecreatefromgif($im);
			break;
		case 2:
			$im = @imagecreatefromjpeg($im);
			break;
		case 3:
			$im = @imagecreatefrompng($im);
			break;
		}
		$pic_width = imagesx($im);
		$pic_height = imagesy($im);
		$resizewidth_tag = false;
		$resizeheight_tag = false;
		if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
			if ($maxwidth && $pic_width > $maxwidth) {
				$widthratio = $maxwidth / $pic_width;
				$resizewidth_tag = true;
			}
			if ($maxheight && $pic_height > $maxheight) {
				$heightratio = $maxheight / $pic_height;
				$resizeheight_tag = true;
			}
			if ($resizewidth_tag && $resizeheight_tag) {
				if ($widthratio < $heightratio) {
					$ratio = $widthratio;
				} else {
					$ratio = $heightratio;
				}
			}
			if ($resizewidth_tag && !$resizeheight_tag) {
				$ratio = $widthratio;
			}
			if ($resizeheight_tag && !$resizewidth_tag) {
				$ratio = $heightratio;
			}
			$newwidth = $pic_width * $ratio;
			$newheight = $pic_height * $ratio;
			if (function_exists("imagecopyresampled")) {
				$newim = imagecreatetruecolor($newwidth, $newheight);
				imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
			} else {
				$newim = imagecreate($newwidth, $newheight);
				imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
			}

			imagejpeg($newim, $dest);
			imagedestroy($newim);
		} else {
			imagejpeg($im, $dest);
		}
	}
}
?>








