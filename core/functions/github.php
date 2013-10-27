<?php

$authentication = array(
	'auth' => new Requests_Auth_Basic(array('dg239', '123123abc'))
);

function create_repo($snumber, $first_name, $last_name) {
	global $authentication;
	d($response = Requests::post('https://api.github.com/user/repos', 
		array(), headers_create_repo($snumber, $first_name, $last_name), $authentication));
	return $response;

}
function headers_create_repo($snumber, $first_name, $last_name) {
	$headers = array(
		'name'=> $snumber,
		'description'=> 'This repo is off ' . $first_name . (!empty($last_name) ? ' ' . $last_name : null),
		'homepage'=> 'https=>//github.com',
		'private'=> false,
		'has_issues'=> true,
		'has_wiki'=> false,
		'has_downloads'=> false,
		'auto_init' => true
	);
	return json_encode($headers);
}

function create_file_repo($snumber, $subfolder, $filename, $message) {
	global $authentication;
	if(empty($subfolder)){ $suffix = '/';} else {$suffix = '';}

	$content = file_get_contents('C:/wamp/www/u/'.$snumber. $suffix . $subfolder . $filename,true);
	if(is_null($content)) {
		return;
	}
	$content = base64_encode($content);
	d("https://api.github.com/repos/dg239/'.$snumber.'/contents'.$suffix.$subfolder.$filename");
	d($response = Requests::put('https://api.github.com/repos/dg239/'.$snumber.'/contents'.$suffix.$subfolder.$filename, 
		array(), headers_create_file_repo($message, $content), $authentication));
	log_file_error($response->status_code, $snumber, $filename, $subfolder);
	
	return $response;
}

function headers_create_file_repo($message, $content) {
	$headers = array(
		'message' => $message,
		'content'=> $content,
		'committer' => array(
			'name'=> 'dg239',
			'email'=> 'mail@thijstervelde.com'
		)
	);
	d(json_encode($headers));
	return json_encode($headers);

}

function update_file_repo($snumber, $subfolder, $filename, $message, $githubID) {
	global $authentication;
	if(empty($subfolder)){ $suffix = '/';} else {$suffix = '';}
	$content = file_get_contents('C:/wamp/www/u/'.$snumber. $suffix . $subfolder . $filename,true);
	$content = base64_encode($content);
	d('https://api.github.com/repos/dg239/'.$snumber.'/contents'.$suffix.$subfolder.$filename);
	d($response = Requests::put('https://api.github.com/repos/dg239/'.$snumber.'/contents'.$suffix.$subfolder.$filename, 
		array(), headers_update_file_repo($message, $content, $githubID), $authentication));
	log_file_error($response->status_code, $snumber, $filename, $subfolder);
	return $response;
}

function headers_update_file_repo($message, $content, $githubID) {
	$headers = array(
		'message' => $message,
		'content'=> $content,
		'sha' => $githubID,
		'committer' => array(
			'name'=> 'dg239',
			'email'=> 'mail@thijstervelde.com'
		)
	);

	return json_encode($headers);
}


?>