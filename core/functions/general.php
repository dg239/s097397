<?php
function log_file_error($status_code, $snumber, $filename, $subfolder){
	$query = "INSERT INTO files_log(status_code, snumber, filename, subfolder) 
					VALUES (%s,'%s','%s','%s')";
		$query = sprintf($query, $status_code, $snumber, $filename, $subfolder);
		mysql_query($query) or die ("Error: " . mysql_error());

	return;
}

function dump($array){
	return '<pre>' . var_dump($array, true) . '</pre><hr>';
}

function admin_protect() {
	global $user_data;
	if(has_access($user_data['userID'], 2) === false) {
		header('Location: index.php');
		exit();
	}
}

function protect_page() {
	if (logged_in() === false){
			header('Location: protected.php');
	}
}

function logged_in_redirect() {
	if (logged_in() === true){
			header('Location: index.php');
	}
}

function array_sanitize(&$item){
	$item = mysql_real_escape_string($item);
}

function sanitize($data){
	return mysql_real_escape_string($data);
}

function output_errors($errors){
	return '<p class="error"><ul><li>' . implode('<li></li>',$errors) . '</li></ul></p>';
}
	
function hr(){
	//lazy programmer = lazy
	echo'<hr>';
	return;
}

function h1($text){
	//lazy programmer = lazy
	echo'<h1>'.$text.'</h1>';
	return;
}


?>