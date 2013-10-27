<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php'; 

if (empty($_POST) === false) {
	$required_fields = array('username','password','password_again','snumber','email');
	foreach($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'Fields marked with an asterisk are required.';
			break 1;
		}
	}

	if (empty($errors) === true) {
		//Username
		if (user_exists($_POST['username'], 'username') === true) {
			$errors[] = 'Sorry, the username \'' . htmlentities($_POST['username']) . '\' is already taken.';
		}
		if (preg_match("/\\s/", $_POST['username']) == true) {
			$errors[] = 'Your username must not contain any spaces.';
		}
		if(strlen($_POST['username']) < 5 ) {
			$errors[] = 'Your username must be at least 5 characters.';
		} else if (strlen($_POST['username']) > 16) {
			$errors[] = 'Your username can not be longer than 16 characters.';
		}
		if (preg_match('/[^A-Za-z0-9]/', $_POST['username'])) // '/[^a-z\d]/i' should also work.
		{
			$errors[] = 'Your username can only consist out of numbers 0-9 and letters A-Z.';
		}


		//S-number
		if (snumber_exists($_POST['snumber']) === true) {
			$errors[] = 'Sorry, the snumber \'' . htmlentities($_POST['snumber']) . '\' is already taken.';
		}
		if (snumber_valid($_POST['snumber']) === false) {
			$errors[] = 'Please fill in a valid s-number.';
		}

		//password
		if(strlen($_POST['password']) < 6 ) {
			$errors[] = 'Your password must be at least 6 characters.';
		} else if (strlen($_POST['password']) > 30) {
			$errors[] = 'Your password can not be longer than 30 characters.';
		}
		if ($_POST['password'] !== $_POST['password_again']) {
			$errors[] = 'Your passwords do not match.';
		}

		//email address
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'Please fill in a valid email address.';
		}
		if(email_exists($_POST['email']) === true) {
			$errors[] = 'Sorry, the email \'' . htmlentities($_POST['email']) . '\' is already taken.';
		}
	}
}
?> 

<h1>Register</h1>

<?php
if (isset($_GET['success']) && empty($_GET['success'])){
	echo 'You\'ve been registered. <br>Please check your email address to confirm the final stage of the registration process.<p>';
	echo '<h1>Notes - email function is not working on local address!! </h1> <br>
	Therefore instead of sending a mail, here is the body of the email you would normally receive<br><hr>';

	$temp_id = $_GET['id'];
	$data = user_data($temp_id, 'first_name', 'email', 'email_code');

	$string_mail = 'Hello %s,<br><br>';
	$string_mail .= 'You need to activate your account, so please click the link below:<br>';
	$string_mail .= '<a href="/activate.php?email=%s&email_code=%s">';
	$string_mail .= 'http://www.dg239.thijstervelde.com/activate.php?email=%s&email_code=%s</a><br><br>';
	$string_mail .= '-Thijs';
	echo sprintf($string_mail, $data['first_name'], $data['email'], $data['email_code'], $data['email'], $data['email_code']);

} else {
	if (empty($_POST) === false && empty($errors) === true) {
		$register_data = array(
			'username' 		=> $_POST['username'],
			'password' 		=> $_POST['password'],
			'first_name' 	=> $_POST['first_name'],
			'last_name' 	=> $_POST['last_name'],
			'snumber'		=> $_POST['snumber'],
			'email' 		=> $_POST['email'],
			'email_code'	=> md5($_POST['username'] + microtime()),
			'ipaddress'		=> $_SERVER["REMOTE_ADDR"]
		);
		//TEMPORARY DETOUR, sorry for the inconvience
		//register_user($register_data);
		$temp_username = temp_register_user($register_data);
		$temp_id = userID_from_data($temp_username,'username');
		//TEMPORARY DETOUR OVER
		header('Location: register.php?success&id='.$temp_id);
	} else if (empty($errors) === false){
		echo output_errors($errors);
	}
	?>
	<br>
	<form action="" method="post">
		<ul>
			<li>
				Username*:<br>
				<input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" autofocus>
			</li>
			<li>
				S-number*:<br>
				<input type="text" name="snumber" placeholder="e.g. s012345" value="<?php echo isset($_POST['snumber']) ? $_POST['snumber'] : ''; ?>">
			</li>
			<li>
				Password*:<br>
				<input type="password" name="password">
			</li>
			<li>
				Password again*:<br>
				<input type="password" name="password_again">
			</li>
			<li>
				First name:<br>
				<input type="text" name="first_name" x-webkit-speech value="<?php  echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>">
			</li>
			<li>
				Last name:<br>
				<input type="text" name="last_name" x-webkit-speech value="<?php  echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>">
			</li>

			<li>
				Email*:<br>
				<input type="text" name="email" value="<?php  echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
			</li>
			<li>
				<input type="submit" name="Register">
			</li>
		</ul>
	</form>
<?php 

}

include 'includes/overall/footer.php'; ?> 
