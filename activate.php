<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php'; 

if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
	echo '<h2> Thanks! </h2> <br> We activated your account. Feel free to log in now.';
	
} else if (isset($_GET['email'], $_GET['email_code']) === true){
	$email = trim($_GET['email']);
	$email_code = trim($_GET['email_code']);

	if (email_exists($email) === false){
		$errors[] = 'Oops, something went wrong, we couldn\'t find that email address!';
	} else if (verify_email_code($email, $email_code) === false) {
		$errors[] = 'We had problems activation your account, please contant mail@thijstervelde.com in order to fix the problem';
	}

	if (empty($errors) === false) {
		echo '<h2> Oops...</h2>' . output_errors($errors);
	} else {
		header('Location: activate.php?success');
		exit();
	}
} else {
	header('Location: index.php');
	exit();
}

include 'includes/overall/footer.php'; 
?> 
