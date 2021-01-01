<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Penjual_models extends CI_Model{
        private $_table_name = 'penjual';

        public function add(){
            $data = array(
                'nama_penjual' => $this->input->post('namaPenjual'),
                'no_hp' => $this->input->post('noHP'),
                'alamat' => $this->input->post('alamat'),
                'date_created' => date('Y-m-d H:i:s',now()),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            return $this->db->insert($this->_table_name, $data);
        }

        public function edit($id){
            $data = array(
                'nama_penjual' => $this->input->post('namaPenjual'),
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
                [
                    'field' => 'alamat',
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.',
                    ]                

                ]
            ];
        }
    }