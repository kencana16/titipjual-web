<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}
	}

	public function tambah_barang()
	{
		$this->load->view('admin/barang/barang_add');
	}

	public function daftar_barang()
	{
		$this->load->view('admin/barang/barang_show');
	}
}
