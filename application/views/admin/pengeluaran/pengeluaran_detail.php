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
                        <h1 class="h3 mb-0 text-gray-800">Detail Pengeluaran</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow ">
                                <div class="card-header">
                                <a class="btn btn-sm text-primary" href="<?php echo site_url('pengeluaran') ?>"><i class="fas fa-arrow-left mr-1"></i> Kembali<span class="hide-mobile"> ke data pengeluaran</span></a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">ID pengeluaran</div>
                                        <div class="col-md-9">: <?=$pengeluaran->id_pengeluaran?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Tanggal pengeluaran</div>
                                        <div class="col-md-9">: <span class="tanggal-indo"><?=$pengeluaran->tgl_pengeluaran?></span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Jenis pengeluaran</div>
                                        <div class="col-md-9">: <?=$pengeluaran->jenis?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Total</div>
                                        <div class="col-md-9">: Rp. <?=number_format($pengeluaran->jml_pengeluaran)?></div>
                                    </div>
                                    
                                    <div class="my-2">
                                        <a class="btn btn-sm btn-primary m-1 " href="<?=site_url('pengeluaran/edit_pengeluaran/'.$pengeluaran->id_pengeluaran)?>">
                                            <i class="fas fa-edit"></i>
                                            <span class="hide-mobile ml-1">edit</span>
                                        </a>
                                        <a class="btn btn-sm btn-danger open-DeleteDataModal m-1" href="#" 
                                         data-toggle="modal" data-target="#deleteDataModal" 
                                         data-id="<?=$pengeluaran->id_pengeluaran?>" data-name="<?=$pengeluaran->tgl_pengeluaran?>">
                                            <i class="fas fa-trash"></i>
                                            <span class="hide-mobile ml-1">hapus</span>
                                        </a>
                                    </div>

                                    <hr class="my-2">
                                    <div class="col py-2">
                                        <div class="table-responsive">
                                            <table id="dataTables" class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($detail_pengeluarans as $detail_pengeluaran):?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?= $detail_pengeluaran->nama_barang?></td>
                                                        <td><?= $detail_pengeluaran->jumlah_barang?></td>
                                                        <td><?= 'Rp. '.number_format($detail_pengeluaran->harga)?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-right">Total halaman ini:</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3" class="text-right">Total keseluruhan:</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
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
                }, ],
                "order": [[ 1, 'asc' ]],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\R\p\.\ ,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
        
                    // Total over all pages
                    total = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
        
                    // Total over this page
                    pageTotal = api
                        .column( 3, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
        
                    // Update footer
                    $( api.column( 3 ).footer() ).html(
                        'Rp. '+numberWithCommas(pageTotal)
                    );
                    $('tr:eq(1) th:eq(1)', api.table().footer()).html('Rp. '+numberWithCommas(total));
                }
            } );

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $(document).on("click", ".open-DeleteDataModal", function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                $("#deleteDataModal").find($("#keterangan")).text(" Pengeluaran "+tanggalIndo(name));
                $("#deleteDataModal").find($(".btn-delete")).attr("href", '<?=site_url('pengeluaran/hapus_pengeluaran/')?>'+id);
                
            });
        } );
    </script>
    <script src="<?=base_url('assets/tanggal-indo.js')?>"></script>

</body>

</html>
