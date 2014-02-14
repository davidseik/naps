<?php
class Main_model extends CI_Model {

	/*
		Name: sign_in
		Usage:
		1.- Check if a user exist with the provided credentials, if it does return the information and update the last_log
		2.- if it doesn't eixst return a response of 3 which is a fail to login.
	*/
	function sign_in($mail,$pass){
		$query = $this->db->query('SELECT id_user, name, last_name, category, mail, active, last_log FROM user WHERE mail="'.$mail.'" AND password="'.md5($pass).'" AND active = 1');
		$arr;
		if($query->num_rows()==1){
			$user = $query -> row_array();
			$this -> db -> update('user', array('last_log' => date("Y-m-d h:i:s")), array('id_user' => $user['id_user']));
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
	
	/*
		Name: get_user_data
		Usage: gets the information of all the active  presentation users in the system.
	*/	
	function get_user_data(){
		$query = $this->db->query('SELECT * FROM user WHERE active = 1 AND category = 2');
		$users = $query -> result_array();
		return $users;
	}
	/*
		Name: get_user
		Usage: gets the information of a single user with an ID provided.
	*/	
	function get_user($id){
		$query = $this->db->get_where('user', array('id_user' => $id));
		$result = $query -> row_array();
		return $result;
	}

	/*
		Name: get_topic
		Usage: gets the topic information with an ID provided.
	*/	
	function get_topic($id){
		$query = $this->db->get_where('topic', array('id_topic' => $id));
		$result = $query -> row_array();
		return $result;
	}

	/*
		Name: get_user_topics
		Usage: gets the topics of a user through its ID;
		Restrictions: User must be active, the topic for the user must be active, the topic must be active.
	*/	
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
		Name: sort_user_topic
		Usage:
		Three Scenarios
			a) Random User, Random Topic
				- Get random user that hasn't presented
				- If all the users already presented clean the users (Set presented of all the users to zero)
					- Get random user that hasn't presented
				- Get random topic for the user selected
				- if all the topics of the user are already presented, clean the topics of the user (Set presented
				of all the topics of that user to zero)
					- Get random topic for the user selected
				- Construct an array with all the information that will be returned to the main view and decide
				if that user is going to present or not.

			b) Selected User, Random Topic
				- User ID is set, get the information of that user
				- Get random topic for the user selected
				- if all the topics of the user are already presented, clean the topics of the user (Set presented
				of all the topics of that user to zero)
					- Get random topic for the user selected
				- Construct an array with all the information that will be returned to the main view and decide
				if that user is going to present or not.

