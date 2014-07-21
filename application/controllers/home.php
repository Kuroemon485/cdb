<?php

class Home extends CI_Controller{
	private $option;
	public function __construct() {
		parent::__construct();
        // $this->load->model('news');
        // $option = array();
		$this->option['is_logged_in'] = is_logged_in();
		if (is_logged_in()) {
			$this->option['current_user'] = current_user();
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