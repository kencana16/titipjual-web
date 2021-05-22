<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct(){
		parent::__construct();

		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}

		$this->load->model('profile_models');
	}

	public function index(){

		$validation = $this->form_validation;
		$validation->set_rules($this->profile_models->rulesUpdate());
		if($validation->run()){
			if($this->profile_models->update()){
				$this->session->set_flashdata('success', 'Data Berhasil Diperbarui');

				$profile = $this->profile_models->showById($this->input->post('id'));
				if($profile->foto == ""){
					$profile_picture_path = "user-default.png";
				}else{
					$profile_picture_path = $profile->foto;
				}
				$logininfo = array(
					'is_logged_in' => true,
					'id_user' => $profile->id_user,
					'username' => $profile->username,
					'no_hp' => $profile->no_hp,
					'photo' => $profile->foto
				);
				$this->session->set_userdata($logininfo);

			}else{
				$this->session->set_flashdata('error', 'Data Gagal Diperbarui');
			}
		}

		$this->load->view('admin/profile');
		
	}

	public function change_password(){

		$pwdValidation = $this->form_validation;
		$pwdValidation->set_rules($this->profile_models->rulesPassword());
		if($pwdValidation->run()){
			if($this->profile_models->update_password()){
				$this->session->set_flashdata('success', 'Password Berhasil Diperbarui');

			}else{
				$this->session->set_flashdata('error', 'Password Gagal Diperbarui');
			}
			redirect(site_url('profile'));
		}

		$this->load->view('admin/profile');
		
	}
}
