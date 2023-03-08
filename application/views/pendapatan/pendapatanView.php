<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="row">
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
                        <div class="col-9">
                            <div class="fw-bold text-uppercase"><?= $title; ?> <?= $bulanPilih . ' ' . $tahunPilih ?></div>
                        </div>
                        <div class="col-3">
                            <button id="belum" class="btn btn-warning btn-sm float-end"><i class="fas fa-calendar-alt"></i> Pilih Bulan</button>
                            <!-- <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#pilihTanggal"><i class="fas fa-calendar-alt"></i> Pilih Tanggal</button> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2" id="tanya" style="display: none;">
                        <div class="col-xl-12">
                            <div class="card bg-light shadow text-center text-dark">
                                <div class="card-body">
                                    <form action="<?= base_url('pendapatan') ?>" method="GET">
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
                    <div class="row">
                        <div class="col-xl-12 mb-4">
                            <div class="table-responsive" style="font-size: 0.7rem;">
                                <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-secondary border-dark">
                                            <th class=" text-center">No</th>
                                            <th class=" text-center">Tanggal</th>
                                            <th class=" text-center">Nama Pasien</th>
                                            <th class=" text-center">Alamat Pasien</th>
                                            <th class=" text-center">Rupiah</th>
                                            <!-- <th class=" text-center">Keterangan</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($pendapatan as $row) :
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
                                            <tr>
                                                <td class=" text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $tanggalFix ?></td>
                                                <td class=""><?= $row->nama_pasien ?></td>
                                                <td class=""><?= $row->alamat_pasien ?></td>
                                                <td class="text-end"><?= number_format($row->tagihan, '0', ',', '.');  ?>,-</td>
                                                <!-- <td class=""><?= $row->keterangan ?></td> -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tr>
                                        <td colspan="4" class="text-center fw-bold">Total</td>
                                        <td class="text-end fw-bold">
                                            Rp. <?php foreach ($totalBulan as $row) {
                                                    echo number_format($row->tagihan, '0', ',', '.');
                                                } ?>,-
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal pilih tanggal -->
                    <!-- <div class="modal fade" id="pilihTanggal" tabindex="-1" aria-labelledby="examplePilihTanggal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-uppercase" id="examplePilihTanggal">Pilih Tanggal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('pendapatan'); ?>" method="GET">
                                        <div class="mb-2">
                                            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Pilih Tanggal">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="pilihTanggal">Pilih</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Modal pilih tanggal -->

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