<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Produk extends RestController {
    
    function __construct(){
		parent::__construct();
		$this->load->model('barang_models');
	}

    public function index_get()
    {
        $id_penjualan = $this->input->get('id');

        $data = $this->barang_models->get($id_penjualan);

        if($data){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'produk' => $data
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

        if($this->barang_models->post($data)){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'produk' => $this->barang_models->get()
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

    public function index_put()
    {
        $data = json_decode($this->input->raw_input_stream, true);

        if($this->barang_models->put($data)){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'produk' => $this->barang_models->get()
                ],
                'message' => "Data updated"
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'success'  => FALSE,    
                'data'    => null,
                'message' => "Data not updated"
            ], RestController::HTTP_OK);
        }
    }

    public function index_delete($id)
    {

        if($this->barang_models->delete($id)){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'produk' => $this->barang_models->get()
                ],
                'message' => "Data deleted"
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'success'  => FALSE,    
                'data'    => null,
                'message' => "Data not deleted"
            ], RestController::HTTP_OK);
        }
    }

    public function average_sales_get()
    {
        # code...
    }
}
