<?php
namespace snow\bases;
use snow\bases\db_interface;

// class mysql implements db_interface
class mysql implements db_interface {
	private $db_congis = [];
	private $_sql;
	private $is_where = false;
	private $master_con = null;
	private $slave_con = null;
	private $option_code = 0x00; //0x01:insert 0x02:delete 0x03:update 0x04:select
	private $echo_sql_status = false;
	private $bool_set = false;

	public function __construct($configs) {
		$this->db_congis = $configs;
	}
	public function __destruct() {

	}
	public function echo_sql(bool $echo_sql = false) {
		$this->echo_sql_status = $echo_sql;
		return $this;
	}

	private function _connect_db(bool $is_master = false) {
		$user_name = $this->db_congis["user_name"];
		$password = $this->db_congis["password"];
		$db_name = $this->db_congis["db_name"];
		if ($this->db_congis["open_slave"] == false) {
			//如果没有开启从服务器配置
			if ($this->master_con == null) {
				$host = $this->db_congis["master"];
				$this->master_server = $host;
				$this->master_con = mysqli_connect($host, $user_name, $password, $db_name);
			}
			if (mysqli_connect_errno($this->master_con)) {
				throw new \Exception("连接 MySQL 失败: " . mysqli_connect_error(), 1);
			}
			return $this->master_con;
		}
		if ($is_master == false) {
			if ($this->slave_con == null) {
				$slave_count = count($this->db_congis["slave"]);
				$index = rand() % $slave_count;
				$host = $this->db_congis["slave"][$index];
				$this->slave_con = mysqli_connect($host, $user_name, $password, $db_name);
				if (mysqli_connect_errno($this->slave_con)) {
					throw new \Exception("连接 MySQL 失败: " . mysqli_connect_error(), 1);
				}
				$charset = "set names utf8";
				mysqli_query($this->slave_con, $charset);
			}
			return $this->slave_con;
		} else {
			if ($this->master_con == null) {
				$host = $this->db_congis["master"];
				$this->master_con = mysqli_connect($host, $user_name, $password, $db_name);
				if (mysqli_connect_errno($this->master_con)) {
					throw new \Exception("连接 MySQL 失败: " . mysqli_connect_error(), 1);
				}
				$charset = "set names utf8";
				mysqli_query($this->master_con, $charset);
			}
			return $this->master_con;
		}
	}

	public function insert(string $table_name) {
		$this->option_code = 0x01;
		$this->_sql = "insert into {$this->db_congis["prefix"]}{$table_name}";
		return $this;
	}
	public function replace(string $table_name) {
		$this->option_code = 0x01;
		$this->_sql = "replace into {$this->db_congis["prefix"]}{$table_name}";
		return $this;
	}

	public function select(string $fields = "*") {

		$this->_sql = "select {$fields}";
		$this->option_code = 0x04;
		return $this;
	}

