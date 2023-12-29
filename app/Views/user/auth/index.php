<?= $this->extend('layouts/user/layouts'); ?>

<?= $this->section('content'); ?>
<div class="login-form mt-1">
    <div class="section">
        <img src="<?= base_url() ?>/assets/img/sample/photo/vector4.png" alt="image" class="form-image">
    </div>
    <div class="section mt-1">
        <h1>Selamat Datang!</h1>
        <h4>Silahkan Email dan Password anda</h4>
    </div>
    <div class="section mt-1 mb-5">
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger mb-1" role="alert">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('user/login') ?>" method="post">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="email" class="form-control" name="email" id="email1" placeholder="Email address">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>

            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="password" class="form-control" name="password" id="password1" placeholder="Password">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>

            <div class="form-links mt-2">
                <div>
                    <a href="<?= base_url('user/register') ?>">Registrasi</a>
                </div>
            </div>
            <div class="form-button-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
            </div>

        </form>
    </div>
</div>
<?= $this->endSection(); ?>