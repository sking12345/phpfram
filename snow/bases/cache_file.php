<?php
namespace snow\bases;
use snow\bases\cache_interface;
use snow\config;

class cache_file implements cache_interface {
	private $_config;
	private $fp;
	private $file;
	public function __construct() {

		$this->_config = config::$obj->cache->file->get();
		$this->file = $this->_config["path"] . "/public1.ch";
	}
	public function select_db($db = "") {
		if (!empty($db)) {
			$this->file = $this->_config["path"] . "/{$db}.ch";
		}
		return $this;
	}

	private function flock() {
		flock($this->fp, LOCK_EX | LOCK_NB);
	}
	private function unflock() {
		flock($this->fp, LOCK_UN);
	}
	private function fopen($mode = "r+") {
		if (file_exists($this->file)) {
			$this->fp = fopen($this->file, $mode);
		} else {
			$this->fp = fopen($this->file, "w+"); //如果文件不存在,则读写方式打开并创建文件
		}
	}
	/**
	 * [read_contents 夺取文件内容]
	 * @return [type] [description]
	 */
	private function get_contents() {
		$size = filesize($this->file);
		if ($size <= 0) {
			return null;
		}
		$str = fread($this->fp, $size);

		if (!empty($str)) {
			return unserialize($str);
			// $str = gzuncompress($str);
			// return json_decode($str, true);
		}
		return null;
	}

	private function write_contents($data) {
		// $json_data = json_encode($data);
		$gz_data = serialize($data);
		fseek($this->fp, 0);
		fwrite($this->fp, $gz_data, strlen($gz_data));
		return true;
	}
	public function set(string $key, string $val, int $ttl = 0) {
		if ($ttl == "0") {
			$data[$key] = ["val" => $val, "ttl" => "0"];
		} else {
			$data[$key] = ["val" => $val, "ttl" => time() + $ttl];
		}

		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (empty($arr)) {
			$result = $data;
		} else {
			$result = array_merge($arr, $data);
		}
		$this->write_contents($result);
		$this->unflock();
		return true;
	}

	public function get(string $key) {
		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (empty($arr[$key])) {
			unset($arr[$key]);
			$this->write_contents($arr);
			$this->unflock();
			return null;
		}

		if ($arr[$key]["ttl"] > 0 && $arr[$key]["ttl"] < time()) {
			unset($arr[$key]);
			$this->write_contents($arr);
			$this->unflock();
			return null;
		}
		$this->unflock();
		return $arr[$key]["val"];
	}
	public function del(string $key) {
		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (empty($arr[$key])) {
			$this->unflock();
			return true;
		}
		unset($arr[$key]);
		$this->write_contents($arr);
		$this->unflock();
		return true;
	}
	/**
	 * [remove_all 清空缓存]
	 * @return [type] [description]
	 */
	public function remove_all() {
		unlink($this->file);
		return true;
	}
	public function get_keys(string $pattern = "*") {
		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (empty($arr)) {
			$this->unflock();
			return [];
		}
		if ($pattern == "*") {
			foreach ($arr as $key => $value) {
				if ($arr[$key]["ttl"] > 0 && $arr[$key]["ttl"] < time()) {
					unset($arr[$key]);
				} else {
					$all_arr[] = $key;
				}
			}
		} else {
			foreach ($arr as $key => $value) {
				if ($arr[$key]["ttl"] > 0 && $arr[$key]["ttl"] < time()) {
					unset($arr[$key]);
				} else {
					if (preg_match($pattern, $key)) {
						$all_arr[] = $key;
					}
				}
			}
		}

		$this->write_contents($arr);
		$this->unflock();
		return $all_arr;
	}

	public function get_size() {
		if (file_exists($this->file)) {
			return filesize($this->file);
		}
		return '0';
	}

	/**
	 * [lpush 队列]
	 * @param  string $queue [description]
	 * @param  string $val   [description]
	 * @return [type]        [description]
	 */
	public function lpush(string $queue, string $val) {
		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (empty($arr)) {
			$arr[$queue] = [$val];
		} else {
			$arr = array_unshift($arr[$queue], $val);
		}
		$this->write_contents($arr);
		$this->unflock();
		return true;
	}
	public function brpop(string $queue) {
		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (!empty($arr[$queue])) {
			$val = array_pop($arr[$queue]);
		} else {
			$val = [];
		}
		$this->write_contents($arr);
		$this->unflock();
		return $val;
	}
	public function llen(string $queue) {
		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (!empty($arr[$queue])) {
			$count = count($arr[$queue]);
		} else {
			$count = '0';
		}
		$this->write_contents($arr);
		$this->unflock();
		return $count;
	}
	public function lpop(string $queue) {
		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (!empty($arr[$queue])) {
			$val = array_shift($arr[$queue]);
		} else {
			$val = [];
		}
		$this->write_contents($arr);
		$this->unflock();
		return $val;
	}
	public function lpushs(string $queue, array $vals) {
		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (empty($arr)) {
			$arr[$queue] = $vals;
		} else {
			foreach ($vals as $key => $val) {
				$arr = array_unshift($arr[$queue], $val);
			}
		}
		$this->write_contents($arr);
		$this->unflock();
		return true;
	}
	public function lrange(string $queue, int $start, int $stop) {
		$this->fopen();
		$this->flock();
		$arr = $this->get_contents();
		if (!empty($arr[$queue])) {
			$vals = array_slice($arr[$queue], $start, $stop - $start);
		} else {
			$val = [];
		}
		$this->write_contents($arr);
		$this->unflock();
		return $vals;
	}
	/**
	 * [lremove description]
	 * @param  string $queue [description]
	 * @param  int    $count [count > 0 : 从表头开始向表尾搜索，移除与 VALUE 相等的元素，数量为 COUNT 。
	count < 0 : 从表尾开始向表头搜索，移除与 VALUE 相等的元素，数量为 COUNT 的绝对值。
	count = 0 : 移除表中所有与 VALUE 相等的值。];
	 * @param  string $val   [description]
	 * @return [type]        [description]
	 */
	// public function lremove(string $queue, int $count, string $val) {
	// 	$this->fopen();
	// 	$this->flock();
	// 	$arr = $this->get_contents();
	// 	if (!empty($arr[$queue])) {
	// 		if ($count < 0) {
	// 			for ($i = count($arr[$queue]); $i >= 0; $i--) {
	// 				if ($queue_arr[$i] == $val) {
	// 					unset($arr[$queue][$i]);
	// 					$count++;
	// 				}
	// 				if ($count > 0) {
	// 					goto End;
	// 				}
	// 			}
	// 		} elseif ($count > 0) {
	// 			foreach ($arr[$queue] as $key => $value) {
	// 				if ($value == $val) {
	// 					unset($arr[$queue][$i]);
	// 					$count--;
	// 				}
	// 				if ($count < 0) {
	// 					goto End;
	// 				}
	// 			}
	// 		} else {
	// 			foreach ($arr[$queue] as $key => $value) {
	// 				if ($value == $val) {
	// 					unset($arr[$queue][$i]);
	// 				}
	// 			}
	// 		}
	// 	}
	// 	End:
	// 	$this->write_contents($arr);
	// 	$this->unflock();
	// 	return true;
	// }
	public function rpop(string $queue) {
		$this->flock();
		$arr = $this->get_contents();
		if (!empty($arr[$queue])) {
			$val = array_pop($arr[$queue]);
		} else {
			$val = [];
		}
		$this->write_contents($arr);
		$this->unflock();
		return $val;
	}
	public function get_obj(bool $is_master = false) {
		return $this;
	}
	public function get_key_len() {

	}
}
