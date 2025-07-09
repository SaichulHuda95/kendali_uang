<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="text-title">Rekap Bulanan</h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-glass">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-sm table-glass glass" id="tbl-rekap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bulan / Tahun</th>
                                    <th>Total Pemasukan</th>
                                    <th>Total Pengeluaran</th>
                                    <th>Sisa Saldo</th>
                                    <th>Jumlah Transaksi</th>
                                    <th>Aksi</th>
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
<!-- END content -->
<?= $this->endSection(); ?>