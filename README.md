# board-o2switch
 
## 1. Requirement
- Compte API Layer (gratuit pour 3000 Requests mois) sur https://apilayer.com/marketplace/whois-api et 
récupérer le clé API
- BDD
## 2. board.sql
Crée un BDD et importer le fichier  via PHPMyAdmin


## 3. config.php

```php
define('BOARD_NAME', ''); // Nom afficher comme logo

define('DB_HOST', 'localhost'); // Host BDD
define('DB_NAME', ''); // Nom de la BDD
define('DB_USER', ''); // Utilisateur
define('DB_PASSWORD', ''); // Mots de pass d'utilisateur

define('__WHOIS_API_KEY__', ''); // Clé API (API Layer)
```

## 4. Vous pouvez connecter à present :
- Identifiant : root
- Mots de passe : azertyuiop1A
- Possibilité de mettre à jour le pass ou crée un utilisateur sur PHPMyAdmin table : user (cryptage mots de passe : MD5)