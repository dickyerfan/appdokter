<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Drg | <?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- select2 bootstrap5 -->
    <!-- Styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/select2.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2/select2-bootstrap-5-theme.min.css" />

    <link href="<?= base_url(); ?>assets/datatables/bootstrap5/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/datatables/bootstrap5/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        .judul {
            display: none;
        }

        @media print {

            .header,
            .navbar1 {
                display: none;
            }

            .logo {
                display: none;
            }

            .title {
                text-align: center;
            }

            .font {
                font-size: 0.8rem;
            }

            .judul {
                display: block;
            }
        }

        @media (max-width:460px) {
            .card1 {
                /* height:300px !important; */
                font-size: 0.8em !important;
            }
        }

        .cardEffect:hover {
            transition: transform 0.5s;
            box-shadow: 2px 2px 10px rgb(0, 0, 0);
            transform: scale(1.1);
        }

        @media (min-width: 992px) {
            .judulPraktek {
                font-size: 0.9rem;
            }
        }

        @media (min-width: 1400px) {
            .judulPraktek {
                font-size: 1.5rem;
            }
        }

        .kecilinFont {
            font-size: 0.7rem;
        }
    </style>

</head>

<body class="sb-nav-fixed">