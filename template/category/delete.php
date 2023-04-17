<?php
$action = inputPost('action');
$id =  inputGet('id');
$catData = category_get($id);

$deleted = !$catData;

$all_category =  category_select_all();

$site_count = category_get_ndd($id, true);

if (!$site_count) {
	category_delete($id);
	$msg = html_msg_success("Catégorie supprimée avec succès");

	$deleted = true;
}

if ($action && $id ==  inputPost('id') && inputPost('replace_to')) {

	$cat_site = category_get_ndd($id);
	$new_cat = inputPost('replace_to');

	foreach ($cat_site as $item) {
		ndd_meta_update($item['id'], "category", $new_cat );
	}

	category_delete($id);
	$deleted = true;

	$msg = html_msg_success("Catégorie supprimée avec succès");


}

?>
<?php if (!$deleted): ?>
<h1 class="page-title">Supprimer la catégorie : <?= $catData->name ?></h1>
<?php
if ($msg)
	echo $msg;
?>
	<form action="" method="post">
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="id" value="<?= $id ?>">
		<div>
			<label for="">Remplacer la categorie par :</label>
			<select name="replace_to" id="">
				<?php foreach ($all_category as $item): ?>
					<?php if ($item['id'] !== $id): ?>
						<option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
					<?php endif ?>
				<?php endforeach ?>
			</select>
		</div>
		<div>
			<button type="submit">Supprimer</button>
		</div>
	</form>
<?php else: ?>
<h1 class="page-title">Catégorie n'existe pas</h1>

<?php endif ?>
