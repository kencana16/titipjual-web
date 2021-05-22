<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('_partial/meta') ?>
    <!-- Datatables styles -->
    <link href="<?=base_url('assets/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet" type="text/css">
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('_partial/sidebar') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('_partial/topbar') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Daftar Produk</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow ">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?php echo site_url('barang/tambah_barang') ?>"><i class="fas fa-plus mr-1"></i> Tambah Produk</a>
                                </div>
                                <div class="card-body">
                                    <div class="col py-2">
                                        <div class="table-responsive">
                                            <table id="barangTable" class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Nama Produk</th>
                                                    <th>Satuan</th>
                                                    <th>Harga Normal</th>
                                                    <th>Harga Reseller</th>
                                                    <!-- <th>Estimasi Modal (/KG)</th> -->
                                                    <th>Aksi</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($barangs as $barang): ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?= $barang->nama_barang?></td>
                                                        <td class="text-right"><?= 'Rp.&nbsp;'.number_format($barang->harga_satuan_normal)?></td>
                                                        <td ><?= $barang->satuan ?></td>
                                                        <td class="text-right"><?= 'Rp.&nbsp;'.number_format($barang->harga_satuan_reseller)?></td>
                                                        <!-- <td class="text-right"><?php//echo 'Rp.&nbsp;'.number_format($barang->estimasi_modal_per_kg)?></td> -->
                                                        <td class="text-md-left text-center">
                                                            <a class="btn btn-sm btn-primary m-1 " href="<?=site_url('barang/edit_barang/'.$barang->id_barang)?>">
                                                                <i class="fas fa-edit"></i>
                                                                <span class="hide-mobile ml-1">edit</span>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger open-DeleteDataModal m-1" href="#" 
                                                            data-toggle="modal" data-target="#deleteDataModal" 
                                                            data-id="<?=$barang->id_barang?>" data-name="<?=$barang->nama_barang?>">
                                                                <i class="fas fa-trash"></i>
                                                                <span class="hide-mobile ml-1">hapus</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                   </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('_partial/footer') ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal-->
    <?php $this->load->view('_partial/modal_logout') ?>
    <?php $this->load->view('_partial/modal_delete_data') ?>

    <!-- Javascript Import -->
    <?php $this->load->view('_partial/jsScript') ?>

    <!-- datatables Import-->
    <?php $this->load->view('_partial/jsDatatables') ?>
    <script>
        $(document).ready( function () {
            var t = $('#barangTable').DataTable( {
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 4
                } ],
                "order": [[ 1, 'asc' ]]
            } );

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();


            $(document).on("click", ".open-DeleteDataModal", function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                $("#deleteDataModal").find($("#keterangan")).text(" "+name);
                $("#deleteDataModal").find($(".btn-delete")).attr("href", '<?=site_url('barang/hapus_barang/')?>'+id);
                
            });
        } );
    </script>

</body>

</html>