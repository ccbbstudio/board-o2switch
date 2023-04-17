<?php

require 'config.php';
require 'inc/db.class.php';
require 'inc/helper.class.php';
require 'inc/user.class.php';

$msg = '';
session_start();
if (is_connected()) 
	redirection('/');

if (isset($_POST['username']) && isset($_POST['password'])) {
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$login = trim($_POST['username']);
		$password = trim($_POST['password']);
		if (!user_exist($login, $password)) {
			$msg = 'Mots de passe ou login erronee';
		} else {
			$_SESSION["username"] = $login;
			$_SESSION["sessionID"] = true;
			redirection('/');
		}
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,600;1,300;1,600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://cdnjs.cloudflare.com">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body class="form-body">
	<div class="form-ctn">
		<h1><?= BOARD_NAME ?></h1>
		<form action="" class="form" method="post">
			<?php echo $msg ?>
			<div>
				<input type="text" name="username">
			</div>
			<div>
				<input type="password" name="password">
			</div>
			<div>
				<button type="submit">Connexion</button>
			</div>
		</form>
		<div class="form-footer">
			Studio CCBB &copy; <?= date('Y') ?>
		</div>
	</div>
	
</body>
</html>