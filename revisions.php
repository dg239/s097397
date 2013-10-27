<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php'; 

$path = 'C:/wamp/www/u/'.$user_data['snumber'].'/';

?>


	<h1>Revisions</h1>
	<p>Click on a file to see all previous versions.</p>

<?php 
listFolderFiles($path, true, true);
include 'includes/overall/footer.php'; ?> 
