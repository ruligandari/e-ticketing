<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>

<style>
    @media print {
        @page {
            size: 58mm auto;
            /* Lebar x Tinggi untuk kertas termal 55mm */
            margin: 0;
            padding: 0;

        }

        body {
            width: 58mm;
            height: auto;
        }

        table {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        h4,
        h5 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .header-wisata {
            margin-top: 0px;
            margin-bottom: 10px;
        }

        /* Tambahkan gaya CSS tambahan sesuai kebutuhan */
    }
</style>

<body>
    <?php
    helper('base64');
    helper('qrcode');
    ?>
    <center>

        <h4>TIKET MASUK</h4>
        <h5 class="header-wisata">Wisata Tirta Sumber Jaya Cipangalun</h5>
        <?= generateQrcode(enkripsi($tiket['no_tiket']), 100) ?>
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
        <h5>Terima Kasih Atas Kunjunganya</h5>
        <h5>Di Wisata Tirta Sumber Jaya Cipangalun</h5>

    </center>

    <script>
        // Fungsi ini akan dipanggil otomatis setelah halaman dimuat
        window.onload = function() {
            window.print(); // Memanggil fungsi cetak otomatis
        };
        window.onafterprint = function() {
            window.close(); // Menutup halaman setelah mencetak atau tombol "Cancel" ditekan
        };
    </script>
</body>

</html>