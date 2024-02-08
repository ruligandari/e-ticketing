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
    <div class="listview-title mt-2">Profile</div>
    <ul class="listview image-listview">
        <li>
            <div class="item">
                <!-- <img src="assets/img/sample/avatar/avatar3.jpg" alt="image" class="image"> -->
                <div class="in">
                    <div><?= session()->get('nama') ?></div>
                </div>
            </div>
        </li>
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        <header>Email</header>
                        <div><?= session()->get('email') ?></div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        <!-- logout -->
                        <a href="<?= base_url('user/logout') ?>" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
<?= $this->endSection(); ?>