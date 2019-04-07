<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends CI_Controller {


	public function detail($id_serie,$saison)
	{
    $this->load->model('user');
    $this->load->model('serie');
	  $data=$this->user->get_logged_user();

		$data['serie'] = $this->serie->get($id_serie);
		$data['cast'] = $this->serie->get_cast($id_serie);
		$data['crew'] = $this->serie->get_crew_list($id_serie);
		$data['season'] = $this->serie->get_season_list($id_serie);
		$data['episode'] = $this->serie->get_episode_list($id_serie,$saison);
		$data['saison'] = $saison;

    $this->load->view('header',$data);
		$this->load->view('serie',$data);
		$this->load->view('footer');
	}


}
