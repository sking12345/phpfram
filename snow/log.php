<?php

namespace snow;
use snow\util;

class log {
	private $err_info = [];
	private static $obj = null;
	private $err_html = '';

	public static function set_errr($info, $file = "", $line = "", $trace = null) {
		if (self::$obj == null) {
			self::$obj = new log();
		}
		$Breakpoint_code = util::get_file_line($file, $line);

		self::$obj->err_info[] = $info;
		self::$obj->err_html .= ' <div style="font-size:14px;line-height:160%;border-bottom:1px dashed #ccc;margin-top:8px;">';
		self::$obj->err_html .= ' 发生环境' . date("Y-m-d H:i:s", time()) . '::' . $_SERVER["REQUEST_URI"] . "<br>";
		self::$obj->err_html .= '错误类型：<font color="#CDA93A">普通警告' . '</font><br>
        出错原因：<font color="#3F7640">' . $info . '</font><br>';
		self::$obj->err_html .= "提示位置：<a href=\"mvim://open?url=file://{$file}:line={$line}\"></a>{$file} 第 {$line} 行<br>";
		self::$obj->err_html .= '断点源码：<font color="#747267">' . $Breakpoint_code . '</font><br>';
		if (!empty($trace)) {
			self::$obj->err_html .= '详细跟踪：<br>';
			foreach ($trace as $key => $value) {
				if ($key == "1") {
					continue;
				}
				if (empty($value["line"])) {
					continue;
				}
				self::$obj->err_html .= "<font color=\"#747267\">
				[{$key}]{$value["file"]}:line={$value["line"]}</font>
				function_name:{$value["function"]}
				<br>";
			}
		}
		self::$obj->err_html .= '</div>';
	}
	public function __destruct() {

		if (!empty($this->err_html)) {
			$html = "<div style='width:100px;line-height:18px;position:absolute;top:2px;left:2px;border:1px solid #ccc; padding:1px;text-align:center;font-size:14px;color:#666;z-index:10000' onclick=\"javascript:document.getElementById('debug_errdiv').style.display='block';\">";
			$html .= '[打开调试信息]';
			$html .= "</div>";
			$html .= '<div id="debug_errdiv" style="z-index: 9999; width: 80%; position: absolute; top: 10px; left: 8px; border: 2px solid rgb(204, 204, 204); background: rgb(255, 255, 255); padding: 8px; display: none">';
			$html .= '<div style="line-height:24px; background: #FBFEEF;;">
			        <div style="float:left"><strong>应用错误/警告信息追踪：</strong></div>
			        <div style="float:right">';
			$html .= "<a href=\"javascript:;\" onclick=\"javascript:document.getElementById('debug_errdiv').style.display='none'\" style=\"font-size:14px;\">[关闭全部]</a>";
			$html .= '</div><br style="clear:both"></div>';
			$html .= $this->err_html;
			$html .= "</idv>";
			echo $html;
		}
	}
}