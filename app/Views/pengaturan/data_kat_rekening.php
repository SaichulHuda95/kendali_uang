<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>/pengaturan">Pengaturan Aplikasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kategori Rekening</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-glass shadow-sm">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <button type="button" class="btn btn-sm border btn-primary" onclick="tambah_kat_rekening()">Tambah</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-sm table-glass glass" id="tbl-kat_rekening" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
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