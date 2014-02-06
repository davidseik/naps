<?php
class Main_model extends CI_Model {
	function sign_in($mail,$pass){
		//$query = $this -> db -> get_where('admin_user', array('mail' => $mail, 'password' => md5($pass)));
		$query = $this->db->query('SELECT id_admin_user, name, last_name, category, mail, active, last_log FROM admin_user WHERE mail="'.$mail.'" AND password="'.md5($pass).'" AND active = 1');
		$arr;
		if($query->num_rows()==1){
			$user = $query -> row_array();
			$this -> db -> update('admin_user', array('last_log' => date("Y-m-d h:i:s")), array('id_admin_user' => $user['id_admin_user']));
			$arr = array("resp"=>1,"user"=>$user);
		}else{
			// $query = $this -> db -> get_where('admin_user', array('mail' => $mail));
			// if($query->num_rows()==1){
			// 	$arr = array("resp"=>2); // Wrong password only
			// }else{
			// 	$arr = array("resp"=>3); // Both Wrong
			// }
			$arr = array("resp" =>3);
		}
		return $arr;
	}
}
?>