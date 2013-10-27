<?php
include 'core/init.php';
logged_in_redirect();

if (empty($_POST) === false)
{
	$username = $_POST['username'];
	$password = $_POST['password'];
// Showing errors.
	$userID = userID_from_data($username, 'username');
	if (user_locked($_SERVER["REMOTE_ADDR"]) === true){
		$errors[] = 'You have tried logging in too many times in the last 5 minutes. You can attempt to login again after 5 minutes.';
		sleep(1);
	} else if (empty($username) === true || empty($password) === true) {
		$errors[] = 'You need to enter a username and password.';
	} else if (user_exists($username, 'username') === false) {
		$errors[] = 'We can\'t find that username. Have your registered?';
		log_login($username, 0);
	} else if (user_active($username) === false) {
		$errors[] = 'You haven\'t activated your account! Please check your email';
	}else if (strlen($password)> 32) {
			$errors[] = 'Password too long';
	} else {
		//Login process
		$login = login($username, $password);
		
		if ($login === false){
			//Not matching passwords
			$errors[] = 'That username/password combination is incorrect';
			log_login($username, 0);
		} else {
			//Successful
			$_SESSION['userID'] = $login;
			log_login($username, 1);
			unset($_POST);
			header('Location: index.php');
			exit();
		}
	}
} else {
	$errors[] = 'No data received. Are you doing something cheeky?';
}
include 'includes/overall/header.php';
if(empty($errors) === false){
?>
	<h2>We tried to log you in, but...</h2>
<?php
	echo output_errors($errors);
	if (user_locked($_SERVER["REMOTE_ADDR"]) === true) {
		//Something
	} else {
		$count = failed_login_count($_SERVER["REMOTE_ADDR"]);
		$count = 5 - $count;
		if ($count < 6 && $count > 0){
			$suffix = ($count != 1) ? 's' : '';
			echo 'You have ' . $count . ' time' . $suffix . ' to try to log in.';
		} else if ($count === 0){
			echo 'You have tried to login too many times. You will be locked for a period of 5 minutes.';
			lockout_user($_SERVER["REMOTE_ADDR"]);
		}
	}
}
include 'includes/overall/footer.php';
?>
