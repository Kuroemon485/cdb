<?php

class Type extends CI_Controller {
	private $option;
	function __construct() {
		parent::__construct();
		$this->load->model('pokemon_model');
		$this->load->model('move_model');
		$this->option['is_logged_in'] = is_logged_in();
		if (is_logged_in()) {
		    $this->option['current_user'] = current_user();
		}
	}

	function index() {
		$type_data = array();

		$this->option['selected'] = 'view';
		$this->option['sub_selected'] = 'view_type';
		$this->option['title'] = 'Types';
        $this->option['main_script'] = $this->load->view('scripts/main_script', null, true);
        $this->load->view('header', $this->option);
        $this->load->view('type/all_types');
        $this->load->view('footer');
	}

	function id($type = false) {
		if ($type) {
			$type_data = array();
			$this->option['selected'] = 'view';
			$this->option['sub_selected'] = 'view_type';
			$this->option['title'] = ucwords($type);
            $this->option['main_script'] = $this->load->view('scripts/main_script', null, true);

            $type_data['detail'] = new stdClass();
            $type_data['detail']->name = ucwords($type);
            $type_data['pokemon_list'] = $this->pokemon_model->get_pokemon_by_type($type);
            $type_data['move_list'] = $this->move_model->get_move_by_type($type);

            $this->load->view('header', $this->option);
            $this->load->view('type/single_type', $type_data);
            $this->load->view('footer');
		} else {
			show_404();
		}
	}
}