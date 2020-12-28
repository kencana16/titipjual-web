<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}

		$this->load->model('pengeluaran_models');
    }

    public function index()
    {
        $data['pengeluarans'] = $this->pengeluaran_models->showAll();
        $this->load->view('admin/pengeluaran/pengeluaran_table', $data);
    }
    
    public function tambah_pengeluaran()
    {
        $validation = $this->form_validation->set_rules($this->pengeluaran_models->rules());
		if($validation->run()){
			$this->session->set_flashdata('success', 'Berhasil Ditambah');
            redirect(current_url());
        }
        $this->load->view('admin/pengeluaran/pengeluaran_add');
    }
}