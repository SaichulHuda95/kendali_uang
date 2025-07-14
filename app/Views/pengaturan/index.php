<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="text-title">Pengaturan Aplikasi</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="list-group card-glass shadow-sm">
            <a href="<?= base_url() ?>/pengaturan/data_kat_pemasukan" class="list-group-item list-group-item-action list-glass">Kategori Pemasukan</a>
            <a href="<?= base_url() ?>/pengaturan/data_kat_pengeluaran" class="list-group-item list-group-item-action list-glass">Kategori Pengeluaran</a>
            <a href="<?= base_url() ?>/pengaturan/data_kat_rekening" class="list-group-item list-group-item-action list-glass">Rekening</a>
        </div>
    </div>
</div>
<!-- END content -->
<?= $this->endSection(); ?>