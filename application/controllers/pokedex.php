<?php 

class Pokedex extends CI_Controller {
        private $option;
        function __construct() {
                parent::__construct();
                $this->option['is_logged_in'] = is_logged_in();
                if (is_logged_in()) {
                    $this->option['current_user'] = current_user();
                }
        }

        function index() {
                $this->benchmark->mark('start');
                $this->load->model('pokemon_model');
                $this->option['selected'] = 'view';
                $this->option['sub_selected'] = 'view_pokedex';
                $this->option['main_script'] = $this->load->view('scripts/main_script', null, true);
                $pokemon = array();
                $pokemon['a_g'] = $this->pokemon_model->get_pokemon_list_by_alphabet('a', 'g');
                $pokemon['h_r'] = $this->pokemon_model->get_pokemon_list_by_alphabet('h', 'r');
                $pokemon['s_z'] = $this->pokemon_model->get_pokemon_list_by_alphabet('s', 'z');
                $this->option['title'] = 'Pokedex';
                $this->load->view('header', $this->option);
                $this->load->view('pokedex/main', $pokemon);
                $this->benchmark->mark('end');
                $mark = array();
                $mark['benchmark'] = $this->benchmark->elapsed_time('start', 'end');
                $this->load->view('footer', $mark);
        }
        function masterlist() {
// $this->output->cache(100000);
                $this->benchmark->mark('start');
                $this->load->model('pokemon_model');
                $this->option['selected'] = 'view';
                $this->option['sub_selected'] = 'view_pokedex';
                $this->option['main_script'] = $this->load->view('scripts/main_script', null, true);
                $pokemon = array();
                $this->option['title'] = 'Master List';
                $this->load->view('header', $this->option);
                $pokemon['all'] = $this->pokemon_model->get_pokedex();
                $this->load->view('pokedex/master_list', $pokemon);
                $this->benchmark->mark('end');
                $mark = array();
                $mark['benchmark'] = $this->benchmark->elapsed_time('start', 'end');
                $this->load->view('footer', $mark);
        }
}