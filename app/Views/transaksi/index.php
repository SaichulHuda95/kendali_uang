<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="text-title">Transaksi Harian</h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-glass shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-4">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tambah Transaksi
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="tambah_transaksi('2')">Pengeluaran</a></li>
                                <li><a class="dropdown-item" href="#" onclick="tambah_transaksi('1')">Pemasukan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-sm table-glass glass" id="tbl-transaksi" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu Transaksi</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Rekening</th>
                                    <th>Jumlah</th>
                                    <th>Ket</th>
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