<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="row">
                        <div class="col-lg-9">
                            <h3 class="text-uppercase judulPraktek">Daftar Tindakan</h3>
                        </div>
                        <div class="col-lg-3">
                            <button class="btn btn-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#inputTindakan"><i class="fas fa-plus"></i> Input Data Baru</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" style="font-size: 0.7rem;">
                                <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-secondary border-dark">
                                            <th class=" text-center">No</th>
                                            <th class=" text-center">Jenis Tindakan</th>
                                            <th class=" text-center">Harga</th>
                                            <th class=" text-center">Keterangan</th>
                                            <th class=" text-center">Status</th>
                                            <th class=" text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($tindakan as $row) :
                                            $status = $row->status;
                                            $statusPasien = [
                                                '0' => 'Tidak Aktif',
                                                '1' => 'Aktif',

                                            ];
                                        ?>
                                            <tr>
                                                <td class="fw-bold text-center"><?= $no++ ?></td>
                                                <td class="fw-bold"><?= $row->nama_tindakan ?></td>
                                                <td class="fw-bold text-end"><?= number_format($row->harga, '0', ',', '.')  ?></td>
                                                <td class="fw-bold"><?= $row->ket_tindakan ?></td>
                                                <td class="fw-bold text-center"><?= $statusPasien[$status] ?></td>
                                                <td class="text-center">
                                                    <a data-bs-toggle="modal" data-bs-target="#editTindakan<?= $row->id_tindakan; ?>"><i class="fas fa-fw fa-edit text-primary" data-bs-toggle="tooltip" title="Edit Data"></i></a>
                                                    <a href="<?= base_url('tindakan/hapusTindakan/') ?><?= $row->id_tindakan; ?>" class="sweet text-danger" data-bs-toggle="tooltip" title="Hapus data"><i class="fas fa-fw fa-trash"></i></a>
                                                    <a href="#" class="text-success" data-bs-toggle="tooltip" title="Detail data"><i class="fa-solid fa-circle-info"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Input Tindakan -->
                    <div class="modal fade" id="inputTindakan" tabindex="-1" aria-labelledby="exampleInputTindakan" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-uppercase" id="exampleInputTindakan">Input Tindakan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('tindakan/inputTindakan') ?>" method="POST">
                                        <div class="mb-2">
                                            <label for="nama_tindakan" class="form-label">Nama Tindakan</label>
                                            <input type="text" class="form-control" name="nama_tindakan" id="nama_tindakan">
                                        </div>
                                        <div class="mb-2">
                                            <label for="harga" class="form-label">Harga</label>
                                            <input type="text" class="form-control" name="harga" id="harga">
                                        </div>
                                        <div class="mb-2">
                                            <label for="ket_tindakan" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" name="ket_tindakan" id="ket_tindakan">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="inputTindakan">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Input Tindakan end -->

                    <!-- Modal Edit Tindakan -->
                    <?php $no = 0;
                    foreach ($tindakan as $row) : $no++; ?>
                        <div class="row">
                            <div id="editTindakan<?= $row->id_tindakan; ?>" class="modal fade" tabindex="-1" aria-labelledby="exampleEditTindakan" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?= base_url('tindakan/editTindakan'); ?>" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title text-uppercase" id="exampleEditTindakan">Edit Tindakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" readonly value="<?= $row->id_tindakan; ?>" name="id_tindakan" class="form-control">
                                                <div class="mb-2">
                                                    <label class="form-label">Nama Tindakan</label>
                                                    <input type="text" name="nama_tindakan" autocomplete="off" value="<?= $row->nama_tindakan; ?>" placeholder="Masukkan nama Tindakan" class="form-control">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Harga</label>
                                                    <input type="text" name="harga" autocomplete="off" value="<?= $row->harga; ?>" placeholder="Masukkan Harga" class="form-control">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Keterangan</label>
                                                    <input type="text" name="ket_tindakan" autocomplete="off" value="<?= $row->ket_tindakan; ?>" placeholder="Masukkan Keterangan" class="form-control">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Status Tindakan</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="0" <?= $row->status == '0' ? 'selected' : '' ?>>Tidak Aktif</option>
                                                        <option value="1" <?= $row->status == '1' ? 'selected' : '' ?>>Aktif</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="editTindakan">Update</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Modal Edit Tindakan end -->
                </div>
            </div>
    </main>