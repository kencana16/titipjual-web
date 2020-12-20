<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function tambah_barang()
	{
		$this->load->view('admin/barang/barang_add');
	}

	public function daftar_barang()
	{
		$this->load->view('admin/barang/barang_show');
	}
}
