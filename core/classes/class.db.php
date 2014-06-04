<?php
	/******************************************
	Class for interacting with DB
	******************************************/

	class db {
	    var $connection = false;
	    var $result = false;
		var $db_user;
		var $db_pass;
		var $db_name;
		
		function db($db_server='localhost',$db_user='',$db_pass='',$db_name='') {
			$this->db_server = $db_server;
			$this->db_user = $db_user;
			$this->db_pass = $db_pass;
			$this->db_name = $db_name;
		}

		function connect() {
		
			if (is_resource($this->connection)) {
				return true;
			}
	
			if (!$this->connection = mysql_connect($this->db_server, $this->db_user, $this->db_pass, false, 2)) {
				trigger_error(get_class($this)
				.'::connect() Could not connect to server: '
				.mysql_error(), E_USER_ERROR);
				return false;
			}
			else {
				if (!mysql_select_db($this->db_name, $this->connection)) {
					trigger_error(get_class($this)
					.'::connect() Could not connect to specified database on server: '
					.mysql_error(), E_USER_ERROR);
					return false;
				}
				else {
					return true;
				}
			}
		}
		
		function es($query) {
			if (!$this->connection) $this->connect();
			return mysql_real_escape_string($query,$this->connection);	
		}
		
		// Executes the supplied SQL statement and returns the result of the call.
		// @return	mixed   
		// @param	string	SQL to execute
		function execute($query) {
		
			if (!$this->connection) {
				$this->connect();
			}
		
			if (!$this->result = mysql_query($query, $this->connection)) {
				trigger_error(get_class($this)."::execute() Could not execute: "
				.mysql_error()." (SQL: ".$query.")", E_USER_ERROR);
				return false;
			}
			else {
				return true;
			}
		}
		
		// Reads into an array the current record in the result.
		// @return	mixed
		// @param   string  (optional) SQL to execute 
		function &get_row() {
			if (func_num_args() == 1) {
				$this->execute(func_get_arg(0));
			}

			if (!$this->result) {
				return false;
			}
			else {
				return mysql_fetch_assoc($this->result);
			}
		}
		
		// Returns an array of records from the 
		// Returns empty array if no retrieval
		// @return  mixed   
		// @param   string  (optional) SQL to execute 
		function &get_all_rows() {
			if (func_num_args() == 1) {
				$this->execute(func_get_arg(0));
			}

			$return = array();
			if (!is_resource($this->result)) {
				trigger_error(get_class($this)."::get_all_rows() : "
				.mysql_error(), E_USER_ERROR);
				return $return;
			}
			else {
				mysql_data_seek($this->result, 0);
				while ($each_row = mysql_fetch_assoc($this->result)) {
					$return[] = $each_row;
				}
				return $return;
			}
		}
		
		// Returns first data point from current result resource or null if no retrieval
		// @return  mixed   
		// @param   string  (optional) SQL to execute 
		function get_cell($row = 0, $field = 0, $query = null) {
			if ($query) {
				$this->execute($query);
			}
		
			if (!$this->result) {
				return null;
			}
			else {
				if ($cell = @mysql_result($this->result, $row, $field)){
					return $cell;
				}
				else {
					return null;
				}
			}
		}

		// Returns last inserted auto-id
		// @return  mixed   
		function insert_id() {
			return mysql_insert_id($this->connection);
		}

		// Returns number of rows in result set
		// @return  int   
		function num_rows() {
			return mysql_num_rows($this->result);
		}

		// Returns number of rows affected by DML statement
		// @return  int   
		function affected_rows() {
			return mysql_affected_rows($this->connection);
		}

		// returns date formatted for insert/update
		function format_date($value) {
			if (empty($value)){
				return '0000-00-00';
			}
			else {
				return "'".date('Y-m-d', strtotime($value))."'";
			}
		}
		
		function local_ip($ip) {
			$masks = array(array('255.0.0.0','127.0.0.0'),array('255.0.0.0','10.0.0.0'),array('255.255.0.0','192.168.0.0'));
			$ip = ip2long($ip);
			foreach ($masks as $mask) if (!(ip2long($mask[0]) & ($ip ^ ip2long($mask[1])))) return true;
			return false;
		}
		
		
		
	}
?>
