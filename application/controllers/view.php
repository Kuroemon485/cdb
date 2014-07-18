<?php

class View extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        redirect('view/pokemon', 301);
    }

    

    public function something() {
        $data = $this->input->post();
        // print_r($data);
        $model = $data['model'];
        $edit_what = $data['function'];
        $edit_data = array(
                'pkm_id' => $data['pkm_id'],
                'info' => $data['info']
            );
        $this->load->model($model);
        $response = $this->$model->$edit_what($edit_data);
    }
}
