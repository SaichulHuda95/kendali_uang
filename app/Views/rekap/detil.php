<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>/rekap">Daftar Rekap</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Rekap Bulanan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <h3 class="text-title">Masa: <?= $bulan ?></h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-glass">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-sm table-glass glass" id="tbl-detil-rekap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu Transaksi</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Rekening</th>
                                    <th>Jumlah</th>
                                    <th>Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let bulan = "<?= $bulan_num ?>";
        let tahun = "<?= $tahun ?>";

        $('#tbl-detil-rekap').DataTable({
            responsive: true,
            processing: true,
            ajax: {
                url: BASE_URL + "/rekap/get_detil_rekap",
                type: "POST",
                data: {
                    bulan: bulan,
                    tahun: tahun
                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "waktu_transaksi"
                },
                {
                    data: "judul"
                },
                {
                    data: "kategori"
                },
                {
                    data: "rekening"
                },
                {
                    data: "jumlah"
                },
                {
                    data: "desc"
                },
            ]
        });
    });
</script>
<!-- END content -->
<?= $this->endSection(); ?>