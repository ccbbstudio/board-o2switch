<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?> | StudioCCBB</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,600;1,300;1,600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://cdnjs.cloudflare.com">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/app-theme.css">
	
</head>
<body>
	<!-- header -->
	<header class="header">
		<div>
			<h1 class="logo"><?= BOARD_NAME ?></h1>
			<nav>
				<ul class="menu">
					<li class="menu-item"><a href="/" class="<?= $current_page == 'home' ? 'active' : ''; ?>"><i class="fa fa-home" aria-hidden="true"></i><span>Accueil</span></a></li>
					<li class="menu-item"><a href="/server.php" class="<?= $current_page == 'server' ? 'active' : ''; ?>"><i class="fa fa-server" aria-hidden="true"></i><span>Serveurs</span></a></li>
					<li class="menu-item has-child">
						<a href="{"> <i class="fa fa-globe" aria-hidden="true"></i><span>Sites</span></a>
						<ul>
							<li><a class="<?= $current_page == 'sites' ? 'active' : ''; ?>"  href="/sites.php">Tous les sites</a></li>
							<li><a class="<?= $current_page == 'category' ? 'active' : ''; ?>" href="/categorie.php">Catégories</a></li>
						</ul>
					</li>
					<li class="menu-item"><a href="/owner.php" class="<?= $current_page == 'owner' ? 'active' : ''; ?>"><i class="fa fa-id-card" aria-hidden="true"></i> Propriétaires</a></li>
					<li class="menu-item"><a href="/documentation.php" class="<?= $current_page == 'doc' ? 'active' : ''; ?>"><i class="fa fa-code" aria-hidden="true"></i> <span>Documentations</span></a></li>
					
				</ul>
			</nav>
		</div>
		<div class="user-widget">
			<div class="user-widget--card">
				<div class="user-widget--img">
					<img src="https://placehold.co/60x60" alt="<?= $_SESSION["username"] ?>">
				</div>
				<div class="user-widget--content">
					<span>@<?= $_SESSION["username"] ?></span>
					<span>Administrateur</span>
				</div>
			</div>
			<div>
				<ul class="user-menu">
					<!-- <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i><span>Paramètres</span></a></li>  -->	
					<li><a href="/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Déconnexion</span></a></li>
				</ul>
			</div>
		</div>
	</header>
	<!-- /header -->
