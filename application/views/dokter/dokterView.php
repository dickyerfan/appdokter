<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-1 mt-1">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="col-7 col-lg-8">
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
                        <div class="col-5 col-lg-4">
                            <h6 class="btn btn-light text-secondary float-end" id="jam" style="font-size:.9rem; border-radius: 25px; box-shadow: inset 3px 3px 5px #cbced1, inset -8px -8px 8px #fff; "></h6>
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
                                    <h3 class="text-uppercase judulPraktek">Daftar Pasien Hari ini</h3>
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
                                            <th class=" text-center">Tindakan 2</th>
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
                                                <td class=""><?= $row->nama_tindakan2 ?></td>
                                                <td class=" text-end"><?= number_format($row->tagihan, '0', ',', '.')  ?>,-</td>
                                                <td class="text-center" style="<?= $row->status_pasien == 3 ? 'color:red;background-color:lightgrey;' : '' ?>"><?= $statusPasien[$status]; ?></td>
                                                <td class="text-center">
                                                    <a href="<?= $row->status_pasien == 2 && $row->keluhan == '' ? base_url('dokter/inputTindakanDokter/') : 'javascript:void(0)' ?><?= $row->id_jadwal ?>" class="text-primary"><i class="fas fa-fw fa-check-circle" data-bs-toggle="tooltip" title="Update Status Pasien"></i></a>
                                                    <a href="<?= $row->status_pasien == 2 && $row->keluhan != NULL ? base_url('dokter/pembayaran/') : 'javascript:void(0)' ?><?= $row->id_jadwal ?>" class="text-primary"><i class="fas fa-fw fa-dollar" data-bs-toggle="tooltip" title="Pembayaran"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                    // $masuk = $this->db->query("SELECT sum(jml_transaksi) as masuk FROM transaksi WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0");
                    // foreach ($masuk->result() as $row) {
                    //     $masuk = $row->masuk;
                    // }

                    $tgl = date('d');
                    $bulan = date('m');
                    $tahun = date('Y');
                    $this->db->select('*');
                    $this->db->from('jadwal_periksa');
                    $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
                    $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
                    $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
                    $this->db->join('kunjungan_pasien', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal', 'left');
                    $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan', 'left');
                    $this->db->join('tindakan2', 'tindakan2.id_tindakan2 = kunjungan_pasien.id_tindakan2', 'left');
                    $this->db->where('DAY(tanggal)', $tgl);
                    $this->db->where('MONTH(tanggal)', $bulan);
                    $this->db->where('YEAR(tanggal)', $tahun);
                    $this->db->where('status_pasien', 3);
                    $this->db->order_by('jam_periksa.jam');
                    $jumlahPasienHariIni = $this->db->get()->num_rows();

                    $this->db->select('*');
                    $this->db->from('jadwal_periksa');
                    $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
                    $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
                    $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
                    $this->db->join('kunjungan_pasien', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal', 'left');
                    $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan', 'left');
                    $this->db->join('tindakan2', 'tindakan2.id_tindakan2 = kunjungan_pasien.id_tindakan2', 'left');
                    $this->db->where('MONTH(tanggal)', $bulan);
                    $this->db->where('YEAR(tanggal)', $tahun);
                    $this->db->where('status_pasien', 3);
                    $this->db->order_by('jam_periksa.jam');
                    $jumlahPasienBulanIni = $this->db->get()->num_rows();

                    $this->db->select_sum('tagihan');
                    $this->db->from('jadwal_periksa');
                    $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
                    $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
                    $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
                    $this->db->join('kunjungan_pasien', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal', 'left');
                    $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan', 'left');
                    $this->db->join('tindakan2', 'tindakan2.id_tindakan2 = kunjungan_pasien.id_tindakan2', 'left');
                    $this->db->where('DAY(tanggal)', $tgl);
                    $this->db->where('MONTH(tanggal)', $bulan);
                    $this->db->where('YEAR(tanggal)', $tahun);
                    $this->db->where('status_pasien', 3);
                    $this->db->order_by('jam_periksa.jam');
                    $jumlahPendapatanHariIni = $this->db->get();

                    foreach ($jumlahPendapatanHariIni->result() as $row) {
                        $jumlahPendapatanHariIni = $row->tagihan;
                    }

                    $this->db->select_sum('tagihan');
                    $this->db->from('jadwal_periksa');
                    $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
                    $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
                    $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
                    $this->db->join('kunjungan_pasien', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal', 'left');
                    $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan', 'left');
                    $this->db->join('tindakan2', 'tindakan2.id_tindakan2 = kunjungan_pasien.id_tindakan2', 'left');
                    $this->db->where('MONTH(tanggal)', $bulan);
                    $this->db->where('YEAR(tanggal)', $tahun);
                    $this->db->where('status_pasien', 3);
                    $this->db->order_by('jam_periksa.jam');
                    $jumlahPendapatanBulanIni = $this->db->get();

                    foreach ($jumlahPendapatanBulanIni->result() as $row) {
                        $jumlahPendapatanBulanIni = $row->tagihan;
                    }

                    ?>
                    <div class="row justify-content-center" style="font-size:0.7rem;">
                        <div class=" col-md-6 col-lg-3 mb-1">
                            <div class="card border-0 shadow">
                                <div class="card-body bg-light cardEffect border-start border-warning border-2 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-light">
                                                <h6 class="text-uppercase text-warning" style="font-size:0.6rem;">Total Pasien hari ini</h6>
                                                <h5 class="text-warning" style="font-size:0.7rem;"><?= $jumlahPasienHariIni ?> Orang</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-1">
                            <div class="card border-0 shadow">
                                <div class="card-body bg-light cardEffect border-start border-success border-2 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-light">
                                                <h6 class="text-uppercase text-success" style="font-size:0.6rem;">Total Pendapatan hari ini</h6>
                                                <h5 class="text-success" style="font-size:0.7rem;">Rp.<?= number_format($jumlahPendapatanHariIni, '0', ',', '.') ?> ,-</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-donate fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-1">
                            <div class="card border-0 shadow">
                                <div class="card-body bg-light cardEffect border-start border-primary border-2 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-primary">
                                                <h6 class="text-uppercase text-primary" style="font-size:0.6rem;">Total Pasien bulan ini</h6>
                                                <h5 class="text-primary" style="font-size:0.7rem;"><?= $jumlahPasienBulanIni ?> Orang</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-1">
                            <div class="card border-0 shadow">
                                <div class="card-body bg-light cardEffect border-start border-danger border-2 rounded">
                                    <div class="row">
                                        <div class="col mr-2">
                                            <a href="#" class="text-decoration-none fw-bold text-danger">
                                                <h6 class="text-uppercase text-danger" style="font-size:0.6rem;">Total pendapatan bulan ini</h6>
                                                <h5 class="text-danger" style="font-size:0.7rem;">Rp. <?= number_format($jumlahPendapatanBulanIni, '0', ',', '.');  ?> ,-</h5>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-donate fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row mt-2">
                        <div class="col-md-6 col-lg-3">
                            <div class="card shadow">
                                <img src="<?= base_url('assets/img/komputer.jpg') ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card Title</h5>
                                    <p class="card-text">This is a sample card with some text.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

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