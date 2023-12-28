<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/admin/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/admin/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="a<?= base_url() ?>/sdminmodules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/admin/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/admin/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login Untuk Masuk</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="<?= base_url('login') ?>" class="needs-validation" novalidate="">
                                    <!-- alert -->
                                    <?php if (session()->getFlashdata('error')) : ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= session()->getFlashdata('error') ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    <?php endif ?>
                                    <div class="form-group">
                                        <label for="email">Username</label>
                                        <input id="email" type="text" name="username" placeholder="Masukan Username" class="form-control" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Masukan Usename Anda
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input id="password" type="password" name="password" placeholder="Masukan Password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Masukan Password
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/admin/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>/admin/modules/popper.js"></script>
    <script src="<?= base_url() ?>/admin/modules/tooltip.js"></script>
    <script src="<?= base_url() ?>/admin/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/admin/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/admin/modules/moment.min.js"></script>
    <script src="<?= base_url() ?>/admin/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/admin/js/scripts.js"></script>
    <script src="<?= base_url() ?>/admin/js/custom.js"></script>
</body>

</html>