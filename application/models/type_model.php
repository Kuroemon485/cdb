<?php 
class Type extends CI_Model {

	function __construct() {
		parent::__construct();
    	$this->load->database();
	}

	function get_type_list() {
		$query = "SELECT type_id, type_name FROM type_list";
		$result = $this->db->query($query);
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo $message;
		} else {
			$type_list = array();
			foreach($result->result() as $type) {
				$type_list[] = $type;
			}
			return $type_list;
		}
	}
	function add_type($data) {
		$id = isset($data['id']) ? $data['id'] : null;
		$name = isset($data['name']) ? $data['name'] : null;
		
		$query = sprintf("INSERT INTO type_list VALUES ('%s', '%s')",
			mysql_escape_string($id),
			mysql_escape_string($name));

		$result = mysql_query($query);

		if ($result) {
			$response['success'] = 1;
		} else {
			$response['success'] = 0;
			$response['error_detail'] = mysql_error();
			$response['full query'] = $query;
		}
		echo json_encode($response);
		return;
	}


}

 ?>