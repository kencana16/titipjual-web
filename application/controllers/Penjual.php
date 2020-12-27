<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjual extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}

		$this->load->model('penjual_models');
	}

	public function tambah_penjual()
	{
		$validation = $this->form_validation->set_rules($this->penjual_models->rules());
		if($validation->run()){
			$this->penjual_models->add();
			$this->session->set_flashdata('success', 'Berhasil Ditambah');
            redirect(current_url());
		}
		$this->load->view('admin/penjual/penjual_form');
	}

	public function daftar_penjual()
	{
		$data['penjuals'] = $this->penjual_models->showAll();
		$this->load->view('admin/penjual/penjual_table', $data);
	}

	public function edit_penjual($id){
		$validation = $this->form_validation->set_rules($this->penjual_models->rules());
		if($validation->run()){
			$this->penjual_models->edit($id);
			$this->session->set_flashdata('success', 'Berhasil Diupdate');
            redirect(current_url());
		}
		$data['penjual'] = $this->penjual_models->showById($id);
		$this->load->view('admin/penjual/penjual_form', $data);
	}

	public function hapus_penjual($id){
		if(!isset($id)) show_404();

        if($this->penjual_models->delete($id)){
            redirect(site_url('penjual/daftar_penjual'));
        }
	}

}
