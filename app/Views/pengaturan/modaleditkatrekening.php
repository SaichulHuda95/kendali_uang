<div class="modal fade" id="modaleditkatrekening">
    <div class="modal-dialog border">
        <div class="modal-content border">
            <div class="modal-header bg-primary border-top">
                <h5 class="modal-title text-white" id="modaleditkatrekeningLabel">Edit Kategori Rekening</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-edit-kat-rekening" action="<?= base_url() ?>/pengaturan/update_kat_rekening" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="exampleFormControlInput1">Nama Kategori Rekening</label>
                        <input type="hidden" name="id_rekening" value="<?= $id_rekening ?>">
                        <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" placeholder="Nama Kategori Rekening" value="<?= $data_kat_rekening->nama_rekening ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn_update_kat_rekening">
                        <span class="spinner-border spinner-border-sm" id="btn-spinner-kat-rekening" role="status" aria-hidden="true" style="display: none;"></span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // jquery simpan form-edit-kat-rekening
    $("#form-edit-kat-rekening").on("submit", function(e) {
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
                $("#btn-spinner-kat-rekening").show();
                $("#btn_update_kat_rekening").attr("disabled", true);
            },
            success: function(response) {
                if (response.success == true) {
                    $('#modaleditkatrekening').modal('hide'); // ✅ Tutup modal
                    alert_success(response.message);
                    tbl_kat_rekening.ajax.reload(null, false);
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
                $("#btn-spinner-kat-rekening").hide();
                $("#btn_update_kat_rekening").attr("disabled", false);
            },
        });
    });
</script>