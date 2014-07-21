<?php

class Insert extends CI_Controller {
    private $option;
    public function __construct() {
        parent::__construct();
        $this->option['selected'] = 'admin';
        $this->option['sub_selected'] = 'database_control';
        if (is_logged_in()) {
            $this->option['is_logged_in'] = is_logged_in();
            $this->option['current_user'] = current_user();
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
        $this->option['title'] = 'Insert Pokemon';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $this->load->view('/admin/insert_pkm');
        $this->load->view('footer');
    }

    public function move($category=false) {
        $this->option['title'] = 'Insert Move';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);
        if ($category) {
            $this->option['category'] = $category;
        }

        $this->load->view('header', $this->option);
        $this->load->view('/admin/insert_move');
        $this->load->view('footer');
    }

    public function ability() {
        $this->option['title'] = 'Insert Ability';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $this->load->view('/admin/insert_ability');
        $this->load->view('footer');
    }
    public function item() {
        $this->option['title'] = 'Insert Item';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $this->load->view('/admin/insert_item');
        $this->load->view('footer');
    }
    public function news() {
        $this->option['title'] = 'News';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $this->load->view('/admin/insert_news');
        $this->load->view('footer');
    }
    public function insert_data() {
        $data = $this->input->post();
        // print_r($this->option);
        $model = $data['model'];
        $table = $data['table'];
        $insert_data = $data['data'];
        $this->load->model($model);
        // print_r($insert_this->option);
        $response = $this->$model->$table($insert_data);
        echo json_encode($response);
    }
}