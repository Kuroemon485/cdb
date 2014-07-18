<?php

class Item extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	function index() {
		$data = array();
		$item = array();
		$this->load->model('item_model');
		$data['title'] = "Items Dex";
		$data['selected'] = "view";
		$data['sub_selected'] = "view_item";
		$data['main_script'] = $this->load->view('scripts/main_script', '', true);
		$this->load->view('header', $data);
		$item['all_items'] = $this->item_model->get_item();
		$this->load->view('items_dex/all_items', $item);
		$this->load->view('footer');
	}
}