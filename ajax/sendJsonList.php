<?php


$password =  'Qgj4TdFed4GH';

$postdata = http_build_query($_GET);

if ($postdata) {
    if ($_GET['key'] !== $password) 
        die();
}

else {
    die();
}


$data = file_get_contents('../../domain-data/list-domaine.json');
$data = json_decode($data,true);
$subdomaine = $data['result']['data']['addon_domains'];

$list = [];
foreach ($subdomaine as $item) {
  $list[] = $item["domain"];
}

$list = json_encode($list);

echo $list;
