<?php 
$msg = null;
$owner_id = inputGet('id');
$owner_name = owner_get_name($owner_id);

if (inputPost('action') == 'edit') {
	$temps_id = inputPost('owner_id');
	$temps_name = inputPost('owner_name');

	if ($temps_name) {
		if ($temps_name !== owner_get_name($temps_id)) {

			if (owner_get_ID($temps_name) != $temps_id) {
				if (owner_update($temps_id, $temps_name)) {
					$owner_name = $temps_name;
					$msg = html_msg_success('proprietaire mis à jour');
				}
			} else {
				$msg = html_msg_error('Le nom que vous vous choisissez appartient déjà à un autre proprietaire');
			}
			
		}
	}
	else {
		$msg = html_msg_error('Veuillez remplir tous les champs');
	}
}
?>
<div>
	<a href="/owner.php">Tous les proprietaire</a>
	<h1 class="page-title">Modifier le proprietaire</h1>
	<?php if ($msg): ?>
		<?php echo $msg ?>
	<?php endif ?>
	<form action="" method="post">
		<input type="hidden" name="action" value="edit">
		<input type="hidden" name="owner_id" value="<?= $owner_id ?>">

		<div>
			<label for="">Name</label>
			<input type="text" name="owner_name" value="<?= $owner_name ?>">
		</div>

		<div>
			<button type="submit">Mettre à jour</button>
		</div>
	</form>

</div>