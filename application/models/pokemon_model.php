<?php

class Pokemon_Model extends CI_Model {

	function __construct() {
		parent::__construct();
    	$this->load->database();
	}
    function get_pokemon_list() {
        $this->db->select('dex_id, species_id, species');
        $this->db->order_by('dex_id', 'asc');
        $this->db->order_by('species', 'asc');
        $query = $this->db->get('pokedex');
        return $query->result();
    }
    function get_pokemon_list_by_alphabet($start, $end) {
        $this->db->select('dex_id, species_id, species');
        $this->db->where('substr(species_id, 1, 1) >=',$start);
        $this->db->where('substr(species_id, 1, 1) <=', $end);
        $this->db->order_by('species_id', 'asc');
        $query = $this->db->get('pokedex');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function test1($species_id) {
        $querystr = 'SELECT
                        pokedex.*,
                        GROUP_CONCAT(ability_id) AS abilities
                    FROM
                        pokedex,
                        ability_sets
                    where
                        pokedex.species_id=ability_sets.species_id
                    GROUP BY
                        pokedex.species_id
                    having
                        pokedex.species_id = "'.$species_id.'"';

        // $this->db->select('pokedex.*, ability_sets.ability_id');
        // $this->db->from('pokedex');
        // $this->db->group_by('pokedex.species_id');
        // $this->db->join('ability_sets', 'ability_sets.species_id = pokedex.species_id', 'left');
        // $this->db->where('pokedex.species_id', $species_id);
        $query = $this->db->query($querystr);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
	function get_pokedex(/*$limit, $offset*/) {
        $this->db->select('dex_id, species_id, species, hp, atk, def, sp_atk, sp_def, spd');
        $this->db->order_by('dex_id', 'asc');
        $this->db->order_by('species', 'asc');
        $query = $this->db->get('pokedex'/*, $limit, $offset*/);
        if ($query->num_rows() > 0) {
            $pokedex = $query->result();
            foreach ($pokedex as $pkm) {
                $this->db->select('type');
                $this->db->where('species_id', $pkm->species_id);
                $query = $this->db->get('type_sets');
                if ($query->num_rows() > 0) {
                    $pkm->types = array();
                    foreach ($query->result() as $type) {
                        $pkm->types[] = $type->type;
                    }
                }
                $this->db->select('ability_id, ability_name, id');
                $this->db->where('species_id', $pkm->species_id);
                $query = $this->db->get('ability_sets');
                if ($query->num_rows() > 0) {
                    $pkm->abilities = array();
                    $pkm->abilities = $query->result();
                }
            }
        } else $pokedex = false;
        return $pokedex;
	}
    function get_pokemon_by_species($species_id) {
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('pokedex');
        if ($query->num_rows() > 0) {
            $pokemon = $query->row();
            $pokemon->types = $this->get_pokemon_type($pokemon->species_id);
            $pokemon->abilities = $this->get_pokemon_abilities($pokemon->species_id);
            return $pokemon;
        } else {
            return false;
        }
    }
    function get_pokemon_by_type($type) {
        $this->db->where('type', $type);
        $this->db->select('species_id');
        $query = $this->db->get('type_sets');
        if ($query->num_rows() > 0) {
            $pokemon = array();
            foreach ($query->result() as $pkm) {
                $pokemon[] = $this->get_pokemon_by_species($pkm->species_id);
            }
            return $pokemon;
        } else {
            return false;
        }
    }
    function get_pokemon_by_ability($id) {
        $this->db->select('species_id, id');
        $this->db->where('ability_id', $id);
        $query = $this->db->get('ability_sets');
        if ($query->num_rows() > 0) {
            $pokemon_list = array();
            foreach ($query->result() as $pkm) {
                $pokemon = $this->get_pokemon_by_species($pkm->species_id);
                foreach ($pokemon as $key => $value) {
                    $pkm->$key = $value;
                }
                $pokemon_list[] = $pkm;
            }
            function cmp($a, $b) {
                if ($a->dex_id == $b->dex_id) {
                    return 0;
                }
                return ($a->dex_id < $b->dex_id) ? -1 : 1;
            }
            usort($pokemon_list, "cmp");
            return $pokemon_list;
        } else {
            return false;
        }
    }
    # Because original form and additional forms share a learn set,
    # when we get pokemon that can learn a move, we have to get that
    # pokemon's forms, too.
    function get_pokemon_by_move($move_id) {
        $this->db->select('species_id');
        $this->db->where('move_id', $move_id);
        $query = $this->db->get('learn_sets');
        if ($query->num_rows() > 0) {
            $pokemon_list = array();
            foreach ($query->result() as $pkm) {
                $pokemon = $this->get_pokemon_by_species($pkm->species_id);
                $pokemon_list[] = $pokemon;
                $forms = $this->get_pokemon_form($pkm->species_id);
                if ($forms) {
                    foreach ($forms as $pokemon) {
                        $pokemon_list[] = $pokemon;
                    }
                }
            }
            function cmp($a, $b) {
                if ($a->dex_id == $b->dex_id) {
                    return 0;
                }
                return ($a->dex_id < $b->dex_id) ? -1 : 1;
            }
            usort($pokemon_list, "cmp");
            return $pokemon_list;
        } else {
            return false;
        }
    }
    function get_pokemon_by_dex_id() {

    }
    function get_pokemon_species($species_id) {
        $this->db->select('species');
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('pokedex');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    function get_pokemon_form($species_id) {
        $this->db->select('species_id');
        $this->db->where('base_species', $species_id);
        $query = $this->db->get('pokedex');
        if ($query->num_rows() > 0) {
            $forms = array();
            foreach ($query->result() as $form_id) {
                $forms[] = $this->get_pokemon_by_species($form_id->species_id);
            }
            return $forms;
        } else {
            return false;
        }
    }
    function get_pokemon_type($species_id) {
        $this->db->select('type');
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('type_sets');
        if ($query->num_rows() > 0) {
            $types = array();
            foreach ($query->result() as $type) {
                $types[] = $type->type;
            }
            return $types;
        } else {
            return false;
        }
    }
    function get_pokemon_ability($species_id, $ability_id) {
        // $this->db->select('id, ability_name, ability_id');
        $this->db->where('species_id', $species_id);
        $this->db->where('ability_id', $ability_id);
        $query = $this->db->get('ability_sets');
        if ($query->num_rows() > 0) {
            $abilities = $query->row();
            return $abilities;
        } else {
            return false;
        }
    }
    function get_pokemon_abilities($species_id) {
        // $this->db->select('id, ability_name, ability_id');
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('ability_sets');
        if ($query->num_rows() > 0) {
            $abilities = $query->result();
            return $abilities;
        } else {
            return false;
        }
    }
    function get_pokemon_learnset($species_id) {
        $original_form = $this->get_origin($species_id);
        if ($original_form) {
            $this->db->where('species_id', $original_form);
        } else {
            $this->db->where('species_id', $species_id);
        }
        $this->db->select('move_id');
        $query = $this->db->get('learn_sets');
        if ($query->num_rows() > 0) {
            $this->load->model('move_model');
            $learn_sets = array();
            foreach ($query->result() as $move_id) {
                $move = $this->move_model->get_move_by_id($move_id->move_id);
                unset($move->no);
                unset($move->priority);
                unset($move->target);
                unset($move->desc);
                $learn_sets[] = $move;
            }
            return $learn_sets;
        } else return false;
    }
    function get_pokemon_learnset_simple($species_id) {
        $original_form = $this->get_origin($species_id);
        if ($original_form) {
            $this->db->where('species_id', $original_form);
        } else {
            $this->db->where('species_id', $species_id);
        }
        $this->db->select('move_id');
        $query = $this->db->get('learn_sets');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else return false;
    }
    function get_pokemon_strategies($species_id) {
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('strategy_dex');
        $strategies = array();
        if ($query->num_rows() > 0) {
            $basic = $this->get_pokemon_by_species($species_id);
            // return $query->result();
            foreach ($query->result() as $str) {
                $strategy = new stdClass();
                $strategy->id = $str->id;
                $strategy->name = $str->name;
                $strategy->base_hp = $basic->hp;
                $strategy->base_atk = $basic->atk;
                $strategy->base_def = $basic->def;
                $strategy->base_sp_atk = $basic->sp_atk;
                $strategy->base_sp_def = $basic->sp_def;
                $strategy->base_spd = $basic->spd;
                $strategy->species = $this->pokemon_model->get_pokemon_species($str->species_id);
                $strategy->ability = $this->pokemon_model->get_pokemon_ability($str->species_id, $str->ability_id);
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
                $strategies[] = $strategy;
            }
            return $strategies;
        } else {
            return false;
        }
    }
    function get_pokemon_strategy_list($species_id) {
        $this->db->select('id, name');
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('strategy_dex');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_strategy_list() {
        $this->db->select('id, name');
        $query = $this->db->get('strategy_dex');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_strategy_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('strategy_dex');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    function count_pokemon() {
        return $this->db->count_all('pokedex');
    }
    function get_origin($species_id) {
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('pokedex');
        if ($query->num_rows() > 0) {
            return $query->row()->base_species;
        } else {
            return false;
        }
    }
    function get_builder_species_info($species_id) {
        $this->db->where('species_id', $species_id);
        $this->db->select('hp, atk, def, sp_atk, sp_def, spd');
        $query = $this->db->get('pokedex');
        if ($query->num_rows() > 0) {
            $result = new stdClass();
            foreach ($query->row() as $key => $value) {
                $new_key = 'base_'.$key;
                $result->$new_key = $value;
            }
            return $result;
        } else {
            return false;
        }
    }
    // add data to "pokedex" table
    function insert_pokedex($data) {
        $response = new stdClass();
        $query = $this->db->get_where('pokedex', array('dex_id' => $data['dex_id'], 'species_id' => $data['species_id']));
        if ($query->num_rows() > 0) {
            $response->status = 'fail';
            $response->title = 'Fail';
            $response->message = "{$data['species']} has already been added. Skipped";
        } else {
            $query = $this->db->insert('pokedex', $data);
            if ($this->db->affected_rows() > 0) {
                $response->status = 'success';
                $response->title = 'Success';
                $response->message = "Success. {$data['species']} has been added";
            } else {
                $response->status = 'fail';
                $response->title = 'Fail';
                $response->message = "Fail. {$data['species']} has not been added.";
            }
        }
        return $response;
    }
    function insert_type_sets($species_id, $data) {
        $response = new stdClass();
        $response->message = "";
        foreach ($data as $type) {
            $this->db->where('species_id', $species_id);
            $this->db->where('type', $type);
            $query = $this->db->get('type_sets');
            if ($query->num_rows() > 0) {
                $response->success = false;
                $response->message .= "{$species_id} had already have {$type} type. Skip. <br>";
            } else {
                $this->db->insert('type_sets', array('species_id' => $species_id, 'type' => $type));
                if ($this->db->affected_rows() > 0) {
                    $response->success = true;
                    $response->message .= "{$type} has been assigned for {$species_id} successfully. <br>";
                } else {
                    $response->success = false;
                    $response->message .= "{$type} has not been assigned for {$species_id}. Fail. <br>";
                }
            }
        }
        return $response;
    }function delete_type_sets($condition) {
        
    }
    function insert_ability_sets($species_id, $data) {
        $response = new stdClass();
        $response->message = "";
        foreach ($data as $key => $value) {
            $this->db->where('species_id', $species_id);
            $this->db->where('id', $key);
            $this->db->where('ability_name', $value);
            $query = $this->db->get('ability_sets');
            if ($query->num_rows() > 0) {
                $response->success = false;
                $response->message .= "Ability {$value} had already been assigned for {$species_id}. Skip.<br>";
            } else {
                $this->db->insert('ability_sets', array('species_id' => $species_id, 'ability_name' => $value, 'id' => $key));
                if ($this->db->affected_rows() > 0) {
                    $response->success = true;
                    $response->message .= "Ability [{$key}]:{$value} has been assigned for {$species_id} successfully.<br>";
                } else {
                    $response->success = false;
                    $response->message .= "Ability [{$key}]:{$value} has not been assigned for {$species_id}. Fail.<br>";
                }
            }
        }
        return $response;
    }
    function delete_ability_sets($condition) {
        
    }
    function insert_learn_sets($species_id, $data) {
        $response = new stdClass();
        $response->message = "";
        foreach ($data as $move_id) {
            $this->db->where('species_id', $species_id);
            $this->db->where('move_id', $move_id);
            $query = $this->db->get('learn_sets');
            if ($query->num_rows() > 0) {
                $response->success = false;
                $response->message .= "Move #{$move_id} had already been assigned for #{$species_id}. Skip.<br>";
            } else {
                $this->db->insert('learn_sets', array('species_id' => $species_id, 'move_id' => $move_id));
                if ($this->db->affected_rows() > 0) {
                    $response->success = true;
                    $response->message .= "Move #{$move_id} has been assigned for #{$species_id} successfully.<br>";
                } else {
                    $response->success = false;
                    $response->message .= "Move #{$move_id} has not been assigned for #{$species_id}. Fail.<br>";
                }
            }
        }
        return $response;
    }

    function insert_strategy_dex($data) {
        $response = new stdClass();
        $this->db->insert('strategy_dex', $data);
        if ($this->db->affected_rows() > 0) {
            $response->success = true;
            $response->title = '<b class="text-success">Success</b>';
            $response->message = "Strategy {$data['name']} has been assigned for {$data['species_id']} successfully.<br>";
        } else {
            $response->success = false;
            $response->title = '<b class="text-red">Fail</b>';
            $response->message = "Strategy {$data['name']} has not been assigned for {$data['species_id']}. Fail.<br>";
        }
        return $response;
    }
	function edit_pokedex($condition, $data) {
        
    }
    function edit_ability_sets($condition, $data) {
        
    }
    function edit_learn_sets($condition, $data) {
        
    }
    function delete_learn_sets($condition, $data) {
       
    }
    function edit_strategy_dex($condition, $data) {
        $response = new stdClass();
        $response->message = "";
        $this->db->where('id', $condition);
        $this->db->update('strategy_dex', $data);
        if ($this->db->affected_rows() > 0) {
            $response->success = true;
            $response->title = '<b class="text-success">Success</b>';
            $response->message .= "Strategy {$data['name']} has been updated successfully.<br>";
        } else {
            $response->success = false;
            $response->title = '<b class="text-red">Fail</b>';
            $response->message .= "Strategy {$data['name']} has not been updated. Fail.<br>";
        }
        return $response;
    }
 }
