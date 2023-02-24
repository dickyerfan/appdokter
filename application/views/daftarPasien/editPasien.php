<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('daftarPasien'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url('daftarPasien/update') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="id_pasien" value="<?= $editPasien->id_pasien ?>">
                                    <label for="nama_pasien">Nama Pasien :</label>
                                    <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" placeholder="Masukkan Nama Pasien" value="<?= $editPasien->nama_pasien; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('nama_pasien'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_pasien">Alamat Pasien :</label>
                                    <input type="text" class="form-control" id="alamat_pasien" name="alamat_pasien" placeholder="Masukkan Alamat Pasien" value="<?= $editPasien->alamat_pasien; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('alamat_pasien'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="telepon_pasien">Telepon Pasien :</label>
                                    <input type="text" class="form-control" id="telepon_pasien" name="telepon_pasien" placeholder="Masukkan Telepon Pasien" value="<?= $editPasien->telepon_pasien; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('telepon_pasien'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="jenkel_pasien">Jenis Kelamin Pasien :</label>
                                    <!-- <input type="text" class="form-control" id="jenkel_pasien" name="jenkel_pasien" placeholder="Masukkan Jenis Kelamin Pasien" value="<?= $editPasien->jenkel_pasien; ?>"> -->
                                    <select name="jenkel_pasien" id="jenkel_pasien" class="form-control select2">
                                        <option value=""> Pilih Jenis Kelamin </option>
                                        <option value="Laki-laki" <?= $editPasien->jenkel_pasien == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= $editPasien->jenkel_pasien == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('jenkel_pasien'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_ktp">No KTP :</label>
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="Masukkan No KTP" value="<?= $editPasien->no_ktp; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('no_ktp'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir :</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" value="<?= $editPasien->tgl_lahir; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('tgl_lahir'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="bpjs">BPJS :</label>
                                    <input type="text" class="form-control" id="bpjs" name="bpjs" placeholder="Masukkan No BPJS" value="<?= $editPasien->bpjs; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('bpjs'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan :</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" value="<?= $editPasien->keterangan; ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('keterangan'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-save"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>