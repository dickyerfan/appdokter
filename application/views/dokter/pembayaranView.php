<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('dokter'); ?>"><button class="btn btn-primary btn-sm float-end kecilinFont"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body kecilinFont">
                    <form class="user" action="" method="POST">
                        <div class="row">
                            <?php
                            $id_jadwal = $this->uri->segment(3);
                            $this->db->select('*');
                            $this->db->from('jadwal_periksa');
                            $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
                            $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
                            $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
                            $this->db->join('kunjungan_pasien', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal', 'left');
                            $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan', 'left');
                            $this->db->where('jadwal_periksa.id_jadwal', $id_jadwal);
                            $identitas = $this->db->get()->result();
                            ?>
                            <?php foreach ($identitas as $row) :
                                $tglLahir = new DateTime($row->tgl_lahir);
                                $today = new DateTime('today');
                                $umur = $today->diff($tglLahir)->y;

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
                                <div class="col-lg-4 mt-2">
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
                                </div>
                            <?php endforeach; ?>
                            <div class="col-lg-4 mt-2">
                                <div class="card p-1 shadow">
                                    <div class="form-group mb-2">
                                        <?php $id_pasien = $this->uri->segment(3); ?>
                                        <input type="hidden" class="form-control" id="id_jadwal" name="id_jadwal" placeholder="Masukkan ID Pasien" value="<?= $id_pasien; ?>">
                                        <small class="form-text text-danger pl-3"><?= form_error('id_jadwal'); ?></small>
                                    </div>
                                    <?php
                                    $id_jadwal = $this->uri->segment(3);
                                    $this->db->select('*');
                                    $this->db->from('kunjungan_pasien');
                                    $this->db->join('tindakan', 'kunjungan_pasien.id_tindakan= tindakan.id_tindakan');
                                    $this->db->where('id_jadwal', $id_jadwal);
                                    $data = $this->db->get()->result();
                                    foreach ($data as $row) : ?>
                                        <div class="form-group">
                                            <div class="card text-dark bg-light mb-1">
                                                <div class="card-header">Keluhan : <br><?= $row->keluhan; ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="card text-dark bg-light mb-1">
                                                <div class="card-header">Tindakan : <br><?= $row->nama_tindakan; ?></div>
                                            </div>
                                        </div>
                                </div>
                                <div class="card p-1 shadow">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 text-center">
                                                <label class="mt-2 fw-bold">Tagihan :</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <h5 class="text-danger text-end">Rp. <?= number_format($row->harga, '0', ',', '.'); ?>,-</h5>
                                            </div>
                                        </div>
                                        <input type="hidden" name="tagihan" id="tagihan" value="<?= $row->harga; ?>">
                                    </div>
                                </div>
                                <div class="card p-1 shadow">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 text-center">
                                                <label for="jumlah" class="mt-2 fw-bold">Jumlah Tindakan :</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3 class="text-danger text-end pe-3"><?= $row->jumlah; ?> </h3>
                                                <input type="hidden" class="form-control kecilinFont" id="jumlah" name="jumlah" value="<?= $row->jumlah; ?>">
                                            </div>
                                            <small class="form-text text-danger pl-3"><?= form_error('jumlah'); ?></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6 class="text-center">Total Tagihan :</h6>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="text-end text-primary" id="total_tagihan">
                                                <?php
                                                $harga = $row->harga;
                                                $jumlah = $row->jumlah;
                                                $totalTagihan = $harga * $jumlah;
                                                echo 'Rp. ' . number_format($totalTagihan, '0', ',', '.') . ',-';
                                                ?>
                                            </h6>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class=" form-group">
                                    <div class="row">
                                        <div class="col-lg-6 text-center">
                                            <label for="diskon" class="mt-2 fw-bold">Potongan / Diskon :</label>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            <input type="text" class="form-control kecilinFont" id="diskon" name="diskon" placeholder="Masukkan Diskon" onchange="getDiskon()">
                                        </div>
                                        <small class="form-text text-danger pl-3"><?= form_error('diskon'); ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="text-center">Yang Harus Dibayar :</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="text-end text-primary" id="dibayar">

                                        </h6>
                                    </div>
                                </div>
                                </div>
                                <div class="card p-1 shadow">
                                    <button class="btn btn-primary btn-sm btn-block mt-1 kecilinFont" name="tambah" type="submit"><i class="fas fa-dollar"></i> Bayar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>