<?php 
class Common extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('move_model');
		$this->load->model('ability_model');
		$this->load->model('pokemon_model');
		$this->load->model('item_model');
	}
	public function index() {
		redirect('/index.php', 301);
	} 

	public function move_list_html() {
		$id = $this->input->post('id');
		$moves = $this->move_model->get_move_list();
		$html = '<br><select class="move-list form-control"><option value="0">Select a move</option>';
		foreach ($moves as $move) {
			if ($id) {
				if ($id == $move->id) {
					$html .= '<option value="'.$move->id.'" selected>'.$move->name."</option>";
				} else $html .= '<option value="'.$move->id.'">'.$move->name."</option>";
			} else 
			$html .= '<option value="'.$move->id.'">'.$move->name."</option>";
		}
		$html .= '</select>';
		echo $html;
	}

	public function get_latest_move() {
		$this->db->select_max('id');
		$query = $this->db->get('move_list');
		$id = $query->result()['0']->id;
		$query = $this->db->get_where('move_list', array('id'=>$id));
		echo json_encode( $query->result()['0']);
	}

	public function get_ab_desc() {
		$ab_id = $this->input->post('ab_id');
		$ability = $this->ability_model->get_ability_by_id($ab_id);
		if ($ability) {
			echo $ability->desc;
		} else echo "Cant find any description for this ability";
	}
	public function get_move_desc() {
		$ab_id = $this->input->post('move_id');
		$move = $this->move_model->get_move_desc($move_id);
		if ($move) {
			echo $move->desc;
		} else echo "Cant find any description for this ability";
	}
	public function get_modal_data() {
		$response = new stdClass();
		$temp = array();
		$data_type = $this->input->post('data_type');
		$id = $this->input->post('id');
		switch ($data_type) {
			case 'type':
			$response->title = "Types list";
			$response->html = $this->load->view('admin/type_modal', '', true);
			break;
			case 'ability':
			if ($id != "false") {
				$pokemon['ability_set'] = array();
				$temp = $this->pokemon_model->get_pokemon_abilities($id);
				foreach ($temp as $key) {
					$pokemon['ability_set'][$key->id] = $this->ability_model->get_ability_by_id($key->ability_id);
				}
				$response->title = "Posible Abilities";
			} else {
				$pokemon['ability_set'] = $this->ability_model->get_ability();
				$response->title = "Abilities list";
			}
			$response->html = $this->load->view('modals/ability_set_modal', $pokemon, true);
			break;
			case 'item':
			$pokemon['item_list'] = $this->item_model->get_item();
			$response->title = "Items";
			$response->html = $this->load->view('modals/item_modal', $pokemon, true);
			break;
			case 'learn_set':
			if ($id != "false") {
				$temp['learn_set'] = $this->pokemon_model->get_pokemon_learnset($id);
				$response->title = "Posible moves";
			} else {
				$temp['learn_set'] = $this->move_model->get_move();
				$response->title = "Moves list";
			}
			$response->html = $this->load->view('modals/learn_set_modal', $temp, true);
			break;
			case 'item_strategy':
			$temp['strategies'] = $this->item_model->get_strategy_for_item($id);
			$response->title = "Strategy using this item";
			$response->html = $this->load->view('modals/item_strategy_modal', $temp, true);
			break;
		default:

		break;
	}
	echo json_encode($response);
}
public function rename_m_sprites() {
		// $pokemon_list = $this->pokemon_model->get_pokemon_list();
  //       foreach ($pokemon_list as $pokemon) {
  //       	if (file_exists ('./public/images/minisprites/'.$pokemon->dex_id.'.png')) {
  //       		$fn = './public/images/minisprites/'.$pokemon->dex_id.'.png';
		// 		$new_fn = './public/images/minisprites/'.$pokemon->species.'.png';
		// 		rename($fn, $new_fn);
		// 	}

		// 	if (file_exists ('./public/images/minisprites/'.$pokemon->dex_id.'-m.png')) {
		// 		$fn = './public/images/minisprites/'.$pokemon->dex_id.'-m.png';
		// 		$new_fn = './public/images/minisprites/'.$pokemon->species.'-Mega.png';
		// 		rename($fn, $new_fn);
		// 	}
		// 	if (file_exists ('./public/images/minisprites/'.$pokemon->dex_id.'-mx.png')) {
		// 		$fn = './public/images/minisprites/'.$pokemon->dex_id.'-mx.png';
		// 		$new_fn = './public/images/minisprites/'.$pokemon->species.'-Mega-X.png';
		// 		rename($fn, $new_fn);
		// 	}
		// 	if (file_exists ('./public/images/minisprites/'.$pokemon->dex_id.'-my.png')) {
		// 		$fn = './public/images/minisprites/'.$pokemon->dex_id.'-my.png';
		// 		$new_fn = './public/images/minisprites/'.$pokemon->species.'-Mega-Y.png';
		// 		rename($fn, $new_fn);
		// 	}
		// }
}
}
?>
