<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('main/main_model');
	}
	public function index()
	{
		$this->template->add_js("js/main/main.js");
		$this->template->write_view('menu', 'navigation/user_nav', '', FALSE);
		$this->template->write_view('content', 'main/main', '', FALSE);
		$this->template->render();
		$this->sign_in("davidcastro@outlook.com","12d3tamarindo");
	}

	public function sign_in($mail,$pass){
		$response = $this->main_model->sign_in($mail,$pass);
		var_dump($response);
	}
}