<?php
class Admin_user_model extends CI_Model {
	function get_admin_user(){
		$query = $this->db->query('SELECT id_admin_user, name, last_name, category, mail, active, last_log FROM admin_user');
		$users = $query -> result_array();
		return $users;
	}

	/*
		Name: add_user
		Usage:  
		1.- Check if the usermail already exist (User mail is the login id)
		Exists: Return response of 0 which indicates failure of the process due the existance of the mail
		Doesn't Exist: MD5 of the password, insert of the current data and return a response of 1 that
		indicates the operation was successful.
	*/
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

	/*
		Name: update_user
		Usage:  
		1.- Get the current information of the user that is about to be updated
		2.- If a password is set, MD5 it.
		3.- If the previous mail is equal to the new mail just update with the provided information
		4.- if it's not the same but already exists return a response of 0 which indicates failure
		5.- if it's not the same but it doesn't exist just update the user.
	*/
	function update_user($params){
		$user = $this->get_user_data($params['id_admin_user']);
		if(isset($params['password'])){
			$params['password'] = md5($params['password']);
		}

		if($user['mail'] == $params['mail']){
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

	/*
		Name: delete_user
		Usage:  
		1.- Delete user by ID
		2.- Check if it was deleted; If it was return response of 1 which is success.
		3.- if it wasn't deleted; Return response of 0 which is failure.
	*/
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

	/*
		Name: get_user_data
		Usage:  
		1.- Get the data of an administrative users by a single ID.
	*/
	function get_user_data($id){
		$query = $this->db->query('SELECT id_admin_user, name, last_name, category, mail, active FROM admin_user WHERE id_admin_user = '.$id);
		$user = $query -> row_array();
		return $user;
	}
}
?>