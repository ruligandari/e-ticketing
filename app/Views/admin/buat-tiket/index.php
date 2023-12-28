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
            <h1>Buat Tiket</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Buat Tiket </h4>
                        <div class="card-header-action">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">+ Buat Tiket</button>
                        </div>
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
                                        <th>Qrcode</th>
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
                                            <td><?=
                                                generateQrcode(enkripsi($item['no_tiket'])) ?></td>
                                            <td>
                                                <a href="<?= base_url('dashboard/cetak-tiket/' . $item['id']) ?>" target="_blank" class="btn btn-primary">Cetak</a>
                                                <button class="btn btn-danger delete" data-id="<?= $item['id'] ?>">Hapus</button>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="tambahModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Tiket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('dashboard/buat-tiket') ?>" method="post">
                        <div class="form-group">
                            <label>Tiket Tersedia</label>
                            <input type="hidden" id="harga" name="harga" value="<?= $tiket['harga'] ?>">
                            <input type="hidden" id="jenis_tiket" name="jenis_tiket" value="<?= $tiket['nama'] ?>">
                            <span class="form-control"><?= $tiket['nama'] ?> - Rp. <?= number_format($tiket['harga'], 0, '.', ',') ?>,-</span>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" name="tgl_pembelian" value="<?= $tanggal ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Pengunjung</label>
                            <input type="number" name="qty" id="pengunjung" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Harga Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp.
                                    </div>
                                </div>
                                <input type="text" name="harga_total" id="totalHarga" class="form-control" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                title: "Apakah Anda Yakin?",
                text: "Anda tidak dapat mengembalikan data ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('dashboard/hapus-buat-tiket') ?>',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            console.log(response.status)
                            Swal.fire({
                                title: "Terhapus!",
                                text: "Data telah dihapus.",
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

    document.getElementById('pengunjung').addEventListener('input', updateTotalHarga);

    function updateTotalHarga() {
        var harga = document.getElementById('harga').value;
        var pengunjung = document.getElementById('pengunjung').value;

        // kalikan
        var totalHarga = harga * pengunjung;

        // Format nilai sebagai mata uang (misalnya, IDR)
        var formattedTotalHarga = totalHarga.toLocaleString('id-ID', {
            maximumFractionDigits: 0
        });

        // masukkan ke value pada elemen input dengan id totalHarga
        document.getElementById('totalHarga').value = formattedTotalHarga;
    }
</script>
<?= $this->endSection(); ?>