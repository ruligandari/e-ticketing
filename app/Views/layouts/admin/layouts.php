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
    <link rel="stylesheet" href="<?= base_url() ?>/admin/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/admin/modules/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/admin/modules/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/admin/modules/summernote/summernote-bs4.css">

    <?= $this->renderSection('header'); ?>

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
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>

                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>admin/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Admin</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">E-Ticketing</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">ET</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="dropdown <?= ($title == 'Dashboard' ? 'active' : '') ?>">
                            <a href="<?= base_url('dashboard') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Tiket</li>
                        <li class="dropdown <?= ($title == 'Scan Tiket' ? 'active' : '') ?>">
                            <a href="<?= base_url('dashboard/scan-tiket') ?>" class="nav-link"><i class="fas fa-qrcode"></i> <span>Scan Tiket</span></a>
                        </li>
                        <li class="dropdown <?= ($title == 'Kelola Tiket' ? 'active' : '') ?>">
                            <a href="<?= base_url('dashboard/kelola-tiket'); ?>" class="nav-link"><i class="fas fa-cog"></i> <span>Kelola Tiket</span></a>
                        </li>
                        <li class="dropdown <?= ($title == 'Buat Tiket' ? 'active' : '') ?>">
                            <a href="<?= base_url('dashboard/buat-tiket') ?>" class="nav-link"><i class="fas fa-ticket-alt"></i> <span>Buat Tiket</span></a>
                        </li>
                        <li class="dropdown <?= ($title == 'Pemesanan Tiket' ? 'active' : '') ?>">
                            <a href="<?= base_url('dashboard/pemesanan-tiket') ?>" class="nav-link"><i class="fas fa-cart-plus"></i> <span>Pemesanan Tiket</span></a>
                        </li>
                        <li class="menu-header">Informasi</li>
                        <li class="dropdown <?= ($title == 'Artikel' ? 'active' : '') ?>">
                            <a href="#" class="nav-link"><i class="fas fa-newspaper"></i> <span>Artikel</span></a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <?= $this->renderSection('content'); ?>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?= date('Y') ?> <div class="bullet"></div>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
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
    <script src="<?= base_url() ?>/admin/modules/simple-weather/jquery.simpleWeather.min.js"></script>
    <script src="<?= base_url() ?>/admin/modules/chart.min.js"></script>
    <script src="<?= base_url() ?>/admin/modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="<?= base_url() ?>/admin/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?= base_url() ?>/admin/modules/summernote/summernote-bs4.js"></script>
    <script src="<?= base_url() ?>/admin/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <?= $this->renderSection('script'); ?>

    <!-- Page Specific JS File -->
    <script src="<?= base_url() ?>/admin/js/page/index-0.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/admin/js/scripts.js"></script>
    <script src="<?= base_url() ?>/admin/js/custom.js"></script>
</body>

</html>