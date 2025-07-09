<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">

    <!-- CSS & Plugin -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap-5.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/flatpickr/dist/css/flatpickr.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/mycss.css">
    <!-- jquery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

    <style>
        body {
            background: url("<?= base_url() ?>/assets/img/bg.png") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            overflow-x: hidden;
        }
    </style>
</head>

<body class="body-layout">

    <!-- Header di luar .container -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light nav-glass fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="<?= base_url() ?>/assets/img/favicon.png" alt="Logo" height="40">
                    <span class="brand-text">Kendali Uang</span>
                </a>

                <button class="navbar-toggler card-glass" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/transaksi">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/rekening">Rekening</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/rekap">Rekap</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Hi, <?= session()->get('username') ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?= base_url() ?>/pengaturan">Pengaturan Aplikasi</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger logout" href="<?= base_url() ?>/login/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div id="flashsuccess" data-flash="<?= session()->getFlashdata('success'); ?>"></div>
        <div id="flasherror" data-flash="<?= session()->getFlashdata('error'); ?>"></div>
        <div class="container mt-3">
            <?= $this->renderSection('content'); ?>
        </div>
    </main>

    <footer class="footer-glass text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">

                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase fw-bold brand-text"><img src="<?= base_url() ?>/assets/img/favicon.png" alt="Logo" height="40"> Kendali Uang</h5>
                    <p>
                        Aplikasi pencatatan pemasukan & pengeluaran harian yang membantu kamu mengelola keuangan secara lebih cerdas dan sederhana.
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Menu</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="<?= base_url() ?>" class="text-reset text-decoration-none">Home</a></li>
                        <li><a href="<?= base_url() ?>/transaksi" class="text-reset text-decoration-none">Transaksi</a></li>
                        <li><a href="<?= base_url() ?>/rekening" class="text-reset text-decoration-none">Rekening</a></li>
                        <li><a href="<?= base_url() ?>/rekap" class="text-reset text-decoration-none">Rekap</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-envelope me-2"></i> saichulhuda1995@gmail.com</li>
                        <li><i class="bi bi-instagram me-2"></i> @saichul_huda</li>
                        <li><i class="bi bi-whatsapp me-2"></i> +62 822 3482 7253</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="text-center p-3 border-top border-light">
            © 2025 - <?= date('Y') ?> Kendali Uang — All rights reserved.
        </div>
    </footer>
    <!-- modal -->
    <div class="viewmodal"></div>
    <!-- JS Libraries -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="<?= base_url() ?>/assets/bootstrap-5.3.7/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/jszip/dist/jszip.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/flatpickr/dist/js/flatpickr.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/autoNumeric/autoNumeric-2.0.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/chart.js/dist/chart.min.js"></script>
    <script>
        const BASE_URL = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url() ?>/assets/js/myjs.js"></script>
</body>

</html>