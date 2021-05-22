<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function __construct(){
		parent::__construct();

		// if(!$this->session->userdata('is_logged_in')){
		// 	$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
		// 	redirect('login');
		// }
		// if($this->session->userdata('role') == 1){
		// 	redirect('penjualanku');
		// }

		$this->load->model('penjualan_models');
    }

    public function index()
    {
        $data['penjualans'] = $this->penjualan_models->showAll();
        $this->load->view('admin/penjualan/penjualan_table', $data);
    }
    
    public function tambah_penjualan()
    {
        $this->load->model('penjual_models');
        $this->load->model('barang_models');
        $data['penjuals'] = $this->penjual_models->showall();
        $data['barangs'] = $this->barang_models->showall();
        $this->load->view('admin/penjualan/penjualan_add', $data);
    }

    public function simpan_penjualan(){
        $this->penjualan_models->add();
        $this->session->set_flashdata('success', 'Berhasil Ditambah');
        redirect(site_url('penjualan/tambah_penjualan'));

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
        $data['pembayaran'] = $this->penjualan_models->getPembayaranTotal($id);
        $this->load->view('admin/penjualan/penjualan_edit', $data);
    }

    public function simpan_edit_penjualan(){
        $id = $this->input->post('id');
        $this->penjualan_models->edit($id);
        $this->session->set_flashdata('success', 'Berhasil Diupdate');
        redirect(site_url('penjualan/edit_penjualan/'.$id));
    }

    public function hapus_penjualan($id = null){
		if(!isset($id)) show_404();

        if($this->penjualan_models->delete($id)){
            redirect(site_url('penjualan'));
        }
    }

    public function get_pembayaran()
    {
        echo json_encode($this->penjualan_models->getPembayaranDetail($this->input->post('id_penjualan')));
    }
    
    public function get_pembayaran_id()
    {
        echo json_encode($this->penjualan_models->getPembayaranRow($this->input->post('id')));
    }

    public function submit_pembayaran()
    {
        $id = $this->input->post('id');
        if($id==""){
            $this->penjualan_models->addPembayaran();
        }else{
            $this->penjualan_models->editPembayaran();
        }

        echo json_encode(array());
    }

    public function delete_pembayaran()
    {
        $this->penjualan_models->deletePembayaran();
        
        echo json_encode(array());
    }

}