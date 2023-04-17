<?php

function owner_add($name, $deleted = '0', $id = NULL){

	$pdo = DB::getInstance();

	$sql = "INSERT INTO owner (id, name, deleted) VALUES (?, ?, ?)";
	$pdo->prepare($sql)->execute([$id, $name, $deleted]);

	return $pdo->lastInsertId();
}

function owner_update($id, $name){

	$pdo = DB::getInstance();

	$sql = "UPDATE owner SET name=? WHERE id=?";
	$updated = $pdo->prepare($sql)->execute([$name, $id]);
	return $updated;
}

function owner_select_all()
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM owner WHERE  deleted=?");
	$stmt->execute([0]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	return $stmt->fetchAll();
}

function owner_meta_add($owner_id, $key, $value, $id = NULL){

	$pdo = DB::getInstance();

	if (!owner_get_meta($owner_id,$key)) {

		$sql = "INSERT INTO owner_meta (id, owner_id, meta_key, meta_value) VALUES (?, ?, ?, ?)";
		$added = $pdo->prepare($sql)->execute([$id, $owner_id, $key, $value]);

		return $added;
	} else {
		return owner_meta_update($owner_id, $key, $value);
	}
}

function owner_meta_update($owner_id, $key, $value){

	$pdo = DB::getInstance();

	$sql = "UPDATE owner_meta SET meta_value=? WHERE owner_id=? AND meta_key=?";
	$updated = $pdo->prepare($sql)->execute([$value, $owner_id, $key]);

	return $updated;
}

function owner_delete($ownerID){

	$pdo = DB::getInstance();
	$sql = "UPDATE owner SET deleted=? WHERE id=?";
	$updated = $pdo->prepare($sql)->execute([1, $ownerID]);
	return $updated;
}

function owner_get_meta($id,$key)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT meta_value  FROM owner_meta WHERE  owner_id=? AND meta_key=?");
	$stmt->execute([$id,$key]); 

	if ($stmt->rowCount()>0) {
		$meta = $stmt->fetch();
		return $meta['meta_value'];
	}
	else {
		return null;
	}	
}


function owner_get_name($ownerID)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT name  FROM owner WHERE  id=?");
	$stmt->execute([$ownerID]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
	if (count($result)) 
		return $result[0]['name'];
	else
		return null;
}


function owner_get_ID($name)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT id  FROM owner WHERE  name=?");
	$stmt->execute([$name]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
	if (count($result)) 
		return $result[0]['id'];
	else
		return 0;
}

function owner_get_ndd($ownerID, $count = false)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM ndd_meta WHERE  meta_key=? AND meta_value=?");
	$stmt->execute(['owner_id',$ownerID]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
	return $count ? count($result) : $result;
}