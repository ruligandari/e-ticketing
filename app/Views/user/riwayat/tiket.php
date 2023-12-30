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
    <?php
    helper('qrcode');
    helper('base64');
    ?>
    <center>
        <h4>TIKET MASUK</h4>
        <h5 class="header-wisata">Wisata Tirta Sumber Jaya Cipangalun</h5>
        <?= generateQrcode(enkripsi($tiket['no_tiket']), 200) ?>
        <hr>
        <table class="font">
            <tr>
                <td>No Tiket</td>
                <td>:</td>
                <td><?= $tiket['no_tiket'] ?></td>
            </tr>
            <tr>
                <td>Jenis Tiket</td>
                <td>:</td>
                <td><?= $tiket['jenis_tiket'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Pembelian</td>
                <td>:</td>
                <td><?= $tiket['tgl_pembelian'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Reservasi</td>
                <td>:</td>
                <td><?= $tiket['tgl_reservasi'] ?></td>
            </tr>
            <tr>
                <td>Qty</td>
                <td>:</td>
                <td><?= $tiket['qty'] ?></td>
            </tr>
            <tr>
                <td>Harga Total</td>
                <td>:</td>
                <td>Rp. <?= number_format($tiket['harga_total'], 0, ',', '.') ?></td>
            </tr>
        </table>
        <hr>
        <h5>Tunjukan tiket ini ke loket</h5>
    </center>
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