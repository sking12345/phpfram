<?php
namespace snow\bases;

use snow\bases\cache_interface;
use snow\config;

class cache_redis implements cache_interface {

	protected static $reids_master_con = null;
	protected static $redis_slave_con = null;
	protected $db_index = 0;
	public static function _init() {
		//function_exists()
		$extends_arr = get_loaded_extensions();
		if (!in_array("redis", $extends_arr)) {
			throw new \Exception("php don't have redis extend", 1);
		}
	}

	protected function _connect(bool $is_master = false) {
		$redis_config = config::$obj->cache->redis->get();
		if ($redis_config["open_slave"] == false || $is_master == true) {
			if (!empty(self::$reids_master_con)) {
				self::$reids_master_con->select($this->db_index);
				return self::$reids_master_con;
			}
			$reids_obj = new \Redis();
			$host = $redis_config["master"]["host"];
			$port = $redis_config["master"]["port"];
			$reids_obj->connect($host, $port);
			if (!empty($redis_config["master"]["password"])) {
				$reids_obj->auth($redis_config["master"]["password"]);
			}
			if ($reids_obj->ping() != "+PONG") {
				throw new Exception("redis ping fail", 1);
			}
			self::$reids_master_con = $reids_obj;
			self::$reids_master_con->select($this->db_index);
		} else {
			if (!empty(self::$redis_slave_con)) {
				self::$redis_slave_con->select($this->db_index);
				return self::$redis_slave_con;
			}
			$reids_obj = new \Redis();
			$hosts = $redis_config["savle"]["host"];
			$index = rand() % count($redis_config["master"]["host"]);
			$host = $hosts[$index];
			$port = $redis_config["savle"]["port"];
			$reids_obj->connect($host, $port);
			if (!empty($redis_config["savle"]["password"])) {
				$reids_obj->auth($redis_config["savle"]["password"]);
			}
			if ($reids_obj->ping() != "+PONG") {
				throw new Exception("redis ping fail", 1);
			}
			self::$redis_slave_con = $reids_obj;
			self::$redis_slave_con->select($this->db_index);
		}
		return $reids_obj;
	}
	public function select_db($db = "") {
		if (!empty($db)) {
			$this->db_index = $db;
		}
		return $this;
	}
	public function set(string $key, string $val, int $ttl = 0, bool $immediate = true) {
		$redis_con = $this->_connect(true);
		if (!empty($ttl)) {
			$redis_con->set($key, $val, $ttl);
		} else {
			$redis_con->set($key, $val);
		}
	}
	public function get(string $key) {
		$redis_con = $this->_connect(false);
		return $redis_con->get($key);
	}
	public function del(string $key) {
		$redis_con = $this->_connect(true);
		return $redis_con->del($key);
	}
	public function remove_all() {
		$redis_con = $this->_connect(true);
		return $redis_con->flushAll();
	}
	public function get_keys(string $pattern = "*") {
		$redis_con = $this->_connect(false);
		return $redis_con->keys($pattern);
	}
	public function get_key_len() {
		$redis_con = $this->_connect(false);
		return $redis_con->dbsize();
	}
	public function get_size() {
		$redis_con = $this->_connect(false);
		return $redis_con->info();
	}
	public function lpush(string $queue, string $val) {
		$redis_con = $this->_connect(true);
		$redis_con->lpush($queue, $val);
	}
	public function brpop(string $queue) {
		$redis_con = $this->_connect(true);
		$redis_con->brpop($queue);
	}
	public function llen(string $queue) {
		$redis_con = $this->_connect(true);
		return $redis_con->llen($queue);
	}
	public function lpop(string $queue) {
		$redis_con = $this->_connect(true);
		$redis_con->lpop($queue);
	}
	public function lpushs(string $queue, array $vals) {
		$redis_con = $this->_connect(true);
		$redis_con->lpop($queue, $vals);
	}
	public function lrange(string $queue, int $start, int $stop) {
		$redis_con = $this->_connect(true);
		return $redis_con->lrange($queue, $start, $stop);
	}
	public function rpop(string $queue) {
		$redis_con = $this->_connect(true);
		return $redis_con->rpop($queue);
	}
	public function get_obj(bool $is_master = false) {
		$redis_con = $this->_connect($is_master);
		return $redis_con;
	}
}
