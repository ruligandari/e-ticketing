<?= $this->extend('layouts/admin/layouts'); ?>

<?= $this->section('header'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('logout') ?>";
                }
            })
        </script>
    <?php endif; ?>
    <!-- error -->
    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire({
                title: "Gagal!",
                text: '<?= session()->getFlashdata('error') ?>',
                icon: "error"
            });
        </script>
    <?php endif; ?>
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan Akun</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan Akun</h4>
                    </div>
                    <div class="card-body">
                        <!-- form menampilkan informasi admin -->
                        <form action="<?= base_url('dashboard/setting') ?>" method="post">
                            <div class="form-group
                                    ">
                                <label for="min">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
                            </div>
                            <div class="form-group
                                    ">
                                <label for="min">Username</label>
                                <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>" required>
                            </div>
                            <div class="form-group
                                    ">
                                <label for="max">Password Baru</label>
                                <input type="password" class="form-control" name="password1" required>
                            </div>

                            <div class="form-group
                                    ">
                                <label for="max">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" name="password2" required>
                            </div>
                            <!-- button simpan perubahan -->
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- ambil tabel dengan id table-1 -->
<script>
    $(document).ready(function() {
        let minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        DataTable.ext.search.push(function(settings, data, dataIndex) {
            let min = minDate.val();
            let max = maxDate.val();
            let date = new Date(data[3]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        });

        // Create date inputs
        minDate = new DateTime('#min', {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime('#max', {
            format: 'MMMM Do YYYY'
        });
        var table = $('#table-1').DataTable({
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Laporan Penjualan Tiket - ' + moment().format('MMMM Do YYYY') + '',
                    footer: true
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    title: 'Laporan Penjualan Tiket - ' + moment().format('MMMM Do YYYY') + '',
                    footer: true
                },

            ],

        });

        // Refilter the table
        document.querySelectorAll('#min, #max').forEach((el) => {
            el.addEventListener('change', () => table.draw());
        });


    });
</script>

<?= $this->endSection(); ?>