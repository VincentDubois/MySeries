<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {


	public function detail($id_personne)
	{
		$this->load->library('my_queries');
    $this->load->model('user');
    $this->load->model('personne');
	  $data=$this->user->get_logged_user();

		$this->my_queries->require('get_person');

		$data['personne'] = $this->personne->get($id_personne);
		$data['serie'] = $this->personne->get_series($id_personne);

    $this->load->view('header',$data);
		$this->load->view('personne',$data);
		$this->load->view('footer');
	}


}
