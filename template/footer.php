<?php 
$keyword = null;
$filter = inputGet('view');
$id = inputGet('id');

if ($filter && $id) {
	switch ($filter) {
		case 'category':
		$keyword = category_get_name($id );
		break;
		case 'server':
			$keyword = server_get_name($id);
		break;

		case 'owner':
			 $keyword = owner_get_name($id);
			break;
		
		default:
			// code...
		break;
	}
}

?>

<div>
	<p>Studio CCBB &copy; <?= date('Y') ?></p>
</div>
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready( function () {
		$('#mainTable').DataTable( {
			"pageLength": 100,
			fixedHeader: true,
			"order": [],
			language: {
				"sEmptyTable":     "Aucune donnée disponible dans le tableau",
				"sInfo":           "_START_ de _END_ / _TOTAL_",
				"sInfoEmpty":      "0 / 0",
				"sInfoFiltered":   "(filtré à partir de _MAX_ lignes)",
				"sInfoPostFix":    "",
				"sInfoThousands":  ",",
				"sLengthMenu":     "Afficher _MENU_ lignes",
				"sLoadingRecords": "Loading...",
				"sProcessing":     "Processing...",
				"sSearch":         "Recherche:",
				"sZeroRecords":    "No matching records found",
				"oPaginate": {
					"sFirst":    "Premier",
					"sLast":     "Dernier",
					"sNext":     "Suivant",
					"sPrevious": "Précédent"
				},
				"select": {
					"rows": {
						"_": "You have selected %d rows",
						"0": "Click a row to select",
						"1": "1 row selected"
					}
				}
			},
			<?php if ($keyword): ?>
				"oSearch": {
					"sSearch": "<?= $keyword ?>"
				},
			<?php endif ?>
		});
	} );
</script>
</body>
</html>