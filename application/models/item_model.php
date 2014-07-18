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
}

?>