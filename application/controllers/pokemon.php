<?php 

class Pokemon extends CI_Controller {
    private $option;
    function __construct() {
        parent::__construct();
        $this->load->model('pokemon_model');
        $this->load->model('ability_model');
        $this->load->model('item_model');
        $this->load->model('move_model');
        $this->option['is_logged_in'] = is_logged_in();
        $this->option['selected'] = 'view';
        $this->option['sub_selected'] = 'view_pokedex';
        if (is_logged_in()) {
            $this->option['current_user'] = current_user();
        }
    }
    // function index() {
        
    // }
    public function species($species_id = false) {
        if ($species_id) {
            $pokemon = array();
            $basic = $this->pokemon_model->get_pokemon_by_species($species_id);
            if ($basic) {
                // this->option data for header
                $this->option['main_script'] = $this->load->view('scripts/main_script', null, true);
                $this->option['title'] = $basic->species;
                $this->load->view('header', $this->option);
                // load header - done

                // data for top section of the page
                $top_data['species'] = $basic->species;
                $top_data['dex_id'] = $basic->dex_id;
                $top_data['species_id'] = $basic->species_id;
                $top_data['pokemon_list'] = $this->pokemon_model->get_pokemon_list();
                $this->load->view('pokedex/single_pkm_top', $top_data);
                // load top section - done

                // data for basic section
                $basic_data['species'] = $basic->species;
                $basic_data['dex_id'] = $basic->dex_id;
                $basic_data['species_id'] = $basic->species_id;
                $stats['hp'] = $basic->hp;
                $stats['atk'] = $basic->atk;
                $stats['def'] = $basic->def;
                $stats['sp_atk'] = $basic->sp_atk;
                $stats['sp_def'] = $basic->sp_def;
                $stats['spd'] = $basic->spd;
                $basic_data['stats'] = $stats;
                $basic_data['height_m'] = $basic->height_m;
                $basic_data['weight_kg'] = $basic->weight_kg;
                $basic_data['test_data'] = $this->pokemon_model->test1($species_id);
                if ($basic->weight_kg<10) {
                    $basic_data['grass_knot_power'] = 20;
                } else if ($basic->weight_kg<25) {
                    $basic_data['grass_knot_power'] = 40;
                } else if ($basic->weight_kg<50) {
                    $basic_data['grass_knot_power'] = 60;
                } else if ($basic->weight_kg<100) {
                    $basic_data['grass_knot_power'] = 80;
                } else if ($basic->weight_kg<200) {
                    $basic_data['grass_knot_power'] = 100;
                } else if ($basic->weight_kg>=200) {
                    $basic_data['grass_knot_power'] = 120;
                }
                $basic_data['types'] = $basic->types;
                $basic_data['abilities'] = $basic->abilities;
                $this->load->view('pokedex/single_pkm_basic', $basic_data);
                // load basic section - done

                // data for move section
                $move_data['learn_set'] = $this->pokemon_model->get_pokemon_learnset($species_id);
                $this->load->view('pokedex/single_pkm_move', $move_data);
                // load move section - done

                // data for strategy section
                // $strategy_data = array();
                $strategy_data['strategies'] = $this->pokemon_model->get_pokemon_strategies($species_id); //
                $this->load->view('pokedex/single_pkm_strategy', $strategy_data);
                // load strategy section - done

                $this->load->view('pokedex/single_pkm_bottom');
                $this->load->view('footer');
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function id($value = false) {
        // if ($value) {
        //     $data = array();
        //     $data['selected'] = 'view';
        //     $data['sub_selected'] = 'view_pokemon';
        //     $data['main_script'] = $this->load->view('scripts/main_script', null, true);
        //     $data['title'] = $this->pokemon_model->get_pokemon_name($value);
        //     $pokemon = array();
        //     $pokemon['single'] = $this->pokemon_model->get_pokemon_by_id($value);
        //     $pokemon['pokemon_list'] = $this->pokemon_model->get_pokemon_list();
        //     $this->load->view('header', $data);
        //     $this->load->view('single_pokemon', $pokemon);
        //     $this->load->view('footer');
        // } else {
        //     show_404();
        // }
    }
    public function change_pokemon($id = false) {
        // if ($id) {
        //     $pokemon = array();
        //     $pokemon['single'] = $this->pokemon_model->get_pokemon_by_id($id);
        //     $pokemon['pokemon_list'] = $this->pokemon_model->get_pokemon_list();
        //     echo $this->load->view('single_pokemon', $pokemon, true);
        // }
    }
}
