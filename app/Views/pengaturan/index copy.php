<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Aplikasi</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="d-flex align-items-start">
            <div class="nav flex-column card-glass nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-kat_pemasukan-tab" data-bs-toggle="pill" data-bs-target="#v-pills-kat_pemasukan" type="button" role="tab" aria-controls="v-pills-kat_pemasukan" aria-selected="true">Kategori Pemasukan</button>
                <button class="nav-link" id="v-pills-kat_pengeluaran-tab" data-bs-toggle="pill" data-bs-target="#v-pills-kat_pengeluaran" type="button" role="tab" aria-controls="v-pills-kat_pengeluaran" aria-selected="false">Kategori Pengeluaran</button>
                <button class="nav-link" id="v-pills-kat_rekening-tab" data-bs-toggle="pill" data-bs-target="#v-pills-kat_rekening" type="button" role="tab" aria-controls="v-pills-kat_rekening" aria-selected="false">Rekening</button>
            </div>
            <div class="tab-content card-glass flex-grow-1" id="v-pills-tabContent">
                <div class="tab-pane fade show active p-3" id="v-pills-kat_pemasukan" role="tabpanel" aria-labelledby="v-pills-kat_pemasukan-tab" tabindex="0">
                    <div class="row mb-3">
                        <div class="col">
                            <button type="button" class="btn btn-sm border btn-primary" onclick="tambah_kat_pemasukan()">Tambah</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-sm table-glass glass" id="tbl-kat_pemasukan" style="width: 100%;">
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
                <div class="tab-pane fade p-3" id="v-pills-kat_pengeluaran" role="tabpanel" aria-labelledby="v-pills-kat_pengeluaran-tab" tabindex="0">
                    <div class="row mb-3">
                        <div class="col">
                            <button type="button" class="btn btn-sm border btn-primary" onclick="tambah_kat_pengeluaran()">Tambah</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-sm table-glass glass" id="tbl-kat_pengeluaran" style="width: 100%;">
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
                <div class="tab-pane fade p-3" id="v-pills-kat_rekening" role="tabpanel" aria-labelledby="v-pills-kat_rekening-tab" tabindex="0">
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
</div>
<!-- END content -->
<?= $this->endSection(); ?>