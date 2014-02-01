<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once FCPATH . APPPATH . "controllers/session/session.php";
class Admin_user extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin_user/admin_user_model');
		$this->check_ses = new Session();
	}
	public function index()
	{
		$this->check_ses->check_session();

		$session_data = $this->session->all_userdata();
		$data = $this->get_main_view_data($session_data); 

		$user_data = $this->get_admin_user();
		$this->template->set_template('admin_template');
		$this->template->write('user_name',$data['menu_data']['name'].' '.$data['menu_data']['last_name']);
		$this->template->write('user_mail',$data['menu_data']['mail']);

		$this->template->write_view('content', 'admin_user/admin_user', array("user_data"=>$user_data), FALSE);

		$this->template->write('module_name','Administration Users');


		$this->get_admin_user();


		$this->template->render();
	}

	public function get_admin_user(){
		return $this->admin_user_model->get_admin_user();
		//var_dump($users);
	}

	public function get_main_view_data($session_data){
		$result;
		if(isset($session_data['auth'])){
			$menu_data = array(
				"auth"=>1,
				"name"=>$session_data["name"],
				"last_name"=>$session_data["last_name"],
				"mail"=>$session_data["mail"]
			);

			$ui_data = array(
				"auth"=>1
				);
		}else{
			$menu_data = array("auth"=>0);
			$ui_data = array(
				"auth"=>0
				);

		}

		$result = array("menu_data"=>$menu_data, "ui_data"=>$ui_data);
		return $result;
	}
}