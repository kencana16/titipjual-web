<?php

// Error controller
// This controller is used to manage the errors (404)
class Errors extends CI_Controller 
{


    public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('is_logged_in')){
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu');
			redirect('login');
		}
    }
    
    // Main controller for the contact form
    public function error404()
    {
        // Create your custom controller

        // Display page
        $this->load->view('404');
    }
}