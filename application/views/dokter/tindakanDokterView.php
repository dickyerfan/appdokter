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
                                    <div class="form-group mb-2">
                                        <label class="mb-1">Tanggal Periksa :</label>
                                        <input type="text" class="form-control kecilinFont" value="<?= $tanggalFix ?>" disabled>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="mb-1">Nama Pasien :</label>
                                        <input type="text" class="form-control kecilinFont" value="<?= $row->nama_pasien ?>" disabled>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="mb-1">Alamat Pasien :</label>
                                        <!-- <input type="textarea" class="form-control kecilinFont" value="<?= $row->alamat_pasien ?>" disabled> -->
                                        <textarea class="form-control kecilinFont" disabled><?= $row->alamat_pasien ?></textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="mb-1">Jenis Kelamin :</label>
                                        <input type="text" class="form-control kecilinFont" value="<?= $row->jenkel_pasien ?>" disabled>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="mb-1">Umur :</label>
                                        <input type="text" class="form-control kecilinFont" value="<?= $umur ?> Tahun" disabled>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="col-lg-4 mt-2">
                                <!-- <div class="form-group mb-2">
                                    <label class="mb-1">Tanggal Periksa :</label>
                                    <input type="text" class="form-control kecilinFont" value="<?= $tanggalFix ?>" disabled>
                                </div> -->
                                <div class="form-group mb-2">
                                    <?php $id_pasien = $this->uri->segment(3); ?>
                                    <input type="hidden" class="form-control" id="id_jadwal" name="id_jadwal" placeholder="Masukkan ID Pasien" value="<?= $id_pasien; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('id_jadwal'); ?></small>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="jumlah" class="mb-1">Keluhan:</label>
                                    <textarea class="form-control kecilinFont" id="keluhan" name="keluhan" placeholder="Masukkan keluhan Pasien"></textarea>
                                    <!-- <input type="text" class="form-control kecilinFont" id="keluhan" name="keluhan" placeholder="Masukkan keluhan Pasien" value="<?= set_value('keluhan'); ?>"> -->
                                    <small class="form-text text-danger pl-3"><?= form_error('keluhan'); ?></small>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="id_tindakan" class="form-label">Jenis Tindakan :</label>
                                    <select name="id_tindakan" id="id_tindakan" class="form-select select2">
                                        <option value=""></option>
                                        <?php
                                        $tindakan = $this->db->get('tindakan')->result();
                                        foreach ($tindakan as $row) : ?>
                                            <option value="<?= $row->id_tindakan ?>"><?= $row->nama_tindakan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('id_tindakan'); ?></small>
                                </div>
                                <!-- <div class="form-group mb-2">
                                    <label for="tagihan" class="form-label">Tagihan :</label>
                                    <select name="tagihan" id="tagihan" class="form-select select2">
                                        <option value=""></option>
                                        <?php
                                        $harga = $this->db->get('tindakan')->result();
                                        foreach ($harga as $row) : ?>
                                            <option value="<?= $row->harga ?>"><?= $row->harga ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('tagihan'); ?></small>
                                </div> -->
                                <div class="form-group mb-2">
                                    <label for="jumlah" class="mb-1">Jumlah Tindakan :</label>
                                    <input type="text" class="form-control kecilinFont" id="jumlah" name="jumlah" placeholder="Masukkan jumlah Tindakan" value="<?= set_value('jumlah'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('jumlah'); ?></small>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="ket_kunjungan" class="mb-1">Keterangan :</label>
                                    <input type="text" class="form-control kecilinFont" id="ket_kunjungan" name="ket_kunjungan" placeholder="Masukkan Keterangan" value="<?= set_value('ket_kunjungan'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('ket_kunjungan'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1 kecilinFont" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>