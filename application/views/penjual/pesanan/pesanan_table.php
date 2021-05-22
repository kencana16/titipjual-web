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
                        <h1 class="h3 mb-0 text-gray-800">Daftar Pesanan</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow ">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?php echo site_url('pesananku/tambah_pesanan') ?>"><i class="fas fa-plus mr-1"></i> Tambah Pesanan</a>
                                </div>
                                <div class="card-body">
                                    <div class="col py-2">
                                        <div class="table-responsive">
                                            <table id="barangTable" class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Tanggal Dipesan</th>
                                                    <th>Tanggal Diambil</th>
                                                    <th>Harga Pesanan</th>
                                                    <th>Dibayar</th>
                                                    <!-- <th>Aksi</th> -->
                                                </thead>
                                                <tbody>
                                                    <?php foreach($pesanans as $pesanan): ?>
                                                    <tr>
                                                        <td></td>
                                                        <td class="tanggal-indo"><?= $pesanan->tgl_dipesan?></td>
                                                        <td class="tanggal-indo"><?= $pesanan->tgl_diambil ?></td>
                                                        <td class="text-right"><?= "Rp. ".number_format($pesanan->total) ?></td>
                                                        <td class="text-right">
                                                            <span class=" <?= ($pesanan->dibayar < $pesanan->total)? 'font-weight-bold text-danger' :' '?>">
                                                                <?= "Rp. ".number_format($pesanan->dibayar) ?>
                                                            </span>
                                                        </td>
                                                        <!-- <td>
                                                            <a class="btn btn-sm btn-primary m-1 " href="<?/*=site_url('pesananku/edit_pesanan/'.$pesanan->id_pesanan)*/?>">
                                                                <i class="fas fa-edit"></i>
                                                                <span class="hide-mobile ml-1">edit</span>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger open-DeleteDataModal m-1" href="#" 
                                                            data-toggle="modal" data-target="#deleteDataModal" 
                                                            data-id="<?/*=$pesanan->id_pesanan*/?>" data-name="<?/*=$pesanan->nama_pemesan*/?>">
                                                                <i class="fas fa-trash"></i>
                                                                <span class="hide-mobile ml-1">hapus</span>
                                                            </a>
                                                        </td> -->
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
                /*{
                    "searchable": false,
                    "orderable": false,
                    "targets": 
                }*/ ],
                "order" : []
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
                $("#deleteDataModal").find($(".btn-delete")).attr("href", '<?=site_url('pesanan/hapus_pesanan/')?>'+id);
                
            });
        } );
    </script>
    <script src="<?=base_url('assets/tanggal-indo.js')?>"></script>

</body>

</html>