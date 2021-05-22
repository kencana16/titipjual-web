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
                        <h1 class="h3 mb-0 text-gray-800">Data Produksi</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow ">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?=site_url('produksi/tambah_produksi')?>"><i class="fas fa-plus mr-1"></i> Tambah data baru</a>
                                </div>
                                <div class="card-body">
                                    <div class="col py-2">
                                        <div class="table-responsive">
                                            <table id="dataTables" class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Tanggal Produksi</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah Produksi (/KG)</th>
                                                    <th>Estimasi Modal</th>
                                                    <th>Aksi</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($produksis as $produksi):?>
                                                    <tr>
                                                        <td></td>
                                                        <td class="tanggal-indo"><?= $produksi->tgl_produksi?></td>
                                                        <td><?= $produksi->nama_barang?></td>
                                                        <td><?= $produksi->jml_produksi?></td>
                                                        <td><?= 'Rp. '.number_format($produksi->estimasi_modal)?></td>
                                                        <td class="text-md-left text-center">
                                                            <a class="btn btn-sm btn-primary m-1 " href="<?=site_url('produksi/edit_produksi/'.$produksi->id_produksi)?>">
                                                                <i class="fas fa-edit"></i>
                                                                <span class="hide-mobile ml-1">edit</span>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger open-DeleteDataModal m-1" href="#" 
                                                            data-toggle="modal" data-target="#deleteDataModal" 
                                                            data-id="<?=$produksi->id_produksi?>" data-name="<?=$produksi->nama_barang?>" data-date="<?=$produksi->tgl_produksi?>">
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

    <!-- Logout Modal-->
    <?php $this->load->view('_partial/modal_logout') ?>
    <?php $this->load->view('_partial/modal_delete_data') ?>

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
                    "targets": 5
                }, ],
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
                var date = $(this).data('date');
                $("#deleteDataModal").find($("#keterangan")).text(" "+name+" ("+tanggalIndo(date)+")");
                $("#deleteDataModal").find($(".btn-delete")).attr("href", '<?=site_url('produksi/hapus_produksi/')?>'+id);
                
            });
        } );
    </script>
    <script src="<?=base_url('assets/tanggal-indo.js')?>"></script>

</body>

</html>
