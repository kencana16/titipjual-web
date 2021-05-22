<!DOCTYPE html>
<html lang="en">

<head>

   <?php $this->load->view('_partial/meta') ?>
    <!-- Datatables styles -->
    <link href="<?=site_url()?>assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('_partial/sidebarku') ?>
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
                        <h1 class="h3 mb-0 text-gray-800">Data Penjualan</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow ">
                                <div class="card-header">
                                    &nbsp;
                                </div>
                                <div class="card-body">
                                    <div class="col py-2">
                                        <div class="table-responsive">
                                            <table id="dataTables" class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Tanggal Penjualan</th>
                                                    <th>Jumlah Produk</th>
                                                    <th>Terjual</th>
                                                    <th>Jumlah Uang</th>
                                                    <th>Dibayar</th>
                                                    <th>Aksi</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($penjualans as $penjualan):?>
                                                    <tr>
                                                        <td></td>
                                                        <td class="tanggal-indo"><?= $penjualan->tgl_penjualan?></td>
                                                        <td class="text-right"><?= $penjualan->jml_produk?></td>
                                                        <td class="text-right"><?= $penjualan->jml_terjual?></td>
                                                        <td class="text-right"><?= 'Rp. '.number_format($penjualan->jml_uang)?></td>
                                                        <td class="text-right">
                                                            <span class=" <?= ($penjualan->dibayar < $penjualan->jml_uang)? 'font-weight-bold text-danger' :' '?>">
                                                                <?= "Rp. ".number_format($penjualan->dibayar) ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-md-left text-center">
                                                            <a class="btn btn-sm btn-primary m-1 " href="<?=site_url('penjualanku/edit_penjualan/'.$penjualan->id_penjualan)?>">
                                                                <i class="fas fa-edit"></i>
                                                                <span class="hide-mobile ml-1">edit</span>
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

    <!-- Logout Modal-->
    <?php $this->load->view('_partial/modal_logout') ?>

    <!-- Javascript Import -->
    <?php $this->load->view('_partial/jsScript') ?>

    <!-- datatables Import-->
    <?php $this->load->view('_partial/jsDatatables') ?>
    <script>
        $(document).ready( function () {
            var t = $('#dataTables').DataTable( {
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 6
                }, ],
                "order" : []
            } );

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

        } );
    </script>
    <script src="<?=base_url('assets/tanggal-indo.js')?>"></script>

</body>

</html>
