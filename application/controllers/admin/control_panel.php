<?php

class Control_Panel extends CI_Controller {
    private $option;
    public function __construct() {
        parent::__construct();
        if (is_logged_in()) {
            $this->option['is_logged_in'] = is_logged_in();
            $this->option['current_user'] = current_user();
        } else {
            show_404();
        }
    }

    public function database() {
        $this->option['title'] = 'Database Controllers';
        $this->option['selected'] = 'admin';
        $this->option['sub_selected'] = 'database_control';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $this->load->view('/admin/data_controllers');
        $this->load->view('footer');
    }
}