<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Auth extends RestController {
    
    function __construct(){
		parent::__construct();
		$this->load->model('user_models');
	}

    public function index_post()
    {
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');

        if( $phone == null || $password == null) {
            $msg = "";
            if($phone == null){$msg += " required field phone";}
            if($password == null){$msg += " required field password";}

            $this->response(
                ['status' => false, 'msg' => $msg],
                RestController::HTTP_BAD_REQUEST
            );

        }else{
            if( $this->user_models->auth_phone_password($phone, $password)) {
                $this->response([
                    'success'  => TRUE,
                    'data'    => [
                        'user' => $this->user_models->auth_phone_password($phone, $password)
                    ],
                    'msg' => 'Login success'
                ], RestController::HTTP_OK);
            }else {
                $this->response([
                    'success'  => FALSE,
                    'msg' => 'Invalid phone or password'
                ], RestController::HTTP_UNAUTHORIZED);
            }
        }
    }
}
