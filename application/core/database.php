<?php //Connexion à la base (création de $pdo)

function get_pdo()
{
    static $pdo = null;
    if ($pdo === null) {

		$MYSQL_HOST = DB_HOST;
		$MYSQL_DATABASE =DB_NAME;
		$MYSQL_USER =  DB_LOGIN;
		$MYSQL_PASSWORD =  DB_PASSWORD;

		try {
			// On essaie de créer une instance de PDO.
			$pdo = new PDO("mysql:host=$MYSQL_HOST;dbname=$MYSQL_DATABASE", $MYSQL_USER, $MYSQL_PASSWORD,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false );
		}
		catch(Exception $e) {
			erreur(500,"<h2>Echec de la connexion à la base de données</h2>
			Paramètres de la connexion :<pre>".print_r(compact('MYSQL_HOST', 'MYSQL_DATABASE', 'MYSQL_USER', 'MYSQL_PASSWORD'),true)
			."</pre>Message d'erreur reçu : <pre>\n ".$e->getMessage()."</pre>");
		}
	}
	return $pdo;
}

//get_pdo();


 ?>
