<?php


define('DB_HOST', 'db');
define('DB_NAME', 'MY_DATABASE');
define('DB_LOGIN', 'shortener');
define('DB_PASSWORD', 'dfqsdfqsdfdsd1234dfs');

$base_url = getenv('BASE_URL');

if ($base_url === false){
  $PATH_INDEX = '/';

  if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
  else{
        $protocol = 'http';
  }

  if (isset($_SERVER['HTTP_HOST'])){
    $http_host = $_SERVER['HTTP_HOST'];
  } else {
    $http_host = "127.0.0.1";
  }

  define('BASE_URL',$protocol . "://" . $http_host.$PATH_INDEX);
} else {
  define('BASE_URL',$base_url);
}


  define('URL_INDEX',BASE_URL.'index.php');
  define('URL_PUBLIC',BASE_URL.'public/');
  define('URL_CSS',URL_PUBLIC.'css/');
  define('URL_IMG',URL_PUBLIC.'img/');
  define('URL_ICON',URL_PUBLIC.'icon/');


$locale = 'fr_FR.UTF-8';
setlocale(LC_ALL, $locale);
setlocale(LC_TIME, $locale);
date_default_timezone_set("Europe/Paris");

define('CURRENT_DATE', $_GET['currentDate'] ?? date("Y-m-d"));

?>
