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
                        <h1 class="h3 mb-0 text-gray-800">Data Penjualan</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow ">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?=site_url('penjualan/tambah_penjualan')?>"><i class="fas fa-plus mr-1"></i> Tambah data baru</a>
                                </div>
                                <div class="card-body">
                                    <div class="col py-2">
                                        <div class="table-responsive">
                                            <table id="dataTables" class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Nama Penjual</th>
                                                    <th>Tanggal Penjualan</th>
                                                    <th>Jumlah Produk</th>
                                                    <th>Terjual</th>
                                                    <th>Jumlah Uang</th>
                                                    <th>DIbayar</th>
                                                    <th>Aksi</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($penjualans as $penjualan):?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?= $penjualan->nama_penjual?></td>
                                                        <td class="tanggal-indo"><?= $penjualan->tgl_penjualan?></td>
                                                        <td class="text-right"><?= $penjualan->jml_produk?></td>
                                                        <td class="text-right"><?= $penjualan->jml_terjual?></td>
                                                        <td class="text-right"><?= 'Rp. '.number_format($penjualan->jml_uang)?></td>
                                                        <td class="text-right">
                                                            <span class=" <?= ($penjualan->dibayar < $penjualan->jml_uang)? 'font-weight-bold text-danger' :' '?>">
                                                                <?= "Rp. ".number_format($penjualan->dibayar) ?>
                                                            </span>

                                                            <a class="btn btn-sm ml-1<?= ($penjualan->dibayar < $penjualan->jml_uang)? ' btn-outline-danger' :' btn-outline-primary'?>
                                                            open-PembayaranModal m-1" href="#" 
                                                            data-toggle="modal" data-target="#pembayaranModal" 
                                                            data-id="<?=$penjualan->id_penjualan?>">
                                                                <i class="fas fa-file-invoice-dollar"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-md-left text-center">
                                                            <a class="btn btn-sm btn-primary m-1 " href="<?=site_url('penjualan/edit_penjualan/'.$penjualan->id_penjualan)?>">
                                                                <i class="fas fa-edit"></i>
                                                                <span class="hide-mobile ml-1">edit</span>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger open-DeleteDataModal m-1" href="#" 
                                                            data-toggle="modal" data-target="#deleteDataModal" 
                                                            data-id="<?=$penjualan->id_penjualan?>" data-name="<?=$penjualan->nama_penjual?>" data-date="<?=$penjualan->tgl_penjualan?>">
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
    <?php $this->load->view('_partial/modal_pembayaran') ?>

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
                    "targets": 7
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
                $("#deleteDataModal").find($("#keterangan")).text(" Penjualan "+name+" - "+tanggalIndo(date));
                $("#deleteDataModal").find($(".btn-delete")).attr("href", '<?=site_url('penjualan/hapus_penjualan/')?>'+id);
                
            });
            
            
        } );
    </script>
    <script>
    // script untuk pembayaran
        $(document).ready(function(){
            $(document).on("click", ".open-PembayaranModal", function () {
                modal_pembayaran("show");
                var id = $(this).data('id');
                render_data(id);
            });

            $("#pembayaranModal").find($('#tambah-pembayaran')).click(function(){
                modal_pembayaran("form");
                $("#pembayaranModal").find($('form')).find($('.btn-secondary')).click(function(){
                    modal_pembayaran("show");
                });
            });

        });
        function submitPembayaran(){

            $("#pembayaranModal").find($('.is-invalid')).each(function(){
                $(this).removeClass("is-invalid");
                $(this).parent().find($('.invalid-feedback')).html();
            })
            
            if($("#pembayaranModal").find($('input[name="tgl"]')).val() == "" || $("#pembayaranModal").find($('input[name="uang"]')).val() == ""){
                if($("#pembayaranModal").find($('input[name="tgl"]')).val() == "" ){
                    $("#pembayaranModal").find($('input[name="tgl"]')).addClass("is-invalid");
                    $("#pembayaranModal").find($('input[name="tgl"]')).parent().find($('.invalid-feedback')).html("<small>Tidak boleh kosong</small>");
                }
                if($("#pembayaranModal").find($('input[name="uang"]')).val() == "" ){
                    $("#pembayaranModal").find($('input[name="uang"]')).addClass("is-invalid");
                    $("#pembayaranModal").find($('input[name="uang"]')).parent().find($('.invalid-feedback')).html("<small>Tidak boleh kosong</small>");
                }
                return false
            }

            $.ajax({
                url:'<?=base_url()?>penjualan/submit_pembayaran',
                method: 'post',
                data: {
                    id_penjualan: $("#pembayaranModal").data('idpenjualan'),
                    id : $("#pembayaranModal").find($('input[name="id"]')).val(),
                    tgl : $("#pembayaranModal").find($('input[name="tgl"]')).val(),
                    uang : $("#pembayaranModal").find($('input[name="uang"]')).val(),
                    },
                dataType: 'json',
                success: function(response){
                    modal_pembayaran("show");
                    render_data($("#pembayaranModal").data('idpenjualan'));
                }
            });
            return false;
        }

        function modal_pembayaran(mode="show"){
            switch (mode) {
                case "form":
                    $("#pembayaranModal").find($('#info')).addClass('d-none');
                    $("#pembayaranModal").find($('form')).removeClass('d-none');
                    $("#pembayaranModal").find($('table')).addClass('d-none');
                    $("#pembayaranModal").find($('#delete')).addClass('d-none');
                    break;

                case "delete":
                    $("#pembayaranModal").find($('#info')).addClass('d-none');
                    $("#pembayaranModal").find($('form')).addClass('d-none');
                    $("#pembayaranModal").find($('table')).addClass('d-none');
                    $("#pembayaranModal").find($('#delete')).removeClass('d-none');
                    break;
            
                default:
                    $("#pembayaranModal").find($('#info')).removeClass('d-none');
                    $("#pembayaranModal").find($('form')).addClass('d-none');
                    $("#pembayaranModal").find($('table')).removeClass('d-none');
                    $("#pembayaranModal").find($('#delete')).addClass('d-none');
                    break;
            }
        }

        function render_data(id_penjualan){
            $.ajax({
                url:'<?=base_url()?>penjualan/get_pembayaran',
                method: 'post',
                data: {id_penjualan: id_penjualan},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $("#pembayaranModal").attr("data-idpenjualan", response.id_penjualan);
                        $("#pembayaranModal").find($("#jumlah")).text("Rp. "+Intl.NumberFormat().format(response.jumlah));
                        $("#pembayaranModal").find($("#dibayar")).text("Rp. "+Intl.NumberFormat().format(response.dibayar));
                        $("#pembayaranModal").find($("#kurang")).text("Rp. "+Intl.NumberFormat().format(response.jumlah-response.dibayar));
                        $("#pembayaranModal").find($("#kekurangan")).text("Rp. "+Intl.NumberFormat().format(response.jumlah-response.dibayar));
                        $("#pembayaranModal").find('tbody').html("");
                        var Number = 0;
                        var Total = 0;
                        var Tbody = "";
                        for(const pembayaran of response.pembayaran){
                            Number++;
                            Total += parseFloat(pembayaran.jumlah_uang);
                            Tbody += '<tr>'+
                                    '<td>'+Number+'</td>'+
                                    '<td>'+pembayaran.tanggal+'</td>'+
                                    '<td class="text-right">Rp. '+Intl.NumberFormat().format(pembayaran.jumlah_uang)+'</td>'+
                                    '<td>'+
                                        '<button class="button-edit btn btn-sm btn-primary m-1" data-id="'+pembayaran.id_pembayaran_penjualan+'"><i class="fas fa-edit"></i></button>'+
                                        '<button class="button-remove btn btn-sm btn-danger m-1" data-id="'+pembayaran.id_pembayaran_penjualan+'" '+
                                        ' data-text="'+pembayaran.tanggal+' - '+Intl.NumberFormat().format(pembayaran.jumlah_uang)+'" ><i class="fas fa-trash"></i></button>'+
                                    '</td>'+
                                '</tr>';
                            
                        }
                        $("#pembayaranModal").find('tbody').html(Tbody);
                        $("#pembayaranModal").find("#total").text("Rp. "+Intl.NumberFormat().format(Total));
                        

                        $("#pembayaranModal").find($("input")).each(function(){
                            $(this).val($(this).attr('value'));
                            if($(this).attr('type') == "submit"){   
                                $(this).val("Simpan");
                            }
                        });

                        $("#pembayaranModal").find($('.button-edit')).click(function(){
                            var id_pembayaran = $(this).data('id');
                            modal_pembayaran("form");
                            $.ajax({
                                url:'<?=base_url()?>penjualan/get_pembayaran_id',
                                method: 'post',
                                data: {id: id_pembayaran},
                                dataType: 'json',
                                success: function(response){
                                    const input = $("#pembayaranModal").find($("input"));
                                    input[0].value = response.id_pembayaran_penjualan;
                                    input[1].value = response.tanggal;
                                    input[2].value = response.jumlah_uang;
                                }
                            });
                        });

                        $("#pembayaranModal").find($('.button-remove')).click(function(){
                            var id_pembayaran = $(this).data('id');
                            console.log(id_pembayaran);
                            modal_pembayaran("delete");
                            $("#pembayaranModal").find($('#delete')).find($('span')).text($(this).data('text'));
                            $("#pembayaranModal").find($('#delete')).find($('.btn-secondary')).click(function(){
                                modal_pembayaran("show");
                            });
                            $("#pembayaranModal").find($('#delete')).find($('.btn-danger')).click(function(){
                                $.ajax({
                                    url:'<?=base_url()?>penjualan/delete_pembayaran',
                                    method: 'post',
                                    data: {id: id_pembayaran},
                                    dataType: 'json',
                                    success: function(response){
                                        modal_pembayaran("show");
                                        render_data($("#pembayaranModal").data('idpenjualan'))
                                    }
                                });
                            });
                        });

                        $('.open-PembayaranModal').each(function(){
                            if($(this).data('id')==id_penjualan){
                                $(this).parent().find('span').text("Rp. "+Intl.NumberFormat().format(response.dibayar));
                                if(response.dibayar < response.jumlah){
                                    $(this).parent().find('span').addClass('font-weight-bold text-danger');
                                }else{
                                    $(this).parent().find('span').removeClass('font-weight-bold text-danger');
                                }
                            }
                        });
                    }
                    
                }
            }); 

            
        }


    </script>
    <script src="<?=base_url('assets/tanggal-indo.js')?>"></script>

</body>

</html>
