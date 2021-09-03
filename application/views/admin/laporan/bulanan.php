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
                        <h1 class="h3 mb-0 text-gray-800">Laporan  Global</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow ">
                                <div class="card-header">
                                    Laporan global bulanan
                                </div>
                                <div class="card-body">
                                    <div class="col py-2">
                                        <div class="table-responsive">
                                            <table id="laporanTable" class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Waktu</th>
                                                    <th>Penjualan</th>
                                                    <th>Pesanan</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($data as $row):?>
                                                        <tr>
                                                            <td></td>
                                                            <td class="bulan-indo"><?=$row['periode']?></td>
                                                            <td class="text-right"><?= "Rp. ".number_format($row['penjualan'])?></td>
                                                            <td class="text-right"><?= "Rp. ".number_format($row['pesanan'])?></td>
                                                        </tr>
                                                    <?php endforeach;?>
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

    <!-- Javascript Import -->
    <?php $this->load->view('_partial/jsScript') ?>

    <!-- datatables Import-->
    <?php $this->load->view('_partial/jsDatatables') ?>

    <!-- datatables export -->
    <script src="<?php echo base_url()?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jszip.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url()?>assets/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/buttons.print.min.js"></script>

    <script>
        $(document).ready( function () {
            var t = $('#laporanTable').DataTable( {
                "dom": "<'text-left mb-3'<'col-md-6 p-0'B>><'row '<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>>rtip",
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [],
                "buttons": [
                        {
                            "extend": 'copy',
                            "className": 'btn btn-sm btn-outline-primary',
                            "exportOptions": {
                                columns: ':visible'
                            },
                            "title": ""
                        },
                        {
                            "extend": 'excel',
                            "className": 'btn btn-sm btn-outline-primary',
                            "exportOptions": {
                                columns: ':visible'
                            },
                            "title": ""
                        },
                        {
                            "extend": 'csv',
                            "className": 'btn btn-sm btn-outline-primary',
                            "exportOptions": {
                                columns: ':visible'
                            },
                            "title": ""
                        },
                        
                        {
                            "extend": 'pdf',
                            "className": 'btn btn-sm btn-outline-primary',
                            "exportOptions": {
                                columns: ':visible'
                            },
                            "title": "Laporan Bulanan"
                        },
                        
                        {
                            "extend": 'print',
                            "className": 'btn btn-sm btn-outline-primary',
                            "exportOptions": {
                                columns: ':visible'
                            },
                            "title": "Laporan Bulanan"
                        },
                    ]
            } );

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                    t.cell(cell).invalidate('dom');
                } );
            } ).draw();
            
        } );
    </script>
    <script src="<?=base_url('assets/tanggal-indo.js')?>"></script>

</body>

</html>