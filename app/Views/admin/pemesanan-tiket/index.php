<?= $this->extend('layouts/admin/layouts'); ?>

<?= $this->section('header'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/admin/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/admin/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1>Pemesanan Tiket</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pemesanan Tiket Melalui Aplikasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No
                                        </th>
                                        <th>No Tiket</th>
                                        <th>Jenis Tiket</th>
                                        <th>Tgl Pembelian</th>
                                        <th>Harga Total(Rp)</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    helper('base64');
                                    helper('qrcode');
                                    $no = 1;
                                    foreach ($buatTiket as $item) :
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $item['no_tiket'] ?></td>
                                            <td><?= $item['jenis_tiket'] ?></td>
                                            <td><?= date('d-m-Y H:i:s', strtotime($item['tgl_pembelian'])) ?></td>
                                            <td><?= number_format($item['harga_total'], 0, ',', '.') ?></td>
                                            <td>
                                                <a href="<?= base_url('uploads/bukti-pembayaran/' . $item['upload_bukti']) ?>" target="_blank" rel="noopener noreferrer">
                                                    <img src="<?= base_url('uploads/bukti-pembayaran/' . $item['upload_bukti']) ?>" style="height: 100px; width:50px;">
                                                </a>
                                            </td>
                                            <td><?= $item['status_pemesanan'] ?></td>
                                            <td><button class="btn btn-primary delete" data-id="<?= $item['id'] ?>" <?= ($item['status_pemesanan'] == 'Valid') ? 'disabled' : '' ?>>Konfirmasi Pembayaran</button>
                                            </td>
                                        </tr>

                                    <?php endforeach ?>
                                </tbody>
                            </table>
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