<?php

require 'config.php';
require 'inc/db.class.php';
require 'inc/helper.class.php';
require 'inc/user.class.php';
require 'inc/server.class.php';
require 'inc/ndd.class.php';
require 'inc/whois.class.php';
require 'inc/category.class.php';
require 'inc/owner.class.php';

session_start();

$title = "Sites";
$current_page = 'sites';

if (!is_connected()) 
	redirection('login.php');

$allSites = ndd_select_all();

$action = inputGet('action');

include('template/header.php');
?>
<?php 
switch ($action ) {
	case 'edit':
		include('template/sites/edit.php');
	break;
	
	default:
		include('template/sites/listing.php');
	break;
}
?>
<?php
include('template/footer.php');