<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Barang_models extends CI_Model{
        private $_table_name = 'barang';

        public function add(){
            $data = array(
                'nama_barang' => ucfirst($this->input->post('namaBarang')),
                'satuan' => ucfirst($this->input->post('satuan')),
                'harga_satuan_normal' => $this->input->post('hargaNormal'),
                'harga_satuan_reseller' => $this->input->post('hargaReseller'),
                'date_created' => date('Y-m-d H:i:s',now()),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            return $this->db->insert($this->_table_name, $data);
        }

        public function edit($id){
            $data =  array(
                'nama_barang' => ucfirst($this->input->post('namaBarang')),
                'satuan' => ucfirst($this->input->post('satuan')),
                'harga_satuan_normal' => $this->input->post('hargaNormal'),
                'harga_satuan_reseller' => $this->input->post('hargaReseller'),
                'date_modified' => date('Y-m-d H:i:s',now())
                
            );
            return $this->db->where('id_barang', $id)->update($this->_table_name, $data);
        }

        public function showAll(){
            return $this->db->get($this->_table_name)->result();
        }

        public function showById($id){
            $data =  array(
                'id_barang'=>$id
            );
            return $this->db->get_where($this->_table_name, $data)->row();
        }

        public function delete($id){
            $data =  array(
                'id_barang'=>$id
            );
            return $this->db->delete($this->_table_name, $data);
        }

        
        public function getJsonBarang(){
            $id = $this->input->post('id_barang');
            if($id==""){return array();}
            $query = "SELECT * FROM barang WHERE id_barang=$id";
            return $this->db->query($query)->result_array();
        }

        public function rules(){
            return [
                [
                    'field' => 'namaBarang',
                    'label' => 'Nama Barang',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.',
                    ]                

                ],
                [
                    'field' => 'hargaNormal',
                    'label' => 'Harga Normal',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.'
                    ]                

                ],
                [
                    'field' => 'hargaReseller',
                    'label' => 'Harga Reseller',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.'
                    ]                

                ]
            ];
        }

        public function get($id = null)
        {
            if($id != null){
                $this->db->where("$this->_table_name.id_barang", $id);
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