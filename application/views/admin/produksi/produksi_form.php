<!DOCTYPE html>
<html lang="en">

<head>

   <?php $this->load->view('_partial/meta') ?>

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
                        <h1 class="h3 mb-0 text-gray-800">
                            <?php echo isset($barang) ? 'Edit Produksi':'Input Produksi' ?>
                        </h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?php echo site_url('produksi') ?>"><i class="fas fa-arrow-left mr-1"></i> Kembali<span class="hide-mobile"> ke data produksi</span></a>
                                </div>
                                <div class="card-body">
                                   <div class="col py-2">
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success" role="alert">
                                                <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <form action="<?= current_url() ?>" method="post">
                                            <input type="hidden" name="idProduksi" 
                                             <?php echo isset($produksi) ? 'value="'.$produksi->id_produksi.'"':'' ?>>

                                            <div class="form-group row">
                                                <label for="tgl" class="col-lg-2 col-form-label">Tanggal Produksi</label>
                                                <div class="col-lg-10">
                                                    <input type="date" class="form-control <?php echo form_error('tgl') ? 'is-invalid':'' ?> <?php echo isset($produksi) ? ' ':' date-now' ?>"
                                                     id="tgl"  name="tgl"  placeholder="" min="<?=Date("Y-m-d")?>"
                                                     <?php echo isset($produksi) ? 'value="'.$produksi->tgl_produksi.'"': "" ?>>
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('tgl') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nama-barang" class="col-lg-2 col-form-label">Nama Barang</label>
                                                <div class="input-group col-lg-10">
                                                    <select class="form-control  <?php echo form_error('idBarang') ? 'is-invalid':'' ?>"
                                                     name="idBarang" id="nama-barang">
                                                        <option value="" <?= isset($produksi) ? " ":" selected"?>>--Pilih Barang--</option>
                                                        <?php foreach($barangs as $barang): ?>
                                                            <option value="<?=$barang->id_barang?>" <?php if(isset($produksi)){if($produksi->id_barang == $barang->id_barang){echo "selected";}}?>><?=$barang->nama_barang?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('idBarang') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jml" class="col-lg-2 col-form-label">Jumlah Produksi</label>
                                                <div class="input-group col-lg-10">
                                                    <input type="number" class="form-control <?php echo form_error('jml') ? 'is-invalid':'' ?> 
                                                     price" id="jml" name="jml"  placeholder=""
                                                     <?php echo isset($produksi) ? 'value="'.$produksi->jml_produksi.'"':'' ?>>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                        <span class="d-md-inline d-none">Kilogram</span>
                                                        <span class="d-md-none d-inline">KG</span>
                                                        </div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('jml') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="estModal" class="col-lg-2 col-form-label">Estimasi Modal /KG</label>
                                                <div class="input-group col-lg-10">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Rp.</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="estModal" name="estModal"  placeholder="" disabled>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Simpan</button>

                                        </form>
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

    <script>

        $(document).ready( function () {
            var classDateNow = document.querySelector('.date-now');
            if(classDateNow !== null){
                document.querySelector('.date-now').valueAsDate = new Date();
            }
            

            countEstModal()
            $('#nama-barang').change(function(){
                countEstModal();
            });
            $('#jml').keyup(function(){
                countEstModal();
            });

            function countEstModal(){
                var idBarang = $('#nama-barang').val();
                var jmlProduksi = Number.isInteger( $('#jml').val() ) ? 0 : $('#jml').val();
                $.ajax({
                    url:'<?=base_url()?>barang/get_barang_json',
                    method: 'post',
                    data: {id_barang: idBarang},
                    dataType: 'json',
                    success: function(response){
                        var len = response.length;
                        if(len > 0){
                            // Read values
                            var est_modal_per_kg = response[0].estimasi_modal_per_kg;
                            $('#estModal').val(Intl.NumberFormat().format(est_modal_per_kg * jmlProduksi));
                        }else{
                            $('#estModal').val("0");
                        }
                    
                    }
                });
            }
            
        } );

    </script>

</body>

</html>