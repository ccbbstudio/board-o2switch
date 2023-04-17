<?php
function category_add($name, $color, $deleted = '0', $id = NULL){

	$pdo = DB::getInstance();

	$sql = "INSERT INTO category (id, name, color, deleted) VALUES (?, ?, ?, ?)";
	$pdo->prepare($sql)->execute([$id, $name, $color,$deleted]);

	return $pdo->lastInsertId();
}

function category_select_all()
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM category WHERE  deleted=?");
	$stmt->execute([0]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	return $stmt->fetchAll();
}

function category_get($categoryID)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM category WHERE  id=? AND deleted=?");
	$stmt->execute([$categoryID, 0]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$data =  $stmt->fetchAll();

	return $data ? (object)$data[0] : null;

}

function category_get_name($categoryID)
{
	$data = category_get($categoryID);

	return $data ? $data->name : null;
}

function category_delete($categoryID){

	$pdo = DB::getInstance();
	$sql = "UPDATE category SET deleted=? WHERE id=?";
	$deleted = $pdo->prepare($sql)->execute([1, $categoryID]);
	return $deleted;
}

function category_update($categoryID,$name,$color){

	$pdo = DB::getInstance();
	$sql = "UPDATE category SET  name=?, color=? WHERE id=?";
	$updated = $pdo->prepare($sql)->execute([$name, $color, $categoryID]);
	return $updated;
}



function category_exist($category)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM category WHERE  name=?");
	$stmt->execute([$category]); 
	return $stmt->rowCount();
}

function category_get_ndd($categoryID, $count = false)
{
	$pdo = DB::getInstance();
	$stmt = $pdo->prepare("SELECT *  FROM ndd_meta WHERE  meta_key=? AND meta_value=?");
	$stmt->execute(['category',$categoryID]); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
	return $count ? count($result) : $result;
}