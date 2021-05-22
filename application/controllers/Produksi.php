<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}
		if($this->session->userdata('role') == 1){
			redirect('penjualanku');
		}

		$this->load->model('produksi_models');
		$this->load->model('barang_models');
    }

    public function index()
    {
        $data['produksis'] = $this->produksi_models->showAll();
        $this->load->view('admin/produksi/produksi_table', $data);
    }
    
    public function tambah_produksi()
	{
		$validation = $this->form_validation->set_rules($this->produksi_models->rules());
		if($validation->run()){
			if($this->produksi_models->add()) $this->session->set_flashdata('success', 'Berhasil Ditambah');
            redirect(current_url());
        }
        $data['barangs'] = $this->barang_models->showAll();
		$this->load->view('admin/produksi/produksi_form', $data);
	}

    public function edit_produksi($id = null){
		if(!isset($id)) show_404();

		$validation = $this->form_validation->set_rules($this->produksi_models->rules());
		if($validation->run()){
			if($this->produksi_models->edit($id)) $this->session->set_flashdata('success', 'Berhasil Diupdate');
            redirect(current_url());
		}
        $data['produksi'] = $this->produksi_models->showById($id);
        $data['barangs'] = $this->barang_models->showAll();
		$this->load->view('admin/produksi/produksi_form', $data);
	}

    public function hapus_produksi($id = null){
		if(!isset($id)) show_404();

        if($this->produksi_models->delete($id)){
            redirect(site_url('produksi'));
        }
    }

}