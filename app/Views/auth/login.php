<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap-5.3.7/css/bootstrap.min.css">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap-icons/bootstrap-icons.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.css">
    <!-- my css -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/mycss.css">
    <!-- Jquery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <style>
        body {
            background: url("<?= base_url() ?>/assets/img/bg.png") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            overflow-x: hidden;
        }
    </style>
</head>

<body>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card card-glass" style="border-radius: 20px;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-3 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="mb-5">Please enter your username and password!</p>
                                <div id="flashsuccess" data-flash="<?= session()->getFlashdata('success'); ?>"></div>
                                <div id="flasherror" data-flash="<?= session()->getFlashdata('error'); ?>"></div>
                                <form action="<?= base_url() ?>/login/login" method="post">
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control form-control-lg glass <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username'); ?>
                                        </div>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control form-control-lg glass <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>

                                    <p class="small mb-5 pb-lg-2"><a class="-50" href="#!">Forgot password?</a></p>

                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg px-5 border" type="submit">Login</button>
                                </form>

                            </div>

                            <div>
                                <p class="mb-0">Don't have an account? <a href="<?= base_url() ?>/register" class="fw-bold">Sign Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url() ?>/assets/bootstrap-5.3.7/js/bootstrap.min.js"></script>
    <!-- SweetAlert -->
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- my js -->
    <script src="<?= base_url() ?>/assets/js/myjs.js"></script>
</body>

</html>