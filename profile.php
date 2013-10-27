<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 

if (isset($_GET['snumber']) === true && empty($_GET['snumber']) === false) {
	$snumber 	= $_GET['snumber'];
	$userID 	= userID_from_data($snumber,'snumber');
	if (user_exists($userID, 'userID')) {
		$profile_data	= user_data($userID, 'first_name', 'last_name', 'email', 'snumber', 'regdate', 'timelastseen');
	?>

		<!-- Needs cleaning up, horrible.. -->
		<?php echo '<h1>' . $profile_data['first_name']; ?>'s profile</h1>
		<?php echo '<b>Name:</b><br>' . $profile_data['first_name'] . ' ' . $profile_data['last_name'] ?><br>
		<?php echo '<b>Snumber:</b><br>' .$profile_data['snumber']; ?><br>
		<?php echo '<b>Email:</b><br>' .$profile_data['email']; ?><br>
		<?php echo '<b>Date of registration:</b><br>' .$profile_data['regdate']; ?><br>
		<?php echo '<b>Time last seen:</b><br>' .$profile_data['timelastseen']; ?><br>

		<?php
		if (logged_in()){
			if($session_userID === $userID){
			// WORK IN PROGRESS
			echo 'Current login information';
			// WORK IN PROGRES
			}
		} 
		?>

	<?php
	} else {
		header('Location: 404.php');
	}
} else {
	header('Location: index.php');
}
include 'includes/overall/footer.php'; ?> 
