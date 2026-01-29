<?php
// Fichier de configuration du projet

// Configuration de l'accès à la base de données
// Exemples :
// - sur vos machines (en général, dépend de votre configuration) : 
//   DB_HOST : 127.0.0.1
//   DB-NAME : nom de la base que vous utilisez
//   DB_LOGIN : root
//   DB_PASSWORD : rien ou root
// - sur les pc des salles TP : voir ~/.my.cnf
// - sur la machine 172.31.144.142 :
//   DB_HOST : 127.0.0.1
//   DB_LOGIN : groupe_xx
//   DB_NAME : groupe_xx
//   DB_PASSWORD : le mot de passe qui vous a été fourni
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'sae'); // nom de la base
define('DB_LOGIN', 'sae'); // login (nom de l'utilisateur)
define('DB_PASSWORD', 'password');


// BASE_URL définit le chemin vers index.php (dans le navigateur)
// Adaptez-le au chemin vers le site dans votre navigateur
// exemples :
// - avec php -S lancé dans le répertoire du projet
//       URL dans le navigateur : http://127.0.0.1:8000/
// - hébergement sur la machine sae : 
//       URL dans le navigateur : http://172.31.144.142/~groupe_xx/
define('BASE_URL',"http://127.0.0.1:8000/");

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