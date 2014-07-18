<?php 

class Move_Model extends CI_Model {
	
	function __construct() {
		parent::__construct();
    	$this->load->database();
	}

	function get_move() {
		$this->db->select('id, name, type, category, base_power, pp, accuracy, short_desc');
		$query = $this->db->get('attack_dex');
		if (count($query->result()) > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_move_by_id($move_id) {
		$this->db->where('id', $move_id);
		$query = $this->db->get('attack_dex');
		if ($query->num_rows() > 0) {
			return $query->result()[0];
		} else {
			return false;
		}
	}
	function get_move_by_type($type) {
		$this->db->select('id, name, category, base_power, pp, accuracy, short_desc');
		$this->db->where('type', $type);
		$query = $this->db->get('attack_dex');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_move_list() {
		$this->db->order_by('name', 'asc');
		$this->db->select('id, name, type');		
		$query = $this->db->get('attack_dex');
		if ($query->num_rows() > 0) {
		    return $query->result();
		} else {
			return false;
		}
	}
	// import from pokemon showdown's database
	function add_move($data) {
		$query = $this->db->get_where('attack_dex', array('no'=>$data['no'], 'name'=>$data['name']));
		if (count($query->result()) > 0) {
			$response = new stdClass();
			$response->success = false;
			$response->message = "{$data['name']} has already been added, skipped.";
		} else {
			$response = new stdClass();
			$this->db->insert('attack_dex', $data);
			if ($this->db->affected_rows() > 0) {
				$response->success = true;
				$response->message = "{$data['name']} has been added successfully";
			} else {
				$response->success = false;
				$response->message = "{$data['name']} has not been added, fail...";
			}
		}
		return $response;
	}
	// import from PokeAPI
	function add_move_pokeAPI($data) {
		$query = $this->db->get_where('move_list', array('name'=>$data['name']));
		if (count($query->result()) > 0) {
			$response = new stdClass();
			$response->success = false;
			$response->message = "{$data['name']} has already been added, skipped.";
		} else {
			$move_uri = 'http://pokeapi.co/api/v1/move/'.$data['id'];
            $move_data = json_decode(file_get_contents($move_uri));
            $data['category'] = $move_data->category;
            $data['pp'] = $move_data->pp;
            $data['power'] = $move_data->power;
            $data['accuracy'] = $move_data->accuracy;
            $data['effect'] = $move_data->description;
			$this->db->insert('move_list', $data);
			echo 'added move '.$data['name'].' successfully <br>';
		}

	}
	function edit_move($data) {
		$this->db->where('id', $data['id']);
		$query = $this->db->update('move_list', $data);
		if ($query == 1) {
			return array('success'=>true, 'message' => "Move {$data['name']} has been updated");
		} else {
			return array('success'=>false, 'message' => "Move can not be updated");
		}
	}
	function fix_move_list($data) {
		$this->db->where('name', str_replace('-', ' ', $data->name));
		$query = $this->db->get('move_list');
		if (count($query->result())>0) {
			$this->db->where('name', str_replace('-', ' ', $data->name));
			$query = $this->db->update('move_list', array('id' => $data->id, 'effect' => $data->description));
			if ($query == 1) {
				echo "Updated";
			} else {
				echo "Updating failed";
			}
		} else {
			$query = $this->db->insert('move_list', array('id' => $data->id, 'category' => $data->category, 'accuracy' => $data->accuracy, 'name'=>$data->name, 'type'=>"", 'power'=>$data->power, 'pp'=>$data->pp, 'effect' => $data->description, 'description'=>""));
			if ($query == 1) {
				echo "added";
			} else {
				echo "adding failed";
			}
		}
	}
}

 ?>