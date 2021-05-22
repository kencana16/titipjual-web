<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_models');
	}

	public function index(){
		if($this->session->userdata('is_logged_in')){
			redirect('dashboard');
		}
		$this->load->view('login');
	}

	public function check_login(){
		$valid_user = $this->user_models->check_credential();
		$data['test'] = $valid_user;
		$this->load->view('login', $data);
		if($valid_user == FALSE){
			$this->session->set_flashdata('error', 'email/username atau password salah');
			redirect('login');
		}else{
			if($valid_user->foto == ""){
				$profile_picture_path = "user-default.png";
			}else{
				$profile_picture_path = $valid_user->foto;
			}
			$logininfo = array(
				'is_logged_in' => true,
				'id_user' => $valid_user->id_user,
				'id_penjual' => $valid_user->id_penjual,
				'username' => $valid_user->username,
				'no_hp' => $valid_user->no_hp,
				'photo' => $profile_picture_path,
				'role' => $valid_user->role
			);
			$this->session->set_userdata($logininfo);
			if($this->session->userdata('role') == 0){
				redirect('dashboard');
			}else{
				redirect('penjualanku');
			}
			
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
