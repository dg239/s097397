<?php
	ob_start();
	include 'core/init.php';
	session_start();

	session_destroy();
	header('Location: index.php');
	ob_end_flush();
?>
