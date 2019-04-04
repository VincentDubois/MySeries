<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends CI_Controller {
/*
	public function index()
	{
		$this->load->model('user');
		$this->load->model('serie');
		$data=$this->user->get_logged_user();
		$data['serie_list'] = $this->serie->get_all(12);

		$this->load->view('header',$data);
		$this->load->view('gallery',$data);
		$this->load->view('footer');
	}*/

	public function detail($id_serie)
	{
    $this->load->model('user');
    $this->load->model('serie');
	  $data=$this->user->get_logged_user();

		$data['serie'] = $this->serie->get($id_serie);

    $this->load->view('header',$data);
		$this->load->view('serie',$data);
		$this->load->view('footer');
	}


}
