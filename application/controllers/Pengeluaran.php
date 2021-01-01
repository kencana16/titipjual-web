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
        $this->load->view('admin/pengeluaran/pengeluaran_add');
    }

    public function simpan_pengeluaran(){
        if($this->pengeluaran_models->add())
        $this->session->set_flashdata('success', 'Berhasil Ditambah');
        redirect(site_url('pengeluaran/tambah_pengeluaran'));

    }

    public function detail_pengeluaran($id = null)
    {
        if(!isset($id)) show_404();

        $data['detail_pengeluarans'] = $this->pengeluaran_models->showDetail($id);
        $data['pengeluaran'] = $this->pengeluaran_models->showByID($id);
        $this->load->view('admin/pengeluaran/pengeluaran_detail', $data);
    }

    public function edit_pengeluaran($id = null)
    {
        if(!isset($id)) show_404();

        $data['detail_pengeluarans'] = $this->pengeluaran_models->showDetail($id);
        $data['pengeluaran'] = $this->pengeluaran_models->showByID($id);
        $this->load->view('admin/pengeluaran/pengeluaran_edit', $data);
    }

    public function simpan_edit_pengeluaran(){
        $id = $this->input->post('id');
        $this->pengeluaran_models->edit($id);
        $this->session->set_flashdata('success', 'Berhasil Diupdate');
        redirect(site_url('pengeluaran/edit_pengeluaran/'.$id));
    }

    public function hapus_pengeluaran($id = null){
		if(!isset($id)) show_404();

        if($this->pengeluaran_models->delete($id)){
            redirect(site_url('pengeluaran'));
        }
    }

}