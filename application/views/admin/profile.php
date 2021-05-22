<!DOCTYPE html>
<html lang="en">

<head>

   <?php $this->load->view('_partial/meta') ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php if($this->session->userdata('role') == 1){
            $this->load->view('_partial/sidebarku');
            }else{
                $this->load->view('_partial/sidebar'); 
            } 
        ?>
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
                            Update Profile
                        </h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- card -->
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header">
                                    Update Profile
                                </div>
                                <div class="card-body">
                                   <div class="col py-2">

                                        <!-- <div class="col-12 d-flex justify-content-between">

                                            <h2>Profile</h2>

                                            <div><button id="btn-edit" type="button" class="btn btn-sm btn-primary my-2"><i class="fas fa-edit mr-1"></i>Edit</button></div>

                                        </div> -->

                                        <?php if ($this->session->flashdata('success')): ?>

                                            <div class="alert alert-success" role="alert">

                                                <?php echo $this->session->flashdata('success'); ?>

                                            </div>

                                        <?php endif; ?>

                                        <?php if ($this->session->flashdata('error')): ?>

                                            <div class="alert alert-danger" role="alert">

                                                <?php echo $this->session->flashdata('error'); ?>

                                            </div>

                                        <?php endif; ?>

                                        <form action="<?=current_url()?>" method="post" enctype="multipart/form-data" class="mt-1">

                                                            

                                            <input type="hidden" name="id" value="<?= $this->session->userdata('id_user') ?>" />

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="img-container border border-2 rounded-circle">
                                                        <img class="rounded-circle" src="<?= base_url('assets/images/'.$this->session->userdata('photo')) ?>" alt="">
                                                    </div>

                                                    <div class="text-center">
                                                        <a class="btn btn-outline-danger my-2" href="" data-toggle="modal" data-target="#changePassword" >Ubah Password</a>
                                                    </div>
                                                </div>

                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Foto Profile</label>
                                                        <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1"
                                                        accept="image/gif, image/jpg, image/png">
                                                        <input type="hidden" name="gambar_lama" value="<?=$this->session->userdata('photo')?>"/>
                                                        <small>*) .gif .png .jpg</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">No Telepon</label>
                                                        <input id="email" class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>"
                                                        type="number" name="email" value="<?=$this->session->userdata('no_hp')?>"/>
                                                        <div class="invalid-feedback">
                                                            <?php echo form_error('email') ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                            <label for="username">Username</label>
                                                            <input id="username" class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>"
                                                            type="text" name="username" value="<?=$this->session->userdata('username')?>"/>
                                                            <div class="invalid-feedback">
                                                                <?php echo form_error('username') ?>
                                                            </div>
                                                    </div>

                                                    <input class="btn btn-primary" type="submit" name="btn" value="Update Profile" id="submit"/>
                                                </div>
                                            </div>

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
    <!-- Logout Modal-->
    <!-- Change Password Model -->
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?=site_url('profile/change_password')?>" method="post">
                        <input type="hidden" name="idUser" value="<?= $this->session->userdata('id_user') ?>">
                        <div class="form-group">
                            <label for="oldPwd">Password lama</label>
                            <input class="form-control pwd <?php echo form_error('oldPwd') ? 'is-invalid':'' ?>"
                                type="password" name="oldPwd" />
                            <div class="invalid-feedback">
                                <?php echo form_error('oldPwd') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="newPwd">Password baru</label>
                            <input class="form-control pwd <?php echo form_error('newPwd') ? 'is-invalid':'' ?>"
                                type="password" name="newPwd" />
                            <div class="invalid-feedback">
                                <?php echo form_error('newPwd') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="newPwdConf">Konfirmasi password baru</label>
                            <input class="form-control pwd <?php echo form_error('newPwdConf') ? 'is-invalid':'' ?>"
                                type="password" name="newPwdConf" />
                            <div class="invalid-feedback">
                                <?php echo form_error('newPwdConf') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="passwordHide">
                                <label class="custom-control-label" for="passwordHide" onclick="showHide()">Tampilkan Password</label>
                            </div>
                        </div>

                        <input class="btn btn-primary" type="submit" value="Simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Change Password Model -->

    <!-- Javascript Import -->
    <?php $this->load->view('_partial/jsScript') ?>
    <script>
        $(document).ready(function(){
            if($('#changePassword').find('.is-invalid').length >= 1){
                $('#changePassword').modal('show');
            }

            
        });
        function showHide() {
            var pwds = document.querySelectorAll('.pwd');
            for(const pwd of pwds){
                if (pwd.type === "password") {
                    pwd.type = "text";
                } else {
                    pwd.type = "password";
                }
            }
        }
    </script>

    

</body>

</html>