<?php // Gestion des routes (liens entre urls et code à exécuter)

$routes = [];

define('POST','POST');
define('GET','GET');

function add_page($page,$params=[]){
  global $routes;
  $routes[] = ['name' => $page, 'type' => 'page', 'params' =>$params];
}

function add_action($action,$params=[]){
  global $routes;
  $routes[] = ['name'=> $action, 'type'=> 'action', 'params' => $params];
}

function getParam($name,$method){
  switch($method){
    case GET: $SRC = $_GET;break;
    case POST: $SRC= $_POST;break;
    default: return NULL;break;
  }
  return isset($SRC[$name]) ? $SRC[$name] : NULL;
}

function route(){
  global $routes;
  $action =  isset($_GET['action']) ? $_GET['action'] : NULL;
  $page = NULL;
  if($action !=  NULL) $log = "Action $action demandée<br>\n";// routes :".print_r($routes,true)." <br>\n";
  else {
    $page = isset($_GET['page']) ? $_GET['page'] : 'index';
  }
  if ($page!= NULL) $log = "Page $page demandée<br>\n";// routes :".print_r($routes,true)." <br>\n";

  foreach ($routes as  $route) {
  
    $name = ($route['type'] == 'action') ? $action : $page;

    if ($route['name'] == $name){
      $log .= "Test des routes pour ". print_r($route,true) ."<br> \n";
      $attr = [$route['type']=>$name, 'file'=>"application/$route[type]s/$name.php"];
    
      $valid = true;
      foreach($route['params'] as $name=>$method){
        $optionnal = $name[-1] == '?';
        if ($optionnal) $name = substr($name,0,-1);
        $value = getParam($name,$method);
        if ($value == NULL && !$optionnal){
          $log .= "Paramètre absent : $name ($method)\n\n";
          $valid = false;
          break;
        }
        if ($value != NULL) $attr[$name] = $value;
      }
      if ($valid) return $attr;
    }
  }
  $log .= "Aucune route valide trouvée.\n";
  erreur(404,$log);
}

function erreur($code,$log=""){
  global $blade;
  http_response_code($code);
  echo $blade->run("errors.$code", ['log'=>$log]);
  exit();
}

function check_route_url($params_get){
  global $routes;
  $log = '';
  foreach ($routes as  $route) {
    $type = $params_get[$route['type']] ?? null;
    if ( $type != $route['name'] ) continue;
    $route_is_ok = true;
    $acceptable = [$route['type']];
    foreach($route['params'] as $name=>$method){
      if ($method == GET){
        $optionnal = $name[-1] == '?';
        if ($optionnal) $name = substr($name,0,-1);
        else {
          if (!array_key_exists($name,$params_get)){
            $log .= "Route $route[name] : Paramètre obligatoire $name non précisé \n";
            $route_is_ok = false;
            break;
          }
        }
        $acceptable[] = $name;
      }
    }
    if ($route_is_ok) return array_intersect_key($params_get, array_flip($acceptable)); 
  }
  if ($log == '') $log = "Aucune route trouvée pour les paramètres : ".print_r($route,true)."\n";
  throw new Exception($log);
}

function url_page($page = 'index',$params_get=[]){
  $params_get['page'] = $page;
  $params = check_route_url($params_get);
  return URL_INDEX.'?'.http_build_query($params,'','&');
}

function url_action($action,$params_get=[]){
  $params_get['action'] = $action;
  $params = check_route_url($params_get);
  return URL_INDEX.'?'.http_build_query($params,'','&');
}

function redirect($page='index', $params_get=[], $part=null){
  if ($part===null) header("Location: ".url_page($page,$params_get));
  else header("Location: ".url_page($page,$params_get)."#$part");
}

?>
