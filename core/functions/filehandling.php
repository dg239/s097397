<?php

function recursive_subfolders($folders, $path) {
	//Credits: http://www.php.net/manual/en/function.scandir.php#68856
	// Set path here
		// Create initial "Folders" array
	if ($dir = opendir($path)) {
		$j = 0;
		while (($file = readdir($dir)) !== false) {
			if ($file != '.' && $file != '..' && is_dir($path.$file)) {
				$j++;
				$folders[$j] = $path . $file;
			}
		}
	}

	closedir($dir);

	// Then check each folder in that array for subfolders and add the subfolders to the "Folders" array.
	$j = count($folders);
	foreach ($folders as $folder) {
		if ($dir = opendir($folder)) {
			while (($file = readdir($dir)) !== false) {
				$pathto = $folder. '/' . $file;
				if ($file != '.' && $file != '..' && is_dir($pathto) && !in_array($pathto, $folders)) {
					$j++;
					$folders[$j] = $pathto;
					$folders = recursive_subfolders($folders, $path);
				}
			}
		}
		closedir($dir);
	}
	
	sort($folders);
	return $folders;
}

function listFolderFiles($dir, $recursive, $output){
	//Credits: http://stackoverflow.com/a/7121809
	$files = array();
	$ffs = scandir($dir);
	if($output === true) echo '<ol>';
	foreach($ffs as $ff){
		if($ff != '.' && $ff != '..'){
			$files["$ff"]=filemtime($dir.'/'.$ff);

			if($output === true) echo '<ol>'.$ff;
			if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff, $recursive, $output);
			if($output === true) echo '</ol>';	
			
		}
	}
	if($output === true) echo '</ol>';
	return $files;
}

function file_data_dir($dir) {
	$file_data_dir = array();

	//Snumber
	$parts = explode("/",$dir);
	$file_data_dir['snumber'] = $parts['4']; 


	//Subfolder
	$file_data_dir['subfolder'] = str_replace("C:/wamp/www/u/".$file_data_dir['snumber'], "", "$dir");
	if(empty($file_data_dir['subfolder']) === false){
		$file_data_dir['subfolder'] = $file_data_dir['subfolder'] . '/';
	}
	return $file_data_dir;
}

function file_data($file, $modify_time) {
	$file_data = array();

	//Modify_time
	$file_data['modify_time'] = intval($modify_time);

	//Filename
	$parts = explode(".",$file);
	$file_data['file_name'] = $parts['0'];

	//Extension
	$file_data['extension'] = ltrim(strstr($file, '.'), '.');

			//Version
	return $file_data;
}

function database_file_control($files, $dir){
	gc_enable(); 
	$files;
	//Get general info on file passed by $files and $dir, ready to be placed in the database
	$file_data_dir = file_data_dir($dir);
	foreach ($files as $key => $value){
		$file_data = file_data($key, $value);
		
		//Check for emtpy subfolders = not a great solution, should fix function (listFolderFiles)
		if(empty($file_data['extension']) === true) {
			return;
		} else {
			//Filter files bigger then 5 mb
			if (filesize($dir . '/' . $key) >= 5242880) {
				return;
			} 			
			//check if file exists, if so, return modify time, hash, version and fileID
			$row = file_exists_db($file_data_dir['subfolder'], $file_data['file_name'], $file_data['extension'], $file_data_dir['snumber']);
			if($row === false){
				//create file
//				$file_data['hash'] = file_hash($dir . '/' .$key);
				$file_data['version'] = 1;
				file_create_db($file_data_dir['snumber'], $file_data['file_name'], $file_data['extension'], 
					$file_data_dir['subfolder'], $file_data['modify_time'], '', 'xxx');

				echo date("Y-m-d H:i:s") . '<hr>';
			} else {
				//Check whether or not to push revision
				if(file_requires_update_mftime($row['modify_time'], $file_data['modify_time']) === false) {
					
				} else {
//					$file_data['hash'] = file_hash($dir . '/' .$key);
					// if (file_requires_update_mftime($row['hash'], $file_data['hash']) === false) {
					// 	h1('File doesnt needs updating, hash is the same');
					// 	//file_update_mftime($fileID);
					// } else {
						h1('File needs updating' . $row['modify_time'] . '-' . $row['fileID']);
						d(file_update_db($file_data_dir['snumber'], $file_data['file_name'], 
						$file_data['extension'], $file_data_dir['subfolder'], 
						$file_data['modify_time'], $row['version'], 'xxx', $row['githubID']));
//					}	
				}
			}
		}
	}
	gc_disable();
}

