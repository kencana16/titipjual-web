<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualanku extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}
		if($this->session->userdata('role') == 0){
			redirect('dashboard');
		}

		$this->load->model('penjualan_models');
    }

    public function index()
    {
        $data['penjualans'] = $this->penjualan_models->showByPenjual($this->session->userdata('id_penjual'));
        $this->load->view('penjual/penjualan/penjualan_table', $data);
    }

    public function edit_penjualan($id = null)
    {
        if(!isset($id)) show_404();

        $this->load->model('penjual_models');
        $this->load->model('barang_models');
        $data['penjuals'] = $this->penjual_models->showall();
        $data['barangs'] = $this->barang_models->showall();
        $data['detail_penjualans'] = $this->penjualan_models->showDetail($id);
        $data['penjualan'] = $this->penjualan_models->showByID($id);
        $this->load->view('penjual/penjualan/penjualan_edit', $data);
    }

    public function simpan_edit_penjualan(){
        $id = $this->input->post('id');
        $this->penjualan_models->edit($id);
        $this->session->set_flashdata('success', 'Berhasil Diupdate');
        redirect(site_url('penjualanku/edit_penjualan/'.$id));
    }

    
    public function get_barang_json()
	{
        $this->load->model('barang_models');
		echo json_encode($this->barang_models->getJsonBarang());
	}

}