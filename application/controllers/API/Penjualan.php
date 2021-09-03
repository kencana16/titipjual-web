<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Penjualan extends RestController {
    
    function __construct(){
		parent::__construct();
		$this->load->model('penjualan_models');
	}

    public function index_get()
    {
        $id_penjualan = $this->input->get('id');
        $id_penjual = $this->input->get('seller_id');
        $tanggal = $this->input->get('date');

        $data = $this->penjualan_models->get($id_penjualan, $id_penjual, $tanggal);

        if($data){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'penjualan' => $data
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
        $penjualan = array(
            'id_penjual' => $data['id_penjual'],
            'tgl_penjualan' => $data['tgl_penjualan']
        );
        $detail_penjualan = $data['detail_barang'];


        if($this->penjualan_models->post($penjualan, $detail_penjualan)){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'penjualan' => $this->penjualan_models->get()
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
        $this->penjualan_models->rekap($data);
    }

    // public function detail_get()
    // {
    //     $id_penjualan = $this->input->get('id');

    //     $data = $this->penjualan_models->showByID($id_penjualan);

    //     if($data){
    //         $this->response([
    //             'success'  => TRUE,
    //             'data'    => [
    //                 'penjualan' => $data,
    //                 'detail' => $this->penjualan_models->showDetail($id_penjualan),
    //                 'pembayaran' => $this->penjualan_models->getPembayaranDetail($id_penjualan)
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

    public function rating_get()
    {
        
        $id_barang = $this->input->get('id_barang');
        $id_penjual = $this->input->get('id_penjual');


        $this->response([
            'success'  => TRUE,
            'data'    => $this->penjualan_models->get_penjualan_barang($id_barang, $id_penjual)
        ], RestController::HTTP_OK);
    }

    public function bayar_post()
    {
        $data = array(
            'id_penjualan' => $this->input->post('id_penjualan'),
            'jumlah_uang' => $this->input->post('jumlah_uang'),
        );
        if($this->penjualan_models->add_pembayaran($data)){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'penjualan' => $this->penjualan_models->get($data['id_penjualan'], null, null)
                ],
                'message' => "Data created"
            ], RestController::HTTP_OK);
        }
    }
}
