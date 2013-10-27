<aside>
	<?php 
	if (logged_in() === true)
	{
		include 'includes/widgets/loggedin.php'; 
	}
	else 
	{
//asasss
		include 'includes/widgets/login.php'; 
	}
	include 'includes/widgets/user_count.php';
	?>
</aside>
