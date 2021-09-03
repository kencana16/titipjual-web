<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class User_models extends CI_Model{

        public function check_credential(){
            /*
            data1 and query1 is used to check user table with phone and password
            data2 and query2 is used to check user table with username and password
            */
            $data1 = array(
                'no_hp' => $this->input->post('usernameorphone'),
                'password' => md5($this->input->post('password'))
            );
            $query1 = $this->db->get_where('user', $data1, 1);
            if($query1->num_rows() > 0){
                return $query1->row();
            }else{
                $data2 = array(
                    'username' => $this->input->post('usernameorphone'),
                    'password' => md5($this->input->post('password'))
                );
    
                $query2 = $this->db->get_where('user', $data2, 1);
                if($query2->num_rows() > 0){
                    return $query2->row();
                }else{
                    return array();
                }
            }
        }

        public function auth_phone_password($phone, $password)
        {
            $data = array(
                'no_hp' => $phone,
                'password' => md5($password)
            );
            $query = $this->db->get_where('user', $data, 1);
            if($query->num_rows() > 0){
                return $query->row();
            }else{
                return false;
            }
        }

        public function showAll(){
            return $this->db->get_where('user')->result_array();
        }

    }