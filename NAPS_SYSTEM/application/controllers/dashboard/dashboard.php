<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once FCPATH . APPPATH . "controllers/session/session.php";
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->check_ses = new Session();
		//$this->load->model('main/main_model');
	}
	public function index()
	{
		$this->check_ses->check_session();

		$session_data = $this->session->all_userdata();
		$data = $this->get_main_view_data($session_data); 

		$this->template->set_template('admin_template');
		$this->template->write('user_name',$data['menu_data']['name'].' '.$data['menu_data']['last_name']);
		$this->template->write('user_mail',$data['menu_data']['mail']);
		$this->template->write('module_name','Dashboard');
		$this->template->render();
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

		}else{
			$menu_data = array("auth"=>0);
		}

		$result = array("menu_data"=>$menu_data);
		return $result;
	}
}