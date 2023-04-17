<form action="" method="post">
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="catID" value="<?= $temps_ID ?>">
	<div>
		<div>
			<label for="catName" required>Nom</label>
		</div>
		<div>
			<input type="text" name="catName" id="catName" value="<?= $temps_name ?>">
		</div>
	</div>
	<div>
		<div>
			<label for="catColor" required>Couleur</label>
		</div>
		<div>
			<input type="color" name="catColor" id="catColor" value="<?= $temps_color ?>">
			<input type="text" name="catColorHex" id="catColorHex" value="<?= $temps_color ?>">
			<span class="color-notify"></span>
		</div>
		<div>
			<button type="submit">Mettre à jour</button>
		</div>
	</div>
</form>
