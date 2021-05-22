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
                            <?php echo isset($penjual) ? 'Edit penjual':'Tambah penjual' ?>
                        </h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header">
                                <a class="btn btn-sm text-primary" href="<?php echo site_url('penjual/daftar_penjual') ?>"><i class="fas fa-arrow-left mr-1"></i> Kembali<span class="hide-mobile"> ke daftar penjual</span></a>
                                </div>
                                <div class="card-body">
                                   <div class="col py-2">
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success" role="alert">
                                                <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <form action="" method="post">
                                            <input type="hidden" name="idPenjual" 
                                                <?php echo isset($penjual) ? 'value="'.$penjual->id_penjual.'"':'' ?>>

                                            <div class="form-group row">
                                                <label for="namaPenjual" class="col-lg-2 col-form-label">Nama Penjual</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control <?php echo form_error('namaPenjual') ? 'is-invalid':'' ?>"
                                                     id="namaPenjual" name="namaPenjual" 
                                                     value="<?=(isset($penjual))? $penjual->nama_penjual : set_value('namaPenjual') ?>">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('namaPenjual') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="noHP" class="col-lg-2 col-form-label">No. Telepon</label>
                                                <div class="input-group col-lg-10">
                                                    <input type="number" class="form-control <?php echo form_error('noHP') ? 'is-invalid':'' ?>" 
                                                     id="noHP" name="noHP"
                                                     value="<?=(isset($penjual))? $penjual->no_hp: set_value('noHP') ?>">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('noHP') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="alamat" class="col-lg-2 col-form-label">Alamat</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>" 
                                                     id="alamat" name="alamat" row="3"><?=(isset($penjual))? $penjual->alamat: set_value('alamat') ?></textarea>
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('alamat') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Simpan</button>

                                        </form>
                                        
                                        <div class="text-right small <?=(!isset($penjual))? ' d-none': '' ?>">
                                            <div class="row">
                                                <div class="col">Dibuat :</div>
                                                <div class="col-auto"><?=$penjual->date_created?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">Terakhir diperbarui :</div>
                                                <div class="col-auto"><?=$penjual->date_modified?></div>
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

</body>

</html>