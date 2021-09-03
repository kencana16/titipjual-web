<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
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
		$this->load->model('penjual_models');
		$this->load->model('penjualan_models');
		$this->load->model('pesanan_models');
	}
	
	public function index()
	{
		redirect('laporan/global_bulanan');
	}

    public function global_bulanan()
    {
		$pengeluaran= $this->pengeluaran_models->monthlyReport();
		$pesanan= $this->pesanan_models->monthlyReport();
		$pendapatan= $this->penjualan_models->monthlyReport();
		
		$json = $this->merge($pengeluaran, $pendapatan, $pesanan);
		
		$data['data'] = $json;
		$data['pesanan'] = $pesanan;
		$this->load->view('admin/laporan/bulanan', $data);

	}

	public function global_harian()
    {
		$validation = $this->form_validation;
		$validation->set_rules('tgl', 'Tanggal', 'required');

		if($validation->run()){
			$date = $this->input->post('tgl');
		}else if(!$validation->run()){
			$date = date('Y-m-d');
		}
		$pengeluaran= $this->pengeluaran_models->dailyReport($date);
		$pesanan= $this->pesanan_models->dailyReport($date);
		$pendapatan= $this->penjualan_models->dailyReport($date);
		$json = $this->merge($pengeluaran, $pendapatan, $pesanan);

		
		$data['data'] = $json;
		$data['pesanan'] = $pesanan;
		$data['date'] = $date;
		$this->load->view('admin/laporan/harian', $data);

		
	}

	private function merge($pengeluaran, $penjualan, $pesanan){
		$result = Array();
		foreach($penjualan as $key => $jual){
			foreach($pengeluaran as $keluar){
				$jual['periode'] == $keluar['periode'] ? $valPengeluaran = $keluar['pengeluaran'] : $valPengeluaran = 0;
			}
			foreach($pesanan as $pesan){
				$jual['periode'] == $pesan['periode'] ? $valPesanan = $pesan['pesanan'] : $valPesanan = 0;
			}
			$result[] = array(
				'periode' => $jual['periode'],
				'penjualan' => $jual['penjualan'],
				'pesanan' => $valPesanan,
			);
		}
		return $result;
	}
	
	private function custom_array_merge(&$array1, &$array2) {
		$result = Array();
		foreach ($array1 as $key_1 => &$value_1) {
			// if($value['name'])
			foreach ($array2 as $key_1 => $value_2) {
				if($value_1['periode'] ==  $value_2['periode']) {
					$result[] = array_merge($value_1,$value_2);
				}
			}
	
		}
		return $result;
	}
    
}
?>