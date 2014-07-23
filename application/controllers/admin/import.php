<?php 

class Import extends CI_controller {
    private $option;
	public function __construct() {
		parent::__construct();
		$this->option['is_logged_in'] = is_logged_in();
        if (is_logged_in()) {
            $this->option['current_user'] = current_user();
            $this->load->model('ability_model');
            $this->load->model('pokemon_model');
            $this->load->model('move_model');
            $this->load->model('item_model');
        } else {
            $this->output->set_status_header('404');
            show_404();
        }
	}
	public function index() {
        $this->option['title'] = 'Import Database';
        $this->option['selected'] = 'import_database';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);
        $this->option['data_script'] = $this->load->view('scripts/data_script', null, true);
        $this->load->view('header', $this->option);
        $this->load->view('/admin/import');
        $this->load->view('footer');
    }
    public function process_js_data() {
        $table = $this->input->post('table');
        $data = $this->input->post('data');
        $object = $this->input->post('object');
                $this->load->model('pokemon_model');
                $this->load->model('ability_model');
                $this->load->model('move_model');
                $this->load->model('item_model');
        switch ($table) {
            case 'pokedex':
                $species_id = $object;
                $record = $this->process_pokemon_data($data);
                $record->basic['species_id'] = $species_id;
                $result = $this->pokemon_model->add_pokemon($record->basic);
                echo json_encode($result);
                // print_r($record);
                break;
            case 'abilities_dex':
                $record = $this->process_ability_data($data);
                if ($record) {
                    $result = $this->ability_model->add_ability($record);
                }
                // print_r($record);
                echo json_encode($result);
                break;
            case 'attack_dex':
                $record = $this->process_move_data($data);
                if ($record) {
                    $result = $this->move_model->add_move($record);
                }
                // print_r($record);
                echo json_encode($result);
                break;
            case 'items_dex':
                $record = $this->process_item_data($data);
                if ($record) {
                    $result = $this->item_model->add_item($record);
                }
                // print_r($record);
                echo json_encode($result);
                break;
            case 'learn_set':
                $species_id = $object;
                $record = $this->process_pokemon_learnset($data);
                $result = $this->pokemon_model->add_pokemon_learnset($species_id, $record);
                echo json_encode($result);
                // print_r($record);
                break;
            case 'abilities_set':
                $species_id = $object;
                $record = $this->process_pokemon_data($data);
                $result = $this->pokemon_model->add_pokemon_ability($species_id, $record->abilities);
                echo json_encode($result);
                break;
            case 'types_set':
                $species_id = $object;
                $record = $this->process_pokemon_data($data);
                $result = $this->pokemon_model->add_pokemon_type($species_id, $record->types);
                echo json_encode($result);
                break;
            default:
                
                break;
        }
    }

    private function process_pokemon_data($data) {
        $record = new stdClass();
        $record->basic = array();
        $record->abilities = array();
        $record->types = array();
        $record->basic['dex_id'] = $data['num'];
        $record->basic['species'] = $data['species'];
        $record->basic['hp'] = $data['baseStats']['hp'];
        $record->basic['atk'] = $data['baseStats']['atk'];
        $record->basic['def'] = $data['baseStats']['def'];
        $record->basic['sp_atk'] = $data['baseStats']['spa'];
        $record->basic['sp_def'] = $data['baseStats']['spd'];
        $record->basic['spd'] = $data['baseStats']['spe'];
        $record->basic['height_m'] = $data['heightm'];
        $record->basic['weight_kg'] = $data['weightkg'];
        $record->basic['base_species'] = isset($data['baseSpecies']) ? $data['baseSpecies'] : "";
        foreach ($data['abilities'] as $key => $value) {
            $record->abilities[$key] = $value;
        }
        foreach ($data['types'] as $type) {
            $record->types[] = $type;
        }
        return $record;
    }
    private function process_move_data($data) {
        if (isset($data['num'])) {
            $record = array();
            $record['no'] = $data['num'];
            $record['id'] = $data['id'];
            $record['name'] = $data['name'];
            $record['type'] = $data['type'];
            $record['category'] = $data['category'];
            $record['base_power'] = $data['basePower'];
            $record['pp'] = $data['pp'];
            $record['accuracy'] = $data['accuracy'];
            $record['priority'] = $data['priority'];
            $record['target'] = $data['target'];
            $record['desc'] = $data['desc'];
            $record['short_desc'] = $data['shortDesc'];
            return $record;
        } else {
            return false;
        }
    }
    private function process_ability_data($data) {
        if (isset($data['num'])) {
            $record = array();
            $record['no'] = $data['num'];
            $record['id'] = $data['id'];
            $record['name'] = $data['name'];
            $record['desc'] = $data['desc'];
            $record['short_desc'] = $data['shortDesc'];
            $record['rating'] = $data['rating'];
            return $record;
        } else {
            return false;
        }
    }
    private function process_item_data($data) {
        if (isset($data['num'])) {
            $record = array();
            $record['no'] = $data['num'];
            $record['id'] = $data['id'];
            $record['name'] = $data['name'];
            $record['desc'] = $data['desc'];
            $record['no'] = $data['num'];
            return $record;
        } else {
            return false;
        }
    }
    private function process_pokemon_learnset($data) {
        $record = array();
        foreach ($data['learnset'] as $move => $method) {
            $record[] = $move;
        }
        return $record;
    }

    // public function get_pokeAPI() {
    //     $api = $this->input->post('api');
    //     $url = 'http://pokeapi.co'.$api;
    //     $table = $this->input->post('table');
    //     echo $data = json_decode(file_get_contents($url));
    //     if ($object) {
    //         $this->process_pokeAPI($table, $data);
    //     }
    // }
    // private function process_pokeAPI($object, $data) {
    //     $url = 'http://pokeapi.co/';
    //     switch ($table) {
    //         case 'pokedex':
    //             $all_pokemon = $data->pokemon;
    //             $uri = array();
    //             foreach ($all_pokemon as $pokemon) {
    //                 $uri[] = $pokemon->resource_uri;
    //             }
    //             echo json_encode($uri);
    //             break;
    //         case 'pokemon':
    //             $this->load->model('pokemon');
    //             $this->load->model('move');
    //             $this->load->model('ability');

    //             //insert pokemon basic information
    //             $keys = array("pkdx_id", "national_id", "name", "hp", "attack", "defense", "sp_atk", "sp_def", "speed");
    //             $basic = array();
    //             foreach ($keys as $k) {
    //              $basic[$k] = $data->{$k};
    //             }
    //             $this->{$object}->add_pokemon_basic($basic);
    //             print_r($basic);

    //             //insert pokemon type
    //             $types = array();
    //             foreach ($data->types as $type) {
    //                 $types['pkdx_id'] = $data->pkdx_id;
    //                 $types['type'] = $type->name;
    //                 $this->pokemon->add_pokemon_type($types);
    //                 // echo "pokemon->type: ";print_r($types);
    //             }
    //             // insert pokemon ability
    //             $pokemon_ability = array();
    //             $abilities = array();
    //             foreach ($data->abilities as $ability) {
    //                 $ab_uri = 'http://pokeapi.co'.$ability->resource_uri;
    //                 $ability_data = json_decode(file_get_contents($ab_uri));

    //                 //  For pokemon - Ability relationship
    //                 $pokemon_ability['pkdx_id'] = $data->pkdx_id;
    //                 $pokemon_ability['ability_id'] = $ability_data->id;
    //                 $this->pokemon->add_pokemon_ability($pokemon_ability);
    //                 // echo "pokemon->Ability: ";print_r($pokemon_ability);

    //                 // For ability list
    //                 $abilities['id'] = $ability_data->id;
    //                 $abilities['name'] = str_replace('-', ' ', $ability_data->name);
    //                 $abilities['description'] = $ability_data->description;
    //                 // echo "ability->detail: ". print_r($abilities);
    //                 $this->ability->add_ability($abilities);
    //             }
    //             //  insert pokemon move
    //             $pokemon_move = array();
    //             $moves = array();
    //             foreach ($data->moves as $move) {
    //                 // For Pokemon-move relationship
    //                 $pokemon_move['national_id'] = $data->national_id;
    //                 preg_match_all('!\d+!', $move->resource_uri, $matches);
    //                 $pokemon_move['move_id'] = $matches[0][1];
    //                 $pokemon_move['learn_type'] = $move->learn_type;
    //                 $this->pokemon->add_pokemon_move($pokemon_move);
    //                 // echo "pokemon->Move: ";print_r($pokemon_move);
                    
    //                 // For move_list table
    //                 $moves['id'] = $pokemon_move['move_id'];
    //                 $moves['name'] = str_replace('-', ' ', $move->name);
    //                 $this->move->add_move($moves);
    //                 // echo "Move->detail: ";print_r($moves);
    //                 // echo "<br />";
    //             }
    //             break;

    //             case 'move':
    //                 $this->load->model('move');
    //                 $this->move->fix_move_list($data);
    //                 echo 'src: ';
    //                 print_r($data);
    //             break;

    //             case 'ability':
    //                 $this->load->model('ability');
    //                 $this->ability->fix_ability_list($data);
    //                 echo 'src: ';
    //                 print_r($data);
    //                 break;
    //         default:
    //             break;
    //     }
    // }
}


// End of import.php file
