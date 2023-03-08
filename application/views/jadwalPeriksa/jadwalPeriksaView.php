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
                            <button id="belum" class="btn btn-success btn-sm float-end"><i class="fas fa-calendar-alt"></i> Pilih Waktu</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2" id="tanya" style="display: none;">
                        <div class="col-xl-12">
                            <div class="card bg-light shadow text-center text-dark">
                                <div class="card-body">
                                    <form action="<?= base_url('jadwalPeriksa') ?>" method="GET">
                                        <div class="row">
                                            <div class="col-md-3 d-grid gap-2">
                                                <button class="btn btn-block btn-outline-secondary" disabled>Pilih Bulan & Tahun :</button>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php $bulan = date('m'); ?>
                                                    <select name="bulan" class="form-select mb-1" required>
                                                        <!-- <option value="<?php echo $bulan = date('m'); ?>">Bulan</option> -->
                                                        <option value="01" <?= $bulan == '01' ? 'selected' : '' ?>>Januari</option>
                                                        <option value="02" <?= $bulan == '02' ? 'selected' : '' ?>>Februari</option>
                                                        <option value="03" <?= $bulan == '03' ? 'selected' : '' ?>>Maret</option>
                                                        <option value="04" <?= $bulan == '04' ? 'selected' : '' ?>>April</option>
                                                        <option value="05" <?= $bulan == '05' ? 'selected' : '' ?>>Mei</option>
                                                        <option value="06" <?= $bulan == '06' ? 'selected' : '' ?>>Juni</option>
                                                        <option value="07" <?= $bulan == '07' ? 'selected' : '' ?>>Juli</option>
                                                        <option value="08" <?= $bulan == '08' ? 'selected' : '' ?>>Agustus</option>
                                                        <option value="09" <?= $bulan == '09' ? 'selected' : '' ?>>September</option>
                                                        <option value="10" <?= $bulan == '10' ? 'selected' : '' ?>>Oktober</option>
                                                        <option value="11" <?= $bulan == '11' ? 'selected' : '' ?>>November</option>
                                                        <option value="12" <?= $bulan == '12' ? 'selected' : '' ?>>Desember</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <select name="tahun" class="form-select mb-1">
                                                        <?php
                                                        $mulai = date('Y') - 2;
                                                        for ($i = $mulai; $i < $mulai + 11; $i++) {
                                                            $sel = $i == date('Y') ? ' selected="selected"' : '';
                                                            echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="d-grid gap-2">
                                                    <button type="submit" name="pilihWaktu" id="tombol_pilih" class="btn btn-block btn-outline-primary">Tampilkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-xxl-6">
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-warning btn-sm float-end mb-1" data-bs-toggle="modal" data-bs-target="#inputTanggal"><i class="fas fa-plus"></i> Input Tanggal</button>
                                    <?php
                                    if (isset($_GET['pilihWaktu'])) {
                                        $bulanPilih = $_GET['bulan'];
                                        $tahunPilih = $_GET['tahun'];
                                    } else {
                                        $bulanPilih = date('m');
                                        $tahunPilih = date('Y');
                                    }
                                    switch ($bulanPilih) {
                                        case '1':
                                            $bulanPilih = "Januari";
                                            break;
                                        case '2':
                                            $bulanPilih = "Februari";
                                            break;
                                        case '3':
                                            $bulanPilih = "Maret";
                                            break;
                                        case '4':
                                            $bulanPilih = "April";
                                            break;
                                        case '5':
                                            $bulanPilih = "Mei";
                                            break;
                                        case '6':
                                            $bulanPilih = "Juni";
                                            break;
                                        case '7':
                                            $bulanPilih = "Juli";
                                            break;
                                        case '8':
                                            $bulanPilih = "Agustus";
                                            break;
                                        case '9':
                                            $bulanPilih = "September";
                                            break;
                                        case '10':
                                            $bulanPilih = "Oktober";
                                            break;
                                        case '11':
                                            $bulanPilih = "Nofember";
                                            break;
                                        case '12':
                                            $bulanPilih = "Desember";
                                            break;
                                    }
                                    ?>
                                    <h5 class="text-uppercase mt-1"><?= $bulanPilih . ' ' . $tahunPilih ?></h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $numOfCols = 6;
                                    $rowCount = 0;
                                    $bootstrapColWidth = 12 / $numOfCols;
                                    ?>
                                    <div class="row justify-content-center">
                                        <?php foreach ($jadwalPeriksa as $row) : ?>
                                            <div class="col-xl-<?= $bootstrapColWidth; ?> g-2 mb-1">
                                                <div class="card border-1 shadow" style="height:100% ;">
                                                    <div class="card-body border-top border-warning border-5 rounded-top">
                                                        <?php
                                                        $hari = date('D', strtotime($row->tanggal));
                                                        $hariIndo = [
                                                            'Sun' => 'Ahad',
                                                            'Mon' => 'Senin',
                                                            'Tue' => 'Selasa',
                                                            'Wed' => 'Rabu',
                                                            'Thu' => 'Kamis',
                                                            'Fri' => 'Jumat',
                                                            'Sat' => 'Sabtu'
                                                        ]
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <a href="<?= base_url('jadwalPeriksa/detailPraktek') ?>/<?= $row->id_tanggal ?>/<?= $row->tanggal ?>" class="text-decoration-none fw-bold text-dark" data-toggle="tooltip" title="Detail Jadwal Praktek">
                                                                    <h6><?= $hariIndo[$hari]; ?></h6>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                <?php
                                                                $jumlahJam = $this->db->get_where('jam_periksa', ['ket_jam' => 'Praktek'])->num_rows();
                                                                $id_tanggal = $row->id_tanggal;
                                                                $jumlahPasien = $this->db->get_where('jadwal_periksa', ['id_tanggal' => $id_tanggal])->num_rows();
                                                                $sisaJam = $jumlahJam - $jumlahPasien;
                                                                if ($sisaJam == 0) {
                                                                    $sisaJam = 'full';
                                                                }
                                                                ?>
                                                                <p style="font-size: 0.5rem;"><?= $sisaJam; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href="<?= base_url('jadwalPeriksa/detailPraktek') ?>/<?= $row->id_tanggal ?>/<?= $row->tanggal ?>" class="text-decoration-none fw-bold text-dark text-uppercase" data-toggle="tooltip" title="Detail Jadwal Praktek">
                                                                    <h5 class="text-center"><?php
                                                                                            $tanggal = intval(date('d', strtotime($row->tanggal)));
                                                                                            $sekarang = intval(date('d', strtotime('now')));
                                                                                            if ($tanggal == $sekarang) {
                                                                                                echo "<p style='color:red; font-size:1.2em; text-shadow:1px 1px 1px black;'>$tanggal</p>";
                                                                                            } else {
                                                                                                echo "<p style='color:black;'>$tanggal</p>";
                                                                                            }
                                                                                            ?></h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-donate text-primary" data-toggle="tooltip" title="Edit Tanggal Praktek" data-bs-toggle="modal" data-bs-target="#editTanggal<?= $row->id_tanggal; ?>"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            $rowCount++;
                                            if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                        endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Input Tanggal -->
            <div class="modal fade" id="inputTanggal" tabindex="-1" aria-labelledby="exampleInputTanggal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title text-uppercase" id="exampleInputTanggal">Input Tanggal Praktek</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('jadwalPeriksa/inputTanggal') ?>" method="POST">
                                <div class="mb-2">
                                    <label for="tanggal" class="form-label">Tanggal Praktek</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal">
                                </div>
                                <div class="mb-2">
                                    <label for="ket_tanggal" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="ket_tanggal" id="ket_tanggal">
                                </div>
                                <button type="submit" class="btn btn-primary" name="inputTanggal">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Input Tanggal -->
            <!-- Modal Edit Tanggal -->
            <?php $no = 0;
            foreach ($jadwalPeriksa as $row) : $no++; ?>
                <div class="row">
                    <div id="editTanggal<?= $row->id_tanggal; ?>" class="modal fade" tabindex="-1" aria-labelledby="exampleEditTanggal" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?= base_url('jadwalPeriksa/editTanggal'); ?>" method="post">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title text-uppercase" id="exampleEditTanggal">Edit Tanggal Praktek</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" readonly value="<?= $row->id_tanggal; ?>" name="id_tanggal" class="form-control">
                                        <div class="mb-2">
                                            <label class="form-label">Tanggal Praktek</label>
                                            <input type="date" name="tanggal" autocomplete="off" value="<?= $row->tanggal; ?>" placeholder="Masukkan Tanggal Praktek" class="form-control">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Keterangan</label>
                                            <input type="text" name="ket_tanggal" autocomplete="off" value="<?= $row->ket_tanggal; ?>" placeholder="Masukkan Keterangan" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="editJam">Update</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- Modal Edit Tanggal -->
        </div>
    </main>