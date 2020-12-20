<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('_partial/meta') ?>

    <style>
        .bg-login-image{
            background:url(<?= site_url()."assets/images/cover.png"?>);
            background-position:center;
            background-size:contain;
            background-repeat: no-repeat;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h5 text-gray-800 mb-4">SISTEM PENCATATAN KEUANGAN UMKM ‘HALAL BERKAH’</h1>
                                        <h1 class="h3 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <!-- <label for="email">E-mail</label> -->
                                            <input type="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Masukkan Email">
                                        </div>
                                        <div class="form-group">
                                            <!-- <label for="password">Kata Sandi</label> -->
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Kata Sandi">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ingat saya</label>
                                            </div>
                                        </div>
                                        <a href="<?= base_url().'dashboard'?>" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Lupa Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php $this->load->view('_partial/jsScript') ?>

</body>

</html>