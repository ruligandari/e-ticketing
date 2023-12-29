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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('success') ?>',
        }).then((result) => {
            window.location.href = "<?= base_url('user/riwayat') ?>";
        });
    </script>
<?php endif ?>
<div class="section mt-4">
    <div class="card">
        <div class="card-body">
            <p class="text-success">Pemesanan Tiket Berhasil, Silahkan Melakukan Transfer ke Bank berikut:</p>
            <p class="text-bold">BRI : 34532323232323</p>
            <p class="text-bold">BCA : 34532323232323</p>
            <p class="text-bold">Admin Kami Akan melakukan validasi paling lambat 1x24 jam, status pembelian bisa dibuka pada menu histori</p>
            <form action="<?= base_url('user/pesan-tiket/update') ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="id" value="<?= $dataTiket['id'] ?>" hidden>
                <input type="text" name="no_tiket" value="<?= $dataTiket['no_tiket'] ?>" hidden>
                <div class="custom-file-upload">
                    <input type="file" id="fileuploadInput" name="bukti_pembayaran" accept=".png, .jpg, .jpeg" required>
                    <label for="fileuploadInput">
                        <span>
                            <strong>
                                <ion-icon name="cloud-upload-outline"></ion-icon>
                                <i>Upload Bukti Pembayaran</i>
                            </strong>
                        </span>
                    </label>
                </div>
                <div class="form-button-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Konfirmasi Pembayaran</button>
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