			c) Selected User, Selected Topic
				- User ID is set, get the information of that user
				- Topic ID is set, get the information of that topic
				- Construct an array with all the information that will be returned to the main view and decide
				if that user is going to present or not.

	*/	
	function sort_user_topic($user_select, $topic_select){
		$result;
		if($user_select == '0' && $topic_select == '0'){
			$user = $this->get_random_user();
			if(!count($user)){
				$this->clean_users_presented();
				$user = $this->get_random_user();
			}
			$topic = $this->get_random_topic_by_user($user['id_user']);
			if(!count($topic)){
				$this->clean_topics_by_user($user['id_user']);
				$topic = $this->get_random_topic_by_user($user['id_user']);
			}
			$result = array("id_user"=>$user['id_user'], "name"=>($user['name'].' '.$user['last_name']), "id_topic"=>$topic['id_topic'], "title"=>$topic['title'],'validate'=>1);

		}else if($user_select != '0' && $topic_select == '0'){
			$user = $this->get_user($user_select);
			$topic = $this->get_random_topic_by_user($user_select);
			if(!count($topic)){
				$this->clean_topics_by_user($user['id_user']);
				$topic = $this->get_random_topic_by_user($user['id_user']);
			}
			$result = array("id_user"=>$user['id_user'], "name"=>($user['name'].' '.$user['last_name']), "id_topic"=>$topic['id_topic'], "title"=>$topic['title'],'validate'=>1);

		}else{
			$user = $this->get_user($user_select);
			$topic = $this->get_topic($topic_select);
			if(!$this->get_presentation_history_user_by_date($user['id_user'], $topic['id_topic'])){
				$result = array("id_user"=>$user['id_user'], "name"=>($user['name'].' '.$user['last_name']), "id_topic"=>$topic['id_topic'], "title"=>$topic['title'],'validate'=>1);
			}else{
				$result = array("validate"=>0);
			}
		}
		return $result;
	}

	/*
		Name: set_user_topic_presented
		Usage: 
			- Insert user presentation for a user with a topic
			- update that certain topic to presented
			- update that certain user to presented
	*/	

	function set_user_topic_presented($user_id,$topic_id){
		$this->db->insert('presentation_history', array('id_user'=>$user_id, 'id_topic'=>$topic_id,'date'=>date("Y-m-d h:i:s"),'active'=>1));
		$this->db->update('user_has_topic', array('presented'=>1), array('id_user' => $user_id, 'id_topic'=>$topic_id));
		$this->db->update('user', array('presented'=>1), array('id_user' => $user_id));
	}

	/*
		Name: get_presentation_history_user_by_date
		Usage: Validation to check if a user is presenting a provided topic today
	*/	

	function get_presentation_history_user_by_date($id, $topic){
		$query = $this->db->query('SELECT * FROM presentation_history WHERE presentation_history.date LIKE "%'.date("Y-m-d").'%" AND id_topic ='.$topic.' AND id_user ='.$id);
		$result = $query -> result_array();
		$rows_affected = $this->db->affected_rows();
		return $rows_affected;
	}

	/*
		Name: get_random_user
		Usage: Gets a random user that hasn't presented.
		TODO: CHECK IF USER IS ACTIVE
	*/	

	function get_random_user(){
		$query = $this->db->query('SELECT * FROM user WHERE presented = 0 AND category = 2 ORDER BY RAND() LIMIT 1');
		$user = $query -> row_array();
		return $user;
	}
	/*
		Name: get_random_topic_by_user
		Usage: Gets a random topic for a user id provided; The topic for that user must be active;
		The topic must be active; the topic for that user must not be presented already.
	*/	

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

	/*
		Name: clean_topics_by_user
		Usage: Set all the topics.presented of a user id provided to 0 (Not presented)
	*/	
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
			$this->db->where('id_user', $id);
			$this->db->update('user_has_topic', array('presented'=>0));
		}
	}
	/*
		Name: clean_users_presented
		Usage: Set all the users.presented to 0 (Haven't presented)
	*/	
	function clean_users_presented(){
		$result = $this->get_user_data();
		foreach($result as $user){
			$this->db->where('id_user', $user['id_user']);
			$this->db->update('user', array('presented'=>0));
		}
	}

	/*
		Name: clean_everything
		Usage: Cleans all the user.presented, topic.presented and presentation history
	*/	

	function clean_everything(){
		$this->db->update('user_has_topic', array('presented'=>0));
		$this->db->update('user', array('presented'=>0));
		$this->db->empty_table('presentation_history'); 
		$this->db->empty_table('user_has_rating');
		$this->db->empty_table('rating');
	}

	/*
		Name: get_active_presentation
		Usage: Getting all the active presentations from the presentation history to be evaluated.
	*/	
	function get_active_presentation(){
		$this->db->select('user.id_user, user.name, user.last_name, user.picture, topic.id_topic, topic.title, presentation_history.date');
		$this->db->from('presentation_history');
		$this->db->join('user', 'presentation_history.id_user = user.id_user');
		$this->db->join('topic', 'topic.id_topic = presentation_history.id_topic');
		$this->db->where('presentation_history.active =',1);
		$query = $this->db->get();
		$result = $query -> result_array();
		return $result;
	}

	function insert_rating($params){
		//var_dump($this->config->item('max_rates'));
		$result;

		$data_rating = array(
		   'id_topic' => $params['id_topic'],
		   'score' => $params['score'],
		   'date' => date("Y-m-d h:i:s"),
		   'comment'=>$params['comment']
		);

		$this->db->insert('rating', $data_rating); 
		if($this->db->affected_rows() == 1){
			$insert_id = $this->db->insert_id();
			$data_user_has_rating = array(
			   'id_rating' => $insert_id,
			   'id_user' => $params['id_user']
			);
			$this->db->insert('user_has_rating', $data_user_has_rating);
			if($this->db->affected_rows() == 1){
				$result = array("response"=>1);
			}else{ // Failed to add rating to user
				$result = array("response"=>0);
			}
		}else{
			$result = array("response"=>0);
		} 
		return $result;
	}
}
?>