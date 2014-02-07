<?php
class Admin_user_model extends CI_Model {
	function get_admin_user(){
		$query = $this->db->query('SELECT id_admin_user, name, last_name, category, mail, active, last_log FROM admin_user');
		$users = $query -> result_array();
		return $users;
	}

	function add_user($params){	
		$result;
		$query = $this->db->query('SELECT id_admin_user FROM admin_user WHERE mail = "'.$params['mail'].'"');
		$user_exist = $query -> num_rows();
		if($user_exist != 1){
			$params['password'] = md5($params['password']);
			$this->db->insert('admin_user', $params);
			$result = array("response" =>1); 
		}else{
			$result = array("response" => 0);
		}
		return $result;
	}

	function update_user($params){
		$user = $this->get_user_data($params['id_admin_user']);
		if(isset($params['password'])){
			$params['password'] = md5($params['password']);
		}

		if($user['mail'] == $params['mail']){
			//$params['password'] = md5($params['password']);
			$this->db->where('id_admin_user', $params['id_admin_user']);
			$this->db->update('admin_user', $params);
			$result = array("response"=>1); 
		}else{
			$query = $this->db->query('SELECT id_admin_user FROM admin_user WHERE mail = "'.$params['mail'].'"');
			$user_exist = $query -> num_rows();
			if($user_exist != 1){
				$this->db->where('id_admin_user', $params['id_admin_user']);
				$this->db->update('admin_user', $params);
				$result = array("response"=>1); 
			}else{
				$result = array("response"=>0); 
			}
		}
		 return $result;
	}

	function delete_user($id){
		$this->db->delete('admin_user', array('id_admin_user' => $id));
		$result = $this->db->affected_rows();
		$response;
		if($result == 1){
			$response = array("response"=>1);
		}else{
			$response = array("response"=>0);
		}
		return $response;
	}

	function get_user_data($id){
		$query = $this->db->query('SELECT id_admin_user, name, last_name, category, mail, active FROM admin_user WHERE id_admin_user = '.$id);
		$user = $query -> row_array();
		return $user;
	}
}
?>