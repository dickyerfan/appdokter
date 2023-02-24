<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-1 mt-1">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="col-9">
                            <h6 class="fw-bold text-uppercase mt-2 text-primary" style="text-shadow:1px 1px 2px black;">
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
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6 class="btn btn-primary text-light float-end" id="jam" style="text-shadow:1px 1px 2px black; font-size:0.8rem;"></h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                        <h6>Selamat Datang... <?= $this->session->userdata('fullname') ?>, <span class="text-danger">Anda Login Sebagai <?= $this->session->userdata('level') ?></span></h6>
                    </marquee> -->
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="text-uppercase text-center judulPraktek">Daftar Pasien Hari ini</h3>
                                </div>
                                <div class="col-md-2"><a href="<?= base_url('dokter') ?>" class="btn btn-outline-primary btn-sm float-end mb-1" style="font-size:0.7rem;">Refresh</a></div>
                            </div>
                            <div class="table-responsive" style="font-size: 0.6rem;">
                                <table id="example2" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-secondary border-dark">
                                            <th class=" text-center">No</th>
                                            <th class=" text-center">Jam Periksa</th>
                                            <th class=" text-center">Nama Pasien</th>
                                            <th class=" text-center">Alamat Rumah</th>
                                            <th class=" text-center">Umur</th>
                                            <th class=" text-center">Jenis Kelamin</th>
                                            <th class=" text-center">Keluhan</th>
                                            <th class=" text-center">Tindakan</th>
                                            <th class=" text-center">Tagihan</th>
                                            <th class=" text-center">Status</th>
                                            <th class=" text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($pasienDokter as $row) :
                                            $tglLahir = new DateTime($row->tgl_lahir);
                                            $today = new DateTime('today');
                                            $umur = $today->diff($tglLahir)->y;
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
                                                <td class=" text-center"><?= $no++ ?></td>
                                                <td class=" text-center"><?= $row->jam ?></td>
                                                <td class=""><?= $row->nama_pasien ?></td>
                                                <td class=""><?= $row->alamat_pasien ?></td>
                                                <td class=" text-center"><?= $umur ?></td>
                                                <td class=" text-center"><?= $row->jenkel_pasien ?></td>
                                                <td class=""><?= $row->keluhan ?></td>
                                                <td class=""><?= $row->nama_tindakan ?></td>
                                                <td class=" text-end"><?= number_format($row->tagihan, '0', ',', '.')  ?>,-</td>
                                                <td class="text-center" style="<?= $row->status_pasien == 3 ? 'color:red;background-color:lightgrey;' : '' ?>"><?= $statusPasien[$status]; ?></td>
                                                <td class="text-center">
                                                    <a href="<?= $row->status_pasien == 2 ? base_url('dokter/inputTindakanDokter/') : 'javascript:void(0)' ?><?= $row->id_jadwal ?>" class="text-primary"><i class="fas fa-fw fa-check-circle" data-bs-toggle="tooltip" title="Update Status Pasien"></i></a>
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
                    <!-- <div class="modal fade" id="inputJam" tabindex="-1" aria-labelledby="exampleInputJam" aria-hidden="true">
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
                    </div> -->
                    <!-- Modal Input Jam -->

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
                    <!-- Modal Edit Kehadiran -->
                    <!-- <?php $no = 0;
                            foreach ($pasien as $row) : $no++; ?>
                        <div class="row">
                            <div id="editStatus<?= $row->id_jadwal; ?>" class="modal fade" tabindex="-1" aria-labelledby="exampleEditStatus" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?= base_url('dashboard/editStatus'); ?>" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title text-uppercase" id="exampleEditStatus">Update Status Pasien</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" readonly value="<?= $row->id_jadwal; ?>" name="id_jadwal" class="form-control">
                                                <div class="mb-2">
                                                    <label class="form-label">Status Pasien</label>
                                                    <select name="status_pasien" id="status_pasien" class="form-control select2">
                                                        <option value="0" <?= $row->status_pasien == '0' ? 'selected' : '' ?>>Belum Hadir</option>
                                                        <option value="1" <?= $row->status_pasien == '1' ? 'selected' : '' ?>>Hadir</option>
                                                        <option value="2" <?= $row->status_pasien == '2' ? 'selected' : '' ?>>Proses</option>
                                                        <option value="3" <?= $row->status_pasien == '3' ? 'selected' : '' ?>>Selesai</option>
                                                        <option value="4" <?= $row->status_pasien == '4' ? 'selected' : '' ?>>Batal</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="editHadir">Update</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?> -->
                    <!-- Modal Edit Kehadiran -->
                </div>
            </div>
        </div>
    </main>