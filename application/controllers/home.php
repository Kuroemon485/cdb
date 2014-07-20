<?php

class Home extends CI_Controller{
 	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        // $this->load->model('news');
        // $config = array();
    }

    public function index() {
        $config['title']  = 'Dashboard';
        $config['selected'] = 'homepage';
        $this->load->view('header', $config);
        $this->load->view('homepage');
        $this->load->view('footer');
    }
}