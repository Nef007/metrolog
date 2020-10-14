<?php
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$mysqli->set_charset("utf8");
	
	function addOrder($data) {
		return addRow("device", $data);
	}
	
	
	function isAdmin($login = false, $password = false) {
		if (!$login) $login = isset($_SESSION["login"])? $_SESSION["login"] : false;
		if (!$password) $password = isset($_SESSION["password"])? $_SESSION["password"] : false;
		return mb_strtolower($login) === mb_strtolower(ADM_LOGIN) && $password === ADM_PASSWORD;
	}
	
	function login($login, $password) {
		$password = hashSecret($password);
		if (isAdmin($login, $password)) {
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			return true;
		}
		return false;
	}
	
	function logout() {
		unset($_SESSION["login"]);
		unset($_SESSION["password"]);
	}
	
	function getOrder($id) {
		if (!is_numeric($id)) exit;
		global $mysqli;
		$query = "SELECT * FROM `device` WHERE `id` = '".$mysqli->real_escape_string($id)."'";
		return getRow($query);
	}
	
	function setOrder($id, $data) {
		return setRow("device", $id, $data);
	}
	
	function deleteOrder($id) {
		return deleteRow("device", $id);
	}
	
	function getCampID($data) {
		global $mysqli;
		$query = "SELECT * FROM `lan_camps` WHERE ";
		foreach ($data as $key => $value) {
			if ($value == null) $query .= "`$key` IS NULL AND ";
			else $query .= "`$key` = '".$mysqli->real_escape_string($value)."' AND ";
		}
		$query = substr($query, 0, -5);
		return getCell($query);
	}
	
	function getCountOrders($data_st = false) {
		return getDataForOrders($data_st);
	}
	
	function getCountConfirmOrders($data_st = false) {
		return getDataForOrders($data_st, true, "date_confirm");
	}
	
	function getCountPayOrders($data_st = false) {
		return getDataForOrders($data_st, true, "date_pay");
	}
	
	function getCountCancelOrders($data_st = false) {
		return getDataForOrders($data_st, true, "date_cancel");
	}
	
	function getSummaOrders($data_st = false) {
		return getDataForOrders($data_st, false);
	}
	
	function getSummaConfirmOrders($data_st = false) {
		return getDataForOrders($data_st, false, "date_confirm");
	}
	
	function getSummaPayOrders($data_st = false) {
		return getDataForOrders($data_st, false, "date_pay");
	}
	
	function getSummaCancelOrders($data_st = false) {
		return getDataForOrders($data_st, false, "date_cancel");
	}
	
	function getDataForOrders($data_st, $count = true, $field = false) {
		if ($count) $count = "COUNT(`id`)";
		else $count = "SUM(`price`)";
		$query = "SELECT $count FROM `device`";
		$where = getWhereForOrders($data_st);
		if ($field) {
			$temp = "`$field` IS NOT NULL";
			if ($where) $where .= " AND $temp";
			else $where = $temp;
		}
		if ($where) $query .= " WHERE $where";
		$result = getCell($query);
		if (!$result) return 0;
		return $result;
	}
	
	function getOrders() {

		/*$query = "SELECT * FROM `device`  ORDER BY `date_order` DESC";*/

		$query = "SELECT DISTINCT `id`,`dist_id`, `fif`, `dev_name`,`dev_marka`,`dev_zav_number`, `tex_o`, `prikaz`, `dev_data_pred_poverki`, `dev_data_release`,`dev_data_poverki` FROM `device`, `users` WHERE users.distr_id=device.dist_id";
		$result = getTable($query);
		if (!$result) return array();
		return $result;
	}

	function getDistusers() {

		/*$query = "SELECT * FROM `device`  ORDER BY `date_order` DESC";*/

		$query = "SELECT DISTINCT `distr_id`,`distr` FROM `users`";
		$result = getTable($query);
		if (!$result) return array();
		return $result;
	}


	function getusers() {

		/*$query = "SELECT * FROM `device`  ORDER BY `date_order` DESC";*/

		$query = "SELECT `distr`,`first_name`,`last_name`,`patronymic`,`login` FROM `users` ";
		$result = getTable($query);
		if (!$result) return array();
		return $result;
	}
	
	
	
	function getCell($query) {
		global $mysqli;
		$result_set = $mysqli->query($query);
		if (is_null($result_set) || !$result_set->num_rows) return false;
		$arr = array_values($result_set->fetch_assoc());
		$result_set->close();
		return $arr[0];
	}
	
	function getRow($query) {
		global $mysqli;
		$result_set = $mysqli->query($query);
		if (is_null($result_set)) return false;
		$row = $result_set->fetch_assoc();
		$result_set->close();
		return $row;
	}
	
	function getCol($query) {
		global $mysqli;
		$result_set = $mysqli->query($query);
		if (is_null($result_set)) return false;
		$row = $result_set->fetch_assoc();
		$result_set->close();
		if ($row) return array_values($row);
		return false;
	}
	
	function getTable($query) {
		global $mysqli;
		$result_set = $mysqli->query($query);
		if (is_null($result_set)) return false;
		$result = array();
		while (($row = $result_set->fetch_assoc()) != false) {
			$result[] = $row;
		}
		$result_set->close();
		return $result;
	}
	
	function addRow($table, $data) {
		global $mysqli;
		$query = "INSERT INTO `$table` (";
		foreach ($data as $key => $value) $query .= "`$key`,";
		$query = substr($query, 0, -1);
		$query .= ") VALUES (";
		foreach ($data as $value) {
			if (is_null($value)) $query .= "null,";
			else $query .= "'".$mysqli->real_escape_string($value)."',";
		}
		$query = substr($query, 0, -1);
		$query .= ")";
		$result_set = $mysqli->query($query);
		if (!$result_set) return false;
		return $mysqli->insert_id;
	}
	
	function setRow($table, $id, $data) {
		if (!is_numeric($id)) exit;
		global $mysqli;
		$query = "UPDATE `$table` SET ";
		foreach ($data as $key => $value) {
			$query .= "`$key` = ";
			if (is_null($value)) $query .= "null,";
			else $query .= "'".$mysqli->real_escape_string($value)."',";
		}
		$query = substr($query, 0, -1);
		$query .= " WHERE `id` = '$id'";
		return $mysqli->query($query);
	}
	
	function deleteRow($table, $id) {
		if (!is_numeric($id)) exit;
		global $mysqli;
		$query = "DELETE FROM `$table` WHERE `id`='$id'";
		
		return $mysqli->query($query);
	}
	
	function xss($data) {
		if (is_array($data)) {
			$escaped = array();
			foreach ($data as $key => $value) {
				$escaped[$key] = xss($value);
			}
			return $escaped;
		}
		return trim(htmlspecialchars($data));
	}
	
	function redirect($link) {
		header("Location: $link");
		exit;
	}
	
	function hashSecret($str) {
		return $str;
	}
	
?>