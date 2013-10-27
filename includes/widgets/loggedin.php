<div class="widget">
<a href="/<?php echo $user_data['snumber'] ?>">
<img src="http://www.gravatar.com/avatar/<?php echo md5($user_data['email']); ?>?s=120&r=x">
</a>
	<h2>Hello, <?php echo $user_data['first_name'] ?>!</h2>
	<div class ="inner">
		<ul>
			<li>
				<a href="logout.php">Logout</a>
			</li>
			<li>
				<a href="changepassword.php">Change password<a>
			</li>
		</ul>
		
			Rest of the links.
	</div>
</div>
