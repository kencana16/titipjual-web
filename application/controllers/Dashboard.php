<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}
		if($this->session->userdata('role') == 1){
			redirect('penjualanku');
		}

		$this->load->model('pengeluaran_models');
		$this->load->model('penjualan_models');
		$this->load->model('pesanan_models');
	}

	public function index()
	{
		$incomeDaily = ($this->penjualan_models->incomeThisDay()->jml_uang) + ($this->pesanan_models->incomeThisDay()->jml_uang);
		$incomeMonthly = ($this->penjualan_models->incomeThisMonth()->jml_uang) + ($this->pesanan_models->incomeThisMonth()->jml_uang);
		$profitMonthly = ($incomeMonthly) - ($this->pengeluaran_models->costThisMonth()->jml);
		$data= array(
			'incomeThisDay' => $incomeDaily,
			'incomeThisMonth' => $incomeMonthly,
			'profitThisMonth' => $profitMonthly,
			'order' => $this->pesanan_models->countPesanan()->jml,
		);
		$this->load->view('admin/dashboard', $data);
	}

	public function chart_data()
	{
		echo json_encode($this->penjualan_models->incomeThisWeekJson());
	}
}
