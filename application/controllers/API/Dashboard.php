<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends RestController {

	public function __construct(){
		parent::__construct();

		$this->load->model('penjualan_models');
	}

	public function index_get()
	{
        if($this->penjualan_models->incomeThisDay()->jml_uang == null){ $day = 0;}
        else{$day = $this->penjualan_models->incomeThisDay()->jml_uang;}
        if($this->penjualan_models->incomeThisMonth()->jml_uang == null){ $month = 0;}
        else{$month = $this->penjualan_models->incomeThisMonth()->jml_uang;}

        $this->response([
            'success'  => TRUE,
            'data'    => [
                'this_day_income' => $day,
                'this_month_income' => $month
            ],
        ], RestController::HTTP_OK);

	}

}
