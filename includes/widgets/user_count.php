<div class="widget">
	<h2>Users</h2>
	<div class ="inner">
		<?php $suffix = ($user_count = user_count() != 1) ? 's' : ''; ?>
		We currently have <?php echo user_count(); ?> registered user<?php echo $suffix ?>.<p>
		<?php $suffix = ($user_count = current_user_count() != 1) ? 's' : ''; ?>
		In the last 24 hours <?php echo current_user_count(); ?> user<?php echo $suffix ?> have logged in to the site.
	</div>
</div>
