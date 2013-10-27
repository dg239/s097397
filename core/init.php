<?php
session_start();
ob_start();
//error_reporting(0);
require $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';


//Requests librabry + authentication
require $_SERVER['DOCUMENT_ROOT'].'/core/libs/Requests/Requests.php';
Requests::register_autoloader();

//Functions
require $_SERVER['DOCUMENT_ROOT'].'/core/functions/user.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/functions/general.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/functions/activation.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/functions/github.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/functions/filehandling.php';

//Libraries
require $_SERVER['DOCUMENT_ROOT'].'/core/libs/slim/slim.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/libs/kint-master/Kint.class.php';



if (logged_in()===true){
	$session_userID = $_SESSION['userID'];
	//user_data on current logged in user
	$user_data = user_data($session_userID, 'userID', 'username', 'password', 'first_name', 'last_name', 'email', 'snumber', 'type');
	if(user_active($user_data['username']) === false) {
		session_destroy();
		header('Location: index.php');
		exit();
	}
	else {
		mysql_query("UPDATE users SET TimeLastSeen = NOW() WHERE userID = $session_userID");
	}
}
if (empty($session_userID) === false) {
	
}
$errors = array();
?>