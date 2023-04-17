<?php

$all = category_select_all();

foreach ($all as $item) {
	extract($item);
}

?>
<table class="w-100 table-big-data" id="mainTable">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nom</th>
			<th>Total</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>

			<?php

			$all = category_select_all();

			foreach ($all as $item) {
				extract($item);

				$site_count = category_get_ndd($id, true);
				echo "<tr>";
				echo "<td>#$id</td>";
				echo "<td><div class='category-name__box'>
				<div class='category-bullet category-$id'></div>
				<div>$name</div>
				</div></td>";
				echo "<td class='text-center'>$site_count</td>";
				echo "<td class='text-center'>
				<ul class='actions--list'>
				<li><a href='/sites.php?view=category&id=$id' class='btn-action btn-view'><i class='fa fa-eye' aria-hidden='true'></i></a></li>
				<li><a href='/categorie.php?action=update&id=$id' class='btn-action btn-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></li>
				<li><a href='/categorie.php?action=delete&id=$id' class='btn-action btn-delete'><i class='fa fa-trash' aria-hidden='true'></i></a></li>
				</ul>
				</td>";
				echo "</tr>";
			}

			?>


	</tbody>
</table>