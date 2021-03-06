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
                            <?php echo isset($barang) ? 'Edit Produk':'Tambah Produk' ?>
                        </h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header">
                                    <a class="btn btn-sm text-primary" href="<?php echo site_url('barang/daftar_barang') ?>"><i class="fas fa-arrow-left mr-1"></i> Kembali<span class="hide-mobile"> ke daftar produk</span></a>
                                </div>
                                <div class="card-body">
                                   <div class="col py-2">
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success" role="alert">
                                                <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <form action="<?= current_url() ?>" method="post" onsubmit="reverseFormatting()">
                                            <input type="hidden" name="idBarang" 
                                             <?php echo isset($barang) ? 'value="'.$barang->id_barang.'"':'' ?>>

                                            <div class="form-group row">
                                                <label for="namaBarang" class="col-lg-2 col-form-label">Nama Produk</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control <?php echo form_error('namaBarang') ? 'is-invalid':'' ?>"
                                                     id="namaBarang"  name="namaBarang"  placeholder=""
                                                     value="<?=(isset($barang))? $barang->nama_barang : set_value('namaBarang') ?>" >
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('namaBarang') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="satuan" class="col-lg-2 col-form-label">Satuan</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control <?php echo form_error('satuan') ? 'is-invalid':'' ?>"
                                                     id="satuan"  name="satuan"  placeholder=""
                                                     value="<?=(isset($barang))? $barang->satuan : set_value('satuan') ?>" >
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('satuan') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hargaNormal" class="col-lg-2 col-form-label">Harga Normal</label>
                                                <div class="input-group col-lg-10">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Rp.</div>
                                                    </div>
                                                    <input type="text" class="form-control  <?php echo form_error('hargaNormal') ? 'is-invalid':'' ?>
                                                     price" id="hargaNormal" name="hargaNormal"  placeholder=""
                                                     value="<?=(isset($barang))? number_format($barang->harga_satuan_normal): set_value('hargaNormal') ?>" >
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('hargaNormal') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hargaReseller" class="col-lg-2 col-form-label">Harga Reseller</label>
                                                <div class="input-group col-lg-10">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Rp.</div>
                                                    </div>
                                                    <input type="text" class="form-control <?php echo form_error('hargaReseller') ? 'is-invalid':'' ?> 
                                                     price" id="hargaReseller" name="hargaReseller"  placeholder=""
                                                     value="<?=(isset($barang))? number_format($barang->harga_satuan_reseller): set_value('hargaReseller') ?>" >
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('hargaReseller') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Simpan</button>

                                        </form>

                                        <div class="text-right small <?=(!isset($barang))? ' d-none': '' ?>">
                                            <div class="row">
                                                <div class="col">Dibuat :</div>
                                                <div class="col-auto"><?=$barang->date_created?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">Terakhir diperbarui :</div>
                                                <div class="col-auto"><?=$barang->date_modified?></div>
                                            </div>
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

    <script>
        const prices = document.querySelectorAll('.price');
        for(const price of prices){
            price.addEventListener('focus', (event) => {
                var x = event.target.value;
                var group = new Intl.NumberFormat().format(1111).replace(/1/g, '');
                var decimal = new Intl.NumberFormat().format(1.1).replace(/1/g, '');
                var reversedVal = x.replace(new RegExp('\\' + group, 'g'), '');
                reversedVal = reversedVal.replace(new RegExp('\\' + decimal, 'g'), '.');
                event.target.value = Number.isNaN(reversedVal)?0:reversedVal;
                event.target.type = 'number'
            });

            price.addEventListener('blur', (event) => {
                event.target.type = 'text'
                var x = event.target.value;
                event.target.value = Intl.NumberFormat().format(x);
            });
        }

        function reverseFormatting(){
            const prices = document.querySelectorAll('.price');
            for(const price of prices){
                var x = price.value;
                var group = new Intl.NumberFormat().format(1111).replace(/1/g, '');
                var decimal = new Intl.NumberFormat().format(1.1).replace(/1/g, '');
                var reversedVal = x.replace(new RegExp('\\' + group, 'g'), '');
                reversedVal = reversedVal.replace(new RegExp('\\' + decimal, 'g'), '.');
                price.value = Number.isNaN(reversedVal)?0:reversedVal;
                price.type = 'number'
            }
        }


    </script>

</body>

</html>