<div class="modal fade" id="modaltambahtransaksi">
    <div class="modal-dialog modal-centered border">
        <div class="modal-content border">
            <div class="modal-header bg-primary border-top">
                <h5 class="modal-title text-white" id="modaltambahtransaksiLabel">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-transaksi" action="<?= base_url() ?>/transaksi/simpan_transaksi" method="post">
                <input type="hidden" name="type" id="type" value="<?= $type ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="exampleFormControlInput1">Waktu Transaksi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control datetime" id="waktu_transaksi" name="waktu_transaksi" value="<?= date('Y-m-d H:i') ?>" required autofocus>
                    </div>

                    <?php if ($type == '1') : ?>

                        <div class="form-group">
                            <label class="form-label" for="exampleFormControlInput1">Kategori Pemasukan <span class="text-danger">*</span></label>
                            <select name="id_pemasukan" id="id_pemasukan" class="form-control" required>
                                <option value="">-Pilih Kategori Pemasukan-</option>
                                <?php foreach ($kategori as $row) : ?>
                                    <option value="<?= $row->id_pemasukan ?>"><?= $row->nama_pemasukan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php else : ?>
                        <div class="form-group">
                            <label class="form-label" for="exampleFormControlInput1">Kategori Pengeluaran <span class="text-danger">*</span></label>
                            <select name="id_pengeluaran" id="id_pengeluaran" class="form-control" required>
                                <option value="">-Pilih Kategori Pengeluaran-</option>
                                <?php foreach ($kategori as $row) : ?>
                                    <option value="<?= $row->id_pengeluaran ?>"><?= $row->nama_pengeluaran ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif ?>
                    <div class="form-group">
                        <label class="form-label" for="exampleFormControlInput1">Rekening <span class="text-danger">*</span></label>
                        <select name="id_rekening" id="id_rekening" class="form-control" required>
                            <option value="">-Pilih Rekening-</option>
                            <?php foreach ($kat_rekening as $row) : ?>
                                <option value="<?= $row->id_rekening ?>"><?= $row->nama_rekening ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="exampleFormControlInput1">Jumlah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" id="jumlah" name="jumlah" value="0" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="exampleFormControlInput1">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="exampleFormControlInput1">Keterangan (Opsional)</label>
                        <input type="text" class="form-control" id="desc" name="desc">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn_simpan_transaksi">
                        <span class="spinner-border spinner-border-sm" id="btn-spinner-transaksi" role="status" aria-hidden="true" style="display: none;"></span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // flatpickr datetime
    $(".datetime").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        minuteIncrement: 1
    });

    // numeric
    jQuery(function($) {
        $("input.numeric").autoNumeric("init", {
            mDec: "0",
            aSep: ".",
            aDec: ",",
        });
    });

    // jquery simpan form-transaksi
    $("#form-transaksi").on("submit", function(e) {
        e.preventDefault(); // Mencegah reload halaman

        // Ambil data form
        var formData = $(this).serialize();
        var url = $(this).attr("action");

        // AJAX request
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "json",
            beforeSend: function() {
                // Tampilkan spinner dan nonaktifkan tombol
                $("#btn-spinner-transaksi").show();
                $("#btn_simpan_transaksi").attr("disabled", true);
            },
            success: function(response) {
                if (response.success == true) {
                    $('#modaltambahtransaksi').modal('hide'); // ✅ Tutup modal
                    alert_success(response.message);
                    tbl_transaksi.ajax.reload(null, false);
                } else {
                    alert_fail(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Tampilkan pesan error
                alert_fail(error);
            },
            complete: function() {
                // Sembunyikan spinner dan aktifkan tombol
                $("#btn-spinner-transaksi").hide();
                $("#btn_simpan_transaksi").attr("disabled", false);
            },
        });
    });
</script>