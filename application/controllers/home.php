<?php

class Home extends CI_Controller{
 	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        // $this->load->model('news');
        // $config = array();
    }

    public function index() {
    	$login_user = $this->input->cookie('login_user');
    	if ($login_user) {
            $config['is_logged_in'] = true;
            $config['user'] = $login_user;
    	} else {
    		$config['is_logged_in'] = false;
    	}
        $config['title']  = 'Dashboard';
        $config['selected'] = 'homepage';
        $this->load->view('header', $config);
        $this->load->view('homepage');
        $this->load->view('footer');
    }
}