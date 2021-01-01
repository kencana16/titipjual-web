<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}

		$this->load->model('barang_models');
	}

	public function tambah_barang()
	{
		$validation = $this->form_validation->set_rules($this->barang_models->rules());
		if($validation->run()){
			if($this->barang_models->add()) $this->session->set_flashdata('success', 'Berhasil Ditambah');
            redirect(current_url());
		}
		$this->load->view('admin/barang/barang_form');
	}

	public function daftar_barang()
	{
		$data['barangs'] = $this->barang_models->showAll();
		$this->load->view('admin/barang/barang_table', $data);
	}

	public function edit_barang($id = null){
		if(!isset($id)) show_404();

		$validation = $this->form_validation->set_rules($this->barang_models->rules());
		if($validation->run()){
			if($this->barang_models->edit($id)) $this->session->set_flashdata('success', 'Berhasil Diupdate');
            redirect(current_url());
		}
		$data['barang'] = $this->barang_models->showById($id);
		$this->load->view('admin/barang/barang_form', $data);
	}

	public function hapus_barang($id = null){
		if(!isset($id)) show_404();

        if($this->barang_models->delete($id)){
            redirect(site_url('barang/daftar_barang'));
        }
	}
}
