<?= $this->extend('layouts/user/layouts'); ?>

<?= $this->section('content'); ?>
<div class="section" id="user-section">
    <div id="user-detail">
        <div id="user-info">
            <h2 id="user-name">Selamat Datang </h2>
            <span id="user-role"><?= session()->get('nama') ?></span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="green" style="font-size: 40px;">
                            <ion-icon name="person-sharp"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="danger" style="font-size: 40px;">
                            <ion-icon name="ticket-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Tiket</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="<?= base_url('user/riwayat') ?>" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Riwayat</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="orange" style="font-size: 40px;">
                            <ion-icon name="information-circle-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        info Aplikasi
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <h3>Informasi</h3>
        <div class="card mb-3">
            <img src="<?= base_url() ?>/assets/img/sample/photo/wide4.jpg" class="card-img-top" alt="image">
            <div class="card-body">
                <h6 class="card-subtitle">Informasi</h6>
                <h5 class="card-title">Waterbook Ciamis</h5>
                <p class="card-text">
                    Waterboom Terbaik di Indonesia
                </p>
                <a href="app-components.html" class="btn btn-primary">
                    Lihat Selengkapnya
                </a>
            </div>
        </div>

    </div>

    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <!-- <a href="#" class="item">
            <div class="col">
                <ion-icon name="file-tray-full-outline" role="img" class="md hydrated" aria-label="file tray full outline"></ion-icon>
                <strong>Today</strong>
            </div>
        </a> -->
        <a href="#" class="item active">
            <div class="col">
                <ion-icon name="home-outline" role="img" class="md hydrated" aria-label="calendar outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="<?= base_url('user/pesan-tiket') ?>" class="item">
            <div class="col">
                <div class="action-button large">
                    <ion-icon name="ticket-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
                </div>
            </div>
        </a>
        <!-- <a href="#" class="item">
            <div class="col">
                <ion-icon name="document-text-outline" role="img" class="md hydrated" aria-label="document text outline"></ion-icon>
                <strong>Docs</strong>
            </div>
        </a> -->
        <a href="javascript:;" class="item">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->
</div>
<?= $this->endSection(); ?>