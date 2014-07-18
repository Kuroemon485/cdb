<?php
/**
 * Author: Quang Pham
 * File: homepage.php
 * Date: 4/15/14
 * Time: 4:46 PM
 */

class Home extends CI_Controller{

    public function index() {
        $data = array();

        $data['title']  = 'Dashboard';
        $data['selected'] = 'homepage';
        $this->load->helper('url');
        $this->load->view('header', $data);
        $this->load->view('homepage');
        $this->load->view('footer');
    }
}