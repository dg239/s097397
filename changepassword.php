<?php 
include 'core/init.php';
protect_page();

if (empty($_POST) === false) {
	$required_fields = array('current_password','password','password_again');
	foreach($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'Fields marked with an asterisk are required.';
			break 1;
		}
	}
	if($user_data['password'] === md5($_POST['current_password'])) {
		if (trim($_POST['password']) === trim($_POST['password_again'])) {
			if (strlen($_POST['password']) < 6) {
				$errors[] = 'Your new password needs to be at least 6 characters long.';
			} else if (strlen($_POST['password']) > 30) {
				$errors[] = 'Your new password needs to be shorter then 30 characters.';
			} else if (trim($_POST['password']) === trim($_POST['current_password'])) {
				$errors[] = 'Your new password is the same as your old one.';
			}
		} else {
			$errors[] = 'Your new password does not match in both fields.';
		}
	} else {
		$errors[] = 'Your current password is incorrect.';
	}
	print_r($errors);
}
include 'includes/overall/header.php'; 
?> 
      <h1>Change password</h1>

<?php
if (empty($_POST) === false && empty($errors) === true) {
	change_password($session_userID, $_POST['password']);
	header('Location: changepassword.php?success');
} else if(empty($errors) === false) {
	echo output_errors($errors);
}

if (isset($_GET['success']) && empty($_GET['success'])){
	echo 'You\'ve changed your password successfully';
} else {
?>

<form action="" method="post">
	<ul>
		<li>
			Current password*:<br>
			<input type="password" name="current_password">
		</li>
		<li>
			New password*:<br>
			<input type="password" name="password">
		</li>
				<li>
			New password again*:<br>
		<input type="password" name="password_again">
		</li>
		<li>
			<input type="submit" value="Change password">
		</li>
	</ul>
</form>
<?php 
}
include 'includes/overall/footer.php'; 
?> 
