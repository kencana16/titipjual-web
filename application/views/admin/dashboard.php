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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Penjualan hari ini -->
                        <div class="col-xl-3 col-6 mb-4 responsive-sidebar">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Terjual hari ini
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 "><?="Rp. ".number_format($incomeThisDay)?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Penjualan bulan ini -->
                        <div class="col-xl-3 col-6 mb-4 responsive-sidebar">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Penjualan bulan ini
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 "><?="Rp. ".number_format($incomeThisMonth)?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profit bulan ini -->
                        <div class="col-xl-3 col-6 mb-4 responsive-sidebar">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Keuntungan bulan ini
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 "><?="Rp. ".number_format($profitThisMonth)?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pesanan yang harus dibuat -->
                        <div class="col-xl-3 col-6 mb-4 responsive-sidebar">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pesanan yang harus dibuat
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 "><?=$order?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Penjualan 7 hari terakhir</h6>
                                    <!-- <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="chartMingguan" data-json="<?=site_url('dashboard/chart_data')?>"></canvas>
                                    </div>
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
    <script src="<?= base_url('assets/chart.js/Chart.min.js')?>"></script>

    <!-- Chart.js custom scripts -->
    <script src="<?= base_url('assets/chart-data/cart-pendapatan-mingguan.js')?>"></script>
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