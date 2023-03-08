<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">

                <div class="nav">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-fw"></i></div>
                        <div style="font-size: 0.8rem;">Dashboard</div>
                    </a>
                    <a class="nav-link" href="<?= base_url('daftarPasien') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
                        <div style="font-size: 0.8rem;">Daftar Pasien</div>
                        <a class="nav-link" href="<?= base_url('jadwalPeriksa') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-book fa-fw"></i></div>
                            <div style="font-size: 0.8rem;">Jadwal Periksa</div>
                        </a>
                        <!-- <a class="nav-link" href="<?= base_url('histori') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
                        Log Histori
                    </a> -->
                        <!-- <a class="nav-link" href="<?= base_url('user/admin') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                        Data User
                    </a> -->
                        <a class="nav-link" href="<?= base_url('backup') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-database fa-fw"></i></div>
                            <div style="font-size: 0.8rem;">Backup</div>
                        </a>
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt fa-fw"></i></div>
                            <div style="font-size: 0.8rem;"> Logout</div>
                        </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small" style="font-size: 0.7rem;">Anda Login sebagai:</div>
                <div class="small" style="font-size: 0.7rem;"><?= $this->session->userdata('level'); ?></div>
            </div>
        </nav>
    </div>