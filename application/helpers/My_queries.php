<?php
require_once 'application/core/database.php';

// chargement des requêtes définies dans application/config/query.sql;
  global $queries;
  $queries = [];
  $query_file = 'application/config/query.sql';
  $data = file($query_file);

  $current_key = NULL;
  $query = "";
  foreach($data as $line){
// On cherche les lignes de la forme ### key
    if (preg_match('/### (\w+)/',$line,$key)){
      $current_key = $key[1];
// On initialise la requête à vide
      $queries[$current_key] = '';
    } else if ($current_key!=NULL && strlen($line)>0 && $line[0]!=='#'){
// Tout ce que l'on trouve après une clef, non vide et noncommenté
// est ajouté à la requête correspondante
      $queries[$current_key] .= $line;
    }
  }
  

 function query($name, $data){ // un peu de magie...
    // Cette fonction exécute la requête dont le nom est donné
    // Les paramètres nécessaires sont pris dans $data
    // Les requêtes dont définies dans un fichier de configuration
    // (voir le constructeur pour les détails)
    global $queries;

    // On récupère la requête brute, avec des :champs dedans
      $sql_query = $queries[$name];
    // Il faut maintenant la réécrire avec de ?, et fournir
    // le tableau de valeurs (dans l'ordre) correspondant à chaque paramètre

    // Motif de recherche (multiligne) :quelquechose
      $pattern= '/:(\w+)/m';

    // On demande toutes les correspondances
      preg_match_all($pattern,$sql_query,$params,PREG_PATTERN_ORDER);
    // Pour chaque correspondance, on extrait de $data la valeur,
      $param = [];
      foreach($params[1] as $p){
        $param[] = $data[$p];
      }

    // On remplace maintenant les :param de la requête par des ?
      $sql_query = preg_replace($pattern,'?',$sql_query);

      if (strlen(trim($sql_query))==0) { // Si la requête n'a pas encore été écrite
        return null; //show_error("requete absente : $name");
      }
      // On exécute la requête modifiée, en passant le tableau de paramètres
      $pdo = get_pdo();

      try {
        $query = $pdo->prepare($sql_query);
        $query->execute($param);
        return $query;
      } catch (Exception $e){
        erreur(500,"<h2>Erreur dans la requête $name</h2>
        <p>Requète récupérée :</p>
        <code><pre>$sql_query</pre></code>
        <p>Paramètres disponibles :</p>
        <pre>".print_r($data,true)."</pre>
        <p>Détail de l'erreur :</p>
        <pre>".$e->getMessage()."</pre>");
      }
      /*
	    $query = $this->CI->db->query($sql_query, $param);

    // retour du résultat
      return $query;
      */
  }


 function has($name){
    global $queries;
    return isset($queries[$name]) && strlen(trim($queries[$name]))>0;
  }

  function require_query($name){
    global $queries;
    if (!isset($queries[$name])){
        erreur(500,"Requete non trouvée : $name\n".
                  "Vous avez probablement supprimé le commentaire correspondant ".
                  "dans le fichier 'query.sql'");
    }
    $sql_query = $queries[$name];
    if (strlen(trim($sql_query))==0) {
      erreur(500,"Désolé, la requête '$name' est nécessaire au bon fonctionnement de cette page");
    }
  }

  /*
  public function update_serie($id){
    $path=APPPATH.'helpers';
    exec("cd $path;node db_update.js '# $id'",$result);

    $commands = explode(";\n",join("\n",$result));
    foreach($commands as $command){
      $this->CI->db->simple_query($command.';');
    }
  }*/

    /*
  public function search_serie($query){
    $path=APPPATH.'helpers';
    exec("cd $path;node db_update.js '$query'",$result);
    return json_decode(join("\n",$result));
  }
*/
