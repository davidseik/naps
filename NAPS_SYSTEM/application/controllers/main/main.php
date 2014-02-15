<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once FCPATH . APPPATH . "controllers/session/session.php";

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('main/main_model');
		$this->check_ses = new Session(); // Create the session class
	}
	public function index($err = '0')
	{
		$this->template->add_js("js/main/main.js");
		$this->template->add_js("js/raty/jquery.raty.js");
		$this->template->add_css("css/main/main.css");
		
		//$this->main_model->clean_everything();

		$session_data = $this->session->all_userdata(); // We get the session Data
		$data = $this->get_main_view_data($session_data); // This method gets all the data for the MAIN view
		$error = $this->get_error_data($err); // We get the error string
		$this->template->write_view('menu', 'navigation/user_nav', $data['menu_data'], FALSE);
		$this->template->write_view('error', 'error/error', $error, FALSE);
		$this->template->write_view('content', 'main/main', array("data"=>$data), FALSE);
		$this->template->render();
	}


	public function insert_rating(){
		$params = array();
		parse_str($_POST['data'],$params);
		$response = $this->main_model->insert_rating($params);
		echo json_encode($response);
	}

	/*
		get_main_view_data

		This functions gets the meaningful data of the session to use it later in the views
	*/
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

			$user_data = $this->main_model->get_user_data(); // Getting all the data from the users
			$result = array("menu_data"=>$menu_data, "user_data"=>$user_data);

		}else{ 
			$menu_data = array("auth"=>0);
			$result = array("menu_data"=>$menu_data);
		}

		/*
			Get the information of the active presentations to show in the main view.
		*/
		if(isset($menu_data['id_user'])){
			$presentation_data = $this->main_model->get_active_presentation($menu_data['id_user']);
		}else{
			$presentation_data = $this->main_model->get_active_presentation();
		}
		
		$arr_length = count($presentation_data);
		for($i = 0; $i<$arr_length; $i++ ){ 
			$time = strtotime($presentation_data[$i]['date']); // formatting the date
			$newformat = date('F jS, Y',$time);
			$presentation_data[$i]['date'] = $newformat;
		}
		$result['presentation_data'] = $presentation_data;

		return $result;
	}

	/*
		Name: get_user_topics
		Usage: gets all the topics by an user ID.
	*/

	public function get_user_topics(){
		echo json_encode($this->main_model->get_user_topics($_POST['id']));
	}


	/*
		Name: sort_user_topic
		Usage: Calls the method of sort_user_topic in the model to retrieve the user information
		according to the selected options in the sorting view provided to the admin. Returns the
		information of the user and the topic.

			Three States
			a) Everything Random
			b) User Selected, Topic Random
			c) User Selected, Topic Selected
	*/
	public function sort_user_topic(){

		$user_select = $_POST['user_select'];
		$topic_select = $_POST['topic_select'];
		$result = $this->main_model->sort_user_topic($user_select,$topic_select);
		echo json_encode($result);
	}

	/*
		Name: set_user_topic_presented
		Usage: Receives an user and a topic and sets that as an active presentation.
	*/
	public function set_user_topic_presented(){
		$this->main_model->set_user_topic_presented($_POST['id_user'],$_POST['id_topic']);
		echo json_encode(array('response'=>1));
	}


	/*
		get_error_data
		$err : Number parameter of the error we want to display

		This functions expects a number to display an error on the screen
	*/
	public function get_error_data($err){
		$data = array();
		switch($err){
			case '1':
				$data['error'] = "You have your mail or your password wrong!";
			break;
			default:
				$data['error'] = "";
			break;
		}
		return $data;
	}

	/*
		Name: sign_in

		Usage: This functions uses the provided mail and password to sign in
		depending on the status received from the database we use a redirection and display
		an error if necessary.
	*/
	public function sign_in(){
		$userName = $this -> input -> post("mail");
		$password = $this -> input -> post("pass");
		$user = $this->main_model->sign_in($userName,$password);
 		switch($user['resp']){
 			case 1:
 			$info = $user['user'];
			$session_data = array(
					'auth'=> 1,
					'id_user'=>$info['id_user'],
					'name'=>$info['name'],
					'last_name'=>$info['last_name'],
					'mail'=>$info['mail'],
					'category'=>$info['category']
					);			
			$this->session->set_userdata($session_data);
			header("Location: ".base_url()."index.php/");

 			break;
 			case 2: // Wrong Password
 				header("Location: ".base_url()."index.php/main/main/index/1"); // #1 is the number of the error, several can be added
 			break;
 			case 3: // Wrong Everything!
 				header("Location: ".base_url()."index.php/main/main/index/1");
 			break;
 		}
	}
}