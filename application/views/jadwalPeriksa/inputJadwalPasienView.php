<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header card-outline card-primary shadow">
                    <a class="fw-bold text-dark" style="text-decoration:none ;"><?= strtoupper($title) ?></a>
                    <a href="<?= base_url('jadwalPeriksa'); ?>"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="<?= base_url('jadwalPeriksa/inputJadwalPasien') ?>" method="POST">
                                <div class="mb-2">
                                    <label for="id_pasien" class="form-label">Nama Pasien</label>
                                    <select name="id_pasien" id="id_pasien" class="form-select select2">
                                        <option value="">Pilih Pasien</option>
                                        <?php
                                        $pasien = $this->db->get('data_pasien')->result();
                                        foreach ($pasien as $row) : ?>
                                            <option value="<?= $row->id_pasien ?>"><?= $row->nama_pasien ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('id_pasien'); ?></small>
                                    <label for="id_jam" class="form-label">Jam Praktek</label>
                                    <select name="id_jam" id="id_jam" class="form-select select2">
                                        <option value="">Pilih Jam</option>
                                        <?php
                                        $jam = $this->db->get_where('jam_periksa', ['ket_jam' => 'Praktek'])->result();
                                        foreach ($jam as $row) : ?>
                                            <option value="<?= $row->id_jam ?>"><?= $row->jam ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('id_jam'); ?></small>
                                    <!-- <label for="id_tanggal" class="form-label">Tanggal Praktek</label>
                                    <select name="id_tanggal" id="id_tanggal" class="form-select select2">
                                        <option value="">Pilih Tanggal</option>
                                        <?php
                                        $id_tanggal = $this->uri->segment(3);
                                        $tanggal = $this->db->get('tanggal_pasien')->result();
                                        foreach ($tanggal as $row) : ?>
                                            <option value="<?= $row->id_tanggal ?>" <?= $row->id_tanggal == $id_tanggal ? 'selected' : '' ?>><?= $row->tanggal ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger pl-3"><?= form_error('id_tanggal'); ?></small> -->
                                    <input type="hidden" class="form-control" id="id_tanggal" name="id_tanggal" value="<?= $this->uri->segment(3) ?>">
                                    <small class="form-text text-danger pl-3"><?= form_error('id_tanggal'); ?></small>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" name="inputJam">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>