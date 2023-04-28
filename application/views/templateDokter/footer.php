<footer class="py-2 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <!-- <div class="text-muted">Copyright &copy; ABY Bondowoso 2022</div> -->
            <div class="text-muted" style="font-size: 0.7rem;">Built with <span class="text-danger">&hearts;</span> by DIE Art'S Production 2022</div>
        </div>
    </div>
</footer>
</div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">Yakin Mau Logout.?</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" jika anda yakin mau keluar</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Sweetalert2 -->
<script src="<?php echo base_url('assets/'); ?>sweetalert2.all.min.js"></script>

<script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>assets/js/scripts.js"></script>
<script src="<?= base_url() ?>assets/js/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>assets/demo/chart-area-demo.js"></script>
<script src="<?= base_url() ?>assets/demo/chart-bar-demo.js"></script>
<script src="<?= base_url() ?>assets/js/datatables-simple-demo.js"></script>

<!-- datatable bootstrap5 -->
<script src="<?= base_url(); ?>assets/datatables/bootstrap5/jquery-3.5.1.js"></script>
<script src="<?= base_url(); ?>assets/datatables/bootstrap5/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/datatables/bootstrap5/dataTables.bootstrap5.min.js"></script>
<!-- select2 js -->
<script src="<?= base_url() ?>assets/select2/select2.min.js"></script>


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<script>
    $('.select2').select2({
        theme: 'bootstrap-5'
    });
</script>

<script>
    $('.sweet').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Yakin mau Di Hapus?',
            text: 'Jika yakin tekan Hapus',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    })
</script>
<script>
    const tanya = document.getElementById('tanya');
    const tables = document.getElementById('tables');
    const tombol_belum = document.getElementById('belum');
    const tombol_saldo = document.getElementById('saldo');
    const tombolSaldo = document.getElementById('tombolSaldo');
    const getSaldo = document.getElementById('getSaldo');
    const tombol_pilih = document.getElementById('tombol_pilih');
    const tabel = document.getElementById('tabel');
    const cetak = document.getElementById('cetak');

    // cetak.addEventListener('click', function() {
    //     window.print();
    // })

    if (tombol_belum !== null) {
        tombol_belum.addEventListener('click', function() {
            if (tanya.style.display == "none") {
                tanya.style.display = "block";
            }
        });
    }

    if (tombol_saldo !== null) {
        tombol_saldo.addEventListener('click', function() {
            if (getSaldo.style.display == "none") {
                getSaldo.style.display = "block";
            }
        });
    }

    if (tombol_pilih !== null) {
        tombol_pilih.addEventListener('click', function() {
            if (tanya.style.display == "block") {
                tanya.style.display = "none";
            }
        });
    }

    if (tombolSaldo !== null) {
        tombolSaldo.addEventListener('click', function() {
            if (getSaldo.style.display == "block") {
                getSaldo.style.display = "none";
            }
        });
    }
    if (tombol_pilih !== null) {
        tombol_pilih.addEventListener('click', function() {
            if (tables.style.display == "none") {
                tables.style.display = "block";
            }
        });
    }
</script>

<!-- membuat efek alert bergerak dan menghilang -->
<script>
    window.setTimeout(function() {
        $(".alert").animate({
            left: "+=50",
            width: "350"
        }, 5000, function() {}).fadeTo(1000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 1000);
</script>

<script>
    window.onload = function() {
        jam();
    }

    function jam() {
        var e = document.getElementById('jam'),
            d = new Date(),
            h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());

        if (e) {
            e.innerHTML = h + ' : ' + m + ' : ' + s + ' WIB';
            setTimeout('jam()', 1000);

        }

    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }
</script>
<!-- <script>
    window.onload = function() {
        jam();
    }

    function jam() {
        var e = document.getElementById('jam'),
            d = new Date(),
            h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());

        e.innerHTML = h + ' : ' + m + ' : ' + s + ' WIB';
        setTimeout('jam()', 1000);
    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }
</script> -->

