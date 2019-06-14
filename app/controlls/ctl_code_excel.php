<?php

namespace app\controlls;
use snow\db;
use snow\exts\PHPExcel;

class ctl_code_excel {
	private $path = '/Users/aaa/code/web/phpfram/cache';

	public function __destruct() {
		echo "ok";
	}
	/**
	 *导出种类编码
	 */
	public function export_kind() {
		$objPHPExcel = new \PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '种类')
			->setCellValue('B1', '编号');
		$kinds = db::select("code", "*")->where(["type" => "1", "delete_time" => "0"])->order_by("code asc")->all();
		foreach ($kinds as $key => $value) {
			$index = $key + 2;
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A{$index}", $value["name"])
				->setCellValue("B{$index}", $value["code"]);
		}
		$objPHPExcel->getActiveSheet()->setTitle('种类');
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save("{$this->path}/种类.xlsx");
		$this->down("种类.xlsx");
	}
	public function export_business_unit() {
		$kinds = db::select("code", "*")->where(["type" => "1", "delete_time" => "0"])->order_by("code asc")->all("code");
		$objPHPExcel = new \PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '事业部')
			->setCellValue('B1', '编号')
			->setCellValue("C1", "所属种类");
		$business_unit = db::select("code", "*")->where(["type" => "2", "delete_time" => "0"])->order_by("code asc")->all();
		foreach ($business_unit as $key => $value) {
			$index = $key + 2;
			$kind_code = substr($value["code"], 0, 1);
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A{$index}", $value["name"])
				->setCellValue("B{$index}", $value["code"])
				->setCellValue("C{$index}", "{$kinds[$kind_code]["name"]}({$kinds[$kind_code]["code"]})");
		}
		$objPHPExcel->getActiveSheet()->setTitle('事业部');
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save("{$this->path}/事业部.xlsx");
		$this->down("事业部.xlsx");
	}

	public function export_big_cate() {
		$kinds = db::select("code", "*")->where(["type" => "1", "delete_time" => "0"])->all("code");
		$objPHPExcel = new \PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '大类')
			->setCellValue('B1', '编号')
			->setCellValue("C1", "所属事业")
			->setCellValue("D1", "所属种类");

		$business_unit = db::select("code", "*")->where(["type" => "2", "delete_time" => "0"])->all("code");
		$big_cate = db::select("code", "*")->where(["type" => "3", "delete_time" => "0"])->order_by("code asc")->all();
		foreach ($big_cate as $key => $value) {
			$index = $key + 2;
			$kind_code = substr($value["code"], 0, 1);
			$unit_code = substr($value["code"], 0, 3);
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A{$index}", $value["name"])
				->setCellValue("B{$index}", $value["code"])
				->setCellValue("C{$index}", "{$business_unit[$unit_code]["name"]}({$business_unit[$unit_code]["code"]})")
				->setCellValue("D{$index}", "{$kinds[$kind_code]["name"]}({$kinds[$kind_code]["code"]})");
		}
		$objPHPExcel->getActiveSheet()->setTitle('事业部');
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save("{$this->path}/大类.xlsx");
		$this->down("大类.xlsx");
	}

	public function export_small_cate() {
		$kinds = db::select("code", "*")->where(["type" => "1", "delete_time" => "0"])->all("code");
		$business_unit = db::select("code", "*")->where(["type" => "2", "delete_time" => "0"])->all("code");
		$big_cate = db::select("code", "*")->where(["type" => "3", "delete_time" => "0"])->all("code");
		$small_cate = db::select("code", "*")->where(["type" => "4", "delete_time" => "0"])->order_by("code asc")->all();
		$objPHPExcel = new \PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '小类')
			->setCellValue('B1', '编号')
			->setCellValue("C1", "所属大类")
			->setCellValue("D1", "所属事业")
			->setCellValue("E1", "所属种类");
		foreach ($small_cate as $key => $value) {
			$index = $key + 2;
			$kind_code = substr($value["code"], 0, 1);
			$unit_code = substr($value["code"], 0, 3);
			$big_code = substr($value["code"], 0, 5);
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A{$index}", $value["name"])
				->setCellValue("B{$index}", $value["code"])
				->setCellValue("C{$index}", "{$big_cate[$big_code]["name"]}({$big_cate[$big_code]["code"]})")
				->setCellValue("D{$index}", "{$business_unit[$unit_code]["name"]}({$business_unit[$unit_code]["code"]})")
				->setCellValue("E{$index}", "{$kinds[$kind_code]["name"]}({$kinds[$kind_code]["code"]})");
		}
		$objPHPExcel->getActiveSheet()->setTitle('小类');
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save("{$this->path}/小类.xlsx");
		$this->down("小类.xlsx");
	}

	public function export_all() {
		$kinds = db::select("code", "*")->where(["type" => "1", "delete_time" => "0"])->all("code");
		$business_unit = db::select("code", "*")->where(["type" => "2", "delete_time" => "0"])->all("code");
		$big_cate = db::select("code", "*")->where(["type" => "3", "delete_time" => "0"])->all("code");
		$small_cate = db::select("code", "*")->where(["type" => "4", "delete_time" => "0"])
			->order_by("code asc")->all("id");
		$objPHPExcel = new \PHPExcel();
		$index = 1;
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '种类')
			->setCellValue('B1', '编号');
		foreach ($kinds as $key => $value) {
			$index = $index + 1;
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A{$index}", $value["name"])
				->setCellValue("B{$index}", $value["code"]);
		}

		$objPHPExcel->getActiveSheet()->setTitle('种类');
		$objPHPExcel->createSheet();
		$objPHPExcel->setactivesheetindex(1);
		$index = 1;
		$objPHPExcel->setActiveSheetIndex(1)
			->setCellValue('A1', '事业部')
			->setCellValue('B1', '编号')
			->setCellValue("C1", "所属种类");
		foreach ($business_unit as $key => $value) {
			$index = $index + 1;
			$kind_code = substr($value["code"], 0, 1);
			$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue("A{$index}", $value["name"])
				->setCellValue("B{$index}", $value["code"])
				->setCellValue("C{$index}", "{$kinds[$kind_code]["name"]}({$kinds[$kind_code]["code"]})");
		}
		$objPHPExcel->getActiveSheet()->setTitle('事业部');
		$objPHPExcel->createSheet();
		$objPHPExcel->setactivesheetindex(2);
		$index = 1;
		$objPHPExcel->setActiveSheetIndex(2)
			->setCellValue('A1', '大类')
			->setCellValue('B1', '编号')
			->setCellValue("C1", "所属事业")
			->setCellValue("D1", "所属种类");
		foreach ($big_cate as $key => $value) {
			$index = $index + 1;
			$kind_code = substr($value["code"], 0, 1);
			$unit_code = substr($value["code"], 0, 3);
			$objPHPExcel->setActiveSheetIndex(2)
				->setCellValue("A{$index}", $value["name"])
				->setCellValue("B{$index}", $value["code"])
				->setCellValue("C{$index}", "{$business_unit[$unit_code]["name"]}({$business_unit[$unit_code]["code"]})")
				->setCellValue("D{$index}", "{$kinds[$kind_code]["name"]}({$kinds[$kind_code]["code"]})");
		}
		$objPHPExcel->getActiveSheet()->setTitle('大类');
		$objPHPExcel->createSheet();
		$objPHPExcel->setactivesheetindex(3);
		$objPHPExcel->setActiveSheetIndex(3)
			->setCellValue('A1', '小类')
			->setCellValue('B1', '编号')
			->setCellValue("C1", "所属大类")
			->setCellValue("D1", "所属事业")
			->setCellValue("E1", "所属种类");
		$index = 1;
		foreach ($small_cate as $key => $value) {
			$index = $index + 1;
			$kind_code = substr($value["code"], 0, 1);
			$unit_code = substr($value["code"], 0, 3);
			$big_code = substr($value["code"], 0, 5);
			$objPHPExcel->setActiveSheetIndex(3)
				->setCellValue("A{$index}", $value["name"])
				->setCellValue("B{$index}", $value["code"])
				->setCellValue("C{$index}", "{$big_cate[$big_code]["name"]}({$big_cate[$big_code]["code"]})")
				->setCellValue("D{$index}", "{$business_unit[$unit_code]["name"]}({$business_unit[$unit_code]["code"]})")
				->setCellValue("E{$index}", "{$kinds[$kind_code]["name"]}({$kinds[$kind_code]["code"]})");
		}
		$objPHPExcel->getActiveSheet()->setTitle('小类');

		$product_name = db::select("product_name", "*")->all();
		$objPHPExcel->createSheet();
		$objPHPExcel->setactivesheetindex(4);
		$objPHPExcel->setActiveSheetIndex(4)
			->setCellValue('A1', '品名')
			->setCellValue('B1', '编码')
			->setCellValue('C1', '小类')
			->setCellValue('D1', '小类编号')
			->setCellValue("E1", "所属大类")
			->setCellValue("F1", "所属事业")
			->setCellValue("G1", "所属种类");
		$index = 1;
		foreach ($small_cate as $key => $value) {
			$kind_code = substr($value["code"], 0, 1);
			$unit_code = substr($value["code"], 0, 3);
			$big_code = substr($value["code"], 0, 5);
			$product_names = db::select("product_name", "*")->where(["code_id" => $value["id"]])->all();
			$pcode = $value["code"] . "00000";
			foreach ($product_names as $key1 => $val1) {
				$index = $index + 1;
				$_code = $pcode + $key1;
				$objPHPExcel->setActiveSheetIndex(4)
					->setCellValue("A{$index}", $val1["name"])
					->setCellValue("B{$index}", "x{$_code}")
					->setCellValue("C{$index}", $value["name"])
					->setCellValue("D{$index}", $value["code"])
					->setCellValue("E{$index}", "{$big_cate[$big_code]["name"]}({$big_cate[$big_code]["code"]})")
					->setCellValue("F{$index}", "{$business_unit[$unit_code]["name"]}({$business_unit[$unit_code]["code"]})")
					->setCellValue("G{$index}", "{$kinds[$kind_code]["name"]}({$kinds[$kind_code]["code"]})");
			}

		}
		$objPHPExcel->getActiveSheet()->setTitle('品名');
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save("{$this->path}/编码.xlsx");
		$this->down("编码.xlsx");
	}

	private function down($file_name) {
		// $file = fopen($this->path . "/" . $file_name, "r");
		// //输入文件标签
		// Header("Content-type: application/octet-stream");
		// Header("Accept-Ranges: bytes");
		// Header("Accept-Length: " . filesize($this->path . "/" . $file_name));
		// Header("Content-Disposition: attachment; filename=" . $file_name);
		// //输出文件内容
		// //读取文件内容并直接输出到浏览器
		// echo fread($file, filesize($this->path . "/" . $file_name));
		// fclose($file);
		// exit();
	}

}
?>































