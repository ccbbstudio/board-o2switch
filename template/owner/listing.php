<?php 
$all = owner_select_all();

?>
<div>
	<h1 class="page-title">Proprietaire</h1>
	<a href="/owner.php?action=add">Ajouter un proprietaire</a>
	<table  id="mainTable" class="w-100 table-big-data">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Sites</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($all as $item):

				extract($item);
				?>
				<tr>
					<td>
						#<?= $id ?>
					</td>
					<td>
						<?= $name ?>
					</td>
					<td class="text-center">
						<?= owner_get_ndd($id, true) ?>
					</td>
					<td>
						<ul class='actions--list'>
							<li><a href='/sites.php?view=owner&id=<?= $id ?>' class='btn-action btn-view'><i class='fa fa-eye' aria-hidden='true'></i></a></li>
							<li><a href='/owner.php?action=edit&id=<?= $id ?>' class='btn-action btn-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></li>
						</ul>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

</div>