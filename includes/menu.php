<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			// --
			<?php if(logged_in() === true){
			echo '<li><a href="u/' . $user_data['snumber'] . '">My Homepage</a></li>';
			echo '<li><a href="/revisions.php">Revisions</a></li>';
			//Does not work
			echo '<li><a href="/phpmyadmin/index.php?old_usr='.$user_data['username'].'">Phpmyadmin</a></li>';
			echo '<li><a href="/tutorials.php">Tutorials</a></li>';
			} ?>

			<?php if(logged_in() === false){
			echo '<li><a href="/register.php">Register</a></li>';
			} ?>

			<li><a href="contact.php">Contact us</a></li>
		</ul>
</nav>
	