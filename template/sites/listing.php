<h1 class="page-title">Sites</h1>
<table id="mainTable" class="table-big-data">
	<thead>
		<tr>
			<th class="col-ndd">NDD</th>
			<th class="col-owner">Proprietaire</th>
			<th class="col-category">Catégorie</th>
			<th class="col-server">Serveur</th>
			<th class="col-ip">Adresse IP</th>
			<th class="col-expiration">Expiration</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($allSites as $site): 
			$siteID = $site['id'];
			?>
			<tr>
				<td data-order="<?= $site['name'] ?>">
					<div class="ndd-name">
						<div class="dropdown-box">
							<button class="dropdown-toggle"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
							<ul class="dropdown">
								<li><a target="_blank" href="https://www.google.fr/search?q=site%3A<?= $site['name'] ?>">site:</a></li>
								<li><a target="_blank" href="https://web.archive.org/web/*/<?= $site['name'] ?>">archive.org</a></li>
								<li><a target="_blank" href="https://fr.semrush.com/analytics/overview/?q=<?= $site['name'] ?>&searchType=domain">semrush</a></li>
								<li><a target="_blank" href="https://app.seobserver.com/sites/view/<?= $site['name'] ?>">seobserver.com</a></li>
								<?php
								$backoffice_url = ndd_get_meta($siteID,'backoffice_url');
								 if ($backoffice_url): ?>
								<li><a target="_blank" href="<?= $backoffice_url ?>">backoffice</a></li>	
								<?php endif ?>
							</ul>
						</div>
						<div class="ndd-name--content">
							<img src="http://www.google.com/s2/favicons?domain=<?= $site['name'] ?>" alt="">
							<?= $site['name'] ?>
						</div>
						<a class="ndd--edit"href="/sites.php?action=edit&id=<?= $siteID ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					</div>
				</td>
				<td>
					<?php
						$owner_id = ndd_get_meta($siteID,'owner_id');
						echo owner_get_name($owner_id);
					?>
				</td>
				<td><?php
				$cat_id = ndd_get_meta($siteID,'category');
				$cat_name = category_get_name($cat_id);
				echo "<div class='category-tag category-$cat_id'>$cat_name</div>";

			?></td>
			<td class="text-center">
				<a class="link" href="<?= server_get_URL($site['server_id']) ?>"><?= server_get_name($site['server_id']) ?></a>
			</td>
			<td class="text-center"><?php
			$ip = ndd_get_meta($siteID,'ip_adress');
			if (filter_var($ip, FILTER_VALIDATE_IP)) {
				echo $ip;
			} else {
				echo "-";
			}
		?></td>
		<?php 
		$expiration = ndd_get_meta($siteID,'expiration_date');
		$date=date_create($expiration);
		$date_ndd = date_format($date,"Y-m-d");
		?>
		<td data-order="<?= $date_ndd ?>"  class="text-center">
			<?=  getDifference($date_ndd); ?>

		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>