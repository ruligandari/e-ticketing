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
            <h1>Informasi</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url('dashboard/artikel/tambah') ?>" class="btn btn-primary">+ Tambah Artikel</a>
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
                                        <th>Tanggal</th>
                                        <th>Judul</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($dataArtikel as $item) :
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $item['tanggal'] ?></td>
                                            <td><?= $item['judul'] ?></td>
                                            <td>
                                                <a href="<?= base_url('dashboard/artikel/show/' . $item['id']) ?>" class="btn btn-primary">Edit</a>
                                                <button class="btn btn-danger delete" data-id="<?= $item['id'] ?>">Delete</button>
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
                title: "Apakah Anda Yakin?",
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
                        url: '<?= base_url('dashboard/delete-artikel') ?>',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            console.log(response.status)
                            Swal.fire({
                                title: "Berhasil!",
                                text: response.messages,
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