<?php
class User_profile_model extends CI_Model {

	function get_user_by_mail($mail){
		$this->db->select('user.id_user, user.name, user.last_name, user.picture, user.mail');
		$this->db->from('user');
		$this->db->where('user.category',2);
		$this->db->where('user.active',1);
		$this->db->where('user.mail',$mail);
		$query = $this->db->get();
		$result = $query -> row_array();
		return $result;
	}

	function get_user_rating_history($id_user){
		$this->db->select('user.id_user, topic.topic_category,topic.title,rating.score, rating.date, rating.comment');
		$this->db->from('user');
		$this->db->join('user_has_rating','user_has_rating.id_user = user.id_user');
		$this->db->join('rating', 'rating.id_rating = user_has_rating.id_rating');
		$this->db->join('topic', 'topic.id_topic = rating.id_topic');
		$this->db->where('user.category',2);
		$this->db->where('user.active',1);
		$this->db->where('user.id_user',$id_user);
		$query = $this->db->get();
		$result = $query -> result_array();
		// $total_rows = count($result);
		// if($total_rows!=0){
			//$score = 0;
			for($i = 0; $i<count($result); $i++){
				$time = strtotime($result[$i]['date']); // formatting the date
			//	$score += $result[$i]['score'];
				$newformat = date('F jS, Y',$time);
				$result[$i]['date'] = $newformat;
			}
			//$score = (float) $score / $total_rows;
			//$score = round($score, 1);
			//var_dump($score);
		//}
		
		return $result;


	}

	function get_user_average_score($id_user){
		$this->db->select('AVG(rating.score) as score');
		$this->db->from('user');
		$this->db->join('user_has_rating','user_has_rating.id_user = user.id_user');
		$this->db->join('rating', 'rating.id_rating = user_has_rating.id_rating');
		$this->db->where('user.category',2);
		$this->db->where('user.active',1);
		$this->db->where('user.id_user',$id_user);
		$query = $this->db->get();
		$result = $query -> row_array();
		return $result;
		//var_dump($result);
	}
}
?>