<?php

function getDomainData($dns)
{
	$url = "https://api.apilayer.com/whois/query?domain=".$dns;

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$headers = array(
		"apikey: ".__WHOIS_API_KEY__,
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$resp = curl_exec($curl);
	curl_close($curl);

	$ip = gethostbyname($dns);
	$expiration_date = NULL;
	$name_servers = NULL;
	$registrat = NULL;
	$resultat = json_decode($resp,true);

	if ($resultat['result'] !== 'error') {
		$expiration_date = $resultat['result']['expiration_date'];
		$registrar = $resultat['result']['registrar'];
		$name_servers = $resultat['result']['name_servers'];

		return [
			'ip_adress' =>  filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '-' ,
			'expiration_date' => $expiration_date ,
			'registrar' =>  $registrar ,
			'server_dns' => serialize($name_servers)
		];
	} else {
		return [
			'ip_adress' =>  filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '-'
		];
	}

	
}

