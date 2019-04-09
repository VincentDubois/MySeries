<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('user');
		$this->load->model('serie');
		$data=$this->user->get_logged_user();
		$lastVisit = isset($data['lastVisit']) ? $data['lastVisit'] : NULL;
		if ($lastVisit==NULL || $lastVisit=='') $lastVisit=date('Y-m-d',strtotime('-7 day'));
		echo $lastVisit;
		$data['serie_list'] = $this->serie->get_all(30,$lastVisit);

		$this->load->view('header',$data);
//		$this->load->view('welcome_message');
		$this->load->view('gallery',$data);
		$this->load->view('footer');
	}

	public function login()
	{
		$this->load->model('user');
		$this->user->login();

		$this->index();
	}

	public function logout()
	{
		$this->load->model('user');
		$this->user->logout();

		$this->index();
	}

}
