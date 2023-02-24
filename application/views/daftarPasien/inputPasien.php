<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('daftarPasien'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <form class="user" action="" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_pasien">Nama Pasien :</label>
                                    <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" placeholder="Masukkan Nama Pasien" value="<?= set_value('nama_pasien'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('nama_pasien'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_pasien">Alamat Pasien :</label>
                                    <input type="text" class="form-control" id="alamat_pasien" name="alamat_pasien" placeholder="Masukkan Alamat Pasien" value="<?= set_value('alamat_pasien'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('alamat_pasien'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="telepon_pasien">Telepon Pasien :</label>
                                    <input type="text" class="form-control" id="telepon_pasien" name="telepon_pasien" placeholder="Masukkan Telepon Pasien" value="<?= set_value('telepon_pasien'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('telepon_pasien'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="jenkel_pasien">Jenis Kelamin Pasien :</label>
                                    <!-- <input type="text" class="form-control" id="jenkel_pasien" name="jenkel_pasien" placeholder="Masukkan Jenis Kelamin Pasien" value="<?= set_value('jenkel_pasien'); ?>"> -->
                                    <select name="jenkel_pasien" id="jenkel_pasien" class="form-select select2">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('jenkel_pasien'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_ktp">No KTP :</label>
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="Masukkan No KTP" value="<?= set_value('no_ktp'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('no_ktp'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir :</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" value="<?= set_value('tgl_lahir'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('tgl_lahir'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="bpjs">BPJS :</label>
                                    <input type="text" class="form-control" id="bpjs" name="bpjs" placeholder="Masukkan No BPJS" value="<?= set_value('bpjs'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('bpjs'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan :</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" value="<?= set_value('keterangan'); ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('keterangan'); ?></small>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm float-left mt-1" name="tambah" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>