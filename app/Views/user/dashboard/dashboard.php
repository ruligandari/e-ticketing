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
                        <a href="<?= base_url('user/profile') ?>" class="green" style="font-size: 40px;">
                            <ion-icon name="person-sharp"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="<?= base_url('user/pesan-tiket') ?>" class="danger" style="font-size: 40px;">
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
                        <a href="<?= base_url('user/info-aplikasi') ?>" class="orange" style="font-size: 40px;">
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
        <div class="section full mt-3 mb-3">
            <div class="carousel-slider owl-carousel owl-theme">
                <?php foreach ($artikel as $item) : ?>
                    <div class="item">
                        <a href="<?= base_url('user/blog/' . $item['slug']) ?>">
                            <div class="card">
                                <img src="<?= base_url('uploads/artikel/' . $item['gambar']) ?>" class="card-img-top" alt="image">
                                <div class="card-body pt-2">
                                    <h5 class="mb-0"><?= $item['judul'] ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
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
        <a href="<?= base_url('user/dashboard') ?>" class="item active">
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
        <a href="<?= base_url('user/profile') ?>" class="item">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->
</div>
<?= $this->endSection(); ?>