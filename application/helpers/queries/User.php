<?php
require_once 'application/helpers/My_queries.php';

function login($email,$password){
    unset($_SESSION['userId']);

    $query = query('check_user', compact('email','password'));

    $userId =-1;
    $last = NULL;

    $response = $query->fetch();

    if ($response === false){ // nouvel utilisateur, on enregistre
      query('register_user', compact('email','password'));
      $userId = get_pdo()->lastInsertId();
    } else if ($response['ok']){
      $userId = $response['id'];
      $last = $response['lastVisit'];
      query('update_visit', ['id'=>$userId]);
    } else {
      var_dump($response);
    }

    if ($userId != -1){
      $_SESSION['userId'] =  $userId;
      $_SESSION['email'] = $email;
      $_SESSION['lastVisit'] = $last;
    }
  }

  function logout(){
    session_destroy();
  }

  function is_logged(){
    return isset($_SESSION['userId']);
  }

  function get_logged_user(){
    if (is_logged()){
      $data = [];
      $data['id'] = $_SESSION['userId'];
      $data['email'] = $_SESSION['email'];
      $data['lastVisit'] = $_SESSION['lastVisit'];
      return $data;
    } else {
      return [];
    }
  }

  function follow($value,$idSerie){
    if (!is_logged()) return;
    query(($value == "true" ? 'follow' : 'unfollow'),
        ['idUser' => $_SESSION['userId'], 'idSerie'=>$idSerie]);
  }


