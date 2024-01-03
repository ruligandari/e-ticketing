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
    <div class="blog-post">
        <div class="mb-2">
            <img src="<?= base_url('uploads/artikel/' . $artikel['gambar']) ?>" alt="image" class="imaged square w-100">
        </div>
        <h3 class="title"><?= $artikel['judul'] ?></h3>

        <div class="post-header">
            <div>
                <a href="#">
                    Admin
                </a>
            </div>
            <?= $artikel['tanggal'] ?>
        </div>
        <div class="post-body">
            <?= $artikel['isi'] ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>