<?php

function ndd_add($name, $serverID, $deleted = '0', $id = NULL){

	$pdo = DB::getInstance();

	$sql = "INSERT INTO ndd (id, name, server_id, deleted) VALUES (?, ?, ?, ?)";
	$pdo->prepare($sql)->execute([$id, $name, $serverID,$deleted]);

	return $pdo->lastInsertId();
}

function ndd_select_all()
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM ndd WHERE  deleted=?");
	$stmt->execute([0]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	return $stmt->fetchAll();
}

function ndd_get_name($nddID)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT name  FROM ndd WHERE  id=?");
	$stmt->execute([$nddID]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
	if (count($result)) 
		return $result[0]['name'];
	else
		return null;
}

function ndd_meta_add($ndd_id, $key, $value, $id = NULL){

	$pdo = DB::getInstance();

	if (!ndd_get_meta($ndd_id,$key)) {

		$sql = "INSERT INTO ndd_meta (id, ndd_id, meta_key, meta_value) VALUES (?, ?, ?, ?)";
		$added = $pdo->prepare($sql)->execute([$id, $ndd_id, $key, $value]);

		return $added;
	} else {
		return ndd_meta_update($ndd_id, $key, $value);
	}
}

function ndd_meta_update($ndd_id, $key, $value){

	$pdo = DB::getInstance();

	$sql = "UPDATE ndd_meta SET meta_value=? WHERE ndd_id=? AND meta_key=?";
	$updated = $pdo->prepare($sql)->execute([$value, $ndd_id, $key]);

	return $updated;
}

function ndd_delete($ndd, $serverID){

	$pdo = DB::getInstance();
	$sql = "UPDATE ndd SET deleted=? WHERE name=? AND server_id=?";
	$updated = $pdo->prepare($sql)->execute([1, $ndd, $serverID]);
	return $updated;
}

function ndd_get_meta($id,$key)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT meta_value  FROM ndd_meta WHERE  ndd_id=? AND meta_key=?");
	$stmt->execute([$id,$key]); 

	if ($stmt->rowCount()>0) {
		$meta = $stmt->fetch();
		return $meta['meta_value'];
	}
	else {
		return null;
	}	
}

function ndd_exist($ndd)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM ndd WHERE  name=?");
	$stmt->execute([$ndd]); 
	return $stmt->rowCount();
}