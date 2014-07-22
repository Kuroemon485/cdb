<?php 
class Ability_Model extends CI_Model {

	function __construct() {
		parent::__construct();
    	$this->load->database();
	}

	function get_ability() {
		$this->db->select('id, name, rating, short_desc');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('abilities_dex');
		if (count($query->result()) > 0) {
			return($query->result());
		} else {
			return false;
		}
	}
	function get_ability_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('abilities_dex');
		if ($query->result() > 0) {
			return $query->result()[0];
		} else {
			return false;
		}
	}
	function get_ability_by_id_simple($id) {
		$this->db->where('id', $id);
		$this->db->select('id, name');
		$query = $this->db->get('abilities_dex');
		if ($query->result() > 0) {
			return $query->result()[0];
		} else {
			return false;
		}
	}
	function get_ability_list() {
		$this->db->order_by('id', 'asc');
		$this->db->select('id, name');
		$query = $this->db->get('abilities_dex');
		if (count($query->result()) > 0) {
			return $query->result();
		} else {
		   	return false;
		}
	}
	function edit_ability($condition, $data) {
		$response = new stdClass();
		$this->db->where($condition);
		$this->db->update('abilities_dex', $data);
		if ($this->db->affected_rows() == 1) {
			$response->status = "success";
			$response->title = "Success";
			$response->message = "Ability #{$condition['id']} has been updated successfully.";
		} else {
			$response->status = "fail";
			$response->title = "Fail";
			$response->message = "Something went wrong. Ability #{$condition['id']} has not been updated. Please try again later.";
		}
		return $response;
	}
	// import from pokemonshowdown' database
	function add_ability($data) {
		$query = $this->db->get_where('abilities_dex', array('no'=>$data['no'], 'name'=>$data['name']));
		if (count($query->result()) > 0) {
			$response = new stdClass();
			$response->success = false;
			$response->message = "{$data['name']} has already been added, skipped.";
		} else {
			$response = new stdClass();
			$this->db->insert('abilities_dex', $data);
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
	// function add_ability_pokeAPI($data) {
	// 	$this->db->where('name', $data['name']);
	// 	$query = $this->db->get('ability_list');
	// 	if (count($query->result()) > 0) {
	// 		$this->db->where('name', $data['name']);
	// 		$this->db->update('ability_list', array('id' => $data['id']));

	// 		echo "Ability ".$data['name']." exist, updated it. <br>";
	// 	} else {
	// 		$this->db->insert('ability_list', $data);
	// 		echo "added ability ". $data['name'] . " successfully <br>";
	// 	}
	// }
}

 ?>