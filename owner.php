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
$current_page = 'owner';

if (!is_connected()) 
	redirection('login.php');

$action = inputGet('action');

include('template/header.php');
?>
<?php 
switch ($action ) {
	case 'add':
		include('template/owner/add.php');
	break;
	
	case 'edit':
		include('template/owner/edit.php');
	break;
	
	default:
		include('template/owner/listing.php');
	break;
}
?>
<?php
include('template/footer.php');