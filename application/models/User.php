<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

  public $error;

  function __construct()
  {
      parent::__construct();
      $this->load->library('session');
      $this->load->library('my_queries');
  }

  public function login(){
    $this->session->unset_userdata('userId');

    $email = $this->input->post('email'); //'vincent@email.com';
    $password = $this->input->post('password'); //'toto';

    $query = $this->my_queries->query('check_user', $_POST);

    $userId =-1;
    $last = NULL;
    if ($query->num_rows()== 0){
      $this->my_queries->query('register_user', $_POST);
      $userId = $this->my_queries->insert_id();
    } else if ($query->first_row()->password == $password){
      $userId = $query->first_row()->id;
      $last = $query->first_row()->lastVisit;
    }

    if ($userId != -1){
      $this->session->set_userdata('userId', $userId);
      $this->session->set_userdata('email',$email);
      if ($last != NULL) $this->session->set_userdata('last', $last);
    }
  }

  public function logout(){
    $this->session->unset_userdata('userId');
  }

  public function is_logged(){
    return ($this->session->has_userdata('userId'));
  }

  public function get_logged_user(){
    if ($this->session->has_userdata('userId')){
      $data = [];
      $data['id'] = $this->session->userId;
      $data['email'] = $this->session->email;
      return $data;
    } else {
      return [];
    }
  }

}
