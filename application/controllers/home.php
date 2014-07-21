<?php

class Home extends CI_Controller{
	private $option;
	public function __construct() {
		parent::__construct();
        // $this->load->model('news');
        // $option = array();
        $login_user = check_login();
		if ($login_user) {
			$this->option['is_logged_in'] = $login_user;
		} else {
			$this->option['is_logged_in'] = false;
		}
	}

	public function index() {
		$this->option['title']  = 'Dashboard';
		$this->option['selected'] = 'homepage';
		$this->load->view('header', $this->option);
		$this->load->view('homepage');
		$this->load->view('footer');
	}
}