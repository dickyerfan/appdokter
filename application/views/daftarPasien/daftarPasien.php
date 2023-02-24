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
                            <a href="<?= base_url('daftarPasien/inputPasien'); ?>"><button class="btn btn-warning btn-sm float-end"><i class="fas fa-plus"></i> Input Pasien Baru</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 mb-4">
                            <div class="table-responsive" style="font-size: 0.7rem;">
                                <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-secondary border-dark">
                                            <th class=" text-center">No</th>
                                            <th class=" text-center">Nama Pasien</th>
                                            <th class=" text-center">Alamat Pasien</th>
                                            <th class=" text-center">Telepon</th>
                                            <th class=" text-center">Jenis Kel</th>
                                            <th class=" text-center">No KTP</th>
                                            <th class=" text-center">Umur</th>
                                            <th class=" text-center">BPJS</th>
                                            <th class=" text-center">Keterangan</th>
                                            <th class=" text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($allPasien as $row) :
                                            $tglLahir = new DateTime($row->tgl_lahir);
                                            $today = new DateTime('today');
                                            $umur = $today->diff($tglLahir)->y;
                                        ?>
                                            <tr>
                                                <td class=" text-center"><?= $no++ ?></td>
                                                <td class=""><?= $row->nama_pasien ?></td>
                                                <td class=""><?= $row->alamat_pasien ?></td>
                                                <td class=""><?= $row->telepon_pasien ?></td>
                                                <td class=""><?= $row->jenkel_pasien ?></td>
                                                <td class=""><?= $row->no_ktp ?></td>
                                                <td class="text-center"><?= $umur ?> Tahun</td>
                                                <td class=""><?= $row->bpjs != null ? $row->bpjs : 'Umum' ?></td>
                                                <td class=""><?= $row->keterangan ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url(); ?>daftarPasien/edit/<?= $row->id_pasien; ?>"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data"></i></a>
                                                    <!-- <a href="<?= ($this->session->userdata('level') == 'SuperAdmin') ? base_url('daftarPasien/hapus/') : 'javascript:void(0)' ?><?= $row->id_pasien; ?>" class="sweet text-danger" data-bs-toggle="tooltip" title="Hapus data"><i class="fas fa-fw fa-trash"></i></a> -->
                                                    <a href="<?= base_url('daftarPasien/hapus/') ?><?= $row->id_pasien; ?>" class="sweet text-danger" data-bs-toggle="tooltip" title="Hapus data"><i class="fas fa-fw fa-trash"></i></a>
                                                    <a href="<?= base_url(); ?>daftarPasien/detail/<?= $row->id_pasien; ?>" class="text-success" data-bs-toggle="tooltip" title="Detail data"><i class="fa-solid fa-circle-info"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Input Pasien -->
                    <!-- <div class="modal fade" id="inputPasien" tabindex="-1" aria-labelledby="exampleInputPasien" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-uppercase" id="exampleInputPasien">Input Pasien Baru</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('daftarPasien/inputPasien') ?>" method="POST">
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" placeholder="Masukan Nama Pasien">
                                        </div>
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="alamat_pasien" id="alamat_pasien" placeholder="Masukan Alamat Pasien">
                                        </div>
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="telepon_pasien" id="telepon_pasien" placeholder="Masukan Telepon Pasien">
                                        </div>
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="jenkel_pasien" id="jenkel_pasien" placeholder="Masukan Jenis Kelamin Pasien">
                                        </div>
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukan No KTP">
                                        </div>
                                        <div class="mb-2">
                                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Masukan Tanggal Lahir">
                                        </div>
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="bpjs" id="bpjs" placeholder="Masukan No BPJS">
                                        </div>
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukan Keterangan">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="inputJam">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Modal Input Pasien -->

                    <!-- Modal Edit Jam -->
                    <!-- <?php $no = 0;
                            foreach ($allPasien as $row) : $no++; ?>
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
                                    <input type="hidden" readonly value="<?= $row->id_jam; ?>" name="id_jam" class="form-control" >
                                    <div class="mb-2">
                                        <label class="form-label">Jam Praktek</label>
                                        <input type="text" name="jam" autocomplete="off" value="<?= $row->jam; ?>"  placeholder="Masukkan Jam Praktek" class="form-control" >
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Jam Praktek</label>
                                        <input type="text" name="ket_jam" autocomplete="off" value="<?= $row->ket_jam; ?>"  placeholder="Masukkan Keterangan" class="form-control" >
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