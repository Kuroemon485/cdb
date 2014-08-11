<?php

class Edit extends CI_Controller {
    private $option;
    public function __construct() {
        parent::__construct();
        $this->option['is_logged_in'] = is_logged_in();
        $this->option['selected'] = 'admin';
        $this->option['sub_selected'] = 'database_control';
        if (is_logged_in()) {
            $this->option['current_user'] = current_user();
            $this->load->model('ability_model');
            $this->load->model('pokemon_model');
            $this->load->model('move_model');
            $this->load->model('item_model');
            $this->load->model('news_model');
        } else {
            $this->output->set_status_header('404');
            show_404('404');
        }
    }

    public function index() {
        redirect('admin/edit/pokemon', 301);
    }

    public function pokemon($species_id = false) {
        $pokemon = array();
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);
        $pokemon['work_mode'] = 'edit';
        $pokemon['pkm_list'] = $this->pokemon_model->get_pokemon_list();
        $pokemon['move_list'] = $this->move_model->get_move_list();
        if ($species_id) {
            $pokemon['current_pkm'] = $this->pokemon_model->get_pokemon_by_species($species_id);
            $pokemon['learn_set'] = $this->pokemon_model->get_pokemon_learnset_simple($species_id);
            $strategy_list = $this->pokemon_model->get_pokemon_strategy_list($species_id);
            if ($strategy_list) {
                $pokemon['strategy_list'] = $strategy_list;
            }
            $this->option['title'] = $pokemon['current_pkm']->species;
        } else {
            $this->option['title'] = 'Edit Pokemon';
        }
        
        $this->load->view('header', $this->option);
        $this->load->view('admin/pokemon', $pokemon);
        $this->load->view('footer');
    }

    public function move() {
        $this->option['title'] = 'Edit Move';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);
        $moves['all_moves'] = $this->move_model->get_move_list();
        $this->load->view('header', $this->option);
        $this->load->view('admin/edit_move', $moves);
        $this->load->view('footer');
    }

    public function ability() {
        $this->option['title'] = 'Edit Ability';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $abilities = array();
        $abilities['all_ab'] = $this->ability_model->get_ability_list();
        $this->load->view('/admin/edit_ability', $abilities);
        $this->load->view('footer');
    }
    public function item() {
        $this->option['title'] = 'Edit Item';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $item = array();
        $item['all_item'] = $this->item_model->get_item_list();
        $this->load->view('/admin/edit_item', $item);
        $this->load->view('footer');
    }
    public function news() {
        $this->option['title'] = 'Edit News';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $this->option);
        $news = array();
        $news['news_list'] = $this->news_model->get_news_list();
        $this->load->view('/admin/edit_news', $news);
        $this->load->view('footer');
    }
    function strategy() {
        $this->option['title'] = 'Edit strategy';
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);
        $data = new stdClass();
        $data->strategy_list = $this->pokemon_model->get_strategy_list();
        $data->pkm_list = $this->pokemon_model->get_pokemon_list();
        $this->load->view('header', $this->option);
        $this->load->view('/admin/edit_strategy', $data);
        $this->load->view('footer');
    }
    // GET data
    public function get($model, $table, $id) {
        $get_object = "get_".$table."_by_id";
        $result = $this->$model->$get_object($id);
        // print_r($result);
        echo json_encode($result);
    }
    public function update_data() {
        $data = $this->input->post();
        $model = $data['model'];
        $edit_table = "edit_".$data['table'];
        $condition = $data['condition'];
        $edit_data = $data['data'];
        $response = $this->$model->$edit_table($condition, $edit_data);
        echo json_encode($response);
    }

    public function update_pokemon_ta() {
        $what = $this->input->post('what'); //add, modify, delete types, abilities
        $where = $this->input->post('where');
        $values = $this->input->post('values');
        $response = $this->pokemon_model->$what($where, $values);
        echo json_encode($response);
    }

    public function update_pokemon_move() {
        $what = $this->input->post('what'); //add_move or delete_move
        $where = $this->input->post('where');
        $values = $this->input->post('values');
        $response = $this->pokemon_model->$what($where, $values);
        echo json_encode($response);
    } 
   
    // GET functions - END
}
