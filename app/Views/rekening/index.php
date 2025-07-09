<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="text-title">Daftar Rekening</h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-glass">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-sm table-glass glass" id="tbl-rekening" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Rekening</th>
                                    <th>Total Pemasukan</th>
                                    <th>Total Pengeluaran</th>
                                    <th>Sisa Saldo</th>
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