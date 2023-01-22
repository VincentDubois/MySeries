<?
define('BASEPATH', "..");
define('ENVIRONMENT', "production");
include "../application/config/database.php";
//var_dump($db['default']);
extract($db['default']);

try {

	// On essaie de créer une instance de PDO.
	$pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
	echo "Erreur : ".$e->getMessage()."<br />";
}

$keep = ['medium_portrait.png','medium_landscape.png'];

cache_table('serie','urlImage','portrait');
cache_table('episode','urlImage','landscape');
//cache_table('personnage','urlImage','portrait');
//cache_table('personne','urlImage','portrait');

if (isset($_GET["delete"])){
	$dir = scandir('../public/img');
	$diff = array_diff($dir,$keep);
	echo count($dir).' '.count($keep).' '.count($diff);
	echo "\n<br>Deleted files : <br>\n";
	foreach ($diff as $filename){
		if (substr( $filename, 0, 7 ) === "medium_"){
			echo "$filename <br>\n";
			unlink("../public/img/$filename");
		}
	}
}



function cache_table($table, $field){
  global $pdo;

  $sql = "SELECT id,$field FROM $table";
//  echo "$sql\n";
  $query = $pdo->prepare($sql); // Etape 1 : Préparation de la requête
  $query->execute();  // Etape 2 : exécution de la requête
  while($line = $query->fetch()) {
//    $id = $line['id'];
    $url = $line[$field];
    $path = cache_image($url);
//    if ($path != $url){
//      update_table($table,$id,$field,$path);
//    }
//    echo "[$table] $id: $path \n";
  }
}

function update_table($table, $id, $field, $path){
  global $pdo;

  $sql = "UPDATE $table SET $field=\"$path\" WHERE id=$id";
  echo $sql."\n";
  $query = $pdo->prepare($sql); // Etape 1 : Préparation de la requête
  $query->execute();  // Etape 2 : exécution de la requête
}


function url_to_path($url,$default = 'portrait'){
  if ($url==NULL) return 'img/medium_'.$default.'.png';
  if(preg_match('[https?://static.tvmaze.com/uploads/images/(.+)]i', $url,$result)) {
    $path = $result[1];
    $path = str_replace('/','_',$path);
		global $keep;
		$keep[] = $path;
    $path = 'img/'.$path;
		return $path;
  }
  return $url;
}

function my_copy($url,$file){
echo "Download: $url -> $file <br>\n";

// open file descriptor
$fp = fopen ($file, 'w+') or die('Unable to write a file');
// file to download
$ch = curl_init($url);
// enable SSL if needed
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// output to file descriptor
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// set large timeout to allow curl to run for a longer time
curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
curl_setopt($ch, CURLOPT_USERAGENT, 'any');
// Enable debug output
curl_setopt($ch, CURLOPT_VERBOSE, false);
curl_exec($ch);
curl_close($ch);
fclose($fp);

sleep(1);
return file_exists($file);
}

function cache_image($url,$default='portrait'){
  $path = "../public/".url_to_path($url,$default);
  if ($path == $url) return $url;

  if ($path !== null && $path !== '' &&
    (file_exists($path)||my_copy($url,$path))) return $path;
  return $url;
}

function cache_src($url,$portrait=true){
  $default = $portrait ? 'portrait' : 'landscape';
  echo 'src="'.cache_image($url,$default).'" ';
}

?>
