<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('user');
	}

	public function index()
	{
		$valid_user = $this->user->check_credential();
		$this->load->view('login');
	}
}
