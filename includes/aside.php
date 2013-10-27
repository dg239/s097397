<aside>
	<?php 
	if (logged_in() === true)
	{
		include 'includes/widgets/loggedin.php'; 
	}
	else 
	{
//asa
		include 'includes/widgets/login.php'; 
	}
	include 'includes/widgets/user_count.php';
	?>
</aside>
