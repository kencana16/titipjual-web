<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Penjualan_models extends CI_Model{
        private $_table_name = 'penjualan';
        private $_detail_table_name = 'detail_penjualan';
        private $_pembayaran_table = 'pembayaran_penjualan';

        public function add(){
            $arrIdBarang = $this->input->post('idBarang');
            $arrJumlah = $this->input->post('jumlah');
            $arrTerjual = $this->input->post('terjual');
            $arrUang = $this->input->post('uang');

            $data = array(
                'id_penjual' => $this->input->post('idPenjual'),
                'tgl_penjualan' => $this->input->post('tgl'),
                'date_created' => date('Y-m-d H:i:s',now()),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $this->db->insert($this->_table_name, $data);
            $idPenjualan = $this->db->insert_id();

            $dataBayar = array(
                'id_penjualan' => $idPenjualan,
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
                    'id_penjualan' => $idPenjualan,
                    'id_barang' => $arrIdBarang[$key],
                    'jml_produk' => $arrJumlah[$key],
                    'jml_terjual' => $arrTerjual[$key],
                    'jml_uang' => $arrUang[$key],
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
            $arrTerjual = $this->input->post('terjual');
            $arrUang = $this->input->post('uang');
            
            $data =  array(
                'id_penjual' => $this->input->post('idPenjual'),
                'tgl_penjualan' => $this->input->post('tgl'),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $this->db->where('id_penjualan', $id)->update($this->_table_name, $data);

            //remove deleted data in database
            $DbBarangIds =  $this->db->query("SELECT `id_detail_penjualan` FROM `detail_penjualan` where `id_penjualan`= $id")->result();
            foreach($DbBarangIds as $key => $DbBarangId){
                $tempId[$key] = $DbBarangId->id_detail_penjualan;
            }
            $deleteIds = array_diff($tempId,$arrId);

            foreach($deleteIds as $deleteId){
                $data =  array(
                    'id_detail_penjualan'=>$deleteId
                );
                $this->db->delete($this->_detail_table_name, $data);
            }


            foreach($arrIdBarang as $key => $barang){
                if($arrIdBarang[$key] == "" && $arrJumlah[$key] == "" && $arrTerjual[$key] == "" && $arrUang[$key] == "" ){
                    continue;
                }
                //update existing data in database
                if($arrId[$key] == ""){
                    //add new data in database
                    $data = array(
                        'id_penjualan' => $id,
                        'id_barang' => $arrIdBarang[$key],
                        'jml_produk' => $arrJumlah[$key],
                        'jml_terjual' => $arrTerjual[$key],
                        'jml_uang' => $arrUang[$key],
                        'date_created' => date('Y-m-d H:i:s',now()),
                        'date_modified' => date('Y-m-d H:i:s',now())
                    );
                    $this->db->insert($this->_detail_table_name, $data);
                }else{
                    $data = array(
                        'id_penjualan' => $id,
                        'id_barang' => $arrIdBarang[$key],
                        'jml_produk' => $arrJumlah[$key],
                        'jml_terjual' => $arrTerjual[$key],
                        'jml_uang' => $arrUang[$key],
                        'date_modified' => date('Y-m-d H:i:s',now())
                    );
                    $this->db->where('id_detail_penjualan', $arrId[$key])->update($this->_detail_table_name, $data);
                }
            }
        }

        public function showAll(){
            $query = "SELECT p.id_penjualan, nama_penjual, tgl_penjualan, SUM(jml_produk) as jml_produk, SUM(jml_terjual) as jml_terjual, SUM(jml_uang) as jml_uang
                FROM penjualan p 
                LEFT JOIN penjual pj 
                    ON p.id_penjual = pj.id_penjual 
                INNER JOIN detail_penjualan dp
                    ON p.id_penjualan = dp.id_penjualan
                GROUP BY dp.id_penjualan
                ORDER BY tgl_penjualan DESC, nama_penjual ASC";
            $results = $this->db->query($query)->result();
            foreach($results as $result){
                $id = $result->id_penjualan;
                $v = $this->db
                ->query("SELECT sum(jumlah_uang) as jumlah_uang FROM $this->_pembayaran_table WHERE id_penjualan=$id")
                ->row();
                $result->dibayar = ($v->jumlah_uang == null)? "0" : $v->jumlah_uang;
            }
            return $results;
        }

        public function showByPenjual($id_penjual){
            $query = "SELECT p.id_penjualan, nama_penjual, tgl_penjualan, SUM(jml_produk) as jml_produk, SUM(jml_terjual) as jml_terjual, SUM(jml_uang) as jml_uang
                FROM penjualan p 
                INNER JOIN penjual pj 
                    ON p.id_penjual = pj.id_penjual 
                INNER JOIN detail_penjualan dp
                    ON p.id_penjualan = dp.id_penjualan
                WHERE p.id_penjual = '$id_penjual'
                GROUP BY dp.id_penjualan
                ORDER BY tgl_penjualan DESC, nama_penjual ASC";
            return $this->db->query($query)->result();
        }
        
        public function showByID($id){
            $data =  array(
                'id_penjualan'=>$id
            );
            return $this->db->get_where($this->_table_name, $data)->row();
        }
        
        public function delete($id){
            $data =  array(
                'id_penjualan'=>$id
            );
            $this->db->delete($this->_detail_table_name, $data);
            return $this->db->delete($this->_table_name, $data);
        }
        
        public function showDetail($id){
            $data =  array(
                'id_penjualan'=>$id
            );
            return $this->db->order_by('id_detail_penjualan', 'ASC')->get_where($this->_detail_table_name, $data)->result();
        }

        public function getPembayaranTotal($id){
            $data =  array(
                'id_penjualan'=>$id
            );
            return $this->db->select_sum('jumlah_uang')->get_where($this->_pembayaran_table, $data)->row();
            
        }

        public function getPembayaranDetail($id){
            $data =  array(
                'id_penjualan'=>$id
            );
            $jumlah = $this->db->select_sum('jml_uang')->get_where($this->_detail_table_name, $data)->row();
            $dibayar = $this->db->select_sum('jumlah_uang')->get_where($this->_pembayaran_table, $data)->row();
            $pembayaran = $this->db->get_where($this->_pembayaran_table, $data)->result();
            $data = array(
                'id_penjualan' => $id,
                'jumlah' => $jumlah->jml_uang,
                'dibayar' => $dibayar->jumlah_uang,
                'pembayaran' => $pembayaran,
                'success' => true
            );
            return $data;
        }
        
        public function getPembayaranRow($id){
            $data =  array(
                'id_pembayaran_penjualan'=>$id
            );
            $pembayaran = $this->db->get_where($this->_pembayaran_table, $data)->row();
            return $pembayaran;
        }

        public function addPembayaran()
        {
            $data = array(
                'id_penjualan' => $this->input->post('id_penjualan'),
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
                'id_penjualan' => $this->input->post('id_penjualan'),
                'tanggal' => $this->input->post('tgl'),
                'jumlah_uang' => $this->input->post('uang'),
                'date_modified' => date('Y-m-d H:i:s',now())
            );
            $this->db->where('id_pembayaran_penjualan', $this->input->post('id'))->update($this->_pembayaran_table, $data);
        }

        public function deletePembayaran()
        {
            $data =  array(
                'id_pembayaran_penjualan'=>$this->input->post('id')
            );
            return $this->db->delete($this->_pembayaran_table, $data);
        }

        public function incomeThisDay()
        {
            $date = date('Y-m-d',now());
            $query = "SELECT p.id_penjualan, tgl_penjualan, sum(jumlah_uang) as jml_uang
                FROM penjualan p 
                left join pembayaran_penjualan pp on p.id_penjualan=pp.id_penjualan
                where tgl_penjualan = '$date'
                group by tgl_penjualan
                limit 1";

            $get =  $this->db->query($query);
            if($get->num_rows() > 0){
                return $get->row();
            }else{
                return (object) [
                    'id_penjualan' => null,
                    'tgl_penjualan' => null,
                    'jml_uang' => 0,
                ];
            }
        }

        public function incomeThisWeekJson(){
            $last7days = $this->getLastNDays(7, 'Y-m-d');
            $data = [];
            foreach($last7days as $day){
                $query = "SELECT tgl_penjualan, sum(jumlah_uang) as jml 
                    FROM penjualan p 
                    left join pembayaran_penjualan pp on p.id_penjualan=pp.id_penjualan
                    WHERE tgl_penjualan = '$day'
                    Group BY `p`.`tgl_penjualan` 
                    Order BY `p`.`tgl_penjualan` Desc ";
                $result =  $this->db->query($query)->row();
                if($result != null){
                    array_push($data,
                    array(
                        'tgl_penjualan' => $day,
                        'jml' => $result->jml == null ? "0" : $result->jml,
                    ));
                }else{
                    array_push($data,
                    array(
                        'tgl_penjualan' => $day,
                        'jml' => "0"
                    ));
                }
            }

            return $data;
        }

        public function getLastNDays($days, $format = 'd/m'){
            $m = date("m"); $de= date("d"); $y= date("Y");
            $dateArray = array();
            for($i=0; $i<=$days-1; $i++){
                $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
            }
            return $dateArray;
        }

        public function incomeThisMonth()
        {
            $month = date('n',now());
            $year = date('Y', now());
            $query = "SELECT p.id_penjualan, tgl_penjualan, sum(jumlah_uang) as jml_uang
                FROM penjualan p 
                left join pembayaran_penjualan pp on p.id_penjualan=pp.id_penjualan
                where month(tgl_penjualan)='$month' AND year(tgl_penjualan)='$year'
                group by month(tgl_penjualan)";
                
            $get =  $this->db->query($query);
            if($get->num_rows() > 0){
                return $get->row();
            }else{
                return (object) [
                    'id_penjualan' => null,
                    'tgl_penjualan' => null,
                    'jml_uang' => 0,
                ];
            }
        }

        public function monthlyReport()
        {
            $query = "SELECT DATE_FORMAT(p.tgl_penjualan, '%Y, %m') AS periode,
              SUM(jumlah_uang) AS penjualan
              FROM penjualan p
              left join pembayaran_penjualan pp on p.id_penjualan=pp.id_penjualan
              GROUP BY DATE_FORMAT(p.tgl_penjualan, '%Y, %m')
              ORDER BY p.tgl_penjualan DESC";
            return $this->db->query($query)->result_array();
        }

        public function dailyReport($date)
        {
            $month = date('m', strtotime($date));
            $year = date('Y', strtotime($date));
            $query = "SELECT p.tgl_penjualan AS periode, SUM(jumlah_uang) AS penjualan 
              FROM penjualan p
              left join pembayaran_penjualan pp on p.id_penjualan=pp.id_penjualan
              WHERE MONTH(p.tgl_penjualan)= $month AND YEAR(p.tgl_penjualan)= $year 
              GROUP BY p.tgl_penjualan 
              ORDER BY p.tgl_penjualan DESC";
            return $this->db->query($query)->result_array();
        }

        public function get_penjualan_barang($id_barang = "", $id_penjual = ""){
            $hari = $this->db->query("Select DAYNAME(CURDATE()-1) as hari")->row()->hari;

            $query_mingguan = "SELECT DAYNAME(penjualan.tgl_penjualan) as hari, barang.id_barang, AVG(jml_terjual) as jml FROM `detail_penjualan`
            LEFT JOIN penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
            LEFT JOIN barang ON barang.id_barang = detail_penjualan.id_barang
            WHERE id_penjual = $id_penjual
            AND barang.id_barang = $id_barang
            AND DAYNAME(penjualan.tgl_penjualan) = DAYNAME(CURDATE())
            GROUP BY DAYNAME(penjualan.tgl_penjualan), nama_barang  
            ORDER BY `barang`.`nama_barang` ASC";

            $mingguan = $this->db->query($query_mingguan)->row();
            if($mingguan == null){
                $mingguan_val = "Data belum ada";
            }else{
                $mingguan_val = floor($mingguan->jml);
            }
            
            $query_harian = "SELECT DAYNAME(penjualan.tgl_penjualan), barang.id_barang, AVG(jml_terjual) as jml FROM `detail_penjualan`
            LEFT JOIN penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
            LEFT JOIN barang ON barang.id_barang = detail_penjualan.id_barang
            WHERE id_penjual = $id_penjual
            AND barang.id_barang = $id_barang
            GROUP BY  nama_barang  
            ORDER BY `barang`.`nama_barang` ASC";

            $harian = $this->db->query($query_harian)->row();
            if($harian == null){
                $harian_val = "Data belum ada";
            }else{
                $harian_val = floor($harian->jml);
            }

            $result = array(
                'hari' => $hari,
                'mingguan' => $mingguan_val,
                'harian' => $harian_val
            );

            return $result;
        }



        public function get($id = null, $id_penjual = null, $tanggal = null)
        {
            if($id != null){
                $this->db->where("$this->_table_name.id_penjualan", $id);
            }
            if($id_penjual != null){
                $this->db->where("$this->_table_name.id_penjual", $id_penjual);
            }
            if($tanggal != null){
                $arrTgl = explode(" - ", $tanggal);
                if(sizeof($arrTgl) == 2){
                    $this->db->where('tgl_penjualan >=', $this->formatDate($arrTgl[0]));
                    $this->db->where('tgl_penjualan <=', $this->formatDate($arrTgl[1]));
                }else if(sizeof($arrTgl) == 1){
                    $this->db->where('tgl_penjualan', $this->formatDate($arrTgl[0]));
                }
            }
            $this->db->select("$this->_table_name.*, nama_penjual, no_hp, sum(jml_produk) as jml_produk, sum(jml_terjual) as jml_terjual");
            $this->db->select("sum(jml_uang) as total");
            $this->db->from($this->_table_name);
            $this->db->join('penjual', "$this->_table_name.id_penjual = penjual.id_penjual", 'left');
            $this->db->join("$this->_detail_table_name", "$this->_table_name.id_penjualan = $this->_detail_table_name.id_penjualan", 'left');
            $this->db->group_by("$this->_table_name.id_penjualan");
            $this->db->order_by('date_created', 'DESC');
            $this->db->order_by('status', 'ASC');
            $results = $this->db->get()->result_array();

            foreach($results as $key => $result){
                $id_penjualan = $result['id_penjualan'];
                $results[$key]['dibayar'] = $this->db
                    ->select("sum(jumlah_uang)as dibayar")
                    ->from($this->_pembayaran_table)
                    ->where(array('id_penjualan'=>$id_penjualan))
                    ->get()->row()->dibayar;

                if($results[$key]['dibayar'] == null){
                    $results[$key]['dibayar'] = "0";
                }

                $results[$key]['detail_barang'] = $this->db
                    ->select("$this->_detail_table_name.*")
                    ->select("nama_barang, harga_satuan_reseller")
                    ->from($this->_detail_table_name)
                    ->join("barang", "barang.id_barang = $this->_detail_table_name.id_barang")
                    ->where(array('id_penjualan'=>$id_penjualan))
                    ->get()
                    ->result_array();

                $results[$key]['detail_pembayaran'] = $this->db->get_where($this->_pembayaran_table, array('id_penjualan'=>$id_penjualan))->result_array();

            }
            return $results;
        }

        private function formatDate($date)
        {
            
            $date = str_replace('/', '-', $date);
            return date('Y-m-d', strtotime($date));
        }

        
        public function post($penjualan, $detail_penjualan)
        {
            $penjualan_result = $this->db->insert($this->_table_name, $penjualan);
            $penjualan_id = $this->db->insert_id();

            foreach ($detail_penjualan as $key => $value) {
                $detail_penjualan[$key] = array(
                    'id_penjualan' => $penjualan_id,
                    'id_barang' => $detail_penjualan[$key]['id_barang'],
                    'jml_produk' => $detail_penjualan[$key]['jml_produk'],

                );
            }
            $detail_penjualan_result = $this->db->insert_batch($this->_detail_table_name, $detail_penjualan);
            
            return $penjualan_result && $detail_penjualan_result;
        }

        
        public function rekap($arr)
        {
            $jml = 0;
            foreach ($arr as $array) {
                unset($array['date_modified']);
                unset($array['nama_barang']);
                unset($array['harga_satuan_reseller']);
                $this->db->replace($this->_detail_table_name, $array);

                $jml += $array['jml_terjual'];
            }
            if($jml > 0){
                $this->db->set('status', 1)->where('id_penjualan', $arr[0]['id_penjualan'])->update('penjualan');
            }else{
                $this->db->set('status', 0)->where('id_penjualan', $arr[0]['id_penjualan'])->update('penjualan');
            }
        }

        public function add_pembayaran($data)
        {
            $return =  $this->db->insert($this->_pembayaran_table, $data);
            
            $total = $this->db
                    ->select("sum(jml_uang)as total")
                    ->from($this->_detail_table_name)
                    ->where(array('id_penjualan'=>$data['id_penjualan']))
                    ->get()->row()->total;
            $dibayar = $this->db
                    ->select("sum(jumlah_uang)as dibayar")
                    ->from($this->_pembayaran_table)
                    ->where(array('id_penjualan'=>$data['id_penjualan']))
                    ->get()->row()->dibayar;
            if($total == null){$total = 0;}
            if($dibayar == null){$dibayar = 0;}
            if($total != 0 && $total==$dibayar){
                $this->db->set('status', "2")->where('id_penjualan' , $data['id_penjualan'])->update($this->_table_name);
            }

            return $return;
        }

    }