<?php

class Ability extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	function index() {
		$this->load->model('ability_model');
		$data = array();
		$ability = array();
		$data['title'] = 'Ability Dex';
		$data['selected'] = 'view';
		$data['sub_selected'] ='view_ability';
    	$data['main_script'] = $this->load->view('scripts/main_script', null, true);
    	$this->load->view('header', $data);
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
			$ability['pokemon_list'] = $this->pokemon_model->get_pkm_by_ability($ab_id);
			$data = array();
			$data['title'] = ucwords($ab_id);
			$data['selected'] = 'view';
			$data['sub_selected'] = 'view_ability';
			$data['main_script'] = $this->load->view('scripts/main_script', '', true);
			$this->load->view('header', $data);
			$this->load->view('abilities_dex/single_ability', $ability);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}
}
