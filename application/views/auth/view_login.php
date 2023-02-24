<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AppDrg | <?= $title ?></title>

    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body>
    <section class="vh-100" style="background-color: #298EC6;">
        <div class="container vh-100" style="padding-top:40px; padding-bottom:40px;">
            <div class="row d-flex bg-light justify-content-center p-4 shadow rounded align-items-center h-100">
                <div class="col-lg-6 d-none d-sm-block">
                    <h2 class="display-1 fs-2 text-primary text-center">Selamat Datang <br> di Praktek Dokter Gigi <br> Bilal Zaidan</h2>
                    <img src="<?= base_url('assets/img/dentist.png'); ?>" class="img-fluid p-5 rounded">
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="card shadow p-3 ">
                        <div class="card-body text-center">
                            <img src="<?= base_url('assets/img/logo_dentist.png') ?>" class="card-img-top mt-2" alt="" style="width:25%;">
                            <h2 class="text-primary mt-0 display-6">Silakan <?= strtoupper($title); ?></h2>
                            <?= $this->session->flashdata('info'); ?>
                            <?= $this->session->unset_userdata('info'); ?>
                        </div>
                        <div class="card-footer">
                            <form method="post" action="<?= base_url('auth') ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" value="<?= set_value('username'); ?>">
                                    <?= form_error('username', '<span class="text-danger small pl-2">', '</span>'); ?>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
                                    <?= form_error('password', '<span class="text-danger small pl-2">', '</span>'); ?>
                                </div>
                                <div class="d-grid mt-3">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                </div>
                            </form>
                            <hr>
                            <!-- <div class="text-center small mb-3">
                                Belum punya akun!, <a href="<?= base_url('auth/registrasi') ?>" style="text-decoration:none;">Silakan Register</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>/js/scripts.js"></script>
    <script src="<?= base_url() ?>/js/Chart.min.js" crossorigin="anonymous"></script>
</body>

</html>