	public function update(string $table_name) {
		$this->option_code = 0x03;
		$this->bool_set = false;
		$this->_sql = "update {$this->db_congis["prefix"]}{$table_name} set ";
		return $this;
	}
	public function delete(string $table_name) {

		$this->option_code = 0x02;
		$this->_sql = "delete from {$this->db_congis["prefix"]}{$table_name}";
		return $this;
	}
	/**
	 * [set 是否多个数据]
	 * @param array        $data        [description]
	 * @param bool|boolean $is_Multiple [description]
	 */
	public function set(array $data, bool $is_multiple = false) {

		if ($is_multiple == false) {
			if ($this->option_code == 0x01) {
				//新增
				$keys_arr = array_keys($data);
				$this->_sql .= "(" . implode(",", $keys_arr) . ")";
				$this->_sql .= " values('" . implode("','", $data) . "')";
			} else {

				$_update_arr = [];
				foreach ($data as $key => $value) {
					if (is_array($value)) {
						$_update_arr[] = "{$key}={$key}{$value[0]}'{$value[1]}'";
					} else {
						$_update_arr[] = "{$key}='{$value}'";
					}

				}
				if ($this->bool_set == false) {
					$this->_sql .= implode(",", $_update_arr);
					$this->bool_set = true;
				} else {
					$this->_sql .= "," . implode(",", $_update_arr);
				}
			}
		} else {
			$keys_arr = array_keys($data[0]);
			$this->_sql .= "(" . implode(",", $keys_arr) . ") values";
			$value_arr = [];
			foreach ($data as $key => $value) {
				$value_arr[] = " ('" . implode("','", $value) . "') ";
			}
			$this->_sql .= implode(",", $value_arr);
		}
		return $this;
	}
	public function execute(string $index_field = "") {
		if ($this->option_code == 0x04) {
			return $this->all($index_field);
		}
		return $this->query($this->_sql);
	}
	public function from(string $table_name) {
		$this->_sql .= " from {$this->db_congis["prefix"]}{$table_name} ";
		return $this;
	}
	public function where(array $where) {
		$_where = [];
		foreach ($where as $key => $value) {
			if (is_array($value)) {
				if (is_array($value[1])) {

					$_where[] = " {$key} {$value[0]} ('" . implode("','", $value[1]) . "')";
				} else {
					$_where[] = " {$key} {$value[0]} '{$value[1]}'";
				}

			} else {
				$_where[] = " {$key}='{$value}'";
			}
		}
		if ($this->is_where == true) {
			$this->_sql .= " and " . implode(" and ", $_where);
		} else {
			$this->_sql .= " where " . implode(" and ", $_where);
		}
		$this->is_where = true;
		return $this;
	}
	public function or_where(array $where, bool $type = false) {
		$_where = [];
		foreach ($where as $key => $value) {
			if (is_array($value)) {
				if (is_array($value[1])) {

					$_where[] = " {$key} {$value[0]} ('" . implode("','", $value[1]) . "')";
				} else {
					$_where[] = " {$key} {$value[0]} '{$value[1]}'";
				}
			} else {
				$_where[] = " {$key}='{$value}'";
			}
		}
		if ($this->is_where == true) {
			if ($type == false) {
				$this->_sql .= " or (" . implode(" and ", $_where) . ")";
			} else {
				$this->_sql .= " and " . implode(" or ", $_where);
			}
		} else {
			$this->_sql .= " where " . implode(" or ", $_where);
		}
		$this->is_where = true;
		return $this;
	}
	public function order_by(string $order_str) {
		$this->_sql .= " order by " . $order_str;
		return $this;
	}
	public function group_by($groups) {
		if (is_array($groups)) {
			$this->_sql .= " group by " . implode(",", $groups);
		} else {
			$this->_sql .= " group by " . $groups;
		}
		return $this;
	}
	public function limit(int $start, int $end) {
		$this->_sql .= " limit {$start},{$end}";
		return $this;
	}

	public function query(string $sql) {
		$this->is_where = false;
		if ($this->option_code == 0x01 || $this->option_code == 0x02 || $this->option_code == 0x03) {
			$con = $this->_connect_db(true); //增删改主服务器
		} else {
			$con = $this->_connect_db(false);
		}
		if ($this->echo_sql_status == true) {
			echo $sql;
			echo "<br>";
			$this->echo_sql_status = false;
		}
		$charset = "set names utf8";
		mysqli_query($con, $charset);

		$restult = mysqli_query($con, $sql);
		if ($restult == false) {
			throw new \Exception($sql . ":" . mysqli_error($con), 1);
		}
		return $restult;
	}
	/**
	 * [start 开始事务]
	 * @return [type] [description]
	 */
	public function start() {
		if ($this->master_con == null) {
			$this->_connect_db(true);
		}
		mysqli_begin_transaction($this->master_con);
	}
	/**
	 * [commit 提交事务]
	 * @return [type] [description]
	 */
	public function commit() {
		if ($this->master_con == null) {
			$this->_connect_db(true);
		}
		mysqli_commit($this->master_con);
	}
	/**
	 * [ranback 回滚事务]
	 * @return [type] [description]
	 */
	public function ranback() {
		if ($this->master_con == null) {
			$this->_connect_db(true);
		}
		mysqli_query($this->master_con, "ROLLBACK");
	}

	public function one() {
		$this->_sql .= " limit 0,1";
		$restult = $this->query($this->_sql);
		return mysqli_fetch_assoc($restult);
	}
	public function all(string $index_field = "") {
		$restult = $this->query($this->_sql);
		$arr_info = [];
		if (empty($index_field)) {
			while ($row = mysqli_fetch_assoc($restult)) {
				$arr_info[] = $row;
			}
		} else {
			while ($row = mysqli_fetch_assoc($restult)) {
				$key = $row[$index_field];
				$arr_info[$key] = $row;
			}
		}
		return $arr_info;
	}
	public function exist() {
		$restult = $this->query($this->_sql);
		if ($restult->num_rows > 0) {
			return true;
		}
		return false;
	}
	public function count() {
		$restult = $this->query($this->_sql);
		return $restult->num_rows;
	}
	public function to_json(string $index_field = "") {
		$restult = $this->query($this->_sql);
		$arr_info = [];
		if (empty($index_field)) {
			while ($row = mysqli_fetch_assoc($restult)) {
				$arr_info[] = $row;
			}
		} else {
			while ($row = mysqli_fetch_assoc($restult)) {
				$key = $row[$index_field];
				unset($row[$index_field]);
				$arr_info[$key] = $row;
			}
		}
		return json_encode($arr_info);
	}
}
