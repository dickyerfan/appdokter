<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="row">
                        <div class="col-9">
                            <h5 class="fw-bold text-uppercase mt-2 text-primary" style="text-shadow:1px 1px 2px black;">
                                <?php
                                date_default_timezone_set('Asia/Jakarta');
                                $bulan = date('m');
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
                                $tanggal = date('d') . ' ' . $bulanList[$bulan] . ' ' . date('Y');
                                $hari = date('D');
                                $hari = date('D', strtotime($hari));
                                $dayList = array(
                                    'Sun' => 'Ahad',
                                    'Mon' => 'Senin',
                                    'Tue' => 'Selasa',
                                    'Wed' => 'Rabu',
                                    'Thu' => 'Kamis',
                                    'Fri' => 'Jum\'at',
                                    'Sat' => 'Sabtu'
                                );
                                echo $dayList[$hari]  . '  ' . $tanggal
                                ?>
                            </h5>
                        </div>
                        <div class="col-3">
                            <!-- <a href="<?= base_url('dashboard/ekspor') ?>" target="_blank" class="btn btn-success btn-sm float-end"><i class="fas fa-file-alt"></i> Export PDF</a> -->
                            <!-- <a id="belum"><button class="btn btn-warning btn-sm float-end"><i class="fas fa-calendar-alt"></i> Pilih Tanggal</button></a> -->
                            <h2 class="btn btn-primary text-light float-end" id="jam" style="text-shadow:1px 1px 2px black;"></h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                        <h6>Selamat Datang... <?= $this->session->userdata('fullname') ?>, <span class="text-danger">Anda Login Sebagai <?= $this->session->userdata('level') ?></span></h6>
                    </marquee> -->

                    <div class="row">
                        <div class="col-lg-3 col-xxl-3 mb-4">
                            <h3 class="text-uppercase mb-3 text-center judulPraktek">Daftar Jam Praktek</h3>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6"><button class="btn btn-outline-primary btn-sm float-end mb-1" data-bs-toggle="modal" data-bs-target="#inputJam" style="font-size: 0.7rem;">Input Jam</button></div>
                            </div>
                            <div class="table-responsive" style="font-size: 0.7rem;">
                                <table id="example2" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-secondary border-dark">
                                            <th class=" text-center">No</th>
                                            <th class=" text-center">Action</th>
                                            <th class=" text-center">Jam Praktek</th>
                                            <th class=" text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($jam as $row) :
                                        ?>
                                            <tr>
                                                <td class="text-center fw-bold"><?= $no++ ?></td>
                                                <td class="text-center">
                                                    <a data-bs-toggle="modal" data-bs-target="#editJam<?= $row->id_jam; ?>"><i class="fas fa-fw fa-edit text-primary" data-toggle="tooltip" title="Edit Jam Praktek"></i></a>
                                                </td>
                                                <td class="text-center fw-bold"><?= $row->jam ?></td>
                                                <td class="text-center fw-bold"><?= $row->ket_jam ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-9 col-xxl-9 mb-4">
                            <h3 class="text-uppercase mb-3 text-center judulPraktek">Daftar Pasien Hari ini</h3>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6"><a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary btn-sm float-end mb-1" style="font-size: 0.7rem;">Resfresh</a></div>
                            </div>
                            <div class="table-responsive" style="font-size: 0.7rem;">
                                <table id="example2" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-secondary border-dark">
                                            <th class=" text-center">No</th>
                                            <th class=" text-center">Jam Periksa</th>
                                            <th class=" text-center">Nama Pasien</th>
                                            <th class=" text-center">Alamat</th>
                                            <th class=" text-center">Status</th>
                                            <th class=" text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($pasien as $row) :
                                            $status = $row->status_pasien;
                                            $statusPasien = [
                                                '0' => 'Belum hadir',
                                                '1' => 'Hadir',
                                                '2' => 'Proses',
                                                '3' => 'Selesai',
                                                '4' => 'Batal'
                                            ];
                                        ?>
                                            <tr>
                                                <td class="fw-bold text-center"><?= $no++ ?></td>
                                                <td class="fw-bold text-center"><?= $row->jam ?></td>
                                                <td class="fw-bold"><?= $row->nama_pasien ?></td>
                                                <td class="fw-bold"><?= $row->alamat_pasien ?></td>
                                                <td class="fw-bold text-center" style="<?= $row->status_pasien == 3 ? 'color:red;background-color:lightgrey;' : '' ?>"><?= $statusPasien[$status]; ?></td>
                                                <td class="text-center">
                                                    <a data-bs-toggle=<?= ($row->status_pasien == 2 or $row->status_pasien == 3) ? ' ' : 'modal' ?> data-bs-target="#editStatus<?= $row->id_jadwal; ?>" class="text-primary"><i class="fas fa-fw fa-check-circle" data-bs-toggle="tooltip" title="Update Status Pasien"></i></a>
                                                    <!-- <a href="<?= base_url(); ?>dashboard/edit/<?= $row->id_jadwal; ?>" class="text-success"><i class="fas fa-fw fa-clipboard" data-bs-toggle="tooltip" title="Proses Periksa"></i></a>
                                                    <a href="<?= base_url(); ?>dashboard/edit/<?= $row->id_jadwal; ?>" class="text-danger"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Selesai"></i></a> -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Input Jam -->
                    <div class="modal fade" id="inputJam" tabindex="-1" aria-labelledby="exampleInputJam" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-uppercase" id="exampleInputJam">Input Jam Praktek</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('dashboard/inputJam') ?>" method="POST">
                                        <div class="mb-2">
                                            <label for="jam" class="form-label">Jam Praktek</label>
                                            <input type="text" class="form-control" name="jam" id="jam">
                                        </div>
                                        <div class="mb-2">
                                            <label for="ket_jam" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" name="ket_jam" id="ket_jam">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="inputJam">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Input Jam -->

                    <!-- Modal Edit Jam -->
                    <?php $no = 0;
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
                    <?php endforeach; ?>
                    <!-- Modal Edit Jam -->

                    <!-- Modal Edit Kehadiran -->
                    <?php $no = 0;
                    foreach ($pasien as $row) : ?>
                        <div class="row">
                            <div id="editStatus<?= $row->id_jadwal; ?>" class="modal fade" tabindex="-1" aria-labelledby="exampleEditStatus" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?= base_url('dashboard/editStatus'); ?>" id="editStatus" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title text-uppercase" id="exampleEditStatus">Update Status Pasien</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" readonly value="<?= $row->id_jadwal; ?>" name="id_jadwal" id="id_jadwal" class="form-control">
                                                <div class="mb-2">
                                                    <label class="form-label">Status Pasien</label>
                                                    <!-- <input type="text" name="jam" autocomplete="off" value="<?= $row->status_pasien; ?>" placeholder="Masukkan Jam Praktek" class="form-control"> -->
                                                    <select name="status_pasien" id="status_pasien" class="form-control select2">
                                                        <option value="0" <?= $row->status_pasien == '0' ? 'selected' : '' ?>>Belum Hadir</option>
                                                        <option value="1" <?= $row->status_pasien == '1' ? 'selected' : '' ?>>Hadir</option>
                                                        <option value="2" <?= $row->status_pasien == '2' ? 'selected' : '' ?>>Proses</option>
                                                        <option value="4" <?= $row->status_pasien == '4' ? 'selected' : '' ?>>Batal</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="editHadir">Update</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Modal Edit Kehadiran -->
                </div>
            </div>
        </div>
    </main>