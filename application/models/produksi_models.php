<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Produksi_models extends CI_Model{
        private $_table_name = 'produksi';

        public function add(){
            $data = array(
                'tgl_produksi' => $this->input->post('tgl'),
                'id_barang' => $this->input->post('idBarang'),
                'jml_produksi' => $this->input->post('jml'),
                'date_created' => date('Y-m-d H:i:s',now()),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            return $this->db->insert($this->_table_name, $data);
        }

        public function edit($id){
            $data =  array(
                'tgl_produksi' => $this->input->post('tgl'),
                'id_barang' => $this->input->post('idBarang'),
                'jml_produksi' => $this->input->post('jml'),
                'date_modified' => date('Y-m-d H:i:s',now())
                
            );
            return $this->db->where('id_produksi', $id)->update($this->_table_name, $data);
        }

        public function showAll(){
            $query = 'SELECT p.id_produksi, p.tgl_produksi, b.nama_barang, p.jml_produksi, (b.estimasi_modal_per_kg * p.jml_produksi) AS estimasi_modal 
                FROM produksi p
                INNER JOIN barang b
                 on p.id_barang = b.id_barang
                ORDER BY tgl_produksi DESC, nama_barang ASC';
            return $this->db->query($query)->result();
        }
        
        public function showByID($id){
            $data =  array(
                'id_produksi'=>$id
            );
            return $this->db->get_where($this->_table_name, $data)->row();
        }
        
        public function delete($id){
            $data =  array(
                'id_produksi'=>$id
            );
            return $this->db->delete($this->_table_name, $data);
        }

        public function monthlyReport()
        {
            $query = "SELECT DATE_FORMAT(tgl_produksi, '%Y, %m') AS periode,
              SUM(jml_produksi) AS jml_produksi, SUM(b.estimasi_modal_per_kg * p.jml_produksi) AS estimasi_modal
              FROM produksi p
              INNER JOIN barang b
              on p.id_barang = b.id_barang
              GROUP BY DATE_FORMAT(tgl_produksi, '%Y, %m')
              ORDER BY tgl_produksi DESC";
            return $this->db->query($query)->result_array();
        }

        public function rules(){
            return [
                [
                    'field' => 'tgl',
                    'label' => 'Tanggal Produksi',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.',
                    ]                

                ],
                [
                    'field' => 'idBarang',
                    'label' => 'Nama Barang',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.'
                    ]                

                ],
                [
                    'field' => 'jml',
                    'label' => 'Jumlah Produksi',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.'
                    ]                

                ],
            ];
        }
    }