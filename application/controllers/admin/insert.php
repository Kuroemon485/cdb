<?php

class Insert extends CI_Controller {
    private $option;
    public function __construct() {
        parent::__construct();
        $is_logged_in = check_login();
        if ($is_logged_in) {
            $this->option['is_logged_in'] = $is_logged_in;
            $this->load->model('ability_model');
            $this->load->model('pokemon_model');
            $this->load->model('move_model');
            $this->load->model('item_model');
        } else {
            show_404();
        }
    }

    public function index() {
        redirect('admin/insert/pokemon', 301);
    }

    public function pokemon() {
        $this->load->model('ability_model');
        $this->load->model('move_model');
        $this->option = array();
        $this->option['title'] = 'Insert Pokemon';
        $this->option['selected'] = 'insert_datanbase';
        $this->option['sub_selected'] = 'insert_pkm';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $this->load->view('/admin/insert_pkm');
        $this->load->view('footer');
    }

    public function move($category=false) {
        $this->load->model('move_model');
        $this->option = array();
        $this->option['title'] = 'Insert Move';
        $this->option['selected'] = 'insert_database';
        $this->option['sub_selected'] = 'insert_move';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);
        if ($category) {
            $this->option['category'] = $category;
        }

        $this->load->view('header', $this->option);
        $this->load->view('/admin/insert_move');
        $this->load->view('footer');
    }

    public function ability() {
        $this->load->model('ability_model');
        $this->option = array();
        $this->option['title'] = 'Insert Ability';
        $this->option['selected'] = 'insert_database';
        $this->option['sub_selected'] = 'insert_ability';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $this->load->view('/admin/insert_ability');
        $this->load->view('footer');
    }
    public function item() {
        $this->load->model('item_model');
        $this->option = array();
        $this->option['title'] = 'Insert Item';
        $this->option['selected'] = 'insert_database';
        $this->option['sub_selected'] = 'insert_item';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $this->load->view('/admin/insert_item');
        $this->load->view('footer');
    }
    public function insert_this->option() {
        $this->option = $this->input->post();
        // print_r($this->option);
        $model = $this->option['model'];
        $to_do = $this->option['func'];
        $insert_this->option = $this->option['this->option'];
        $this->load->model($model);
        // print_r($insert_this->option);
        $response = $this->$model->$to_do($insert_this->option);
        echo json_encode($response);
    }
}