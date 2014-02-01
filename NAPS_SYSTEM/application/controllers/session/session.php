<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function check_session(){ // Comeback Later here because I think this is shady
			if($this->session->userdata('auth')){
				//Switch of redirections
			}else{
				$this->session->sess_destroy();
				header("Location: ".base_url().'index.php/');
			}
	}

	public function destroy_session(){
		$this->session->sess_destroy();
		header("Location: ".base_url().'index.php/');
	}
}