<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 

// $data = user_data(1, 'username','snumber', 'password');
// if (create_db_files('s0testsomething', 'theshit_lal', '1231231')===true){
// 	echo'yes';
// }
// function create_user_access($userID){
// 	$reg_data = user_data($userID, 'snumber', 'regdate', 'timelastseen');
// 	$query = "SELECT unhashed_password FROM temp_reg WHERE snumber = '".$reg_data['snumber']."'";
// 	$reg_data['password'] = mysql_result(mysql_query($query),0);
// 	if (create_database($snumber) === true) {
// 		if (create_user_mysql($reg_data['username'], $reg_data['password']) === true) {
// 			if (grant_user_database($reg_data['snumber'], $reg_data['username']) ===true) {
// 				echo'success!!';
// 			}asdasdasdasdasdasaaaaasa
// 		}
// 	}
// }

// $sql = "SELECT * FROM users";
// $result = mysql_query($sql);
// while($row = mysql_fetch_array($result, MYSQL_NUM)){
// 	$files = listFolderFiles($row[5]);
// }


// function find_all_files($dir) 
// { 
//     $root = scandir($dir); 
//     foreach($root as $value) 
//     { 
//         if($value === '.' || $value === '..') {continue;} 
//         if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;} 
//         foreach(find_all_files("$dir/$value") as $value) 
//         { 
//             $result[]=$value; 
//         } 
//     } 
//     return $result; 
// } 

// hr();


// // Initialise empty array, otherwise an error occurs
// $dir= 'C:/wamp/www/u/s8106123/s098767';
// $parts = explode("/",$dir);
// $mystring = $parts['4']; 
// echo $mystring;


// echo $broken_dir = str_replace("C:/wamp/www/u/", "", "$dir");
// hr();
// print_r($broken_dir);
// hr();
// echo preg_replace("/^.*-p\/(.*)$/", '$1', $broken_dir);
// hr();

 
//break the string up around the "/" character in $mystring 


// //grab the first part 
// $dir = 'C:/wamp/www/u/s097397/test/lol/';
// $snumber = 's097397';

// echo $subfolder = str_replace("C:/wamp/www/u/".$snumber."/", "", "$dir");

// $result = mysql_query("SELECT modify_time, fileID, version, hash FROM files WHERE subfolder='' AND file_name='FILETEST' AND file_extension='txt' AND snumber='s000000' ORDER BY version DESC");
// d($row = mysql_fetch_assoc($result));



// while () {
// 	d($row['version']);
// 	$results[$row['version']] = $row;
// }
// d($results);

// set_time_limit(600);


// $folders = array();
// $folders = recursive_subfolders($folders);
// $folders;
// foreach ($folders as $subfolder) {
// //	echo $subfolder;
// 	$files_data = listFolderFiles($subfolder);
	
// 	//Filter standard nonsense files
// 	$bad = array('.'=> 0, '..'=> 0, '.DS_Store'=> 0, 
// 		'_notes'=> 0, 'Thumbs.db'=> 0, '.gitignore'=>0,
// 		'.git'=>0, '.gitattributes'=>0 );
	
// 	$files_data = array_diff_key($files_data, $bad);	
// 	database_file_control($files_data, $subfolder);
// }

// set_time_limit(30);
//
// $authentication = array(
// 	'auth' => new Requests_Auth_Basic(array('dg239', '123123abc'))
// );
	// $url = 'https://api.github.com/repos/dg239/s1111111/contents/blogheader.php';

	// d($headers = headers_update_file_repo('1', 'PGhlYWRlcj4NCgk8aDE+TXkgZmlyc3QgYmxvZzwvaDE+DQoJPG5hdj4NCgkJPHVsPg0KCQkJPGxpPg0KCQkJCTxhIGhyZWY9ImJsb2cucGhwIj5PdmVydmlldzwvYT4NCgkJCTwvbGk+DQoJCQk8bGk+DQoJCQkJPGEgaHJlZj0iYWRkcG9zdC5waHAiPkFkZCBwb3N0PC9hPg0KCQkJPC9saT4NCgkJCTxsaT4NCgkJCQk8YSBocmVmPSJhZGRhdXRob3IucGhwIj5BZGQgYXV0aG9yPC9hPg0KCQkJPC9saT4NCgkJPC91bD5xd2Vxd2VXDQoJPC9uYXY+DQo8L2hlYWRlcj4=', 
	// '06eb058d9e54c1cf6f2da12d98dbef70450825fd'));
	// d($response = Requests::put($url, array(), $headers));



// $authentication = array(
// 	'auth' => new Requests_Auth_Basic(array('dg239', '123123abc'))
// );
// $snumber = 's111111';
// $first_name = 'Thijs';
// $last_name = 'ter Velde';



// 	d($response = Requests::post('https://api.github.com/user/repos', 
// 		array(), headers_create_repo($snumber, $first_name, $last_name), $authentication));
// 	return $response;

















