<?php

require 'config.php';
require 'inc/db.class.php';
require 'inc/helper.class.php';
require 'inc/user.class.php';
require 'inc/server.class.php';
require 'inc/ndd.class.php';
require 'inc/whois.class.php';

$title = "Documentation";
$current_page = 'doc';


session_start();

if (!is_connected()) 
	redirection('login.php');

include('template/header.php');
?>
<div class="page_header-with-action">
	<h1 class="page-title">Documentation</h1>
	<p>A reproduire sur chaque lune</p>
</div>
<div>
	<h2>1. Fichiers à mettre en place</h2>
	Dépuis le menu <strong>Gestionnaire de fichiers</strong> ou le <strong> compteFTP</strong>
	<h3>1.1. Dossier racine</h3>
	<ol>
		<li>Créer un dossier <strong>domain-data</strong></li>
		<li>Créer un fichier vide <strong>list-domaine.json</strong></li>
	</ol>
	<img src="/assets/images/1-dossier.jpg">
	<h3>1.2. Dossier <code>public_html</code></h3>
	<ol>
		<li>Mettre le fichier htaccess avec <strong>Options -Indexes</strong> pour désactivé index of</li>
		<li>A partir de ce <a href="downloads/template-api.txt" target="_blank">fichier</a>, génerer un fichier <code>.php</code> avec un nom aléatoire et remplacer <code>{{APIKey}}</code> avec une chaine de caractère assez long (Outils <a href="https://prnt.sc/epsxQez0lHac" target="_blank">Générateur de mots de pass LastPass</a>)</li>
		<li>Uploader le fichier génerér</li>
	</ol>
	<img src="/assets/images/2-dossier.jpg">

	<h2>2. Tâche cron</h2>
	<ul>
		<li>Sur menu <strong>Avancé >Tâches Cron</strong></li>
	</ul>
	<img src="/assets/images/1-tache-cron.jpg">
	<ul>
		<li>Ajouter <strong>une nouvelle tâche</strong> (Tous les 5 minutes) : <code>uapi DomainInfo domains_data --output=json > domain-data/list-domaine.json</code></li>
	</ul>
	<img src="/assets/images/2-formulaire-tache-cron.jpg">
	<code>
	</code>

	<h2>3. Ajouter le serveur sur Board</h2>
	<p>Serveurs > <strong>Ajouter un serveur</strong></p>
	<ol>
		<li>Nom du serveur</li>
		<li>Adresse : Lien vers CPanel</li>
		<li>API Link : Lien accéssible du fichier PHP générer</li>
		<li>API Key : Clé API générer</li>
	</ol>
	<img src="/assets/images/3-formulaire-ajout-serveur.jpg">

</div>


<?php
include('template/footer.php');