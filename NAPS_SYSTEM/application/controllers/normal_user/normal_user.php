<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once FCPATH . APPPATH . "controllers/session/session.php";
class Normal_user extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin_user/admin_user_model');
		// $this->load->helper('security');
		$this->check_ses = new Session();
	}
	public function index()
	{
		$this->template->set_template('admin_template'); // Setting this template as default
//		$this->check_ses->check_session(); // Check session to redirect or not.

		$session_data = $this->session->all_userdata();
		$data = $this->get_main_view_data($session_data); // Obtains the necessary data from the session to display

		 $user_data = $this->get_normal_user(); // Obtain all the administrative USERS
		 //var_dump($user_data);

		// /*
		// 	Addind Specific CSS and JS for this module
		// */
		$this->template->add_css('css/plugins/dataTables/dataTables.bootstrap.css');
		$this->template->add_css('css/admin_user/admin_user.css');
		$this->template->add_js('js/plugins/dataTables/jquery.dataTables.js');
		$this->template->add_js('js/plugins/dataTables/dataTables.bootstrap.js');	
		$this->template->add_js('js/normal_user/normal_user.js');

		// //Writting Directly in the username to display it on the admin.
		$this->template->write('user_name',$data['menu_data']['name'].' '.$data['menu_data']['last_name']);
		// //Writting Directly in the mail to display it on the admin.
		$this->template->write('user_mail',$data['menu_data']['mail']);

		$this->template->write_view('content', 'normal_user/normal_user', array("user_data"=>$user_data), FALSE);

		// $this->template->write('module_name','Administration Users'); // Writting the name of the module

		$this->template->render();
	}

	public function get_normal_user(){
		return $this->admin_user_model->get_normal_user();
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
