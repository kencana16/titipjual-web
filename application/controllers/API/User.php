<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class User extends RestController {
    
    function __construct(){
		parent::__construct();
		$this->load->model('user_models');
		$this->load->model('profile_models');
	}

    public function index_get($id = null)
    {

        if($id != null){
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'user' => $this->profile_models->showById($id)
                ]
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'success'  => TRUE,
                'data'    => [
                    'user' => $this->user_models->showAll()
                ]
            ], RestController::HTTP_OK);
        }
    }
}
