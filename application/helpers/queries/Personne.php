<?php
require_once 'application/helpers/My_queries.php';

  function get_personne($id){
    $query = query('get_person', ['id' => $id]);
    return $query->fetch();
  }

  function get_actor_role($id){
    $query = query('get_actor_role', ['id' => $id]);
    return $query== null ? [] : $query->fetchAll() ;
  }

  function get_crew_role($id){
    $query = query('get_crew_role', ['id' => $id]);
    return $query==null ? [] : $query->fetchAll();
  }

  function get_series_personne($id){
    $result = [];

    $role = get_actor_role($id);
    for($i=0; $i<count($role);$i++){
      if (!isset($result[$role[$i]['s_id']])) $result[$role[$i]['s_id']]=$role[$i];
      $result[$role[$i]['s_id'] ]['character'][] = $role[$i];
    }

    $crew = get_crew_role($id);
    for($i=0; $i<count($crew);$i++){
      if (!isset($result[$crew[$i]['s_id']])) $result[$crew[$i]['s_id']]=$crew[$i];
      $result[$crew[$i]['s_id'] ]['crew'][] = $crew[$i];
    }

    return $result;
  }

/*  public function get_season_list($id){
    $query = $this->my_queries->query('get_season_list', ['id' => $id]);
    return $query->result();
  }

  public function get_episode_list($id,$saison){
    $query = $this->my_queries->query('get_episode_list', ['id' => $id, 'saison' => $saison]);
    return $query->result();
  }

  public function get_crew_list($id){
    $query = $this->my_queries->query('get_crew_list', ['id' => $id]);
    return $query->result();
  }
*/

