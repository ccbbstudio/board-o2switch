<?php

require 'config.php';
require 'inc/db.class.php';
require 'inc/helper.class.php';
require 'inc/user.class.php';
require 'inc/server.class.php';
require 'inc/ndd.class.php';
require 'inc/whois.class.php';

$title = "Accueil";
$current_page = 'home';

session_start();

if (!is_connected()) 
	redirection('login.php');
else
	redirection('server.php');

include('template/header.php');
?>

<?php
include('template/footer.php');
