<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2 mt-2">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
            <div class="card">
                <div class="card-header mb-2 shadow">
                    <div class="row">
                        <div class="col-6">
                            <div class="fw-bold text-uppercase"><?= $title ?></div>
                        </div>
                        <div class="col-6">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahPasien" class="btn btn-warning btn-sm float-end" onclick="submit('tambah')" style=" background: #f0f0f0; border: none; border-radius: 20px; box-shadow: 2px 2px 2px #eee, inset 8px 8px 8px #ffffff, inset -8px -8px 8px #cbced1; color: #333; font-size: 1rem; padding: .3rem .7rem; font-size:.7rem" onMouseOver="this.style.backgroundColor='#cbced1'" onMouseOut="this.style.backgroundColor='#ffffff'"><i class="fas fa-plus"></i> Input Pasien Baru</a>
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
                                    <tbody id="showData">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal tambah Pasien -->
        <div class="modal fade" id="tambahPasien" tabindex="-1" aria-labelledby="exampleTambahPasien" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-uppercase text-center" id="exampleTambahPasien">Data Pasien</h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div id="pesan" style="color: red;" class="p-2"></div>
                    <div class="modal-body">
                        <form id="tambahPasienForm" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="nama_pasien" class="form-label">Nama Pasien :</label>
                                        <input type="text" class="form-control" name="nama_pasien" id="nama_pasien">
                                        <input type="hidden" name="id_pasien" value="">
                                    </div>
                                    <div class="mb-2">
                                        <label for="alamat_pasien" class="form-label">Alamat Pasien</label>
                                        <input type="text" class="form-control" name="alamat_pasien" id="alamat_pasien">
                                    </div>
                                    <div class="mb-2">
                                        <label for="telepon_pasien" class="form-label">Telepon Pasien</label>
                                        <input type="text" class="form-control" name="telepon_pasien" id="telepon_pasien">
                                    </div>
                                    <div class="mb-2">
                                        <label for="jenkel_pasien" class="form-label">Jenis Kelamin Pasien</label>
                                        <select name="jenkel_pasien" id="jenkel_pasien" class="form-select select2">
                                            <option value=""></option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="no_ktp" class="form-label">NO K T P</label>
                                        <input type="text" class="form-control" name="no_ktp" id="no_ktp">
                                    </div>
                                    <div class="mb-2">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                                    </div>
                                    <div class="mb-2">
                                        <label for="bpjs" class="form-label">B P J S</label>
                                        <input type="text" class="form-control" name="bpjs" id="bpjs">
                                    </div>
                                    <div class="mb-2">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" id="btn-tambah" onclick="tambahData()" class="btn btn-primary">Tambah Data</button>
                                <button type="button" id="btn-ubah" onclick="ubahData()" class="btn btn-primary">Ubah Data</button>
                                <button type="button" onclick="batalData()" data-bs-dismiss="modal" class="btn btn-secondary">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal tambah Pasien akhir -->

        <!-- Modal detail Pasien -->
        <div class="modal fade" id="detailPasien" tabindex="-1" aria-labelledby="exampleTambahPasien" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-uppercase text-center" id="exampleTambahPasien">Data Detail Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <form method="POST"> -->
                        <!-- <input type="hidden" name="id_pasien" value="" id="id_pasien"> -->

                        <div class="row g-1">
                            <div class="col-lg-3">
                                <div class="card p-1 shadow">
                                    <div class="card text-dark bg-info mb-1">
                                        <div class="card-header text-center mt-1">
                                            <h4>DATA PASIEN</h4>
                                        </div>
                                    </div>
                                    <div class="card text-dark bg-light mb-1">
                                        <div class="card-header">
                                            Nama : <span class="text-uppercase" id="nama_pasien"></span>
                                        </div>
                                    </div>
                                    <div class="card text-dark bg-light mb-1">
                                        <div class="card-header">Alamat : <br></div>
                                    </div>
                                    <div class="card text-dark bg-light mb-1">
                                        <div class="card-header">Telepon : </div>
                                    </div>
                                    <div class="card text-dark bg-light mb-1">
                                        <div class="card-header">Jenis Kelamin : <br></div>
                                    </div>
                                    <div class="card text-dark bg-light">
                                        <div class="card-header">Umur : Tahun</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card p-1 shadow">
                                    <div class="table-responsive" style="font-size: 0.7rem;">
                                        <table id="example" class="table table-hover table-striped table-bordered table-sm" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="bg-secondary border-dark">
                                                    <th class=" text-center">No</th>
                                                    <th class=" text-center">Tanggal</th>
                                                    <th class=" text-center">Keluhan</th>
                                                    <th class=" text-center">Tindakan 1</th>
                                                    <th class=" text-center">Jumlah</th>
                                                    <th class=" text-center">Tindakan 2</th>
                                                    <th class=" text-center">Jumlah</th>
                                                    <th class=" text-center">Tagihan</th>
                                                </tr>
                                            </thead>
                                            <tbody id="showDataDetail">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal detail Pasien akhir -->

        <!-- Modal edit Pasien -->
        <!-- <div class="modal fade" id="editPasien" tabindex="-1" aria-labelledby="exampleEditPasien" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-uppercase" id="exampleEditPasien">Edit Data Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="nama_pasien" class="form-label">Nama Pasien</label>
                                        <input type="text" class="form-control" name="nama_pasien" id="nama_pasien">
                                    </div>
                                    <div class="mb-2">
                                        <label for="alamat_pasien" class="form-label">Alamat Pasien</label>
                                        <input type="text" class="form-control" name="alamat_pasien" id="alamat_pasien">
                                    </div>
                                    <div class="mb-2">
                                        <label for="telepon_pasien" class="form-label">Telepon Pasien</label>
                                        <input type="text" class="form-control" name="telepon_pasien" id="telepon_pasien">
                                    </div>
                                    <div class="mb-2">
                                        <label for="jenkel_pasien" class="form-label">Jenis Kelamin Pasien</label>
                                        <select name="jenkel_pasien" id="jenkel_pasien" class="form-select select2">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="no_ktp" class="form-label">NO K T P</label>
                                        <input type="text" class="form-control" name="no_ktp" id="no_ktp">
                                    </div>
                                    <div class="mb-2">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir">
                                    </div>
                                    <div class="mb-2">
                                        <label for="bpjs" class="form-label">B P J S</label>
                                        <input type="text" class="form-control" name="bpjs" id="bpjs">
                                    </div>
                                    <div class="mb-2">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_pasien" id="id_pasien" class="form-control">
                            <button type="submit" class="btn btn-primary" id="update">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Modal edit Pasien akhir -->


    </main>