<?php

require 'config.php';
require 'inc/db.class.php';
require 'inc/helper.class.php';
require 'inc/user.class.php';
require 'inc/ndd.class.php';
require 'inc/category.class.php';
require 'inc/theme-template.php';

session_start();

$title = "Catégories";
$current_page = 'category';

if (!is_connected()) 
	redirection('login.php');
$msg = null;

$temps_ID = null;
$temps_name = null;
$temps_color = null;






$action = inputPost('action');
$template = inputGet('action');

if ($template == 'update' && !$action) {
	$id =  inputGet('id');
	$catData = category_get($id);

	if ($catData) {
		$temps_ID = $id;
		$temps_name = $catData->name;
		$temps_color = $catData->color;
	}
	else {
		redirection("categorie.php?msg=cat_no_exist");

	}
}


$getMsg = inputGet('msg');
switch ($getMsg) {
	case 'created_success':
	$msg = html_msg_success("Ajout catégorie success");
	break;
	case 'cat_no_exist':
	$msg = html_msg_error("La catégorie n'existe pas");
	break;
	
	default:

	break;
}





if ($action) {
	if ($action == 'create') {
		$temps_name = inputPost('catName'); 
		$temps_color = inputPost('catColor'); 

		if (!category_exist($temps_name)) {
			if ($temps_name && $temps_color) {
				$id = category_add($temps_name,$temps_color);
				generateTheme();
				if ($id) {
					redirection("categorie.php?action=update&id=$id&msg=created_success");
				}
			} else{
				$msg = html_msg_error("Veuillez remplir tous les champs");
				
			}
			
		} else {
			$msg = html_msg_error("La catégorie existe déjà");
		}
	}

	if ($action == 'update') {
		$temps_ID = inputPost('catID');
		$temps_name = inputPost('catName'); 
		$temps_color = inputPost('catColor'); 

		if (category_get($temps_ID)) {
			if ($temps_name && $temps_color) {
				if(category_update($temps_ID, $temps_name,$temps_color))
					$msg = html_msg_success("Catégorie mis à jour");
				generateTheme();

			} else{
				$msg = html_msg_error("Veuillez remplir tous les champs");
				
			}
			
		}
	}	
}



include('template/header.php');
?>

<?php if ($template == 'add'): ?>
	<a href="/categorie.php">Tous les catégories</a>
	<h1 class="page-title">Ajouter une nouvelle catégorie</h1>

	<?php
	if ($msg)
		echo $msg;
	?>
	<?php include 'template/category/add.php'; ?>
	
<?php elseif ($template == 'update'):?>
	<a href="/categorie.php">Tous les catégories</a>

	<h1 class="page-title">Modifier la catégorie</h1>
	<?php
	if ($msg)
		echo $msg;
	?>
	<?php include 'template/category/update.php'; ?>

<?php elseif ($template == 'delete'): ?>
	<a href="/categorie.php">Tous les catégories</a>
	<?php include 'template/category/delete.php'; ?>

<?php else: ?>
	<div class="page_header-with-action">
		<h1 class="page-title">Catégories</h1>
		<a class="btn__link" href="/categorie.php?action=add">Ajouter une catégorie</a>
	</div>

	<?php
	if ($msg)
		echo $msg;
	?>
	<?php include 'template/category/listing.php'; ?>

<?php endif ?>
<?php
include('template/footer.php');