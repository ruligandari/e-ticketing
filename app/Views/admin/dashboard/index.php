<?= $this->extend('layouts/admin/layouts'); ?>

<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pengunjung</h4>
                        </div>
                        <div class="card-body">
                            <?= $totalPengunjung ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Penjualan Tiket</h4>
                        </div>
                        <div class="card-body">
                            <?= $totalTiket ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pendapatan</h4>
                        </div>
                        <div class="card-body">
                            Rp. <?= number_format($totalPendapatan, 0, ',', '.') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Haloo, <?= session()->get('nama') ?></h4>
                    </div>
                    <div class="card-body">
                        <!-- alert -->

                        <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading">Selamat Datang!</h4>
                            <p>Selamat datang di halaman dashboard, anda dapat melihat data penjualan tiket dan data pengunjung.</p>
                            <hr>
                            <p class="mb-0"> Anda bisa membuat tiket secara langsung, dan melakukan scan tiket untuk pembelian tiket via aplikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>