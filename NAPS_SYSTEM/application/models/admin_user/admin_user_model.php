<?php
class Admin_user_model extends CI_Model {
	function get_admin_user(){
		//$this->db->select('id_admin_user, name, last_name','category','mail','active','last_log');
		//$query = $this -> db -> get('admin_user');
		$query = $this->db->query('SELECT id_admin_user, name, last_name, category, mail, active, last_log FROM admin_user');
		$users = $query -> result_array();
		return $users;
	}

	function get_user_data($id){
		$query = $this->db->query('SELECT id_admin_user, name, last_name, category, mail, active FROM admin_user WHERE id_admin_user = '.$id);
		$user = $query -> row_array();
		return $user;
	}
}
?>