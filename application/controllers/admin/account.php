<?php

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
    }
    public function competition_db_admin_login() {
        $login_user = $this->input->cookie('login_user');
        if ($login_user) {
            redirect('', 301);
        } else {
            $config['title'] = "Admin Login";
            $config['selected'] = "admin";
            $config['sub_selected'] = "login";
            $config['is_logged_in'] = false;
            $config['account_script'] = $this->load->view('admin/account_script', null, true);
            $this->load->view('header', $config);
            $this->load->view('admin/login.php');
            $this->load->view('footer');
        }
    }
    public function login_verify() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');
        $response = $this->user_model->verify_login_user($username, $password);
        if ($response->status == "success") {
            // echo "setting cookies";
            $cookie = array(
                'name'   => 'login_user',
                'value'  => $username,
                'expire' => '86500',
            );
            $this->input->set_cookie($cookie);
            // echo "cookies has been set";
        }
        echo json_encode($response);
    }
    public function logout() {
        // echo "setting cookies";
        $cookie = array(
            'name'   => 'login_user',
            'value'  => $username,
            'expire' => '-86500',
        );
        $this->input->set_cookie($cookie);
        // echo "cookies has been set";
        redirect('admin/account/competition_db_admin_login', 301);
    }
}
