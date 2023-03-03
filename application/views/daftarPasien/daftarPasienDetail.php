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
                            <!-- <a href="<?= base_url('dashboard/ekspor') ?>" target="_blank" class="btn btn-success btn-sm float-end"><i class="fas fa-file-alt"></i> Export PDF</a> -->
                            <!-- <button class="btn btn-warning btn-sm float-end mb-1" data-bs-toggle="modal" data-bs-target="#inputPasien"><i class="fas fa-plus"></i> Input Pasien</button> -->
                            <a href="<?= base_url('daftarPasien'); ?>" id="kembali"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-1">
                        <div class="col-lg-4">
                            <?php foreach ($pasienDetail as $row) :
                                $tglLahir = new DateTime($row->tgl_lahir);
                                $today = new DateTime('today');
                                $umur = $today->diff($tglLahir)->y;
                            ?>
                                <div class="card p-1 shadow">
                                    <div class="card text-dark bg-info mb-1">
                                        <div class="card-header text-center mt-1">
                                            <h4>DATA PASIEN</h4>
                                        </div>
                                    </div>
                                    <div class="card text-dark bg-light mb-1">
                                        <div class="card-header">
                                            Nama : <span class="text-uppercase"><?= $row->nama_pasien; ?></span>
                                        </div>
                                    </div>
                                    <div class="card text-dark bg-light mb-1">
                                        <div class="card-header">Alamat : <br><?= $row->alamat_pasien; ?></div>
                                    </div>
                                    <div class="card text-dark bg-light mb-1">
                                        <div class="card-header">Telepon : <?= $row->telepon_pasien; ?></div>
                                    </div>
                                    <div class="card text-dark bg-light mb-1">
                                        <div class="card-header">Jenis Kelamin : <?= $row->jenkel_pasien; ?><br></div>
                                    </div>
                                    <div class="card text-dark bg-light">
                                        <div class="card-header">Umur : <?= $umur; ?> Tahun</div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-lg-8">
                            <div class="card p-1 shadow">
                                <div class="table-responsive" style="font-size: 0.7rem;">
                                    <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="bg-secondary border-dark">
                                                <th class=" text-center">No</th>
                                                <th class=" text-center">Tanggal</th>
                                                <th class=" text-center">Keluhan</th>
                                                <th class=" text-center">Tindakan</th>
                                                <th class=" text-center">Jumlah</th>
                                                <th class=" text-center">Tagihan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($allPasien as $row) :
                                                $tanggal = explode('-', $row->tanggal);
                                                $day = $tanggal[2];
                                                $bulan = $tanggal[1];
                                                $bulanList = array(
                                                    '01' => 'Januari',
                                                    '02' => 'Februari',
                                                    '03' => 'Maret',
                                                    '04' => 'April',
                                                    '05' => 'Mei',
                                                    '06' => 'Juni',
                                                    '07' => 'Juli',
                                                    '08' => 'Agustus',
                                                    '09' => 'September',
                                                    '10' => 'Oktober',
                                                    '11' => 'November',
                                                    '12' => 'Desember'
                                                );
                                                $tahun = $tanggal[0];
                                                $tanggalFix = $day . ' ' . $bulanList[$bulan] . ' ' . $tahun;
                                            ?>
                                                <tr>
                                                    <td class=" text-center"><?= $no++ ?></td>
                                                    <td class="text-center"><?= $tanggalFix ?></td>
                                                    <td class=""><?= $row->keluhan ?></td>
                                                    <td class=""><?= $row->nama_tindakan ?></td>
                                                    <td class="text-center"><?= $row->jumlah ?></td>
                                                    <td class=" text-end"><?= number_format($row->tagihan, '0', ',', '.')  ?>,-</td>
                                                </tr>
                                            <?php endforeach; ?>
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