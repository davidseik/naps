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
		$query = $this->db->query('SELECT * FROM user WHERE active = 1');
		$users = $query -> result_array();
		return $users;
	}

	function get_user($id){
		$query = $this->db->get_where('user', array('id_user' => $id));
		$result = $query -> row_array();
		return $result;
	}

	function get_topic($id){
		$query = $this->db->get_where('topic', array('id_topic' => $id));
		$result = $query -> row_array();
		return $result;
	}

	function get_user_topics($id){
		$this->db->select('topic.id_topic, topic.title');
		$this->db->from('user');
		$this->db->join('user_has_topic', 'user_has_topic.id_user = user.id_user');
		$this->db->join('topic', 'topic.id_topic = user_has_topic.id_topic');
		$this->db->where('user.id_user', $id);
		$this->db->where('user.active =',1);
		$this->db->where('user_has_topic.active =',1);
		$this->db->where('topic.active =',1);      
		$query = $this->db->get();
		$result = $query -> result_array();
		return $result;
	}



	/*
		TODO: 
		Random Assign Person
		Random Assign Subject
		Validate to not assign a person presenting today
		Clean Topics and Presented

	*/
	function sort_user_topic($user_select, $topic_select){
		//var_dump($user_select, $topic_select);
		//$this->get_random_user();
		//$this->get_random_topic_by_user(1);
		$result;
		if($user_select == '0' && $topic_select == '0'){
			//var_dump("Everything Random");
			//$random_user = $this->get_random_user();
			//$random_topic = $this->get_random_topic_by_user($random_user['id_user']);
			//å$result = array_merge($random_user, $random_topic);
			//$this->clean_users_presented();
			//$this->clean_topics_by_user(1);
			//var_dump($result);


		}else if($user_select != '0' && $topic_select == '0'){
			var_dump("Person Selected and Subject Random");
		}else{

			$user = $this->get_user($user_select);
			$topic = $this->get_topic($topic_select);

			$result = array("id_user"=>$user['id_user'], "name"=>($user['name'].' '.$user['last_name']), "id_topic"=>$topic['id_topic'], "title"=>$topic['title'],'validate'=>1);
			//$this->get_presentation_history_user_by_date($user['id_user'], $topic['id_topic']);
			//var_dump();
		}
		return $result;

	}



	function set_user_topic_presented($user_id,$topic_id){
		$this->db->insert('presentation_history', array('id_user'=>$user_id, 'id_topic'=>$topic_id,'date'=>date("Y-m-d h:i:s"),'active'=>1));
	}

	function get_presentation_history_user_by_date($id, $date){
		$query = $this->db->get_where('presentation_history', array('id_user' => $id, 'date LIKE'=>date("Y-m-d h:i:s")));
		$result = $query -> result_array();
		var_dump($result);
		return $result;
	}

	function get_random_user(){
		$query = $this->db->query('SELECT * FROM user WHERE presented = 0 ORDER BY RAND() LIMIT 1');
		$user = $query -> row_array();
		return $user;
	}

	function get_random_topic_by_user($id){
		$this->db->select('topic.id_topic, topic.title');
		$this->db->from('user');
		$this->db->join('user_has_topic', 'user_has_topic.id_user = user.id_user');
		$this->db->join('topic', 'topic.id_topic = user_has_topic.id_topic');
		$this->db->where('user.id_user', $id);
		$this->db->where('user_has_topic.active =',1);
		$this->db->where('topic.active =',1);
		$this->db->where('user_has_topic.presented =',0);
		$this->db->order_by("RAND()");
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query -> row_array();
		return $result;
	}

	//function set_user_and

	// Set all the presented topics by a user to NOT PRESENTED
	function clean_topics_by_user($id){ 
		$this->db->select('topic.id_topic');
		$this->db->from('user');
		$this->db->join('user_has_topic', 'user_has_topic.id_user = user.id_user');
		$this->db->join('topic', 'topic.id_topic = user_has_topic.id_topic');
		$this->db->where('user.id_user', $id);
		$this->db->where('user_has_topic.active =',1);
		$this->db->where('topic.active =',1);	
		$query = $this->db->get();
		$result = $query -> result_array();
		foreach($result as $row){
			$this->db->where('id_topic', $row['id_topic']);
			$this->db->update('user_has_topic', array('presented'=>0));
		}
	}

	function clean_users_presented(){
		$result = $this->get_user_data();
		foreach($result as $user){
			$this->db->where('id_user', $user['id_user']);
			$this->db->update('user', array('presented'=>0));
		}
	}



	function get_active_presentation(){
		$this->db->select('user.id_user, user.name, user.last_name, user.picture, topic.title, presentation_history.date');
		$this->db->from('presentation_history');
		$this->db->join('user', 'presentation_history.id_user = user.id_user');
		$this->db->join('topic', 'topic.id_topic = presentation_history.id_topic');
		$this->db->where('presentation_history.active =',1);
		$query = $this->db->get();
		$result = $query -> result_array();
		return $result;
	}
}
?>