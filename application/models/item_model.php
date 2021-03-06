<?php
class Item_Model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	function get_item() {
		$this->db->select('id, name, desc');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('items_dex');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_item_list() {
		$this->db->select('id, name');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('items_dex');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_item_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('items_dex');
		if ($query->num_rows() > 0) {
			return $query->result()[0];
		} else {
			return false;
		}
	}
	function get_strategy_for_item($id) {
		$this->db->select('id, name, strategy_dex.species_id, item_id, pokedex.species');
		$this->db->from('strategy_dex');
		$this->db->join('pokedex', 'strategy_dex.species_id = pokedex.species_id', 'left');
		$this->db->where('item_id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function add_item($data) {
		$response = new stdClass();
		$this->db->where('id', $data['id']);
		$check = $this->db->get('items_dex');
		if (count($check->result()) > 0) {
			$response->success = false;
			$response->message = "{$data['name']} had already been in added before. Skipped.";
		} else {
			$query = $this->db->insert('items_dex', $data);
			if ($this->db->affected_rows() > 0) {
				$response->success = true;
				$response->message = "Success. {$data['name']} has been added.";
			} else {
				$response->success = false;
				$response->message = "Fail. {$data['name']} has not been added";
			}
		}
		return $response;
	}
	function edit_item($condition, $data) {
		$response = new stdClass();
		$this->db->where($condition);
		$this->db->update('items_dex', $data);
		if ($this->db->affected_rows() == 1) {
			$response->status = "success";
			$response->title = "Success";
			$response->message = "Item #{$condition['id']} has been updated successfully.";
		} else {
			$response->status = "fail";
			$response->title = "Fail";
			$response->message = "Something went wrong. Item #{$condition['id']} has not been updated. Please try again later.";
		}
		return $response;
	}
}

?>