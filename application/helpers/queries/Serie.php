<?php
require_once 'application/helpers/My_queries.php';

function get_all_series($limit,$last){
  $query = query('get_all_series', ['limit' => $limit, 'lastVisit' => $last]);
  return $query == null ? [] : $query->fetchAll();
}

function get_by_genre($genre,$last){
  $query = query('get_series_by_genre', ['genre' => $genre, 'lastVisit' => $last]);
  return $query == null ? [] : $query->fetchAll();
}

function get_all_categories(){
  $query = query('get_all_categories', []);
  return $query == null ? [] : $query->fetchAll();
}

function watched($vu, $idEpisode){
  $query = query($vu ? 'watched' : 'unwatched',
    ['idUser'=>$_SESSION['userId'],  'idEpisode' => $idEpisode]);
}


function get_followed(){
  $query = query('get_followed_series', $_SESSION);
  $series = $query != null ? $query->fetchAll() : [];
  $result = [];
  for($i=0;$i<count($series);$i++){
    $result[$series[$i]['id']] = $series[$i];
  }

  $query = query('get_next_episode_user', $_SESSION);
  $episodes = $query != null ? $query->fetchAll() : [];
  for($i=0;$i<count($episodes);$i++){
    $result[$episodes[$i]['idSerie']]['episode'][] = $episodes[$i];
  }
  return $result;
}


function get_serie($id){
  $query = query('get_serie', ['id' => $id]);
  if ($query==NULL) return NULL;
  $result = $query->fetch();
  if (is_logged()){
    $query = query('isFollowing',
      ['idUser'=>$_SESSION['userId'] ,'idSerie' => $id]);
    $result['follow'] = $query != null && count($query->fetchAll())>0;
  }
  return $result;
}

function get_genre($id){
  $query = query('get_genre', ['id' => $id]);
  return $query == null ? [] : $query->fetchAll();
}

function get_cast($id){
  $query = query('get_cast', ['id' => $id]);
  return  $query == null ? [] : $query->fetchAll();
}

function get_season_list($id){
  $query = query('get_season_list', ['id' => $id]);
  return $query == null ? [] : $query->fetchAll();
}

function get_episode_list($id,$saison){
  $data = ['id' => $id, 'saison' => $saison];
  if (is_logged() && has('get_episode_list_vu')){
    $data['userId'] = $_SESSION['userId'];
    $name ='get_episode_list_vu';
  } else {
    $name ='get_episode_list';
  }
  $query = query($name, $data);
  return  $query == null ? [] : $query->fetchAll();
}

function get_next_episode($id){
  $query = query('get_next_episode', ['id' => $id]);
  if ($query==NULL) return NULL;
  return  $query->fetch();
}

function get_crew_list($id){
  $query = query('get_crew_list', ['id' => $id]);
  return  $query == null ? [] : $query->fetchAll();
}


