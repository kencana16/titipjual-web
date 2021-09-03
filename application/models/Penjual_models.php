<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Penjual_models extends CI_Model{
        private $_table_name = 'penjual';
        private $_default_pass = '12345';

        public function add(){
            $data = array(
                'nama_penjual' => ucfirst($this->input->post('namaPenjual')),
                'no_hp' => $this->input->post('noHP'),
                'alamat' => $this->input->post('alamat'),
                'date_created' => date('Y-m-d H:i:s',now()),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $add =  $this->db->insert($this->_table_name, $data);

            // $id_penjual = $this->db->insert_id();
            // $user = array(
            //     'id_penjual' => $id_penjual,
            //     'username' => ucfirst($this->input->post('namaPenjual')),
            //     'no_hp' => $this->input->post('noHP'),
            //     'password' => md5($this->_default_pass),
            // );
            // $this->db->insert("user", $user);

            return $add;
        }


        public function edit($id){
            $data = array(
                'nama_penjual' => ucfirst($this->input->post('namaPenjual')),
                'no_hp' => $this->input->post('noHP'),
                'alamat' => $this->input->post('alamat'),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            return $this->db->where('id_penjual', $id)->update($this->_table_name, $data);
        }

        public function showAll(){
            return $this->db->get($this->_table_name)->result();
        }

        public function showById($id){
            $data =  array(
                'id_penjual'=>$id
            );
            return $this->db->get_where($this->_table_name, $data)->row();
        }

        public function delete($id){
            $data =  array(
                'id_penjual'=>$id
            );
            return $this->db->delete($this->_table_name, $data);
            return $this->db->delete("user", $data);
        }

        public function rules(){
            return [
                [
                    'field' => 'namaPenjual',
                    'label' => 'Nama Penjual',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.',
                    ]                

                ],
                [
                    'field' => 'noHP',
                    'label' => 'No. Telepon',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.',
                    ]                

                ],
            ];
        }

        public function get($id = null)
        {
            if($id != null){
                $this->db->where("$this->_table_name.id_penjual", $id);
            }
            return $this->db->get($this->_table_name)->result_array();
        }

        public function post($array)
        {
            return $this->db->insert($this->_table_name, $array);
        }

        public function put($array)
        {
            unset($array['date_modified']);
            return $this->db->replace($this->_table_name, $array);
        }

        public function deleteArray($array)
        {
            return $this->db->delete($this->_table_name, $array);
        }
    }