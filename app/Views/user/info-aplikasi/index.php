<?= $this->extend('layouts/user/layouts'); ?>

<?= $this->section('navigation'); ?>
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle"><?= $title ?></div>
</div>
<br><br>
<!-- * App Header -->
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="section mt-4">
    <div class="listview-title mt-2">Info Aplikasi</div>
    <div class="accordion" id="accordionExample3">
        <div class="item">
            <div class="accordion-header">
                <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#accordion001">
                    <ion-icon name="code-working-outline"></ion-icon>
                    Info Developer
                </button>
            </div>
            <div id="accordion001" class="accordion-body collapse  " data-parent="#accordionExample3">
                <div class="accordion-content">
                    Nama : Yoga Apriansyah <br>
                    NIM : 20180810021 <br>
                    Prodi : Teknik Informatika<br>
                    Fakultas : Fakultas Ilmu Komputer<br>
                    Universitas : Universitas Kuningan
                </div>
            </div>
        </div>

        <div class="item">
            <div class="accordion-header">
                <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#accordion002">
                    <ion-icon name="ticket-outline"></ion-icon>
                    Pemesanan Tiket
                </button>
            </div>
            <div id="accordion002" class="accordion-body collapse" data-parent="#accordionExample3">
                <div class="accordion-content">
                    1. Pilih Menu Pesan Tiket <br>
                    2. Pilih Tiket dengan tanggal kunjungan yang ingin dipesan <br>
                    3. Pilih jumlah tiket yang ingin dipesan <br>
                    4. Klik tombol pesan tiket <br>
                    5. Lakukan pembayaran dengan nomor rekening yang tertera <br>
                </div>
            </div>
        </div>

        <div class="item">
            <div class="accordion-header">
                <button class="btn" type="button" data-toggle="collapse" data-target="#accordion003">
                    <ion-icon name="wallet-outline"></ion-icon>
                    Konfirmasi Pembayaran
                </button>
            </div>
            <div id="accordion003" class="accordion-body collapse" data-parent="#accordionExample3">
                <div class="accordion-content">
                    1. Upload bukti pembayaran ke form yang disediakan<br>
                    2. Tunggu konfirmasi dari admin<br>
                    3. Jika sudah dikonfirmasi, tiket akan muncul di menu riwayat<br>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>