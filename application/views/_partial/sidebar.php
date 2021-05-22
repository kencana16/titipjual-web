<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=site_url()?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="<?=base_url('assets/images/logo-fill.png')?>" alt="logo" width="35em">
        </div>
        <div class="sidebar-brand-text mx-3">PAO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?=($this->uri->segment(1) == "dashboard")? "active" : ""?>">
        <a class="nav-link" href="<?=site_url('dashboard')?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

    <!-- Nav Itemu -->
    <li class="nav-item <?=($this->uri->segment(1) == "barang")? "active" : ""?>" href="<?= site_url('barang/daftar_barang') ?>"">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarang"
            aria-expanded="true" aria-controls="collapseBarang">
            <i class="fa fa-gift"></i>
            <span>Produk</span>
        </a>
        <div id="collapseBarang" class="collapse <?=($this->uri->segment(1) == "barang")? "show" : ""?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tabel Barang</h6>
                <a class="collapse-item  <?=($this->uri->segment(2) == "tambah_barang")? "active" : ""?>" href="<?= site_url('barang/tambah_barang') ?>">Tambah produk</a>
                <a class="collapse-item  <?=($this->uri->segment(2) == "daftar_barang")? "active" : ""?>" href="<?= site_url('barang/daftar_barang') ?>">Lihat daftar produk</a>
            </div>
        </div>
    </li>

    <!-- Nav Item -->
    <li class="nav-item  <?=($this->uri->segment(1) == "penjual")? "active" : ""?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePenjual"
            aria-expanded="true" aria-controls="collapsePenjual">
            <i class="fa fa-users"></i>
            <span>Penjual</span>
        </a>
        <div id="collapsePenjual" class="collapse <?=($this->uri->segment(1) == "penjual")? "show" : ""?>" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tabel Penjual</h6>
                <a class="collapse-item <?=($this->uri->segment(2) == "tambah_penjual")? "active" : ""?>" href="<?= site_url('penjual/tambah_penjual') ?>">Tambah penjual</a>
                <a class="collapse-item <?=($this->uri->segment(2) == "daftar_penjual")? "active" : ""?>" href="<?= site_url('penjual/daftar_penjual') ?>">Lihat daftar penjual</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item -->
    <li class="nav-item   <?=($this->uri->segment(1) == "pengeluaran")? "active" : ""?>">
        <a class="nav-link" href="<?=site_url('pengeluaran')?>" >
            <i class="fas fa-donate"></i>
            <span>Pengeluaran</span>
        </a>
    </li>

    <!-- Nav Item -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="<?=site_url('produksi')?>" >
            <i class="fas fa-dolly"></i>
            <span>Produksi</span>
        </a>
    </li> -->

    <!-- Nav Item -->
    <li class="nav-item   <?=($this->uri->segment(1) == "penjualan")? "active" : ""?>">
        <a class="nav-link" href="<?=site_url('penjualan')?>" >
            <i class="fa fa-store"></i>
            <span>Penjualan</span>
        </a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item   <?=($this->uri->segment(1) == "pesanan")? "active" : ""?>">
        <a class="nav-link" href="<?=site_url('pesanan')?>" >
            <i class="fa fa-vote-yea"></i>
            <span>Pesanan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item -->
    <li class="nav-item   <?=($this->uri->segment(1) == "laporan")? "active" : ""?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fa fa-users"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse  <?=($this->uri->segment(1) == "laporan")? "show" : ""?>" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan GLobal : </h6>
                <a class="collapse-item <?=($this->uri->segment(2) == "global_bulanan")? "active" : ""?>" href="<?= site_url('laporan/global_bulanan') ?>">Laporan Bulanan</a>
                <a class="collapse-item <?=($this->uri->segment(2) == "global_harian")? "active" : ""?>" href="<?= site_url('laporan/global_harian') ?>">Laporan Harian</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

