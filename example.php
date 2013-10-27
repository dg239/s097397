<?php

/*
    CREATE TABLE tokens (token varchar(6), created TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
	CREATE TABLE data (token varchar(6), id int, lang varchar(16), code mediumtext);
*/

require_once('../../secure/DBCreds.php');

function generateToken($length){
	$bytes = '';
	for($index = 0; $index < $length; $index++){
		$bytes .= chr(mt_rand(0, 255));
	}

	$token = '';
	$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
	foreach(str_split($bytes) as $byte){
		$token .= $characters[ord($byte) % strlen($characters)];
	}

	return $token;
}

$format = 'mysql:host=localhost;dbname=%s;charset=utf8';
$db = new PDO(sprintf($format, DBCreds::NAME), DBCreds::USER, DBCreds::PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST'){
	$token = $_POST['token'];
	$id = 0;

	if(empty($token)){
		$succeeded = false;
		$queries = 0;

		$statement = $db->prepare('INSERT INTO tokens (token) VALUES (?)');
		$statement->bindParam(1, $token);

		do {
			$token = generateToken(6);
			$succeeded = false;
			$queries++;

			try {
				$statement->execute();
				$succeeded = true;
			} catch(PDOException $exception){
				if($exception->getCode() === '23000'){
					$succeeded = false;
				} else {
					throw $exception;
				}
			}
		} while(!$succeeded && $queries < 20);
	} else {
		$statement = $db->prepare('SELECT id FROM data WHERE token=?');
		$statement->execute(array($token));
		$id = $statement->rowCount();
	}

	if(!empty($token)){
		$code = $_POST['code'];
		$lang = $_POST['lang'];

		$statement = $db->prepare('INSERT INTO data (token, id, lang, code) VALUES (?, ?, ?, ?)');
		$statement->execute(array($token, $id, $lang, $code));

		echo json_encode(array('token' => $token, 'id' => $id));
	}
} elseif($method === 'GET'){
	$token = $_GET['token'];
	$list = $_GET['list'];

	if(isset($list)){
		$statement = $db->prepare('SELECT id FROM data WHERE token=?');
		$statement->execute(array($token));

		$data = $statement->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($data);
	} elseif(isset($token)){
		$statement = $db->prepare('SELECT code, lang FROM data WHERE token=? AND id=?');
		$statement->execute(array($token, $_GET['id']));

		$data = $statement->fetch(PDO::FETCH_ASSOC);
		if(isset($data['code'])){
			echo json_encode($data);
		}
	}
}
