<?php

require 'config.php';
require 'inc/db.class.php';
require 'inc/helper.class.php';
require 'inc/user.class.php';
require 'inc/server.class.php';
require 'inc/ndd.class.php';
require 'inc/whois.class.php';

$title = "Serveur";
$current_page = 'server';


session_start();

if (!is_connected()) 
	redirection('login.php');

if (isset($_GET['refresh'])) {
	$serverID = trim($_GET['refresh']);
	$apiURL = server_get_meta($serverID,'apiURL');
	$apiKey = server_get_meta($serverID,'apiKey');


	if ($apiURL && $apiKey) {
		$apiPath = "$apiURL?key=$apiKey";
		$data = file_get_contents($apiPath);
		$data = json_decode($data,true);
		if ($data) {
			foreach ($data as $item) {
				$dnsData = getDomainData($item);
				if (!ndd_exist($item)) {
					$nddID = ndd_add($item,$serverID);
					foreach ($dnsData as $key => $value) {
						ndd_meta_add($nddID, $key, $value);
					}

					ndd_meta_add($nddID, 'owner_id', 1);
					ndd_meta_add($nddID, 'category', 1);
				}

			}
			$serverNDDs = server_get_ndd($serverID);

			foreach ($serverNDDs as $item) {
				if (!in_array( $item['name'], $data)) {
					ndd_delete($item['name'], $serverID);
				}
			}
		}

	}
}

$allServer = server_select_all();
include('template/header.php');
?>
<div class="page_header-with-action">
	<h1 class="page-title">Serveur</h1>
	<button class="btn__link btn__addServer"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter un serveur</button>
</div>

<table id="mainTable" class="table-big-data w-100">
	<thead>
		<tr>
			<th>Serveur</th>
			<th>Domaines</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($allServer as $server): ?>
			<tr>
				<td><?= $server['name'] ?></td>
				<td><?php

				$nddDB  = count(server_get_ndd($server['id']));

				$apiURL = server_get_meta($server['id'],'apiURL');
				$apiKey = server_get_meta($server['id'],'apiKey');
				$apiPath = "$apiURL?key=$apiKey";

				if (get_http_response_code($apiPath) == 200) {
			
				$data = file_get_contents($apiPath);

				$data = json_decode($data,true);

				$nddLive = count($data);

				echo $nddDB == $nddLive ? $nddDB : "$nddDB (Live :  $nddLive)";
				}
				else {
					echo "$nddDB (Live : ". html_msg_error("Error").")";
				}


			?></td>
			<td>
				<ul class="action-list">
					<li>
						<a href='/sites.php?view=server&id=<?= $server['id']; ?>' class='btn-action btn-view'><i class='fa fa-eye' aria-hidden='true'></i></a>
					</li>
					<li>
						<a class="btn__link"  href="<?= $server['url'] ?>" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
					</li>
					<li>
						<a class="btn__link"  href="?refresh=<?= $server['id']; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></a>
					</li>
				</ul>

			</td>
		</tr>
	<?php endforeach ?>
</tbody>

</table>
<div class="popup popup__addServer">
	<div class="popup-overlay"></div>
	<div class="popup-content">
		<h2>Ajouter un serveur</h2>
		<div id="msg">
		</div>
		<form action="" id="newServer" class="popup-form">
			<div>
				<label for="server_name">Nom du serveur</label>
				<input type="text" name="server_name" id="server_name">
			</div>
			<div>
				<label for="server_url">Adresse</label>
				<input type="url" name="server_url" id="server_url">
			</div>
			<div>
				<label for="server_APILink">API Link</label>
				<input type="url" name="server_APILink" id="server_APILink">
			</div>
			<div>
				<label for="server_APIkey">API Key</label>
				<input type="txt" name="server_APIkey" id="server_APIkey">
			</div>
			<button type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter</button>
		</form>
	</div>
</div>
<?php
include('template/footer.php');