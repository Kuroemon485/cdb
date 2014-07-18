<?php

class Type extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('pokemon_model');
		$this->load->model('move_model');
	}

	function index() {
		$data = array();
		$type_data = array();

		$data['selected'] = 'view';
		$data['sub_selected'] = 'view_type';
		$data['title'] = 'Types';
        $data['main_script'] = $this->load->view('scripts/main_script', null, true);
        $this->load->view('header', $data);
        $this->load->view('type/all_types');
        $this->load->view('footer');
	}

	function name($type = false) {
		if ($type) {
			$data = array();
			$type_data = array();

			$data['selected'] = 'view';
			$data['sub_selected'] = 'view_type';
			$data['title'] = ucwords($type);
            $data['main_script'] = $this->load->view('scripts/main_script', null, true);

            $type_data['detail'] = new stdClass();
            $type_data['detail']->name = ucwords($type);
            $type_data['pokemon_list'] = $this->pokemon_model->get_pkm_by_type($type);
            $type_data['move_list'] = $this->move_model->get_move_by_type($type);

            $this->load->view('header', $data);
            $this->load->view('type/single_type', $type_data);
            $this->load->view('footer');
		} else {
			show_404();
		}
	}
}