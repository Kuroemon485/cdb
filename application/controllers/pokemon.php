<?php 

class Pokemon extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('pokemon_model');
        $this->load->model('ability_model');
        $this->load->model('item_model');
        $this->load->model('move_model');
    }
    function index() {
        
    }
    public function species($species_id = false) {
        if ($species_id) {
            $pokemon = array();
            $basic = $this->pokemon_model->get_pkm_by_species($species_id);
            if ($basic) {
                // config data for header
                $config = array();
                $config['selected'] = 'view';
                $config['sub_selected'] = 'view_pokemon';
                $config['main_script'] = $this->load->view('scripts/main_script', null, true);
                $config['title'] = $basic->species;
                $this->load->view('header', $config);
                // load header - done

                // data for top section of the page
                $top_data['species'] = $basic->species;
                $top_data['dex_id'] = $basic->dex_id;
                $top_data['species_id'] = $basic->species_id;
                $top_data['pkm_list'] = $this->pokemon_model->get_pkm_list();
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
                $move_data['learn_set'] = $this->pokemon_model->get_pkm_learnset($species_id);
                $this->load->view('pokedex/single_pkm_move', $move_data);
                // load move section - done

                // data for strategy section
                $strategy_data = array(); //array to send to view
                $strategies_data = $this->pokemon_model->get_pkm_strategies($species_id); // data for processing data before sending
                if ($strategies_data) {
                    foreach ($strategies_data as $str) {
                        $strategy = new stdClass();
                        $strategy->id = $str->id;
                        $strategy->name = $str->name;
                        $strategy->base_hp = $basic->hp;
                        $strategy->base_atk = $basic->atk;
                        $strategy->base_def = $basic->def;
                        $strategy->base_sp_atk = $basic->sp_atk;
                        $strategy->base_sp_def = $basic->sp_def;
                        $strategy->base_spd = $basic->spd;
                        $strategy->species = $this->pokemon_model->get_pkm_species($str->species_id);
                        $strategy->ability = $this->pokemon_model->get_pkm_ability($str->species_id, $str->ability_id);
                        $strategy->nature = $str->nature;
                        $strategy->item = $this->item_model->get_item_by_id($str->item_id);
                        $strategy->happiness = $str->happiness;
                        for ($i=1; $i <= 4; $i++) { 
                            $strategy->{'move_'.$i} = $this->move_model->get_move_by_id($str->{'move_'.$i.'_id'});
                        }
                        $stats = array('hp', 'atk', 'def', 'sp_atk', 'sp_def', 'spd');
                        foreach ($stats as $stat) {
                            $strategy->{'ev_'.$stat} = $str->{'ev_'.$stat};
                            $strategy->{'iv_'.$stat} = $str->{'iv_'.$stat};
                        }
                        $strategy->description = $str->description;
                        $strategy_data['strategies'][] = $strategy;
                    }
                }
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
        if ($value) {
            $data = array();
            $data['selected'] = 'view';
            $data['sub_selected'] = 'view_pokemon';
            $data['main_script'] = $this->load->view('scripts/main_script', null, true);
            $data['title'] = $this->pokemon_model->get_pkm_name($value);
            $pokemon = array();
            $pokemon['single'] = $this->pokemon_model->get_pkm_by_id($value);
            $pokemon['pkm_list'] = $this->pokemon_model->get_pkm_list();
            $this->load->view('header', $data);
            $this->load->view('single_pkm', $pokemon);
            $this->load->view('footer');
        } else {
            show_404();
        }
    }
    public function change_pokemon($id = false) {
        if ($id) {
            $pokemon = array();
            $pokemon['single'] = $this->pokemon_model->get_pkm_by_id($id);
            $pokemon['pkm_list'] = $this->pokemon_model->get_pkm_list();
            echo $this->load->view('single_pkm', $pokemon, true);
        }
    }
}
