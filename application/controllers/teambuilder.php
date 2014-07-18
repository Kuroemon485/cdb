<?php
class Teambuilder extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('pokemon_model');
		$this->load->model('item_model');
		$this->load->model('ability_model');
		$this->load->model('move_model');
	}

	function index() {
		$config_data = array();
		$config_data['title'] = "Team Builder";
		$config_data['selected'] = "team_builder";
		$config_data['main_script'] = $this->load->view('scripts/main_script', null, true);
		$config_data['builder_script'] = $this->load->view('scripts/team_builder_script', null, true);
		$this->load->view('header', $config_data);

		$builder_data = array();
		$builder_data['pkm_list'] = $this->pokemon_model->get_pkm_list();
		$this->load->view('tools/team_builder.php', $builder_data);
		$this->load->view('footer');
	}

	public function get_species_info() {
		$species_id = $this->input->post('species_id');
		$info = $this->pokemon_model->get_builder_species_info($species_id);
		echo json_encode($info);
	}

	public function get_modal_data() {
		$response = new stdClass();
		$pkm = array();
		$species_id = $this->input->post('species_id');
		$property = $this->input->post('property');
		switch ($property) {
			case 'learn_set':
				$pkm['learn_set'] = $this->pokemon_model->get_pkm_learnset($species_id);
				$response->title = "Posible moves";
				$response->html = $this->load->view('tools/learn_set_modal', $pkm, true);
				break;
			case 'ability':
				$pkm['ability_set'] = array();
				$temp = $this->pokemon_model->get_pkm_abilities($species_id);
				foreach ($temp as $key) {
					$pkm['ability_set'][$key->id] = $this->ability_model->get_ability_by_id($key->ability_id);
				}
				$response->title = "Posible abilities";
				$response->html = $this->load->view('tools/ability_set_modal', $pkm, true);
				break;
			case 'item':
				$pkm['item_list'] = $this->item_model->get_item();
				$response->title = "Items";
				$response->html = $this->load->view('tools/item_modal', $pkm, true);
				break;
			default:
				
				break;
		}
		echo json_encode($response);
	}
}