<?php
class Tools extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	function calc() {
		$data = array();
		$data['title'] = "IV calculator";
		$data['tools_script'] = $this->load->view('scripts/tools_script', null, true);
		$data['selected'] = 'tools';
		$data['sub_selected'] = 'calc';
		$this->load->view('header', $data);
		$this->load->view('tools/calculators');
		$this->load->view('footer');
	}

	function xytools() {
		$data = new stdClass();
		$data->title = "Pokemon X/Y Tools";
		$data->selected = 'tools';
		$data->sub_selected = 'xytools';
		$data->xytools_script = $this->load->view('scripts/xytools_script', '', true);
		$this->load->view('header', $data);
		$this->load->view('tools/xytools');
		$this->load->view('footer');
	}
}