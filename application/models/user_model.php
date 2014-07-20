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
}

 ?>