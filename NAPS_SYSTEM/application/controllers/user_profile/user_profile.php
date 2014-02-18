<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once FCPATH . APPPATH . "controllers/session/session.php";

class User_profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('user_profile/user_profile_model');
		//$this->check_ses = new Session(); // Create the session class
	}
	public function index($param){


		$this->template->add_css("css/user_profile/user_profile.css");
		$user = $this->get_user_by_mail($param);
		if($user){ // Check if the user exists.
			$rating_history = $this->get_user_rating_history($user['id_user']);
			$average = $this->get_user_average_score($user['id_user']);
			$user['score'] = round($average['score'],1);
			$data = $this->get_main_view_data($this->session->all_userdata()); // This method gets all the data for the MAIN view
			$this->template->write_view('menu', 'navigation/user_nav', $data['menu_data'], FALSE);
			//$this->template->write_view('error', 'error/error', $error, FALSE);
			$this->template->write_view('content', 'user_profile/user_profile', array("user_data"=>$user, "rating_history"=>$rating_history), FALSE);
			$this->template->render();

		}else{
			header("Location: ".base_url().'index.php/');
		}
	}

		public function get_main_view_data($session_data){ 
		$result;
		if(isset($session_data['auth'])){
			$menu_data = array( // This is the data for the menu
				"auth"=>1,
				"id_user"=>$session_data["id_user"],
				"name"=>$session_data["name"],
				"last_name"=>$session_data["last_name"],
				"mail"=>$session_data["mail"],
				"category"=>$session_data["category"]
			);

			$result = array("menu_data"=>$menu_data);

		}else{ 
			$menu_data = array("auth"=>0);
			$result = array("menu_data"=>$menu_data);
		}

		return $result;
	}

	public function get_user_by_mail($mail){
		return $this->user_profile_model->get_user_by_mail($mail);
	}

	public function get_user_average_score($id_user){
		return $this->user_profile_model->get_user_average_score($id_user);
	}

	public function get_user_rating_history($id_user){
		return $this->user_profile_model->get_user_rating_history($id_user);
	}

}