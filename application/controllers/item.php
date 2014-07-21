<?php

class Item extends CI_Controller {
	private $option;
	function __construct() {
		parent::__construct();
		$this->option['is_logged_in'] = is_logged_in();
		if (is_logged_in()) {
		    $this->option['current_user'] = current_user();
		}
	}

	function index() {
		$item = array();
		$this->load->model('item_model');
		$this->option['title'] = "Items Dex";
		$this->option['selected'] = "view";
		$this->option['sub_selected'] = "view_item";
		$this->option['main_script'] = $this->load->view('scripts/main_script', '', true);
		$this->load->view('header', $this->option);
		$item['all_items'] = $this->item_model->get_item();
		$this->load->view('items_dex/all_items', $item);
		$this->load->view('footer');
	}
}