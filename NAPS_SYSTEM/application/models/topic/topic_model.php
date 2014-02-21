<?php
class Topic_model extends CI_Model {
	function get_all_topics(){
		$query = $this->db->get("topic");
		$result = $query->result_array();
		return $result;
	}

	function get_topic($id){
		$query = $this->db->get_where("topic", array("id_topic"=>$id));
		$result = $query->row_array();
		return $result;
	}

	function update_topic($params){
		$this->db->where('id_topic', $params['id_topic']);
		$data = array(
					"title"=>$params['title'],
					"topic_category"=>$params['category'],
					"active"=>$params['active']
				);
		$this->db->update('topic', $data);
		$result = array("response"=>1);
		return $result; 
	}

	function add_topic($params){
		$data = array(
		   'title' => $params['title'] ,
		   'topic_category' => $params['category'] ,
		   'active' => $params['active']
		);
		$this->db->insert('topic', $data); 
		return array("response"=>1);
	}

	function delete_topic($id){
		$this->db->delete('topic', array('id_topic' => $id));
		return array("response"=>1); 
	}

}
?>