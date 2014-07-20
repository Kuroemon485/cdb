<?php

class Insert extends CI_Controller
{

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
    }

    public function index() {
        redirect('admin/insert/pokemon', 301);
    }

    public function pokemon() {
        $this->load->model('ability_model');
        $this->load->model('move_model');
        $data = array();
        $data['title'] = 'Insert Pokemon';
        $data['selected'] = 'insert_database';
        $data['sub_selected'] = 'insert_pkm';
        $data['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $data);
        $this->load->view('/admin/insert_pkm');
        $this->load->view('footer');
    }

    public function move($category=false) {
        $this->load->model('move_model');
        $data = array();
        $data['title'] = 'Insert Move';
        $data['selected'] = 'insert_database';
        $data['sub_selected'] = 'insert_move';
        $data['admin_script'] = $this->load->view('admin/admin_script', null, true);
        if ($category) {
            $data['category'] = $category;
        }

        $this->load->view('header', $data);
        $this->load->view('/admin/insert_move');
        $this->load->view('footer');
    }

    public function ability() {
        $this->load->model('ability_model');
        $data = array();
        $data['title'] = 'Insert Ability';
        $data['selected'] = 'insert_database';
        $data['sub_selected'] = 'insert_ability';
        $data['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $data);
        $this->load->view('/admin/insert_ability');
        $this->load->view('footer');
    }
    public function item() {
        $this->load->model('item_model');
        $data = array();
        $data['title'] = 'Insert Item';
        $data['selected'] = 'insert_database';
        $data['sub_selected'] = 'insert_item';
        $data['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $data);
        $this->load->view('/admin/insert_item');
        $this->load->view('footer');
    }
    public function insert_data() {
        $data = $this->input->post();
        // print_r($data);
        $model = $data['model'];
        $to_do = $data['func'];
        $insert_data = $data['data'];
        $this->load->model($model);
        // print_r($insert_data);
        $response = $this->$model->$to_do($insert_data);
        echo json_encode($response);
    }
}