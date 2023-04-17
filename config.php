<?php

header("Cache-Control:no-cache");

/* sitename */
define('BOARD_NAME', '');

/* developement mode */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Database */
define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');


/* whois */
define('__WHOIS_API_KEY__', '');
