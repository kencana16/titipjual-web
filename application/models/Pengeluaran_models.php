<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Pengeluaran_models extends CI_Model{
        private $_table_name = 'pengeluaran';
        private $_detail_table_name = 'detail_pengeluaran';

        public function add(){
            $arrBarang = $this->input->post('barang');
            $arrJumlah = $this->input->post('jumlah');
            $arrHarga = $this->input->post('harga');

            $data = array(
                'tgl_pengeluaran' => $this->input->post('tgl'),
                'jenis' => $this->input->post('jenis'),
                'date_created' => date('Y-m-d H:i:s',now()),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $this->db->insert($this->_table_name, $data);
            $idPengeluaran = $this->db->insert_id();

            foreach($arrBarang as $key => $barang){
                if($arrBarang[$key] == "" && $arrJumlah[$key] == "" && $arrHarga[$key] == "" ){
                    continue;
                }
                $data = array(
                    'id_pengeluaran' => $idPengeluaran,
                    'nama_barang' => $barang,
                    'jumlah_barang' => $arrJumlah[$key],
                    'harga' => $arrHarga[$key],
                    'date_created' => date('Y-m-d H:i:s',now()),
                    'date_modified' => date('Y-m-d H:i:s',now())
                );
                $this->db->insert($this->_detail_table_name, $data);
            }

        }

        public function edit($id){
            $arrId = $this->input->post('idDetail');
            $arrBarang = $this->input->post('barang');
            $arrJumlah = $this->input->post('jumlah');
            $arrHarga = $this->input->post('harga');
            
            $data =  array(
                'tgl_pengeluaran' => $this->input->post('tgl'),
                'jenis' => $this->input->post('jenis'),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $this->db->where('id_pengeluaran', $id)->update($this->_table_name, $data);

            //remove deleted data in database
            $DbBarangIds =  $this->db->query('SELECT `id_detail_pengeluaran` FROM `detail_pengeluaran` where `id_pengeluaran`= 25')->result();
            $tempIds;
            foreach($DbBarangIds as $key => $DbBarangId){
                $tempId[$key] = $DbBarangId->id_detail_pengeluaran;
            }
            $deleteIds = array_diff($tempId,$arrId);

            foreach($deleteIds as $deleteId){
                $data =  array(
                    'id_detail_pengeluaran'=>$deleteId
                );
                $this->db->delete($this->_detail_table_name, $data);
            }


            foreach($arrBarang as $key => $barang){
                if($arrBarang[$key] == "" && $arrJumlah[$key] == "" && $arrHarga[$key] == "" ){
                    continue;
                }
                //update existing data in database
                if($arrId[$key] == ""){
                    //add new data in database
                    $data = array(
                        'id_pengeluaran' => $id,
                        'nama_barang' => $barang,
                        'jumlah_barang' => $arrJumlah[$key],
                        'harga' => $arrHarga[$key],
                        'date_created' => date('Y-m-d H:i:s',now()),
                        'date_modified' => date('Y-m-d H:i:s',now())
                    );
                    $this->db->insert($this->_detail_table_name, $data);
                }else{
                    $data = array(
                        'id_pengeluaran' => $id,
                        'nama_barang' => $barang,
                        'jumlah_barang' => $arrJumlah[$key],
                        'harga' => $arrHarga[$key],
                        'date_modified' => date('Y-m-d H:i:s',now())
                    );
                    $this->db->where('id_detail_pengeluaran', $arrId[$key])->update($this->_detail_table_name, $data);
                }
            }
        }

        public function showAll(){
            $query = "SELECT p.id_pengeluaran, tgl_pengeluaran, jenis, SUM(harga) jml_pengeluaran 
             FROM pengeluaran p 
             INNER JOIN detail_pengeluaran dp 
                ON p.id_pengeluaran = dp.id_pengeluaran 
             GROUP BY id_pengeluaran
             ORDER BY tgl_pengeluaran DESC, jenis ASC, jml_pengeluaran ASC";
            return $this->db->query($query)->result();
        }
        
        public function showByID($id){
            $query = "SELECT p.id_pengeluaran, tgl_pengeluaran, jenis, SUM(harga) jml_pengeluaran 
             FROM pengeluaran p 
             INNER JOIN detail_pengeluaran dp 
                ON p.id_pengeluaran = dp.id_pengeluaran 
             WHERE p.id_pengeluaran = $id";
            return $this->db->query($query)->row();
        }
        
        public function delete($id){
            $data =  array(
                'id_pengeluaran'=>$id
            );
            return $this->db->delete($this->_table_name, $data);
        }
        
        public function showDetail($id){
            $data =  array(
                'id_pengeluaran'=>$id
            );
            return $this->db->order_by('nama_barang', 'ASC')->get_where($this->_detail_table_name, $data)->result();
        }

        public function rules(){
            return [
                [
                    'field' => 'barang[]',
                    'label' => 'Nama Barang',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.',
                    ]                

                ],
                [
                    'field' => 'jumlah[]',
                    'label' => 'Jumlah Barang',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.'
                    ]                

                ],
                [
                    'field' => 'harga[]',
                    'label' => 'Harga Barang',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => 'Kolom %s harus diisi.'
                    ]                

                ],
            ];
        }
    }