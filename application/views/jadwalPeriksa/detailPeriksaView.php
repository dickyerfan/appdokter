<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="col-9">
                            <div class="fw-bold text-uppercase"><?= $title ?></div>
                        </div>
                        <div class="col-3">
                            <!-- <a href="<?= base_url('dashboard/ekspor') ?>" target="_blank" class="btn btn-success btn-sm float-end"><i class="fas fa-file-alt"></i> Export PDF</a> -->
                            <!-- <a id="belum"><button class="btn btn-warning btn-sm float-end"><i class="fas fa-calendar-alt"></i> Pilih Tanggal</button></a> -->
                            <a href="<?= base_url('jadwalPeriksa'); ?>" id="kembali"><button class="btn btn-primary btn-sm float-end"><i class="fas fa-reply"></i> Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 mb-2">
                            <?php $tanggal = $this->uri->segment(4);
                            $pecahkan = explode('-', $tanggal);
                            $bln = $pecahkan[1];
                            $tahun = $pecahkan[0];
                            $tgl = $pecahkan[2];
                            $tgl = intval($tgl); // merubah string ke integer
                            // $coba = gettype($tgl);  // mengetahui type data 
                            switch ($bln) {
                                case '1':
                                    $bln = "Januari";
                                    break;
                                case '2':
                                    $bln = "Februari";
                                    break;
                                case '3':
                                    $bln = "Maret";
                                    break;
                                case '4':
                                    $bln = "April";
                                    break;
                                case '5':
                                    $bln = "Mei";
                                    break;
                                case '6':
                                    $bln = "Juni";
                                    break;
                                case '7':
                                    $bln = "Juli";
                                    break;
                                case '8':
                                    $bln = "Agustus";
                                    break;
                                case '9':
                                    $bln = "September";
                                    break;
                                case '10':
                                    $bln = "Oktober";
                                    break;
                                case '11':
                                    $bln = "Nofember";
                                    break;
                                case '12':
                                    $bln = "Desember";
                                    break;
                            }
                            $tanggalFix = $tgl . ' ' . $bln . ' ' . $tahun;
                            ?>
                            <h3 class="text-uppercase text-center fw-bold judulPraktek">Daftar Pasien <?= $tanggalFix ?></h3>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <?php $id_tanggal = $this->uri->segment(3) ?>
                                    <a href="<?= base_url('jadwalPeriksa/inputJadwalPasien') ?>/<?= $id_tanggal ?>" class="btn btn-warning btn-sm float-end mb-1"><i class="fas fa-plus"></i> Tambah Jadwal Pasien</a>
                                    <!-- <button class="btn btn-warning btn-sm float-end mb-1" data-bs-toggle="modal" data-bs-target="#inputPasien"><i class="fas fa-plus"></i> Tambah Jadwal Pasien</button> -->
                                </div>
                            </div>
                            <div class="table-responsive" style="font-size: 0.7rem;">
                                <table id="example2" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-secondary border-dark">
                                            <th class=" text-center">No</th>
                                            <th class=" text-center">Jam Periksa</th>
                                            <th class=" text-center">Nama Pasien</th>
                                            <th class=" text-center">Alamat</th>
                                            <th class=" text-center">J.Kelamin</th>
                                            <th class=" text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($detailPasien as $row) :
                                        ?>
                                            <tr>
                                                <td class="fw-bold text-center"><?= $no++ ?></td>
                                                <td class="fw-bold"><?= $row->jam ?></td>
                                                <td class="fw-bold"><?= $row->nama_pasien ?></td>
                                                <td class="fw-bold"><?= $row->alamat_pasien ?></td>
                                                <td class="fw-bold"><?= $row->jenkel_pasien ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url(); ?>dashboard/edit/<?= $row->id_jam; ?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data"></i></a>
                                                    <a href="<?= ($this->session->userdata('level') == 'SuperAdmin') ? base_url('dashboard/hapus/') : 'javascript:void(0)' ?><?= $row->id_jam; ?>" class="sweet text-danger" data-bs-toggle="tooltip" title="Hapus data"><i class="fas fa-fw fa-trash"></i></a>
                                                    <a href="<?= base_url(); ?>donasi/detail/<?= $row->id_jam; ?>" class="text-success" data-bs-toggle="tooltip" title="Detail data"><i class="fa-solid fa-circle-info"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Input Pasien -->
                    <div class="modal fade" id="inputPasien" tabindex="-1" aria-labelledby="exampleInputPasien" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-uppercase" id="exampleInputPasien">Input Jadwal Pasien</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('jadwalPeriksa/inputPasien') ?>" method="POST">
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
                                            <label for="id_jam" class="form-label">Jam Praktek</label>
                                            <select name="id_jam" id="id_jam" class="form-select select2">
                                                <option value="">Pilih Jam</option>
                                                <?php
                                                $jam = $this->db->get('jam_periksa')->result();
                                                foreach ($jam as $row) : ?>
                                                    <option value="<?= $row->id_jam ?>"><?= $row->jam ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="id_tanggal" class="form-label">Tanggal Praktek</label>
                                            <select name="id_tanggal" id="id_tanggal" class="form-select select2">
                                                <option value="">Pilih Tanggal</option>
                                                <?php
                                                $tanggal = $this->db->get('tanggal_pasien')->result();
                                                foreach ($tanggal as $row) : ?>
                                                    <option value="<?= $row->id_tanggal ?>"><?= $row->tanggal ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="inputJam">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Input Pasien -->

                    <!-- Modal Edit Jam -->
                    <!-- <?php $no = 0;
                            foreach ($jam as $row) : $no++; ?>
                        <div class="row">
                            <div id="editJam<?= $row->id_jam; ?>" class="modal fade" tabindex="-1" aria-labelledby="exampleEditJam" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?= base_url('dashboard/editJam'); ?>" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title text-uppercase" id="exampleEditJam">Edit Jam Praktek</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" readonly value="<?= $row->id_jam; ?>" name="id_jam" class="form-control">
                                                <div class="mb-2">
                                                    <label class="form-label">Jam Praktek</label>
                                                    <input type="text" name="jam" autocomplete="off" value="<?= $row->jam; ?>" placeholder="Masukkan Jam Praktek" class="form-control">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Keterangan</label>
                                                    <input type="text" name="ket_jam" autocomplete="off" value="<?= $row->ket_jam; ?>" placeholder="Masukkan Keterangan" class="form-control">
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="editJam">Update</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?> -->
                    <!-- Modal Edit Jam -->
                </div>
            </div>
        </div>
    </main>