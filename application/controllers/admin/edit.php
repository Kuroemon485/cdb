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
        } else {
            show_404();
        }
    }

    public function index() {
        redirect('admin/edit/pokemon', 301);
    }

    public function pokemon($species_id = false) {
        $pkm = array();
        $this->option['admin_script'] = $this->load->view('admin/admin_script', null, true);
        $pkm['work_mode'] = 'edit';
        $pkm['pkm_list'] = $this->pokemon_model->get_pkm_list();
        $pkm['move_list'] = $this->move_model->get_move_list();
        $pkm['ab_list'] =$this->ability_model->get_ability_list();
        $pkm['items_list'] = $this->item_model->get_item_list();
        if ($species_id) {
            $pkm['current_pkm'] = $this->pokemon_model->get_pkm_by_species($species_id);
            $pkm['learn_set'] = $this->pokemon_model->get_pkm_learnset_simple($species_id);
            $strategy_list = $this->pokemon_model->get_pkm_strategy_list($species_id);
            if ($strategy_list) {
                $pkm['strategy_list'] = $strategy_list;
            }
            $this->option['title'] = $pkm['current_pkm']->species;
        } else {
            $this->option['title'] = 'Edit Pokemon';
        }
        
        $this->load->view('header', $this->option);
        $this->load->view('admin/pokemon', $pkm);
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
        $item['all_item'] = $this->item->get_item_list();
        $this->load->view('/admin/edit_item', $item);
        $this->load->view('footer');
    }
    public function update() {
        $model = $this->input->post('model');
        $function = 'edit_'.$this->input->post('object');
        $edit_data = $this->input->post('data');
        $id = $this->input->post('id');
        // print_r($data);
        $response = $this->$model->$function($id, $edit_data);
        echo json_encode($response);
    }

    public function update_pkm_ta() {
        $what = $this->input->post('what'); //add, modify, delete types, abilities
        $where = $this->input->post('where');
        $values = $this->input->post('values');
        $response = $this->pokemon_model->$what($where, $values);
        echo json_encode($response);
    }

    public function update_pkm_move() {
        $what = $this->input->post('what'); //add_move or delete_move
        $where = $this->input->post('where');
        $values = $this->input->post('values');
        $response = $this->pokemon_model->$what($where, $values);
        echo json_encode($response);
    }
    
    // GET functions
    public function get($object, $id) {
        if ($id) {
            $result = $this->$object($id);
            // print_r($result);
            echo json_encode($result);
        }
    }
    private function _pokemon($id = false) {
        if ($id) {
            $pkm = $this->pokemon_model->get_pkm_by_id($id);
            return $pkm;
        }
    }
    public function _ability($id = false) {
        if ($id) {
            $ability = $this->ability_model->get_ability_by_id($id);
            return $ability;
        }
    }
    public function _move($id = false) {
        if ($id) {
            $move = $this->move_model->get_move_by_id($id);
            return $move;
        }
    }
    public function _strategy($id = false) {
        if ($id) {
            $strategy = $this->pokemon_model->get_strategy_by_id($id);
            return $strategy;
        }
    }
    public function get_modal_data($data_type) {
        $response = new stdClass();
        $temp = array();
        switch ($data_type) {
            case 'type':
                $response->title = "Types list";
                $response->html = $this->load->view('admin/type_modal', '', true);
                break;
            case 'ability':
                $temp['ab_list'] = $this->ability_model->get_ability();
                $response->title = "Abilities list";
                $response->html = $this->load->view('admin/ability_modal', $temp, true);
                break;
            default:
                
                break;
        }
        echo json_encode($response);
    }
    // GET functions - END
}
