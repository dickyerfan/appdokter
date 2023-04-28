<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="row">
                        <div class="col-9">
                            <div class="fw-bold text-uppercase"><?= $title ?></div>
                        </div>
                        <div class="col-3">
                            <a href="<?= base_url('daftarPasienAjax'); ?>" id="kembali"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-1">
                        <div class="col-lg-3">
                            <div class="card p-1 shadow">
                                <div class="card text-dark bg-info mb-1">
                                    <div class="card-header text-center mt-1">
                                        <h4>DATA PASIEN</h4>
                                    </div>
                                </div>
                                <div class="card text-dark bg-light mb-1">
                                    <div class="card-header">
                                        Nama : <span class="text-uppercase"></span>
                                    </div>
                                </div>
                                <div class="card text-dark bg-light mb-1">
                                    <div class="card-header">Alamat : <br></div>
                                </div>
                                <div class="card text-dark bg-light mb-1">
                                    <div class="card-header">Telepon : </div>
                                </div>
                                <div class="card text-dark bg-light mb-1">
                                    <div class="card-header">Jenis Kelamin : <br></div>
                                </div>
                                <div class="card text-dark bg-light">
                                    <div class="card-header">Umur : Tahun</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card p-1 shadow">
                                <div class="table-responsive" style="font-size: 0.7rem;">
                                    <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="bg-secondary border-dark">
                                                <th class=" text-center">No</th>
                                                <th class=" text-center">Tanggal</th>
                                                <th class=" text-center">Keluhan</th>
                                                <th class=" text-center">Tindakan 1</th>
                                                <th class=" text-center">Jumlah</th>
                                                <th class=" text-center">Tindakan 2</th>
                                                <th class=" text-center">Jumlah</th>
                                                <th class=" text-center">Tagihan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showDataDetail">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>