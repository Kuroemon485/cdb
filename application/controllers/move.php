<?php

class Move extends CI_Controller {
	private $option;
	function __construct() {
		parent::__construct();
		$this->load->model('move_model');
		$this->option['is_logged_in'] = is_logged_in();
		if (is_logged_in()) {
		    $this->option['current_user'] = current_user();
		}
	}

	function index() {
		$move = array();
		$this->option['title'] = 'Attack Dex';
		$this->option['selected'] = 'view';
		$this->option['sub_selected'] = 'view_move';
    	$this->option['main_script'] = $this->load->view('scripts/main_script', null, true);
    	$move['all_move'] = $this->move_model->get_move();
    	$this->load->view('header', $this->option);
    	$this->load->view('attackdex/all_moves', $move);
        $this->benchmark->mark('end');
        $mark = array();
        $mark['benchmark'] = $this->benchmark->elapsed_time('start', 'end');
        $this->load->view('footer', $mark);
	}

	function id($move_id) {
		$this->load->model('pokemon_model');
		$move = array();
		$this->option['title'] = ucwords($move_id);
		$this->option['selected'] = 'view';
		$this->option['sub-selected'] = 'view_move';
    	$this->option['main_script'] = $this->load->view('scripts/main_script', null, true);
    	$move['info'] = $this->move_model->get_move_by_id($move_id);
    	$move['pokemon_list'] = $this->pokemon_model->get_pokemon_by_move($move_id);
    	$this->load->view('header', $this->option);
    	$this->load->view('attackdex/single_move', $move);
    	$this->load->view('footer');
	}
}