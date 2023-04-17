<?php

function server_add($name, $url, $deleted = '0', $id = NULL){

	$pdo = DB::getInstance();

	$sql = "INSERT INTO server (id, name, url, deleted) VALUES (?, ?, ?, ?)";
	$pdo->prepare($sql)->execute([$id, $name, $url,$deleted]);

	return $pdo->lastInsertId();
}

function server_select_all()
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM server WHERE  deleted=?");
	$stmt->execute([0]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	return $stmt->fetchAll();
}

function server_meta_add($server_id, $key, $value, $id = NULL){

	$pdo = DB::getInstance();

	if (!server_get_meta($server_id,$key)) {

		$sql = "INSERT INTO server_meta (id, server_id, meta_key, meta_value) VALUES (?, ?, ?, ?)";
		$added = $pdo->prepare($sql)->execute([$id, $server_id, $key, $value]);

		return $added;
	} else {
		return server_meta_update($server_id, $key, $value);
	}
}

function server_meta_update($server_id, $key, $value){

	$pdo = DB::getInstance();

	$sql = "UPDATE server_meta SET meta_value=? WHERE server_id=? AND meta_key=?";
	$updated = $pdo->prepare($sql)->execute([$value, $server_id, $key]);

	return $updated;
}

function server_get_meta($id,$key)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT meta_value  FROM server_meta WHERE  server_id=? AND meta_key=?");
	$stmt->execute([$id,$key]); 

	if ($stmt->rowCount() == 1) {
		$meta = $stmt->fetch();
		return $meta['meta_value'];
	}
	else {
		return null;
	}
	
}

function server_get_ndd($serverID)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM ndd WHERE  server_id=? AND deleted=?");
	$stmt->execute([$serverID,0]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	return $stmt->fetchAll();
}

function server_get_name($serverID)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT name  FROM server WHERE  id=?");
	$stmt->execute([$serverID]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
	if (count($result)) 
		return $result[0]['name'];
	else
		return null;
}

function server_get_URL($serverID)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT url  FROM server WHERE  id=?");
	$stmt->execute([$serverID]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
	if (count($result)) 
		return $result[0]['url'];
	else
		return null;
}


function server_exist($name, $url)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT * FROM server WHERE  name=? AND url=?");
	$stmt->execute([$name, $url]); 
	return $stmt->rowCount();
}