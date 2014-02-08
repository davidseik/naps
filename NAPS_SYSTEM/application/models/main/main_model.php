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

	function get_user_data(){
		$query = $this->db->query('SELECT * FROM user');
		$users = $query -> result_array();
		return $users;
	}

	function get_user_topics($id){
		//var_dump($id);
		$this->db->select('topic.id_topic, topic.title');
		$this->db->from('user');
		$this->db->join('user_has_topic', 'user_has_topic.id_user = user.id_user');
		$this->db->join('topic', 'topic.id_topic = user_has_topic.id_topic');
		$this->db->where('user.id_user', $id);
		$this->db->where('user_has_topic.active =',1);
		$this->db->where('user_has_topic.presented =',0);
		$this->db->where('topic.active =',1);      
		$query = $this->db->get();
		$result = $query -> result_array();
		return $result;
		//var_dump($result);
		//$query = $this->db->get();
	}
}
?>