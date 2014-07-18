<?php 

class Pokedex extends CI_Controller {
        function __construct() {
                parent::__construct();
                $this->load->helper('url');
        }

        function index() {
                $this->benchmark->mark('start');
                $this->load->model('pokemon_model');
                $config = array();
                $config['selected'] = 'view';
                $config['sub_selected'] = 'view_pokedex';
                $config['main_script'] = $this->load->view('scripts/main_script', null, true);
                $pokemon = array();
                $config['title'] = 'Pokedex';
                $this->load->view('header', $config);
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
                $config = array();
                $config['selected'] = 'view';
                $config['sub_selected'] = 'view_pokedex';
                $config['main_script'] = $this->load->view('scripts/main_script', null, true);
                $pokemon = array();
                $config['title'] = 'Master List';
                $this->load->view('header', $config);
                $pokemon['all'] = $this->pokemon_model->get_pokedex();
                $this->load->view('pokedex/master_list', $pokemon);
                $this->benchmark->mark('end');
                $mark = array();
                $mark['benchmark'] = $this->benchmark->elapsed_time('start', 'end');
                $this->load->view('footer', $mark);
        }
}