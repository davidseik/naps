<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once FCPATH . APPPATH . "controllers/session/session.php";
class Topic extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('topic/topic_model');
		//$this->load->helper('security');
		//$this->check_ses = new Session();
	}
	public function index()
	{
		$this->template->set_template('admin_template'); // Setting this template as default
		//$this->check_ses->check_session(); // Check session to redirect or not.
		//$session_data = $this->session->all_userdata();
		//$data = $this->get_main_view_data($session_data); // Obtains the necessary data from the session to display

		$topic_data  = $this->get_all_topics();
		//var_dump($topic_data);
		//$user_data = $this->get_admin_user(); // Obtain all the administrative USERS

		/*
			Addind Specific CSS and JS for this module
		*/
		$this->template->add_css('css/plugins/dataTables/dataTables.bootstrap.css');
		$this->template->add_css('css/topic/topic.css');
		$this->template->add_js('js/plugins/dataTables/jquery.dataTables.js');
		$this->template->add_js('js/plugins/dataTables/dataTables.bootstrap.js');	
		$this->template->add_js('js/topic/topic.js');

		//Writting Directly in the username to display it on the admin.
		//$this->template->write('user_name',$data['menu_data']['name'].' '.$data['menu_data']['last_name']);
		//Writting Directly in the mail to display it on the admin.
		//$this->template->write('user_mail',$data['menu_data']['mail']);

		$this->template->write_view('content', 'topic/topic', array("topic_data"=>$topic_data), FALSE);

		//$this->template->write('module_name','Administration Users'); // Writting the name of the module

		$this->template->render();
	}


	public function get_all_topics(){
		return $this->topic_model->get_all_topics();
	}

	public function get_topic(){
		echo json_encode($this->topic_model->get_topic($_POST['id_topic']));
	}

	public function update_topic(){
		$params = array();
		parse_str($_POST['data'],$params);
		$result = $this->topic_model->update_topic($params);
		echo json_encode($result);
		//var_dump($params);
	}
}