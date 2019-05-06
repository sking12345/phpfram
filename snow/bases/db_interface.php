<?php
namespace snow\bases;

interface db_interface {
	public function insert(string $table_name);
	public function select(string $fields = "*");
	public function update(string $table_name);
	public function delete(string $table_name);
	public function set(array $data, bool $is_multiple = false);
	public function execute(string $index_field = "");
	public function from(string $table_name);
	public function where(array $where);
	public function or_where(array $where, bool $type = false);
	public function group_by($groups);
	public function limit(int $start, int $num);
	public function query(string $sql);
	public function start();
	public function commit();
	public function ranback();
	public function one();
	public function exist();
	public function count();
	public function all(string $index_field = "");
	public function to_json(string $index_field = "");
}
