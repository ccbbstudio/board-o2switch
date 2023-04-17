<?php

require '../config.php';
require '../inc/db.class.php';
require '../inc/helper.class.php';
require '../inc/user.class.php';
require '../inc/server.class.php';
require '../inc/ndd.class.php';
require '../inc/whois.class.php';

session_start();
if (!is_connected()) 
	redirection('login.php');

$response = [];

$name = isset($_POST['server_name']) ? $_POST['server_name'] : '';
$url = isset($_POST['server_url']) ? $_POST['server_url'] : '';
$APILink = isset($_POST['server_APILink']) ? $_POST['server_APILink'] : '';
$APIkey = isset($_POST['server_APIkey']) ? $_POST['server_APIkey'] : '';

if ($name && $url && $APILink && $APIkey ) {
	if (filter_var($APILink, FILTER_VALIDATE_URL) && filter_var($url, FILTER_VALIDATE_URL)) {
		if (!server_exist($name, $url)) {

			$apiPath = "$APILink?key=$APIkey";
			$data = file_get_contents($apiPath);
			
			if (get_http_response_code($apiPath) == 200) {

				$serverID = server_add($name, $url);

				server_meta_add($serverID, 'apiURL', $APILink);
				server_meta_add($serverID, 'apiKey', $APIkey);


				if (isJson($data)) {
					$data = json_decode($data);
					foreach ($data as $item) {
						$nddID = ndd_add($item, $serverID);
						$getnddData = getDomainData($item);

						foreach ($getnddData as $key => $value) {
							ndd_meta_add($nddID, $key, $value);
						}
					}
				}


				$response['success'] = true;
				$response['msg'] = '<div class="msg-success">Ajout server success</div>';

			} else {
				$response['success'] = false;
				$response['msg'] = '<div class="msg-error">L\'API ne reponds pas</div>';
			}

		} else{
			$response['success'] = false;
			$response['msg'] = '<div class="msg-error">Serveur existe déjà</div>';
		}
	} else {
		$response['success'] = false;
		$response['msg'] = '<div class="msg-error">Liens URL et/ou API non validées</div>';
	}
} else{
	$response['success'] = false;
	$response['msg'] = '<div class="msg-error">Tous les champs sont obligatoires</div>';
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);