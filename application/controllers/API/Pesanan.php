<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Pesanan extends RestController {
    
    function __construct(){
		parent::__construct();
		$this->load->model('pesanan_models');
	}

    public function index_get()
    {
        $tanggal = $this->input->get('date');

        $data = $this->pesanan_models->get(null, $tanggal);

        if($data){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'pesanan' => $data
                ]
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'success'  => FALSE,    
                'data'    => null,
                'message' => "Data tidak ditemukan"
            ], RestController::HTTP_OK);
        }
    }

    public function index_post()
    {

        $data = json_decode($this->input->raw_input_stream, true);
        $pesanan = array(
            'tgl_diambil' => date("Y-m-d h:i", $data['tgl_diambil']/1000),
            'id_penjual' => $data['id_penjual'],
            'nama_pemesan' => $data['nama_pemesan'],
            'no_hp_pemesan' => $data['no_hp_pemesan'],
            'alamat' => $data['alamat'],
            'jenis_harga' => $data['jenis_harga'],
        );
        $detail_pesanan = $data['detail_barang'];


        if($this->pesanan_models->post($pesanan, $detail_pesanan)){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'pesanan' => $this->pesanan_models->get()
                ],
                'message' => "Data created"
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'success'  => FALSE,    
                'data'    => null,
                'message' => "Data not created"
            ], RestController::HTTP_OK);
        }
    }

    function rekap_put(){
        $data = json_decode($this->input->raw_input_stream, true);
        $this->pesanan_models->rekap($data);
    }

    // public function detail_get()
    // {
    //     $id_penjualan = $this->input->get('id');

    //     $data = $this->pesanan_models->showByID($id_penjualan);

    //     if($data){
    //         $this->response([
    //             'success'  => TRUE,
    //             'data'    => [
    //                 'pesanan' => $data,
    //                 'detail' => $this->pesanan_models->showDetail($id_penjualan),
    //                 'pembayaran' => $this->pesanan_models->getPembayaranDetail($id_penjualan)
    //             ]
    //         ], RestController::HTTP_OK);
    //     }else{
    //         $this->response([
    //             'success'  => FALSE,    
    //             'data'    => null,
    //             'message' => "Data tidak ditemukan"
    //         ], RestController::HTTP_OK);
    //     }
    // }

    public function bayar_post()
    {
        $data = array(
            'id_pesanan' => $this->input->post('id_pesanan'),
            'jumlah_uang' => $this->input->post('jumlah_uang'),
        );
        if($this->pesanan_models->add_pembayaran($data)){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'pesanan' => $this->pesanan_models->get($data['id_pesanan'], null)
                ],
                'message' => "Data created"
            ], RestController::HTTP_OK);
        }
    }
}