<script>
    getData();

    function getData() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('daftarPasienAjax/tampilPasien') ?>',
            async: false,
            dataType: 'json',
            success: function(data) {
                let baris = '';
                let i;
                let no = 1;
                for (i = 0; i < data.length; i++) {
                    const hariIni = new Date();
                    const tglLahir = new Date(data[i].tgl_lahir);

                    let umur = Math.floor((hariIni - tglLahir) / (365.25 * 24 * 60 * 60 * 1000));

                    let bpjs = data[i].bpjs;
                    if (bpjs) {
                        bpjs = data[i].bpjs;
                    } else {
                        bpjs = "Umum";
                    }

                    baris += '<tr>' +
                        '<td style="text-align:center;">' + no++ + '</td>' +
                        '<td>' + data[i].nama_pasien + '</td>' +
                        '<td>' + data[i].alamat_pasien + '</td>' +
                        '<td>' + data[i].telepon_pasien + '</td>' +
                        '<td>' + data[i].jenkel_pasien + '</td>' +
                        '<td>' + data[i].no_ktp + '</td>' +
                        '<td style="text-align:center;">' + umur + ' Tahun' + '</td>' +
                        '<td style="text-align:center;">' + bpjs + '</td>' +
                        '<td>' + data[i].keterangan + '</td>' +
                        '<td style="text-align:center;">' +
                        '<a href="#" data-bs-toggle="modal" data-bs-target="#tambahPasien" class="editPasien"  onclick="submit(' + data[i].id_pasien + ')"><i class="fas fa-fw fa-edit" data-bs-toggle="tooltip" title="Edit Data"></i></a>' +
                        '<a href="#" class="text-danger" onclick="hapusData(' + data[i].id_pasien + ')" data-bs-toggle="tooltip" title="Hapus data"><i class="fas fa-fw fa-trash"></i></a>' +
                        '<a href="#" data-bs-toggle="modal" data-bs-target="#detailPasien" onclick="detail(' + data[i].id_pasien + ')" class="text-success" data-bs-toggle="tooltip" title="Detail data"><i class="fa-solid fa-circle-info"></i></a>' + '</td>' +
                        '</tr>';
                }
                $('#showData').html(baris);
            }
        });
    }

    function tambahData() {
        let nama_pasien = $("[name='nama_pasien']").val();
        let alamat_pasien = $("[name='alamat_pasien']").val();
        let telepon_pasien = $("[name='telepon_pasien']").val();
        let jenkel_pasien = $("[name='jenkel_pasien']").val();
        let no_ktp = $("[name='no_ktp']").val();
        let tgl_lahir = $("[name='tgl_lahir']").val();
        let bpjs = $("[name='bpjs']").val();
        let keterangan = $("[name='keterangan']").val();

        $.ajax({
            type: 'POST',
            data: 'nama_pasien=' + nama_pasien + '&alamat_pasien=' + alamat_pasien + '&telepon_pasien=' + telepon_pasien + '&jenkel_pasien=' + jenkel_pasien + '&no_ktp=' + no_ktp + '&tgl_lahir=' + tgl_lahir + '&bpjs=' + bpjs + '&keterangan=' + keterangan,
            url: '<?= base_url('daftarPasienAjax/inputPasien') ?>',
            dataType: "JSON",
            success: function(hasil) {
                // console.log(hasil);
                $("#pesan").html(hasil.pesan);
                if (hasil.pesan == '') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Data Pasien berhasil ditambahkan',
                        showConfirmButton: true,
                        timer: 0
                    });
                    $("#tambahPasien").modal('hide');
                    $('#example').dataTable().fnDestroy(); // menghancurkan datatable
                    getData();
                    $('#example').dataTable({ // inisialisasi datatable kembali
                        "lengthMenu": [10, 25, 50, 75, 100], // menentukan jumlah data yang ingin ditampilkan
                        "pageLength": 10, // menentukan jumlah data yang ditampilkan secara default
                    });

                    $("[name='nama_pasien']").val('');
                    $("[name='alamat_pasien']").val('');
                    $("[name='telepon_pasien']").val('');
                    $("[name='jenkel_pasien']").val('');
                    $("[name='no_ktp']").val('');
                    $("[name='tgl_lahir']").val('');
                    $("[name='bpjs']").val('');
                    $("[name='keterangan']").val('');
                }
            }
        });
    }

    function batalData() {
        $.ajax({
            success: function(hasil) {
                $("#pesan").html("");
                $("[name='nama_pasien']").val('');
                $("[name='alamat_pasien']").val('');
                $("[name='telepon_pasien']").val('');
                $("[name='jenkel_pasien']").val('');
                $("[name='no_ktp']").val('');
                $("[name='tgl_lahir']").val('');
                $("[name='bpjs']").val('');
                $("[name='keterangan']").val('');
            }
        });
    }

    function submit(x) {
        if (x == 'tambah') {
            $('#btn-tambah').show();
            $('#btn-ubah').hide();
        } else {
            $('#btn-tambah').hide();
            $('#btn-ubah').show();

            $.ajax({
                type: "POST",
                data: 'id_pasien=' + x,
                url: '<?= base_url('daftarPasienAjax/ambilIdPasien') ?>',
                dataType: 'JSON',
                success: function(hasil) {
                    $('[name="id_pasien"]').val(hasil[0].id_pasien);
                    $('[name="nama_pasien"]').val(hasil[0].nama_pasien);
                    $('[name="alamat_pasien"]').val(hasil[0].alamat_pasien);
                    $('[name="telepon_pasien"]').val(hasil[0].telepon_pasien);
                    $('[name="jenkel_pasien"]').val(hasil[0].jenkel_pasien);
                    $('[name="no_ktp"]').val(hasil[0].no_ktp);
                    $('[name="tgl_lahir"]').val(hasil[0].tgl_lahir);
                    $('[name="bpjs"]').val(hasil[0].bpjs);
                    $('[name="keterangan"]').val(hasil[0].keterangan);
                }
            })
        }
    }

    // function detail(x) {
    //     $.ajax({
    //         type: "POST",
    //         data: 'id_pasien=' + x,
    //         url: '<?= base_url('daftarPasienAjax/detailPasien') ?>',
    //         dataType: 'JSON',
    //         success: function(hasil) {
    //             console.log(hasil[0].nama_pasien);
    //             $('#nama_pasien').text(hasil[0].nama_pasien);
    //         }
    //     })
    // }

    // function detail(x) {
    //     console.log("Mengirim permintaan AJAX dengan id_pasien = " + x);

    //     $.ajax({
    //         type: "POST",
    //         data: 'id_pasien=' + x,
    //         url: '<?= base_url('daftarPasienAjax/detailPasien') ?>',
    //         dataType: 'JSON',
    //         success: function(hasil) {
    //             console.log("Menerima data dari server:");
    //             console.log(hasil);

    //             if (hasil && hasil.length > 0 && hasil[0].nama_pasien) {
    //                 console.log("Nilai nama_pasien yang diterima: " + hasil[0].nama_pasien);
    //                 $('#nama_pasien_span').text(hasil[0].nama_pasien);
    //             } else {
    //                 console.log("Data tidak valid atau kosong.");
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.log("Terjadi kesalahan saat mengirim permintaan AJAX.");
    //             console.log("Status: " + status);
    //             console.log("Error: " + error);
    //         }
    //     });
    // }

    function detail(x) {
        console.log("Mengirim permintaan AJAX dengan id_pasien = " + x);

        $.ajax({
            type: "POST",
            data: {
                id_pasien: x
            },
            url: "<?= base_url('daftarPasienAjax/detailPasien') ?>",
            dataType: "JSON",
            success: function(hasil) {
                console.log("Menerima data dari server:");
                console.log(hasil);

                if (hasil && hasil.length > 0 && hasil[0].nama_pasien) {
                    console.log("Nilai nama_pasien yang diterima: " + hasil[0].nama_pasien);
                    $('[name="nama_pasien"]').val('Nama : ' + hasil[0].nama_pasien);
                    $('[name="alamat_pasien"]').val('Alamat : ' + hasil[0].alamat_pasien);
                } else {
                    console.log("Data tidak valid atau kosong.");
                }
            },
            error: function(xhr, status, error) {
                console.log("Terjadi kesalahan saat mengirim permintaan AJAX.");
                console.log("Status: " + status);
                console.log("Error: " + error);
            }
        });
    }

    function ubahData() {
        let id_pasien = $("[name='id_pasien']").val();
        let nama_pasien = $("[name='nama_pasien']").val();
        let alamat_pasien = $("[name='alamat_pasien']").val();
        let telepon_pasien = $("[name='telepon_pasien']").val();
        let jenkel_pasien = $("[name='jenkel_pasien']").val();
        let no_ktp = $("[name='no_ktp']").val();
        let tgl_lahir = $("[name='tgl_lahir']").val();
        let bpjs = $("[name='bpjs']").val();
        let keterangan = $("[name='keterangan']").val();

        $.ajax({
            type: 'POST',
            data: 'id_pasien=' + id_pasien + '&nama_pasien=' + nama_pasien + '&alamat_pasien=' + alamat_pasien + '&telepon_pasien=' + telepon_pasien + '&jenkel_pasien=' + jenkel_pasien + '&no_ktp=' + no_ktp + '&tgl_lahir=' + tgl_lahir + '&bpjs=' + bpjs + '&keterangan=' + keterangan,
            url: '<?= base_url('daftarPasienAjax/updatePasien') ?>',
            dataType: 'JSON',
            success: function(hasil) {
                $("#pesan").html(hasil.pesan);
                if (hasil.pesan == '') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Data Pasien berhasil diupdate',
                        showConfirmButton: true,
                        timer: 0
                    });
                    $("#tambahPasien").modal('hide');
                    $('#example').dataTable().fnDestroy(); // menghancurkan datatable
                    getData();
                    $('#example').dataTable({ // inisialisasi datatable kembali
                        "lengthMenu": [10, 25, 50, 75, 100], // menentukan jumlah data yang ingin ditampilkan
                        "pageLength": 10, // menentukan jumlah data yang ditampilkan secara default
                    });

                    $("[name='nama_pasien']").val('');
                    $("[name='alamat_pasien']").val('');
                    $("[name='telepon_pasien']").val('');
                    $("[name='jenkel_pasien']").val(hasil.jenkel_pasien);
                    $("[name='no_ktp']").val('');
                    $("[name='tgl_lahir']").val('');
                    $("[name='bpjs']").val('');
                    $("[name='keterangan']").val('');
                }
            }
        })
    }

    function hapusData(id_pasien) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda yakin akan menghapus data.?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    data: 'id_pasien=' + id_pasien,
                    url: '<?= base_url('daftarPasienAjax/hapusPasien') ?>',
                    success: function() {
                        $('#example').dataTable().fnDestroy(); // menghancurkan datatable
                        getData();
                        $('#example').dataTable({ // inisialisasi datatable kembali
                            "lengthMenu": [10, 25, 50, 75, 100], // menentukan jumlah data yang ingin ditampilkan
                            "pageLength": 10, // menentukan jumlah data yang ditampilkan secara default
                        });
                        Swal.fire(
                            'Berhasil',
                            'Data Pasien berhasil dihapus',
                            'success'
                        );
                    }
                })
            }
        });
    }

    // function detailData(id_pasien) {
    //     $.ajax({
    //         type: 'POST',
    //         data: 'id_pasien=' + id_pasien,
    //         url: '<?= base_url('daftarPasienAjax/detailPasien') ?>',
    //         success: function() {
    //             $('#example').dataTable().fnDestroy(); // menghancurkan datatable
    //             getData();
    //             $('#example').dataTable({ // inisialisasi datatable kembali
    //                 "lengthMenu": [10, 25, 50, 75, 100], // menentukan jumlah data yang ingin ditampilkan
    //                 "pageLength": 10, // menentukan jumlah data yang ditampilkan secara default
    //             });
    //         }
    //     })
    // }
</script>

</body>

</html>