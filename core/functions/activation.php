<?php
function create_user_access($userID){
	$reg_data = user_data($userID, 'snumber', 'username', 'first_name', 'last_name');
//	print_r($reg_data);
	$query = "SELECT unhashed_password FROM temp_reg WHERE snumber = '".$reg_data['snumber']."'";
	$reg_data['unhashed_password'] = mysql_result(mysql_query($query),0);

	create_database($reg_data['snumber']);
	create_user_mysql($reg_data['username'], $reg_data['unhashed_password']);
	grant_user_database($reg_data['snumber'], $reg_data['username']);
	create_db_files($reg_data['snumber'], $reg_data['username'], $reg_data['unhashed_password']);
	user_ftp($reg_data['username'], $reg_data['unhashed_password']);
	create_repo($reg_data['snumber'], $reg_data['first_name'], $reg_data['last_name']);
	activate_user($reg_data['username']);

	$query = "DELETE FROM temp_reg WHERE snumber ='".$reg_data['snumber']."'";
	mysql_query($query);

	return true;
}

//Repetitive, however needed if having to expand/alter at later date.
function create_database($snumber) {
	$query = "CREATE DATABASE ".$snumber."";
	if (mysql_query($query) === true) {
		return true;
	} else {
		//Outputting of errors later
		return false;
	}
}

function create_user_mysql($username, $unhashed_password) {
	$query = "CREATE USER '".$username."'@'localhost' IDENTIFIED BY '".$unhashed_password."' ";
	if (mysql_query($query) === true) {
		return true;
	} else {
		//Outputting of errors later
		return false;
	}
}

function grant_user_database($snumber, $username) {
	$query = "GRANT ALL PRIVILEGES ON ".$snumber.".* TO '".$username."'@'localhost'";
	if (mysql_query($query) === true) {
		return true;
	} else {
		//Outputting of errors later
		return false;
	}
}

function create_db_files($snumber, $username, $unhashed_password) {
	//Create direction for user and user FTP
	$dir = 'u/' . $snumber;
	$oldumask = umask(0);
	if (!file_exists ( $dir )) {
		mkdir($dir,0777,true);
		umask($oldumask);
	}
	//Need code to remove indentation and make this look better. Messy.
	$content1 = 
"<?php 
\$db = mysqli_connect('localhost', '".$username."', '".$unhashed_password."', '".$snumber."'); 
if(mysqli_connect_errno()){ 
	echo 'MySQL error: '; 
	echo mysqli_connect_error();
}?>";

	$content2 = 
"<?php
mysqli_close(\$db);
?>";
	file_put_contents($dir . '/db_connect.php', $content1);
	file_put_contents($dir . '/db_close.php', $content2);
	return true;
}

function user_ftp($username, $unhashed_password) {
	define("FTP_CONF_FILE",'C:/wamp/ftp/FileZilla Server.xml');
	define("FTP_EXE_FILE","C:\\wamp\\ftp\\FileZilla server.exe");

	$ftpExecutable = '"'.FTP_EXE_FILE.'" /reload-config';
	$command = $ftpExecutable;
	system($command, $retval);
}

