<?php
function has_access($userID, $type) {
		$userID         = (int)$userID;
		$type           = (int)$type;
		$query = "SELECT COUNT(userID) 
			FROM users 
			WHERE userID = $userID 
			AND type = 1";

		return (mysql_result(mysql_query($query), 0) == 1) ? true : false;
}

function verify_email_code($email, $email_code){
		$email = sanitize($email);
		$email_code = sanitize($email_code);
		$query = "SELECT COUNT(userID) 
			FROM users 
			WHERE email = '$email' 
			AND email_code = '$email_code' 
			AND active = 0";
		if (mysql_result(mysql_query($query), 0) == 1) {
			$query = "SELECT userID FROM users WHERE email = '$email'";
				$userID = mysql_result(mysql_query($query), 0);
				if (create_user_access($userID) === true) {
					return true;
				}
		} else {
			return false;
		}
}

function email($to, $subject, $body) {
		$headers = 'From: Thijs ter Velde <mail@thijstervelde.com>' . "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail($to, $subject, $body, $headers);
}

function change_password($userID, $password){
		$userID = (int)$userID;
		$password_data = user_data($userID, 'username');
		mysql_query("SET PASSWORD FOR '" . $password_data['username'] . "'@'localhost' = PASSWORD('$password')") or die ("Error: " . mysql_error());
		$password = md5($password);
		mysql_query("UPDATE users 
			SET password = '$password' 
			WHERE userID = $userID") or die ("Error: " . mysql_error());
}

//TEMPORARY DETOUR, sorry for the inconvience
// function register_user($register_data){
// 		array_walk($register_data, 'array_sanitize');
// 		$register_data['password'] = md5($register_data['password']);     
// 		$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
// 		$data = '\'' . implode('\', \'', $register_data) . '\'';
// 		mysql_query("INSERT INTO users($fields) VALUES ($data)");
// 		register_user_mysql($register_data);
// 		register_user_ftp($register_data);
// 		register_user_grant($register_data);
	
// 		email($register_data['email'], 'Active your account', sprintf('Hello %s,<br><br>You need to activate your account, so please click the link below:<br><a href="http://www.dg239.thijstervelde.com/activate.php?email=%s&email_code=%s">http://www.dg239.thijstervelde.com/activate.php?email=%s&email_code=%s</a><br><br>-Thijs', $register_data['first_name'], $register_data['email'], $register_data['email_code'], $register_data['email'], $register_data['email_code']));
// }

function temp_register_user($register_data){
	array_walk($register_data, 'array_sanitize');
	mysql_query("INSERT INTO temp_reg(snumber, unhashed_password) 
		VALUES ('".$register_data['snumber']."', '".$register_data['password']."')");
	$register_data['password'] = md5($register_data['password']);
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	mysql_query("INSERT INTO users($fields) VALUES ($data)");

	return $register_data['username'];
}
//TEMPORARY DETOUR OVER

function user_data($userID){
	$data = array();
	//prevent sql injection by forcing integer
	$userID = (int)$userID;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	if($func_num_args > 1){
			unset($func_get_args[0]);
			$fields = '`' . implode('`, `', $func_get_args) . '`';
			$data = mysql_fetch_assoc(mysql_query("SELECT $fields 
				FROM `users` 
				WHERE userID = $userID"));

			return $data;
	}
}

function login($username, $password) {
	$userID = userID_from_data($username, 'username');
	$username = sanitize($username);
	$password = md5($password);
	$query = mysql_query("SELECT COUNT(userID) 
		FROM users 
		WHERE username = '$username' 
		AND password = '$password'");

	if (mysql_result(($query), 0) == 1){
		return $userID;
	} else {
		log_login($username, 0);
		return false;	
		
	}
}

function log_login($username, $success){
	mysql_query("INSERT INTO users_login(username, ipaddress, success) 
		VALUES ('".$username."', '".$_SERVER["REMOTE_ADDR"]."', ".$success.")") 
		or die ("Error: " . mysql_error());
	return;
}

function failed_login_count($ipaddress){
	$query = "SELECT COUNT(ipaddress) 
		FROM users_login 
		WHERE ipaddress = '$ipaddress' 
		AND login_timestamp > DATE_SUB(NOW(), INTERVAL 5 MINUTE)";

	$count = intval(mysql_result(mysql_query($query),0));
	return $count;
}

function user_locked($ipaddress){
	$query = mysql_query("SELECT COUNT(entry) 
		FROM users_login 
		WHERE ipaddress = '$ipaddress'
		AND login_timestamp > DATE_SUB(NOW(), INTERVAL 5 MINUTE)
		AND locked = 1");

	return (mysql_result($query, 0) == 1) ? true : false;
}

function lockout_user($ipaddress){
	$query = "INSERT INTO users_login(ipaddress, success, locked) 
		VALUES ('$ipaddress', 1, 1)";
	mysql_query($query);
	return true;
}

function logged_in()
{
		return(isset($_SESSION['userID'])) ? true : false;
}

function user_exists($data, $type) {
		$data = sanitize($data);
		$query = mysql_query("SELECT COUNT(userID) 
			FROM users 
			WHERE $type = '$data'");

		return (mysql_result($query, 0) == 1) ? true : false;
}

function snumber_exists($snumber) {
		$snumber = sanitize($snumber);
		$query = mysql_query("SELECT COUNT(userID) 
			FROM users 
			WHERE snumber = '$snumber'");

		return (mysql_result($query, 0) == 1) ? true : false;
}

function snumber_valid($snumber) {
	if(strlen($snumber) === 7 || strlen($snumber) === 8 ){
		return (
			substr($snumber,0,1) == 's' &&
			ctype_digit(substr($snumber, 1))
		) ? true : false;
	} else { 
		return false; 
	}
}

function email_exists($email) {
		$email = sanitize($email);
		$query = mysql_query("SELECT COUNT(userID) 
			FROM users 
			WHERE email = '$email'");

		return (mysql_result($query, 0) == 1) ? true : false;
}

function user_active($username) {
		$username = sanitize($username);
		$query = mysql_query("SELECT COUNT(userID) 
			FROM users 
			WHERE username = '$username' 
			AND active = 1");

		return (mysql_result($query, 0) == 1) ? true : false;
}

function activate_user($username) {
		$query = mysql_query("UPDATE users
			SET active=1
			WHERE username = '$username'
			AND active = 0");

		return;
}

function userID_from_data($data, $type) {
		$data = sanitize($data);
		$query = mysql_query("SELECT userID 
			FROM users 
			WHERE $type = '$data'");

		if (mysql_num_rows($query) > 0) {
				return (mysql_result(($query), 0, 'userID'));
		}
}

function user_count() {
		$query = mysql_query("SELECT COUNT(userID) 
			FROM users 
			WHERE active = 1");

		return mysql_result($query, 0);
}

function current_user_count(){
		$query = mysql_query("SELECT COUNT(*) 
			FROM users 
			WHERE TimeLastSeen > DATE_SUB( NOW() , INTERVAL 24 HOUR )");

		return mysql_result($query, 0);
}


