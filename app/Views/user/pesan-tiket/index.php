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
    <div class="card">
        <div class="card-body">
            <p class="card-text">Silahkan pilih tanggal kunjungan untuk ketersediaan tiket.</p>
            <form action="<?= base_url('user/pesan-tiket') ?>" method="post">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Tanggal Kunjungan</label>
                        <input type="datetime-local" class="form-control" name="tanggal" id="tanggal" placeholder="Masukan Tanggal Kunjungan">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Tiket Tersedia</label>
                        <input type="text" class="form-control" name="tiket" id="tiket" placeholder="Belum Tersedia" readonly>
                        <input type="hidden" class="form-control" name="id_tiket" id="id_tiket" placeholder="Belum Tersedia">
                        <input type="hidden" class="form-control" name="id_pengunjung" value="<?= session()->get('id') ?>" id="id_tiket" placeholder="Belum Tersedia">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Belum Tersedia" readonly>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Jumlah Tiket</label>
                        <input type="number" class="form-control" name="jumlah" id="name5" placeholder="Masukan Jumlah Tiket" required>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
                <div class="form-button-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Pesan Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $('#tanggal').on('input', function() {
        // Mendapatkan nilai tanggal dari elemen input
        var tanggalValue = $(this).val();

        // Mengecek apakah tanggal telah dimasukkan
        if (tanggalValue) {
            // Mengirim nilai tanggal ke server menggunakan jQuery AJAX
            $.ajax({
                type: 'POST',
                url: '<?= base_url('user/pesan-tiket/cek') ?>',
                data: {
                    tanggal: tanggalValue
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    // Menampilkan inputan baru dengan nilai dari server
                    document.getElementById('tiket').value = data.dataTiket[0]['nama'];
                    //  ubah data.dataTiket[0]['harga'] ke int
                    var Harga = parseInt(data.dataTiket[0]['harga']);
                    // ubah data.dataTiket[0]['harga'] menjadi dari 30000 menjadi 30.000
                    var formatted = Harga.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0,
                        useGrouping: true
                    });

                    console.log(formatted);
                    document.getElementById('harga').value = formatted;
                    document.getElementById('id_tiket').value = data.dataTiket[0]['id'];
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengirim data.');
                }
            });
        } else {
            // Handle jika tanggal kosong (opsional)
            $('#hasil').html('');
        }
    });
</script>
<?= $this->endSection(); ?>