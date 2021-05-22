<!DOCTYPE html>
<html lang="en">

<head>

   <?php $this->load->view('_partial/meta') ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php ($this->session->userdata('role') == 0)? $this->load->view('_partial/sidebar') : $this->load->view('_partial/sidebarku')  ?>
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
                        <h1 class="h3 mb-0 text-gray-800">404 ERROR</h1>
                    </div>


                    <!-- Content Row -->
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                
                                <!-- Card Body -->
                                <div class="card-body text-center p-5">
                                    <h1 class="h2">HALAMAN TIDAK DITEMUKAN</h1>
                                    <span>kembali ke <a href="<?=base_url()?>">Dashboard</a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    

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

    <!-- Chart.js Import -->

    <!-- Chart.js custom scripts -->
    <script>
        $(document).ready(function(){

            $('#sidebarToggleTop').click(function(){
                if($('#accordionSidebar').hasClass("toggled")){
                    $('.responsive-sidebar').removeClass("col-12");
                    $('.responsive-sidebar').addClass("col-6");
                }else{
                    $('.responsive-sidebar').removeClass("col-6");
                    $('.responsive-sidebar').addClass("col-12");
                }
            });
        });
    </script>

</body>

</html>