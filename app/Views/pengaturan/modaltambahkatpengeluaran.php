<div class="modal fade" id="modaltambahkatpengeluaran">
    <div class="modal-dialog border">
        <div class="modal-content border">
            <div class="modal-header bg-primary border-top">
                <h5 class="modal-title text-white" id="modaltambahkatpengeluaranLabel">Tambah Kategori Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-kat-pengeluaran" action="<?= base_url() ?>/pengaturan/simpan_kat_pengeluaran" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="exampleFormControlInput1">Nama Kategori Pengeluaran</label>
                        <input type="text" class="form-control" id="nama_pengeluaran" name="nama_pengeluaran" placeholder="Nama Kategori Pengeluaran" required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn_simpan_kat_pengeluaran">
                        <span class="spinner-border spinner-border-sm" id="btn-spinner-kat-pengeluaran" role="status" aria-hidden="true" style="display: none;"></span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // jquery simpan form-kat-pengeluaran
    $("#form-kat-pengeluaran").on("submit", function(e) {
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
                $("#btn-spinner-kat-pengeluaran").show();
                $("#btn_simpan_kat_pengeluaran").attr("disabled", true);
            },
            success: function(response) {
                if (response.success == true) {
                    $('#modaltambahkatpengeluaran').modal('hide'); // ✅ Tutup modal
                    alert_success(response.message);
                    tbl_kat_pengeluaran.ajax.reload(null, false);
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
                $("#btn-spinner-kat-pengeluaran").hide();
                $("#btn_simpan_kat_pengeluaran").attr("disabled", false);
            },
        });
    });
</script>