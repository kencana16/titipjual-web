<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjual extends CI_Controller {

	public function tambah_penjual()
	{
		$this->load->view('admin/penjual/penjual_add');
	}

	public function daftar_penjual()
	{
		$this->load->view('admin/penjual/penjual_show');
	}
}
