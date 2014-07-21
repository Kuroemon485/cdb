<?php 
class User_Model extends CI_Model {

	function __construct() {
		parent::__construct();
    	$this->load->database();
	}

	function verify_login_user($username, $password) {
		$data = ["username"=>$username, "password"=>$password];
		$this->db->select('username, password');
		$this->db->where($data);
		$query = $this->db->get('users');
		$response = new stdClass();
		if ($query->num_rows() == 1) {
			$response->status = "success";
			$response->title = "Success";
			$response->message = "Logged in to {$query->result()[0]->username}. Redirecting, please wait...";
		} else {
			$response->status = "fail";
			$response->title = "Fail";
			$response->message = "Login fail. Please double check your Username and Password!";
		}
		return $response;
	}
	function check_logged_user($username) {
		$data = ["username"=>$username];
		$this->db->select('username');
		$this->db->where($data);
		$query = $this->db->get('users');
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	function get_user($username) {
		$data = ["username"=>$username];
		$this->db->select('username, position, lv');
		$this->db->where($data);
		$query = $this->db->get('users');
		if ($query->num_rows() == 1) {
			return $query->result()[0];
		} else {
			return false;
		}
	}
}

 ?>