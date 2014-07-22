<?php

class Ability extends CI_Controller {
	private $option;
	function __construct() {
		parent::__construct();
		$this->option['is_logged_in'] = is_logged_in();
		if (is_logged_in()) {
		    $this->option['current_user'] = current_user();
		}
	}

	function index() {
		$this->load->model('ability_model');
		$ability = array();
		$this->option['title'] = 'Ability Dex';
		$this->option['selected'] = 'view';
		$this->option['sub_selected'] ='view_ability';
    	$this->option['main_script'] = $this->load->view('scripts/main_script', null, true);
    	$this->load->view('header', $this->option);
    	$ability['all_abilities'] = $this->ability_model->get_ability();
    	$this->load->view('abilities_dex/all_abilities', $ability);
        $this->load->view('footer');
	}

	function id($ab_id = false) {
		if ($ab_id) {
			$this->load->model('ability_model');
			$this->load->model('pokemon_model');
			$ability = array();
			$ability['info'] = $this->ability_model->get_ability_by_id($ab_id);
			$ability['pokemon_list'] = $this->pokemon_model->get_pokemon_by_ability($ab_id);
			$this->option['title'] = ucwords($ab_id);
			$this->option['selected'] = 'view';
			$this->option['sub_selected'] = 'view_ability';
			$this->option['main_script'] = $this->load->view('scripts/main_script', '', true);
			$this->load->view('header', $this->option);
			$this->load->view('abilities_dex/single_ability', $ability);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}
}
