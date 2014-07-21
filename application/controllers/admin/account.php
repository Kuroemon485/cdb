<?php
    
class Account extends CI_Controller {
    private $option;
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->option['is_logged_in'] = is_logged_in();
        if (is_logged_in()) {
            $this->option['current_user'] = current_user();
        }
    }
    public function competition_db_admin_login() {
        if (is_logged_in()) {
            redirect('', 301);
        } else {
            $this->option['title'] = "Admin Login";
            $this->option['selected'] = "admin";
            $this->option['sub_selected'] = "login";
            $this->option['current_user'] = current_user();
            $this->option['account_script'] = $this->load->view('admin/account_script', null, true);
            $this->load->view('header', $this->option);
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
            set_cookie($cookie);
            // echo "cookies has been set";
        }
        echo json_encode($response);
    }
    public function logout() {
        // echo "setting cookies";
        delete_cookie('login_user');
        // echo "cookies has been set";
        redirect('admin/account/competition_db_admin_login', 301);
    }
    
}
