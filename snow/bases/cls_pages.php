<?php
namespace snow\bases;
use snow\req;

class cls_pages {

	public static function get_pages(int $count, $num) {
		$page_num = ceil($count / $num);
		$show_page = req::item("show_page", 1);

		if ($show_page > $page_num && $page_num > 0) {
			$show_page = $page_num;
		}
		if ($show_page - 3 > 1) {
			$start_page = $show_page - 3;
		} else {
			$start_page = 1;
		}
		if ($show_page + 3 < $page_num) {
			$end_page = $show_page + 3;
		} else {
			$end_page = $page_num;
		}
		$start = ($show_page - 1) * $num;

		return ["page_num" => $page_num, "start" => $start, "num" => $num, "show_page" => $show_page, 'start_page' => $start_page, "end_page" => $end_page];
	}

}
