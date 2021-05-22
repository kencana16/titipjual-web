<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<div class="d-none d-sm-block mr-auto my-2 my-md-0 mw-100">
    <h6 class="h5 font-weight-bold mb-0 text-primary">SISTEM INFORMASI PENJUALAN PAO</h1>
</div>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <?= $this->session->userdata('username')?>
            </span>
            <img class="img-profile rounded-circle"
                src="<?= base_url('assets/images/'.$this->session->userdata('photo')) ?>">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?=base_url('profile')?>">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <!-- <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
<!-- End of Topbar -->