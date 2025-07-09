<div class="modal fade" id="modaltambahkatpemasukan">
    <div class="modal-dialog border">
        <div class="modal-content border">
            <div class="modal-header bg-primary border-top">
                <h5 class="modal-title text-white" id="modaltambahkatpemasukanLabel">Tambah Kategori Pemasukan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-kat-pemasukan" action="<?= base_url() ?>/pengaturan/simpan_kat_pemasukan" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="exampleFormControlInput1">Nama Kategori Pemasukan</label>
                        <input type="text" class="form-control" id="nama_pemasukan" name="nama_pemasukan" placeholder="Nama Kategori Pemasukan" required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn_simpan_kat_pemasukan">
                        <span class="spinner-border spinner-border-sm" id="btn-spinner-kat-pemasukan" role="status" aria-hidden="true" style="display: none;"></span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // jquery simpan form-kat-pemasukan
    $("#form-kat-pemasukan").on("submit", function(e) {
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
                $("#btn-spinner-kat-pemasukan").show();
                $("#btn_simpan_kat_pemasukan").attr("disabled", true);
            },
            success: function(response) {
                if (response.success == true) {
                    $('#modaltambahkatpemasukan').modal('hide'); // ✅ Tutup modal
                    alert_success(response.message);
                    tbl_kat_pemasukan.ajax.reload(null, false);
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
                $("#btn-spinner-kat-pemasukan").hide();
                $("#btn_simpan_kat_pemasukan").attr("disabled", false);
            },
        });
    });
</script>