<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {


	public function detail($id_personne)
	{
    $this->load->model('user');
    $this->load->model('personne');
	  $data=$this->user->get_logged_user();

		$data['personne'] = $this->personne->get($id_personne);
		$data['serie'] = $this->personne->get_series($id_personne);
/*		$data['crew'] = $this->serie->get_crew_list($id_serie);
		$data['season'] = $this->serie->get_season_list($id_serie);
		$data['episode'] = $this->serie->get_episode_list($id_serie,$saison);
		$data['saison'] = $saison;*/

    $this->load->view('header',$data);
		$this->load->view('personne',$data);
		$this->load->view('footer');
	}


}
