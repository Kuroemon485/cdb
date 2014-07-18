<?php 
class Common extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('move_model');
		$this->load->model('ability_model');
		$this->load->model('pokemon_model');
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
	public function rename_m_sprites() {
		$pkm_list = $this->pokemon_model->get_pkm_list();
        foreach ($pkm_list as $pkm) {
        	if (file_exists ('./public/images/minisprites/'.$pkm->dex_id.'.png')) {
        		$fn = './public/images/minisprites/'.$pkm->dex_id.'.png';
				$new_fn = './public/images/minisprites/'.$pkm->species.'.png';
				rename($fn, $new_fn);
			}
			
			if (file_exists ('./public/images/minisprites/'.$pkm->dex_id.'-m.png')) {
				$fn = './public/images/minisprites/'.$pkm->dex_id.'-m.png';
				$new_fn = './public/images/minisprites/'.$pkm->species.'-Mega.png';
				rename($fn, $new_fn);
			}
			if (file_exists ('./public/images/minisprites/'.$pkm->dex_id.'-mx.png')) {
				$fn = './public/images/minisprites/'.$pkm->dex_id.'-mx.png';
				$new_fn = './public/images/minisprites/'.$pkm->species.'-Mega-X.png';
				rename($fn, $new_fn);
			}
			if (file_exists ('./public/images/minisprites/'.$pkm->dex_id.'-my.png')) {
				$fn = './public/images/minisprites/'.$pkm->dex_id.'-my.png';
				$new_fn = './public/images/minisprites/'.$pkm->species.'-Mega-Y.png';
				rename($fn, $new_fn);
			}
		}
	}
}
?>
