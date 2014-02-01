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
		$this->template->add_css("css/main/main.css");
		
		$session_data = $this->session->all_userdata(); // We get the session Data
		$data = $this->get_main_view_data($session_data); // This method gets all the data for the MAIN view
		$error = $this->get_error_data($err); // We get the error string
		$this->template->write_view('menu', 'navigation/user_nav', $data['menu_data'], FALSE);
		$this->template->write_view('error', 'error/error', $error, FALSE);
		$this->template->write_view('content', 'main/main', $data['menu_data'], FALSE);
		$this->template->render();
	}

	/*
		get_main_view_data

		This functions gets the meaningful data of the session to use it later in the views
	*/
	public function get_main_view_data($session_data){ 
		$result;
		if(isset($session_data['auth'])){
			$menu_data = array(
				"auth"=>1,
				"name"=>$session_data["name"],
				"last_name"=>$session_data["last_name"],
				"mail"=>$session_data["mail"]
			);
		}else{
			$menu_data = array("auth"=>0);
		}
		$result = array("menu_data"=>$menu_data);
		return $result;
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
				$data['error'] = "You have your user or your password wrong!";
			break;
			default:
				$data['error'] = "";
			break;
		}
		return $data;
	}

	/*
		sign_in

		This functions uses the provided mail and password to sign in
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