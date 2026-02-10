<?php
// Fichier de configuration du projet

// Configuration de l'accès à la base de données
// Exemples :
// - sur vos machines (en général, dépend de votre configuration) : 
//   DB_HOST : 127.0.0.1
//   DB-NAME : nom de la base que vous utilisez
//   DB_LOGIN : root
//   DB_PASSWORD : rien ou root (sous MAMP)
// - sur les pc des salles TP : voir ~/.my.cnf

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'tvshwows'); // nom de la base
define('DB_LOGIN', 'root'); // login (nom de l'utilisateur)
define('DB_PASSWORD', ''); // mot de passe

// BASE_URL définit le chemin vers index.php (dans le navigateur)
// Adaptez-le au chemin vers le site dans votre navigateur
// exemples :
// - avec php -S lancé dans le répertoire du projet
//       URL dans le navigateur : http://127.0.0.1/MySeries/
// - hébergement sur la machine sae : 
define('BASE_URL',"http://127.0.0.1/MySeries/");

//Rien à changer au dessous de cette ligne


// Constantes pour divers chemins
define('URL_INDEX',BASE_URL.'index.php');
define('URL_PUBLIC',BASE_URL.'public/');
define('URL_CSS',URL_PUBLIC.'css/');
define('URL_IMG',URL_PUBLIC.'img/');


// Configuration des locales et dates
$locale = 'fr_FR.UTF-8';
setlocale(LC_ALL, $locale);
setlocale(LC_TIME, $locale);
date_default_timezone_set("Europe/Paris");

define('CURRENT_DATE', $_GET['currentDate'] ?? date("Y-m-d"));
?>