<?php
class Topic_model extends CI_Model {
	function get_all_topics(){
		$query = $this->db->get("topic");
		$result = $query->result_array();
		return $result;
	}

	function get_topic($id){
		//var_dump($id);
		$query = $this->db->get_where("topic", array("id_topic"=>$id));
		$result = $query->row_array();
		return $result;
		//var_dump($result);
	}

}
?>