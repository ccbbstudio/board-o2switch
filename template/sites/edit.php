<?php 
$msg = null;
$site_id = inputGet('id');

if (inputPost('action') == 'edit' && $site_id == inputPost('id') ) {
	$ndd = inputPost('name');
	$metas = inputPost('meta');

	foreach ($metas as $key => $value) {

		$temps_meta = ndd_get_meta($site_id,$key);

		if ($temps_meta && $value) {
			ndd_meta_update($site_id, $key, $value);
		}

		if (!$temps_meta && $value) {
			ndd_meta_add($site_id, $key, $value);
		}
	}

	$expiration = ndd_get_meta($site_id,'expiration_date');
	$date_now = new DateTime("now");
	$date_new = new DateTime($expiration);

	if ($date_new < $date_now ) {
		$getnddData = getDomainData($ndd);

		foreach ($getnddData as $key => $value) {
			ndd_meta_update($site_id, $key, $value);
		}

	}


	$msg = html_msg_success('Données du site mis à jour');

}

$ndd_name = ndd_get_name($site_id);
$owner_id = ndd_get_meta($site_id,'owner_id');
$cat_id = ndd_get_meta($site_id,'category');
$backoffice_url = ndd_get_meta($site_id,'backoffice_url');


$all_owner =  owner_select_all();
$all_category =  category_select_all();
?>

<h1 class="page-title">Modifier le site</h1>
<a href="/sites.php">Tous les sites</a>
<h2><?= $ndd_name  ?></h2>
<?php if ($msg): ?>
	<?php echo $msg ?>
<?php endif ?>
<form action="" method="post">
	<input type="hidden" name="action" value="edit">
	<input type="hidden" name="name" value="<?= $ndd_name ?>">
	<input type="hidden" name="id" value="<?= $site_id ?>">
	<div>
		<label for="">Proprietaire</label>
		<select name="meta[owner_id]" id="">
			<?php foreach ($all_owner as $item): ?>
				<option value="<?= $item['id'] ?>" <?php if ($item['id'] == $owner_id) echo 'selected'; ?>><?= $item['name'] ?></option>
			<?php endforeach ?>

		</select>
	</div>
	<div>
		<label for="">Categorie</label>
		<select name="meta[category]" id="">
			<?php foreach ($all_category as $item): ?>
				<option value="<?= $item['id'] ?>" <?php if ($item['id'] == $cat_id) echo 'selected'; ?>><?= $item['name'] ?></option>
			<?php endforeach ?>
		</select>
	</div>
	<div>
		<label for="">Liens vers backoffice</label>
		<input type="url" name="meta[backoffice_url]" id="url" placeholder="https://<?= $ndd_name ?>/wp-admin" value="<?= $backoffice_url ?>">
	</div>
	<button type="submit">Mettre à jour</button>
</form>