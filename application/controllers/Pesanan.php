<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {
    public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}
		if($this->session->userdata('role') == 1){
			redirect('penjualanku');
		}

		$this->load->model('pesanan_models');
	}
	
	public function index()
    {
        $data['pesanans'] = $this->pesanan_models->showAll();
        $this->load->view('admin/pesanan/pesanan_table', $data);
    }
    
    public function tambah_pesanan()
    {
        $this->load->model('barang_models');
        $data['barangs'] = $this->barang_models->showall();
        $this->load->view('admin/pesanan/pesanan_add', $data);
    }

    public function simpan_pesanan(){
        $this->pesanan_models->add();
        $this->session->set_flashdata('success', 'Berhasil Ditambah');
        redirect(site_url('pesanan/tambah_pesanan'));
        
    }

    public function edit_pesanan($id = null)
    {
        if(!isset($id)) show_404();

        $this->load->model('barang_models');
        $data['barangs'] = $this->barang_models->showall();
        $data['detail_pesanans'] = $this->pesanan_models->showDetail($id);
        $data['pesanan'] = $this->pesanan_models->showByID($id);
        $data['pembayaran'] = $this->pesanan_models->getPembayaranTotal($id);
        $this->load->view('admin/pesanan/pesanan_edit', $data);
    }

    public function simpan_edit_pesanan(){
        $id = $this->input->post('id');
        $this->pesanan_models->edit($id);
        $this->session->set_flashdata('success', 'Berhasil Diupdate');
        redirect(site_url('pesanan/edit_pesanan/'.$id));

    }

    public function hapus_pesanan($id = null){
		if(!isset($id)) show_404();

        if($this->pesanan_models->delete($id)){
            redirect(site_url('pesanan'));
        }
    }

    public function get_pembayaran()
    {
        echo json_encode($this->pesanan_models->getPembayaranDetail($this->input->post('id_pesanan')));
    }
    
    public function get_pembayaran_id()
    {
        echo json_encode($this->pesanan_models->getPembayaranRow($this->input->post('id')));
    }

    public function submit_pembayaran()
    {
        $id = $this->input->post('id');
        if($id==""){
            $this->pesanan_models->addPembayaran();
        }else{
            $this->pesanan_models->editPembayaran();
        }

        echo json_encode(array());
    }

    public function delete_pembayaran()
    {
        $this->pesanan_models->deletePembayaran();
        
        echo json_encode(array());
    }

    
}