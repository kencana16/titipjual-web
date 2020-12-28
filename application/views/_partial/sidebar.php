<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
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
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarang"
            aria-expanded="true" aria-controls="collapseBarang">
            <i class="fa fa-gift"></i>
            <span>Barang</span>
        </a>
        <div id="collapseBarang" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tabel Barang</h6>
                <a class="collapse-item" href="<?= site_url('barang/tambah_barang') ?>">Tambah barang</a>
                <a class="collapse-item" href="<?= site_url('barang/daftar_barang') ?>">Lihat daftar barang</a>
            </div>
        </div>
    </li>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePenjual"
            aria-expanded="true" aria-controls="collapsePenjual">
            <i class="fa fa-users"></i>
            <span>Penjual</span>
        </a>
        <div id="collapsePenjual" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tabel Penjual</h6>
                <a class="collapse-item" href="<?= site_url('penjual/tambah_penjual') ?>">Tambah penjual</a>
                <a class="collapse-item" href="<?= site_url('penjual/daftar_penjual') ?>">Lihat daftar penjual</a>
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
    <li class="nav-item">
        <a class="nav-link" href="<?=site_url('pengeluaran')?>" >
            <i class="fas fa-donate"></i>
            <span>Pengeluaran</span>
        </a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="#" >
            <i class="fas fa-dolly"></i>
            <span>Produksi</span>
        </a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="#" >
            <i class="fa fa-store"></i>
            <span>Penjualan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