function get_dir($fileID) {
	$query = "SELECT snumber, subfolder, file_name, file_extension FROM files WHERE fileID = $fileID";
	$query;
	$result = mysql_query($query) or die ("Error: " . mysql_error());
	$row = mysql_fetch_array($result,MYSQL_NUM);

	return $row['0'] . '/' . $row['1'] . $row['2'] . '.' . $row['3'];
}

function file_exists_db($subfolder, $file_name, $file_extension, $snumber) {
	$query = "SELECT modify_time, fileID, version, githubID FROM files WHERE subfolder='%s' AND file_name='%s' AND file_extension='%s' AND snumber='%s' ORDER BY version DESC";
	$query = sprintf($query, $subfolder, $file_name, $file_extension, $snumber);
	$result = mysql_query($query) or die ("Error: " . mysql_error());
	$row = mysql_fetch_assoc($result);
	return $row;
}
						// $file_data_dir['snumber'], $file_data['file_name'], $file_data['extension'], 
					// $file_data_dir['subfolder'], $file_data['modify_time'], '', $file_data['hash']
function file_create_db($snumber, $file_name, $file_extension, $subfolder, $modify_time, $version, $hash) {
	if (!is_null($version)){ 
		$version = $version + 1;
	}
	$response = create_file_repo($snumber, $subfolder, $file_name . '.' .$file_extension, 'This file is version number ' . $version );
	if (is_null($response)) { return; }
	if ($response->status_code == 201 ) {

		$githubID= json_decode($response->body);
		d($githubID->content->sha);
		//d($githubID['sha']);
		$query = "INSERT INTO files(snumber, file_name, file_extension, subfolder, modify_time, version, hash, githubID) 
					VALUES ('%s','%s','%s','%s',%s,%s,'%s', '%s')";
		$query = sprintf($query, $snumber, $file_name, $file_extension, $subfolder, $modify_time, $version, $hash, $githubID->content->sha);
		mysql_query($query) or die ("Error: " . mysql_error());

	} else {
		h1('failed to upload new file - error code');
		d($response);
		d($response->status_code);
	}
	// if Query didn't die, push to github
}


function file_update_db($snumber, $file_name, $file_extension, $subfolder, $modify_time, $version, $hash, $githubID) {
	if (!is_null($version)){ 
		$version = $version + 1;
	}
	$response = update_file_repo($snumber, $subfolder, $file_name . '.' .$file_extension, 'This file is version number ' . $version, $githubID);
	if (is_null($response)) { return; }
	if ($response->status_code == 200 ) {

		$githubID= json_decode($response->body);
		d($githubID->content->sha);
		//d($githubID['sha']);
		$query = "INSERT INTO files(snumber, file_name, file_extension, subfolder, modify_time, version, hash, githubID) 
					VALUES ('%s','%s','%s','%s',%s,%s,'%s','%s')";
		$query = sprintf($query, $snumber, $file_name, $file_extension, $subfolder, $modify_time, $version, $hash, $githubID->content->sha);
		mysql_query($query) or die ("Error: " . mysql_error());

	} else {
		h1('failed to upload updated file - error code');
		d($response);
		d($response->status_code);
	}
	// if Query didn't die, push to github
}

//--------------------------------------------------------------------------------------------------
function file_requires_update_mftime($current_modify_time, $saved_modify_time) {
	if((int)$current_modify_time !== $saved_modify_time) {
		return true;
	} else { 
		return false;
	}
	
}

function file_requires_update_hash($hash, $saved_data_hash) {
	if((int)$hash !== $saved_data_hash) {
		return true;
	} else { 
		return false;
	}
	
}

function file_hash($dir) {
	return md5_file($dir);
	
}

// function file_update_mftime($fileID) {
// 	return;
// }

?>