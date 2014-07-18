<?php

class Pokemon_Model extends CI_Model {

	function __construct() {
		parent::__construct();
    	$this->load->database();
	}
    function get_pkm_list() {
        $this->db->select('dex_id, species_id, species');
        $this->db->order_by('dex_id', 'asc');
        $this->db->order_by('species', 'asc');
        $query = $this->db->get('pokedex');
        return $query->result();
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
    function get_pkm_by_species($species_id) {
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('pokedex');
        if ($query->num_rows() > 0) {
            $pokemon = $query->result()[0];
            $pokemon->types = $this->get_pkm_type($pokemon->species_id);
            $pokemon->abilities = $this->get_pkm_abilities($pokemon->species_id);
            return $pokemon;
        } else {
            return false;
        }
    }
    function get_pkm_by_type($type) {
        $this->db->where('type', $type);
        $this->db->select('species_id');
        $query = $this->db->get('type_sets');
        if ($query->num_rows() > 0) {
            $pokemon = array();
            foreach ($query->result() as $pkm) {
                $pokemon[] = $this->get_pkm_by_species($pkm->species_id);
            }
            return $pokemon;
        } else {
            return false;
        }
    }
    function get_pkm_by_ability($id) {
        $this->db->select('species_id, id');
        $this->db->where('ability_id', $id);
        $query = $this->db->get('ability_sets');
        if ($query->num_rows() > 0) {
            $pokemon_list = array();
            foreach ($query->result() as $pkm) {
                $pokemon = $this->get_pkm_by_species($pkm->species_id);
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
    function get_pkm_by_move($move_id) {
        $this->db->select('species_id');
        $this->db->where('move_id', $move_id);
        $query = $this->db->get('learn_sets');
        if ($query->num_rows() > 0) {
            $pokemon_list = array();
            foreach ($query->result() as $pkm) {
                $pokemon = $this->get_pkm_by_species($pkm->species_id);
                $pokemon_list[] = $pokemon;
                $forms = $this->get_pkm_form($pkm->species_id);
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
    function get_pkm_by_dex_id() {

    }
    function get_pkm_species($species_id) {
        $this->db->select('species');
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('pokedex');
        if ($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return false;
        }
    }
    function get_pkm_form($species_id) {
        $this->db->select('species_id');
        $this->db->where('base_species', $species_id);
        $query = $this->db->get('pokedex');
        if ($query->num_rows() > 0) {
            $forms = array();
            foreach ($query->result() as $form_id) {
                $forms[] = $this->get_pkm_by_species($form_id->species_id);
            }
            return $forms;
        } else {
            return false;
        }
    }
    function get_pkm_type($species_id) {
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
    function get_pkm_ability($species_id, $ability_id) {
        $this->db->select('id, ability_name, ability_id');
        $this->db->where('species_id', $species_id);
        $this->db->where('ability_id', $ability_id);
        $query = $this->db->get('ability_sets');
        if ($query->num_rows() > 0) {
            $abilities = $query->result()[0];
            return $abilities;
        } else {
            return false;
        }
    }
    function get_pkm_abilities($species_id) {
        $this->db->select('id, ability_name, ability_id');
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('ability_sets');
        if ($query->num_rows() > 0) {
            $abilities = $query->result();
            return $abilities;
        } else {
            return false;
        }
    }
    function get_pkm_learnset($species_id) {
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
    function get_pkm_learnset_simple($species_id) {
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
    function get_pkm_strategies($species_id) {
        $this->db->where('species_id', $species_id);
        $query = $this->db->get('strategy_dex');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_pkm_strategy_list($species_id) {
        $this->db->select('id, name');
        $this->db->where('species_id', $species_id);
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
            return $query->result()[0];
        } else {
            return false;
        }
    }
    function count_pkm() {
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
    function add_pokemon($data) {
        $response = new stdClass();
        $query = $this->db->get_where('pokedex', array('dex_id' => $data['dex_id'], 'species_id' => $data['species_id']));
        if ($query->num_rows() > 0) {
            $response->success = false;
            $response->message = "{$data['species']} has already been added. Skipped";
        } else {
            $query = $this->db->insert('pokedex', $data);
            if ($this->db->affected_rows() > 0) {
                $response->success = true;
                $response->message = "Success. {$data['species']} has been added";
            } else {
                $response->success = false;
                $response->message = "Fail. {$data['species']} has not been added.";
            }
        }
        return $response;
    }
    function add_pkm_type($species_id, $data) {
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
    }
    function add_pkm_ability($species_id, $data) {
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

    function add_pkm_learnset($species_id, $data) {
        $response = new stdClass();
        $response->message = "";
        foreach ($data as $move_id) {
            $this->db->where('species_id', $species_id);
            $this->db->where('move_id', $move_id);
            $query = $this->db->get('learn_sets');
            if ($query->num_rows() > 0) {
                $response->success = false;
                $response->message .= "Move {$move_id} had already been assigned for {$species_id}. Skip.<br>";
            } else {
                $this->db->insert('learn_sets', array('species_id' => $species_id, 'move_id' => $move_id));
                if ($this->db->affected_rows() > 0) {
                    $response->success = true;
                    $response->message .= "Move {$move_id} has been assigned for {$species_id} successfully.<br>";
                } else {
                    $response->success = false;
                    $response->message .= "Move {$move_id} has not been assigned for {$species_id}. Fail.<br>";
                }
            }
        }
        return $response;
    }

    function add_pkm_strategy($data) {
        $response = new stdClass();
        $response->message = "";
        $this->db->insert('strategy_dex', $data);
        if ($this->db->affected_rows() > 0) {
            $response->success = true;
            $response->message .= "Strategy {$data['name']} has been assigned for {$data['species_id']} successfully.<br>";
        } else {
            $response->success = false;
            $response->message .= "Strategy {$data['name']} has not been assigned for {$data['species_id']}. Fail.<br>";
        }
        return $response;
    }
	function edit_pkm_basic($data) {
        
    }
    function edit_pkm_ability($data) {
        
    }
    function edit_pkm_type($data) {
        
    }
    function edit_pkm_move($data) {
       
    }
    function edit_pkm_strategy($id, $data) {
        $response = new stdClass();
        $response->message = "";
        $this->db->where('id', $id);
        $this->db->update('strategy_dex', $data);
        if ($this->db->affected_rows() > 0) {
            $response->success = true;
            $response->message .= "Strategy {$data['name']} has been updated successfully.<br>";
        } else {
            $response->success = false;
            $response->message .= "Strategy {$data['name']} has not been updated. Fail.<br>";
        }
        return $response;
    }
 }
