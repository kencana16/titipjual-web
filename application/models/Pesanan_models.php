<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Pesanan_models extends CI_Model{
        private $_table_name = 'pesanan';
        private $_detail_table_name = 'detail_pesanan';
        private $_pembayaran_table = 'pembayaran_pesanan';

        public function add(){
            $arrIdBarang = $this->input->post('idBarang');
            $arrJumlah = $this->input->post('jumlah');
            $arrSubtotal = $this->input->post('subtotal');

            $data = array(
                'tgl_dipesan' => $this->input->post('tgl_dipesan'),
                'tgl_diambil' => $this->input->post('tgl_diambil'),
                'nama_pemesan' => $this->input->post('nama'),
                'no_hp_pemesan' => $this->input->post('no_hp'),
                'jenis_harga' => $this->input->post('hargaRadio'),
                'date_created' => date('Y-m-d H:i:s',now()),
                'date_modified' => date('Y-m-d H:i:s',now())
            );

            if($this->input->post('idPenjual') !== null){
                $data['id_penjual'] = $this->input->post('idPenjual');
            };

            $this->db->insert($this->_table_name, $data);
            $idPesanan = $this->db->insert_id();

            $dataBayar = array(
                'id_pesanan' => $idPesanan,
                'tanggal' => date('Y-m-d',now()),
                'jumlah_uang' => $this->input->post('dibayar'),
                'date_created' => date('Y-m-d H:i:s',now()),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $this->db->insert($this->_pembayaran_table, $dataBayar);

            foreach($arrIdBarang as $key => $barang){
                if($arrIdBarang[$key] == "" && $arrJumlah[$key] == ""){
                    continue;
                }
                $data = array(
                    'id_pesanan' => $idPesanan,
                    'id_barang' => $arrIdBarang[$key],
                    'jml_barang' => $arrJumlah[$key],
                    'subtotal' => $arrSubtotal[$key],
                    'date_created' => date('Y-m-d H:i:s',now()),
                    'date_modified' => date('Y-m-d H:i:s',now())
                );
                $this->db->insert($this->_detail_table_name, $data);
            }

        
        }

        public function edit($id){
            $arrId = $this->input->post('idDetail');
            $arrIdBarang = $this->input->post('idBarang');
            $arrJumlah = $this->input->post('jumlah');
            $arrSubtotal = $this->input->post('subtotal');
            
            $data =  array(
                'tgl_dipesan' => $this->input->post('tgl_dipesan'),
                'tgl_diambil' => $this->input->post('tgl_diambil'),
                'nama_pemesan' => $this->input->post('nama'),
                'no_hp_pemesan' => $this->input->post('no_hp'),
                'jenis_harga' => $this->input->post('hargaRadio'),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $this->db->where('id_pesanan', $id)->update($this->_table_name, $data);

            //remove deleted data in database
            $DbBarangIds =  $this->db->query("SELECT `id_detail_pesanan` FROM `detail_pesanan` where `id_pesanan`= $id")->result();
            foreach($DbBarangIds as $key => $DbBarangId){
                $tempId[$key] = $DbBarangId->id_detail_pesanan;
            }
            $deleteIds = array_diff($tempId,$arrId);

            foreach($deleteIds as $deleteId){
                $data =  array(
                    'id_detail_pesanan'=>$deleteId
                );
                $this->db->delete($this->_detail_table_name, $data);
            }


            foreach($arrIdBarang as $key => $barang){
                if($arrIdBarang[$key] == "" ){
                    continue;
                }
                //update existing data in database
                if($arrId[$key] == ""){
                    //add new data in database
                    $data = array(
                        'id_pesanan' => $id,
                        'id_barang' => $arrIdBarang[$key],
                        'jml_barang' => $arrJumlah[$key],
                        'subtotal' => $arrSubtotal[$key],
                        'date_created' => date('Y-m-d H:i:s',now()),
                        'date_modified' => date('Y-m-d H:i:s',now())
                    );
                    $this->db->insert($this->_detail_table_name, $data);
                }else{
                    $data = array(
                        'id_pesanan' => $id,
                        'id_barang' => $arrIdBarang[$key],
                        'jml_barang' => $arrJumlah[$key],
                        'subtotal' => $arrSubtotal[$key],
                        'date_modified' => date('Y-m-d H:i:s',now())
                    );
                    $this->db->where('id_detail_pesanan', $arrId[$key])->update($this->_detail_table_name, $data);
                }
            }
        }

        public function showAll(){
            $query = "SELECT pesanan.id_pesanan, tgl_dipesan, tgl_diambil, nama_pemesan, no_hp_pemesan,
                SUM(jml_barang) AS jml_barang, SUM(subtotal) AS total
                FROM pesanan
                INNER JOIN detail_pesanan
                    ON pesanan.id_pesanan = detail_pesanan.id_pesanan
                GROUP BY pesanan.id_pesanan
                ORDER BY tgl_diambil DESC, nama_pemesan ASC";
            $results = $this->db->query($query)->result();
            foreach($results as $result){
                $id = $result->id_pesanan;
                $v = $this->db
                ->query("SELECT sum(jumlah_uang) as jumlah_uang FROM $this->_pembayaran_table WHERE id_pesanan=$id")
                ->row();
                $result->dibayar = ($v->jumlah_uang == null)? "0" : $v->jumlah_uang;
            }
            return $results;
        }

        public function showByPenjual($id_penjual){
            $query = "SELECT pesanan.id_pesanan, tgl_dipesan, tgl_diambil, nama_pemesan, no_hp_pemesan,
                SUM(jml_barang) AS jml_barang, SUM(subtotal) AS total, dibayar
                FROM pesanan
                INNER JOIN detail_pesanan
                    ON pesanan.id_pesanan = detail_pesanan.id_pesanan
                WHERE id_penjual = $id_penjual
                GROUP BY pesanan.id_pesanan
                ORDER BY tgl_diambil DESC, nama_pemesan ASC";
            return $this->db->query($query)->result();
        }
        
        public function showByID($id){
            $data =  array(
                'id_pesanan'=>$id
            );
            return $this->db->get_where($this->_table_name, $data)->row();
        }

        public function delete($id){
            $data =  array(
                'id_pesanan'=>$id
            );
            $this->db->delete($this->_detail_table_name, $data);
            return $this->db->delete($this->_table_name, $data);
        }
        
        public function showDetail($id){
            $data =  array(
                'id_pesanan'=>$id
            );
            return $this->db->order_by('id_detail_pesanan', 'ASC')->get_where($this->_detail_table_name, $data)->result();
        }
        
        public function getPembayaranTotal($id){
            $data =  array(
                'id_pesanan'=>$id
            );
            return $this->db->select_sum('jumlah_uang')->get_where($this->_pembayaran_table, $data)->row();
            
        }

        public function getPembayaranDetail($id){
            $data =  array(
                'id_pesanan'=>$id
            );
            $jumlah = $this->db->select_sum('subtotal')->get_where($this->_detail_table_name, $data)->row();
            $dibayar = $this->db->select_sum('jumlah_uang')->get_where($this->_pembayaran_table, $data)->row();
            $pembayaran = $this->db->get_where($this->_pembayaran_table, $data)->result();
            $data = array(
                'id_pesanan' => $id,
                'jumlah' => $jumlah->subtotal,
                'dibayar' => $dibayar->jumlah_uang,
                'pembayaran' => $pembayaran,
                'success' => true
            );
            return $data;
        }
        
        public function getPembayaranRow($id){
            $data =  array(
                'id_pembayaran_pesanan'=>$id
            );
            $pembayaran = $this->db->get_where($this->_pembayaran_table, $data)->row();
            return $pembayaran;
        }

        public function addPembayaran()
        {
            $data = array(
                'id_pesanan' => $this->input->post('id_pesanan'),
                'tanggal' => $this->input->post('tgl'),
                'jumlah_uang' => $this->input->post('uang'),
                'date_created' => date('Y-m-d H:i:s',now()),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $this->db->insert($this->_pembayaran_table, $data);
        }

        public function editPembayaran()
        {
            $data = array(
                'id_pesanan' => $this->input->post('id_pesanan'),
                'tanggal' => $this->input->post('tgl'),
                'jumlah_uang' => $this->input->post('uang'),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $this->db->where('id_pembayaran_pesanan', $this->input->post('id'))->update($this->_pembayaran_table, $data);
        }

        public function deletePembayaran()
        {
            $data =  array(
                'id_pembayaran_pesanan'=>$this->input->post('id')
            );
            return $this->db->delete($this->_pembayaran_table, $data);
        }

        public function countPesanan()
        {
            $date = date('Y-m-d',now());
            $query = "select count(*) as jml from pesanan where tgl_diambil >= '$date'";
            return $this->db->query($query)->row();
        }

        public function incomeThisDay()
        {
            $date = date('Y-m-d',now());
            $query = "SELECT p.id_pesanan, tgl_dipesan, sum(jumlah_uang) as jml_uang
                FROM pesanan p 
                left join pembayaran_pesanan pp on p.id_pesanan = pp.id_pesanan
                where tgl_dipesan = '$date'
                group by tgl_dipesan
                limit 1";

            $get =  $this->db->query($query);
            if($get->num_rows() > 0){
                return $get->row();
            }else{
                return (object) [
                    'id_pesanan' => null,
                    'tgl_pesanan' => null,
                    'jml_uang' => 0,
                ];
            }
        }

        public function incomeThisMonth()
        {
            $month = date('n',now());
            $year = date('Y', now());
            $query = "SELECT  p.id_pesanan, tgl_dipesan, sum(jumlah_uang)  as jml_uang
                FROM pesanan p 
                left join pembayaran_pesanan pp on p.id_pesanan = pp.id_pesanan
                where month(tgl_dipesan)='$month' AND year(tgl_dipesan)='$year'
                group by month(tgl_dipesan)";
                
            $get =  $this->db->query($query);
            if($get->num_rows() > 0){
                return $get->row();
            }else{
                return (object) [
                    'id_pesanan' => null,
                    'tgl_pesanan' => null,
                    'jml_uang' => 0,
                ];
            }
        }

        public function monthlyReport()
        {
            $query = "SELECT DATE_FORMAT(p.tgl_diambil, '%Y, %m') AS periode,
              SUM(jumlah_uang) AS pesanan
              FROM pesanan p
              left join pembayaran_pesanan pp on p.id_pesanan = pp.id_pesanan
              GROUP BY DATE_FORMAT(p.tgl_diambil, '%Y, %m')
              ORDER BY p.tgl_diambil DESC";
            return $this->db->query($query)->result_array();
        }
       
        public function dailyReport($date)
        {
            $month = date('m', strtotime($date));
            $year = date('Y', strtotime($date));
            $query = "SELECT p.tgl_diambil AS periode, SUM(jumlah_uang) AS pesanan 
            FROM pesanan p
            left join pembayaran_pesanan pp on p.id_pesanan = pp.id_pesanan
            WHERE MONTH(p.tgl_diambil )= $month AND YEAR(p.tgl_diambil )= $year 
            GROUP BY p.tgl_diambil 
            ORDER BY p.tgl_diambil DESC";
            return $this->db->query($query)->result_array();
        }

        



        public function get($id_pesanan = null, $tanggal = null)
        {
            if($id_pesanan != null){
                $this->db->where("$this->_table_name.id_pesanan", $id_pesanan);
            }
            if($tanggal != null){
                $arrTgl = explode(" - ", $tanggal);
                if(sizeof($arrTgl) == 2){
                    $this->db->where('tgl_diambil >=', $this->formatDate($arrTgl[0])." 00:00:00");
                    $this->db->where('tgl_diambil <=', $this->formatDate($arrTgl[1])." 23:59:59");
                }else if(sizeof($arrTgl) == 1){
                    $this->db->where('tgl_diambil >=', $this->formatDate($arrTgl[0])." 00:00:00");
                    $this->db->where('tgl_diambil <=', $this->formatDate($arrTgl[0])." 23:59:59");
                }
            }
            $this->db->select("$this->_table_name.*, nama_pemesan, sum(jml_barang) as jml_produk");
            $this->db->select("sum(subtotal) as total");
            $this->db->from($this->_table_name);
            $this->db->join("$this->_detail_table_name", "$this->_table_name.id_pesanan = $this->_detail_table_name.id_pesanan", 'left');
            $this->db->order_by('status', 'ASC');
            $this->db->order_by('tgl_diambil', 'DESC');
            $this->db->group_by("$this->_table_name.id_pesanan");
            $results = $this->db->get()->result_array();

            foreach($results as $key => $result){
                $id_pesanan = $result['id_pesanan'];
                $results[$key]['dibayar'] = $this->db
                    ->select("sum(jumlah_uang)as dibayar")
                    ->from($this->_pembayaran_table)
                    ->where(array('id_pesanan'=>$id_pesanan))
                    ->get()->row()->dibayar;

                if($results[$key]['dibayar'] == null){
                    $results[$key]['dibayar'] = "0";
                }
                $results[$key]['detail_barang'] = $this->db
                    ->select("$this->_detail_table_name.*")
                    ->select("nama_barang, harga_satuan_reseller, harga_satuan_normal")
                    ->from($this->_detail_table_name)
                    ->join("barang", "barang.id_barang = $this->_detail_table_name.id_barang")
                    ->where(array('id_pesanan'=>$id_pesanan))
                    ->get()
                    ->result_array();
                $results[$key]['detail_pembayaran'] = $this->db->get_where($this->_pembayaran_table, array('id_pesanan'=>$id_pesanan))->result_array();

                foreach($results[$key]['detail_barang'] as $index => $row){
                    if($result['jenis_harga'] == "harga_satuan_reseller"){
                        $results[$key]['detail_barang'][$index]['harga_satuan'] = $results[$key]['detail_barang'][$index]['harga_satuan_reseller'];
                    }else{
                        $results[$key]['detail_barang'][$index]['harga_satuan'] = $results[$key]['detail_barang'][$index]['harga_satuan_normal'];
                    }
                }

            }
            return $results;
        }

        private function formatDate($date)
        {
            
            $date = str_replace('/', '-', $date);
            return date('Y-m-d', strtotime($date));
        }

        
        public function post($pesanan, $detail_pesanan)
        {


            $pesanan_result = $this->db->insert($this->_table_name, $pesanan);
            $pesanan_id = $this->db->insert_id();

            foreach ($detail_pesanan as $key => $value) {
                $detail_pesanan[$key]['id_pesanan'] = $pesanan_id;
                
                unset($detail_pesanan[$key]['harga_satuan_reseller']);
                unset($detail_pesanan[$key]['harga_satuan_normal']);
                unset($detail_pesanan[$key]['harga_satuan']);
                unset($detail_pesanan[$key]['nama_barang']);
            }
            $detail_pesanan_result = $this->db->insert_batch($this->_detail_table_name, $detail_pesanan);
            
            return $pesanan_result && $detail_pesanan_result;
        }

        public function add_pembayaran($data)
        {
            $return =  $this->db->insert($this->_pembayaran_table, $data);

            $total = $this->db
                    ->select("sum(subtotal)as total")
                    ->from($this->_detail_table_name)
                    ->where(array('id_pesanan'=>$data['id_pesanan']))
                    ->get()->row()->total;
            $dibayar = $this->db
                    ->select("sum(jumlah_uang)as dibayar")
                    ->from($this->_pembayaran_table)
                    ->where(array('id_pesanan'=>$data['id_pesanan']))
                    ->get()->row()->dibayar;
            if($total == null){$total = 0;}
            if($dibayar == null){$dibayar = 0;}
            if($total != 0 && $total==$dibayar){
                $this->db->set('status', "2")->where('id_pesanan' , $data['id_pesanan'])->update($this->_table_name);
            }

            return $return;
        }
    }