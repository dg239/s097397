<?php
include($_SERVER['DOCUMENT_ROOT']."/core/init.php");

set_time_limit(600);
$path = 'C:/wamp/www/u/';
$folders = array();
$folders = recursive_subfolders($folders, $path);
foreach ($folders as $subfolder) {
//	echo $subfolder;
	$files_data = listFolderFiles($subfolder, false, false);
	
	//Filter standard nonsense files
	$bad = array('.'=> 0, '..'=> 0, '.DS_Store'=> 0, 
		'_notes'=> 0, 'Thumbs.db'=> 0, '.gitignore'=>0,
		'.git'=>0, '.gitattributes'=>0, 'db_connect.php'=>0, 
		'db_close.php'=>0 );
	
	$files_data = array_diff_key($files_data, $bad);	
	database_file_control($files_data, $subfolder);
}

set_time_limit(30);
?>