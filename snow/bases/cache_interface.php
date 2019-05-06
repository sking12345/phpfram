<?php
namespace snow\bases;

/**
 *
 */
interface cache_interface {
	public function select_db($db = "");
	public function set(string $key, string $val, int $ttl = 0);
	public function get(string $key);
	public function del(string $key);
	public function remove_all();
	public function get_keys(string $pattern = "*");
	public function get_size();
	public function lpush(string $queue, string $val);
	public function brpop(string $queue);
	public function llen(string $queue);
	public function lpop(string $queue);
	public function lpushs(string $queue, array $vals);
	public function lrange(string $queue, int $start, int $stop);
	public function rpop(string $queue);
	public function get_obj(bool $is_master = false);
	public function get_key_len();

}