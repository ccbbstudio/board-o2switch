<?php

function is_connected()
{
	return isset($_SESSION["sessionID"]) ? true : false;		
}

function user_exist($login, $password)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT count(*)  FROM user WHERE  login=? AND password=?");
	$stmt->execute([$login, md5($password)]); 
	return $stmt->rowCount();
}