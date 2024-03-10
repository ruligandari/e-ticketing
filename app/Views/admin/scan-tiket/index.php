<?= $this->extend('layouts/admin/layouts'); ?>

<?= $this->section('header'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/admin/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/admin/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="main-content">
    <!-- sweet alert -->

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: '<?= session()->getFlashdata('success') ?>',
                icon: "success"
            });
        </script>
    <?php endif; ?>
    <section class="section">
        <div class="section-header">
            <h1>Scan Tiket</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Scan Tiket</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="reader" style="height: 500px; width:500px;"></div>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="text-dark">Hasil Scan Tiket:</h5>
                                <table>
                                    <tr>
                                        <td>Enkripsi</td>
                                        <td>:</td>
                                        <td><span id="enkripsi"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Tiket</td>
                                        <td>:</td>
                                        <td><span id="no_tiket"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Pembelian</td>
                                        <td>:</td>
                                        <td><span id="tgl_pembelian"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Reservasi</td>
                                        <td>:</td>
                                        <td><span id="tgl_reservasi"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Status Pemesanan</td>
                                        <td>:</td>
                                        <td><span id="status_pemesanan"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Tiket</td>
                                        <td>:</td>
                                        <td><span id="jenis_tiket"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Qty</td>
                                        <td>:</td>
                                        <td><span id="qty"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Total</td>
                                        <td>:</td>
                                        <td><span id="harga_total"></span></td>
                                    </tr>
                                </table>
                                <div id="alert-scan" role="alert">
                                    <center>
                                        <h6 class="alert-heading" id="berhasil"></h6>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url() ?>/admin/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url() ?>/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?= base_url() ?>/admin/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url() ?>/admin/js/page/modules-datatables.js"></script>

<script>
    var enkripsi = document.getElementById('enkripsi');
    var noTiket = document.getElementById('no_tiket');
    var tglPembelian = document.getElementById('tgl_pembelian');
    var tglReservasi = document.getElementById('tgl_reservasi');
    var statusPemesanan = document.getElementById('status_pemesanan');
    var jenisTiket = document.getElementById('jenis_tiket');
    var qty = document.getElementById('qty');
    var hargaTotal = document.getElementById('harga_total');
    var berhasil = document.getElementById('berhasil');
    var alert = document.getElementById('alert-scan');


    var isScanned = false; // Variable untuk memeriksa apakah pemindaian sudah dilakukan

    function onScanSuccess(decodedText, decodedResult) {
        if (!isScanned) {
            isScanned = true; // Setel bahwa pemindaian sudah dilakukan

            console.log(`Scan result: ${decodedText}`);

            $.ajax({
                type: 'POST',
                url: '<?= base_url('dashboard/scan-tiket') ?>',
                data: {
                    no_tiket: decodedText
                },
                success: function(response) {
                    console.log(response.status);
                    if (response.status === 'success') {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Tiket Valid",
                            icon: "success"
                        });
                        enkripsi.innerHTML = decodedText;
                        tglPembelian.innerHTML = response.data.tgl_pembelian;
                        noTiket.innerHTML = response.data.no_tiket;
                        tglReservasi.innerHTML = response.data.tgl_reservasi;
                        statusPemesanan.innerHTML = response.data.status_pemesanan;
                        jenisTiket.innerHTML = response.data.jenis_tiket;
                        qty.innerHTML = response.data.qty;
                        hargaTotal.innerHTML = response.data.harga_total;
                        berhasil.innerHTML = "Tiket Valid";
                        // berhasil ganti class menjadi alert-danger
                        alert.classList.add("alert", "alert-success", "mt-3");

                        // Setelah menampilkan hasil, atur timeout untuk memungkinkan pemindaian berikutnya setelah 3 detik
                        setTimeout(function() {
                            isScanned = false; // Setelah 3 detik, izinkan pemindaian berikutnya
                        }, 1000);
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: response.message,
                            icon: "error"
                        });

                        enkripsi.innerHTML = decodedText;
                        tglPembelian.innerHTML = '';
                        noTiket.innerHTML = '';
                        tglReservasi.innerHTML = '';
                        statusPemesanan.innerHTML = '';
                        jenisTiket.innerHTML = '';
                        qty.innerHTML = '';
                        hargaTotal.innerHTML = '';
                        berhasil.innerHTML = "Tiket Tidak Valid";
                        alert.classList.add("alert", "alert-danger", "mt-3");


                        // Setelah menampilkan pesan kesalahan, atur timeout untuk memungkinkan pemindaian berikutnya setelah 3 detik
                        setTimeout(function() {
                            isScanned = false; // Setelah 3 detik, izinkan pemindaian berikutnya
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    Swal.fire({
                        title: "Gagal!",
                        text: "Terjadi kesalahan saat memproses data.",
                        icon: "error"
                    });

                    // Setelah menampilkan pesan kesalahan, atur timeout untuk memungkinkan pemindaian berikutnya setelah 3 detik
                    setTimeout(function() {
                        isScanned = false; // Setelah 3 detik, izinkan pemindaian berikutnya
                    }, 3000);
                }
            });
        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 250,
        }, {
            facingMode: "user",
            formatsToSupport: ["QR_CODE"],
        });

    html5QrcodeScanner.render(onScanSuccess);
</script>
<?= $this->endSection(); ?>