// set_time_limit(600);
// $time = date('i s');
// echo $time;
// $i= 0;
// while ($time != '28 00'){
// 	$query = "INSERT INTO test(text1, hash1) VALUES(".$i.", '".md5($i)."')";
// 	mysql_query($query) or die ("Error: " . mysql_error());
// }
// set_time_limit(30);


create_repo('s1111111', 'Thijs', 'ter Velde');
// $response = create_file_repo('s1111111', '', 'blogheader.php', 'Version something something');
// $test = $response;
// d($test);
// echo $response->status_code;
// $test = $response->body;
// $test = json_decode($test, true);
// echo $test['message'];	
// d($test);
// echo gettype($test);
// hr();





// set_time_limit(600);

// $folders = array();
// $folders = recursive_subfolders($folders);

// foreach ($folders as $subfolder) {
// //	echo $subfolder;
// 	$files_data = listFolderFiles($subfolder);
// //	foreach ($files_mftime as $file_mftime) {
// 	database_file_control($files_data, $subfolder);
// //	}
// }

// set_time_limit(30);




// echo '<br>';
// function listFolderFiles($username){
// 	$dir = 'C:\wamp\www\u/' . $username;
// 	$ffs = scandir($dir);
// 	$i = 0;
// 	$list = array();
// 	foreach ( $ffs as $ff ){
// 		if ( $ff != '.' && $ff != '..' ){
// 			if ( strlen($ff)>=5 ) {
// 				//if ( substr($ff, -4) == '.php' ) {
// 				$list[] = $ff;
// 				//echo dirname($ff) . $ff . "<br/>";
// 				echo $dir . '<br/>';
// 				echo $dir.'/'.$ff.'<br/>';
// 				echo filemtime($dir.'/'.$ff) . '<br/>';
// 				hr();
// 				//}    
// 			}       
// 			if( is_dir($dir.'/'.$ff) ) {
// 				listFolderFiles($dir.'/'.$ff);
// 			}
// 		}
// 	}
// 	return $list;
// }



// hr();
// listFolderFiles1('C:/wamp/www');
//$files = listFolderFiles('u/s8106123');


//echo filemtime('u/s8106123/blog.php');

// echo '<hr>';
// $last = system('dir', $data);
// print_r($last);

// echo attempts_login($_SERVER["REMOTE_ADDR"]);
// sleep(1);
// echo attempts_login($_SERVER["REMOTE_ADDR"]);
// $count = 1;
// echo $count = 5 - $count;

// $response = Requests::get('https://github.com/timeline.json');
// var_dump($response);
// dump($response);
// $response = Requests::get('https://github.com/timeline.json', array('X-Requests' => 'Is Awesome!'));
// var_dump($response->body);
// $response = Requests::post('http://httpbin.org/post');
// var_dump($response->body);

// $response = Requests::get('https://github.com/timeline.json');
// // dump ($response);
// // echo '<hr>';
// // dump ($response->status_code);
// $test = $response->status_code;
// echo $test;


// //dump(Requests::get('https://bitbucket.org/api/1.0/user/repositories', array(), $options));
// $test = Requests::get('https://api.github.com/repos/dg239/s097397/branches/master', array(), $options);

// dump(json_decode($test->body));

// $authentication = array(
//     'auth' => new Requests_Auth_Basic(array('dg239', '123123abc'))
// );

// $headers = array(
//   'name'=> 'Hello-World',
//   'description'=> 'This is your first repo',
//   'homepage'=> 'https=>//github.com',
//   'private'=> false,
//   'has_issues'=> true,
//   'has_wiki'=> true,
//   'has_downloads'=> true
// );
// $headers = json_encode($headers);

// $test = Requests::post('https://api.github.com/user/repos', array(), $headers, $authentication);
// json_decode($test->body);

// // post($url, $headers = array(), $data = array(), $options = array())




// // First, include Requests
// include('../library/Requests.php');

// // Next, make sure Requests can load internal classes
// Requests::register_autoloader();

// // Set up our session
// $session = new Requests_Session('http://httpbin.org/');
// $session->headers['Accept'] = 'application/json';
// $session->useragent = 'Awesomesauce';

// // Now let's make a request!
// $request = $session->get('/get');

// // Check what we received
// var_dump($request);

// // Let's check our user agent!
// $request = $session->get('/user-agent');

// // And check again
// var_dump($request);

//file_put_contents('test.txt', $response->body);

// $snumber = 's0987654321';
// $username = 'testingtestf';
// $password = '123123';


// if (create_database($snumber)===true) {
// 	echo 'yes<br>';
// } else {
// 	echo'no<br>';
// }

// if (create_user_mysql($username, $password)===true) {
// 	echo 'yes<br>';
// } else {
// 	echo'no<br>';
// }

// if (grant_user_database($snumber, $username)===true) {
// 	echo 'yes<br>';
// } else {
// 	echo'no<br>';
// }



include 'includes/overall/footer.php'; ?>

