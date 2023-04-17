<?php 
$msg = null;
$temps_name = null;

if (inputPost('action') == 'create') {
	$temps_name = inputPost('owner_name');

	if ($temps_name) {

			if (!owner_get_ID($temps_name)) {
				$new_id = owner_add($temps_name);
				if ($new_id) {
					$msg = html_msg_success("proprietaire $temps_name ajouter <a href='/owner.php?action=edit&id=$new_id'>Modifier</a>");
					$temps_name = null;
				}
			} else {
				$msg = html_msg_error('Le nom que vous vous choisissez appartient déjà à un autre proprietaire');
			}
			
	}
	else {
		$msg = html_msg_error('Veuillez remplir tous les champs');
	}
}
?>
<div>
	<a href="/owner.php">Tous les proprietaire</a>
	<h1 class="page-title">Ajouter un proprietaire</h1>
	<?php if ($msg): ?>
		<?php echo $msg ?>
	<?php endif ?>
	<form action="" method="post">
		<input type="hidden" name="action" value="create">
		<div>
			<label for="">Name</label>
			<input type="text" name="owner_name" value="<?= $temps_name ?>">
		</div>

		<div>
			<button type="submit">Ajouter</button>
		</div>
	</form>

</div>