<?php
require_once 'application/helpers/queries/User.php';
require_once 'application/helpers/queries/Serie.php';
require_once 'application/helpers/image_cache.php';

require_query('get_serie');

$saison = $saison ?? 1;
$data = get_logged_user();

$data['serie'] = get_serie($idSerie);
$data['genre'] = get_genre($idSerie);
$data['cast']  = get_cast($idSerie);
$data['crew']  = get_crew_list($idSerie);
$season = get_season_list($idSerie);
//$data['season'] = $season;
$data['episode'] = get_episode_list($idSerie,$saison);
$data['next']    = get_next_episode($idSerie);
$data['saison']  = $saison;

$current_season = [];
$nav_saison = [];
$previous=0;
foreach($season as $element){
  if ($element['saison'] == $saison) $current_season = $element;
  $delta = $element['saison'] - $saison;
  if($element['saison'] <2 || ($delta>= -2 && $delta<=2) || $element['saison']>count($season)-2){
    if ($previous+1 != $element['saison']) $nav_saison[]  =  null;
    $previous = $element['saison'];
    $nav_saison[] = $element['saison'];
    // [ ($delta==0) ? 'active':'' , $element['saison'] ];
     //   url_page('serie',['idSerie'=>$serie['id'], 'saison'=>$element['saison']]) ]
  }
}
$data['nav_saison'] = $nav_saison;
$data['last_saison'] = $previous;

$debut = $current_season['debut'] ?? 0;
$description_saison = "";
if ($debut != 0){
        $nb = $current_season['nb'] ?? 0;
        $description_saison .= substr($debut,0,4).' ('.$nb.' episodes)';
        if (isset($saison['total'])) {
                $total = explode(':',$saison['total']);
                $heures = $total[0]+0;
                $minutes = $total[1]+0;
                $description_saison .= " $heures heures $minutes minutes";
        }
}
$data['description_saison'] = $description_saison;

echo $blade->run('serie',$data);