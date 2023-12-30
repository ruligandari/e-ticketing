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
                                        <td>No Tiket</td>
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
                                <div class="alert alert-success mt-3" role="alert">
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


    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`);
        // ajax untuk mengirim decodedText ke controller
        $.ajax({
            type: 'POST',
            url: '<?= base_url('dashboard/scan-tiket') ?>',
            data: {
                no_tiket: decodedText
            },
            success: function(response) {
                console.log(response.status)
                if (response.status == 'success') {
                    enkripsi.innerHTML = decodedText;
                    tglPembelian.innerHTML = response.data.tgl_pembelian;
                    noTiket.innerHTML = response.data.no_tiket;
                    tglReservasi.innerHTML = response.data.tgl_reservasi;
                    statusPemesanan.innerHTML = response.data.status_pemesanan;
                    jenisTiket.innerHTML = response.data.jenis_tiket;
                    qty.innerHTML = response.data.qty;
                    hargaTotal.innerHTML = response.data.harga_total;
                    berhasil.innerHTML = "Tiket Valid";
                } else {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Nomor Tiket Tidak Ditemukan.",
                        icon: "error"
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle kesalahan Ajax (jika diperlukan)
                console.error(xhr.responseText);
            }
        })

    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 250,
        }, {
            facingMode: "environment",
            // single shoot
            delay: 10000,
        });

    html5QrcodeScanner.render(onScanSuccess);

    $(document).ready(function() {
        $('.delete').on('click', function() {
            var id = $(this).data('id')
            Swal.fire({
                title: "Apakah Pembayaran Sudah Valid?",
                text: "Anda tidak dapat mengulangi Konfirmasi!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Konfirmasi",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('dashboard/pemesanan-tiket') ?>',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            console.log(response.status)
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Pembayaran Telah di Konfirmasi",
                                icon: "success"
                            }).then(() => location.reload());
                        },
                        error: function(xhr, status, error) {
                            // Handle kesalahan Ajax (jika diperlukan)
                            console.error(xhr.responseText);
                        }
                    })
                }
            });
        })
    });
</script>
<?= $this->endSection(); ?>