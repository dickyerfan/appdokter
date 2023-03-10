<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AppDrg | <?= $title ?></title>
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="assets/img/logo_dentist.png" alt="logoLogin">
        </div>
        <div class="text-center mt-4 title">
            Selamat datang <br> di Aplikasi
            Dokter Gigi
        </div>
        <div class="error">
            <?= $this->session->flashdata('info'); ?>
            <?= $this->session->unset_userdata('info'); ?>
        </div>
        <div class="text-center mt-4 name">
            Silakan Login
        </div>
        <form class="p-3 mt-3" method="POST" action="<?= base_url('auth') ?>">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <?= form_error('username', '<span class="text-danger small pl-2">', '</span>'); ?>
                <input type="text" name="username" id="username" placeholder="Username" value="<?= set_value('username'); ?>">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <?= form_error('password', '<span class="text-danger small pl-2">', '</span>'); ?>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <button class="btn mt-3" type="submit">Login</button>
        </form>
        <div class="text-center fs-6 forFooter">
            <!-- <a href="#">Forget password?</a> or <a href="#">Sign up</a> -->
            <a href="index.html">Built with <span>&hearts;</span> by DIE Art'S Production 2023</a>
        </div>
    </div>
</body>

</html>