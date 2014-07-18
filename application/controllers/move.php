<?php

class Move extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('move_model');
	}

	function index() {
		$data = array();
		$move = array();
		$data['title'] = 'Attack Dex';
		$data['selected'] = 'view';
		$data['sub_selected'] = 'view_move';
    	$data['main_script'] = $this->load->view('scripts/main_script', null, true);
    	$move['all_move'] = $this->move_model->get_move();
    	$this->load->view('header', $data);
    	$this->load->view('attackdex/all_moves', $move);
        $this->benchmark->mark('end');
        $mark = array();
        $mark['benchmark'] = $this->benchmark->elapsed_time('start', 'end');
        $this->load->view('footer', $mark);
	}

	function id($move_id) {
		$this->load->model('pokemon_model');
		$data = array();
		$move = array();
		$data['title'] = ucwords($move_id);
		$data['selected'] = 'view';
		$data['sub-selected'] = 'view_move';
    	$data['main_script'] = $this->load->view('scripts/main_script', null, true);
    	$move['info'] = $this->move_model->get_move_by_id($move_id);
    	$move['pokemon_list'] = $this->pokemon_model->get_pkm_by_move($move_id);
    	$this->load->view('header', $data);
    	$this->load->view('attackdex/single_move', $move);
    	$this->load->view('footer');
	}
}