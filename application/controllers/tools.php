<?php
class Tools extends CI_Controller {
	private $option;
	function __construct() {
		parent::__construct();
		$this->option['is_logged_in'] = is_logged_in();
		if (is_logged_in()) {
		    $this->option['current_user'] = current_user();
		}
	}

	function calc() {
		$this->option['title'] = "IV calculator";
		$this->option['tools_script'] = $this->load->view('scripts/tools_script', null, true);
		$this->option['selected'] = 'tools';
		$this->option['sub_selected'] = 'calc';
		$this->load->view('header', $this->option);
		$this->load->view('tools/calculators');
		$this->load->view('footer');
	}

	function xytools() {
		$this->option['title'] = "Pokemon X/Y Tools";
		$this->option['selected'] = 'tools';
		$this->option['sub_selected'] = 'xytools';
		$this->option['xytools_script'] = $this->load->view('scripts/xytools_script', '', true);
		$this->load->view('header', $this->option);
		$this->load->view('tools/xytools');
		$this->load->view('footer');
	}
}