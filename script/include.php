<?php define("BASEPATH",'.');
define("ENVIRONMENT","production");
include '../application/config/database.php';
$db = $db["default"];
//var_dump($db);
$host = $db['hostname'];
$database = $db['database'];
$user = $db['username'];
$passwd = $db['password'];
try {
	// On essaie de créer une instance de PDO.
	$pdo = new PDO("mysql:host=$host;dbname=$database", $user, $passwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
	echo "Erreur : ".$e->getMessage()."<br />";
}
?>
