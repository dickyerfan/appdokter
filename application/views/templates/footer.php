<footer class="py-2 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <!-- <div class="text-muted">Copyright &copy; ABY Bondowoso 2022</div> -->
            <div class="text-muted" style="font-size: 0.7rem;">Built with <span class="text-danger">&hearts;</span> by DIE Art'S Production 2023</div>
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

    tombol_belum.addEventListener('click', function() {
        if (tanya.style.display == "none") {
            tanya.style.display = "block";
        }
    });
    tombol_saldo.addEventListener('click', function() {
        if (getSaldo.style.display == "none") {
            getSaldo.style.display = "block";
        }
    });
    tombol_pilih.addEventListener('click', function() {
        if (tanya.style.display == "block") {
            tanya.style.display = "none";
        }
    });
    tombolSaldo.addEventListener('click', function() {
        if (getSaldo.style.display == "block") {
            getSaldo.style.display = "none";
        }
    });
    tombol_pilih.addEventListener('click', function() {
        if (tables.style.display == "none") {
            tables.style.display = "block";
        }
    });
</script>

<!-- Settingan carousel -->
<script>
    const multipleCardCarousel = document.querySelector(
        "#carouselExampleControls"
    );

    if (window.matchMedia("(min-width: 576px)").matches) {
        const carousel = new bootstrap.Carousel(multipleCardCarousel, {
            interval: false,
        });
        var carouselWidth = $(".carousel-inner")[0].scrollWidth;
        var cardWidth = $(".carousel-item").width();
        var scrollPosition = 0;
        $("#carouselExampleControls .carousel-control-next").on("click", function() {
            if (scrollPosition < carouselWidth - cardWidth * 4) {
                scrollPosition += cardWidth;
                $("#carouselExampleControls .carousel-inner").animate({
                        scrollLeft: scrollPosition
                    },
                    600
                );
            }
        });
        $("#carouselExampleControls .carousel-control-prev").on("click", function() {
            if (scrollPosition > 0) {
                scrollPosition -= cardWidth;
                $("#carouselExampleControls .carousel-inner").animate({
                        scrollLeft: scrollPosition
                    },
                    600
                );
            }
        });
    } else {
        $(multipleCardCarousel).addClass("slide");
    }
</script>

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

        e.innerHTML = h + ' : ' + m + ' : ' + s + ' WIB';
        setTimeout('jam()', 1000);
    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }
</script>

<!-- <script>
    $('#editStatus').on('submit', function() {
        var id = $('#id_jadwal').val();
        var status_pasien = $('#status_pasien').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('dashboard/editStatus'); ?>",
            dataType: "JSON",
            data: {
                id: id,
                status_pasien: status_pasien,
            },
            success: function(data) {
                $('#id').val(id);
                $('#status_pasien').val(status_pasien);
            }
        });
    });
</script> -->

<script>
    getData();

    function getData() {
        $.ajax({
            type: 'ajax',
            url: '<?= base_url('daftarPasienAjax/tampilPasien') ?>',
            async: false,
            dataType: 'json',
            success: function(data) {
                let html = '';
                let i;
                for (i = 0; i < data.length; i++) {
                    const tanggal = data[i].tgl_lahir;
                    const tanggalBaru = tanggal.split("-");
                    const bulan = tanggalBaru[1];
                    let bulanIndo;
                    switch (bulan) {
                        case "01":
                            bulanIndo = "Januari";
                            break;
                        case "02":
                            bulanIndo = "Februari";
                            break;
                        case "03":
                            bulanIndo = "Maret";
                            break;
                        case "04":
                            bulanIndo = "April";
                            break;
                        case "05":
                            bulanIndo = "Mei";
                            break;
                        case "06":
                            bulanIndo = "Juni";
                            break;
                        case "07":
                            bulanIndo = "Juli";
                            break;
                        case "08":
                            bulanIndo = "Agustus";
                            break;
                        case "09":
                            bulanIndo = "September";
                            break;
                        case "10":
                            bulanIndo = "Oktober";
                            break;
                        case "11":
                            bulanIndo = "November";
                            break;
                        case "12":
                            bulanIndo = "Desember";
                            break;
                    }
                    const tanggalFix = tanggalBaru[2] + ' ' + bulanIndo + ' ' + tanggalBaru[0];
                    html += '<tr>' +
                        '<td>' + data[i].nama_pasien + '</td>' +
                        '<td>' + data[i].alamat_pasien + '</td>' +
                        '<td>' + data[i].telepon_pasien + '</td>' +
                        '<td>' + data[i].jenkel_pasien + '</td>' +
                        '<td>' + data[i].no_ktp + '</td>' +
                        '<td>' + tanggalFix + '</td>' +
                        '</tr>';
                }
                $('#showData').html(html);


            }
        });
    }
</script>

</body>

</html>