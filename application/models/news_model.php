<?php 
class News_Model extends CI_Model {

	function __construct() {
		parent::__construct();
    	$this->load->database();
	}
	function get_news() {
		$query = $this->db->get('news');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_news_list() {
		$this->db->select('id, title');
		$query = $this->db->get('news');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_news_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('news');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function insert_news($data) {
		$response = new stdClass();
		$this->db->insert('news', $data);
		if ($this->db->affected_rows() == 1) {
			$response->status = "success";
			$response->title = "Success";
			$response->message = "Your news has been posted successfully.";
		} else {
			$response->status = "fail";
			$response->title = "Fail";
			$response->message = "Something went wrong. Please try again later.";
		}
		return $response;
	}
	function edit_news($condition, $data) {
		$response = new stdClass();
		$this->db->where($condition);
		$this->db->update('news', $data);
		if ($this->db->affected_rows() == 1) {
			$response->status = "success";
			$response->title = "Success";
			$response->message = "Your annoucement has been edited successfully.";
		} else {
			$response->status = "fail";
			$response->title = "Fail";
			$response->message = "Something went wrong. Please try again later.";
		}
		return $response;
	}
}

 ?>