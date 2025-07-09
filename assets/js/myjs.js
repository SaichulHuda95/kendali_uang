var flasherror = $("#flasherror").data("flash");
if (flasherror) {
  Swal.fire({
    icon: "error",
    // title: 'Gagal',
    showConfirmButton: false,
    timer: 1400,
    text: flasherror,
    customClass: {
      container: "position-absolute",
      popup: "swal-glass",
    },
    toast: true,
    position: "top-right",
  });
}

var flashsuccess = $("#flashsuccess").data("flash");
if (flashsuccess) {
  Swal.fire({
    icon: "success",
    // title: 'Gagal',
    showConfirmButton: false,
    timer: 1400,
    text: flashsuccess,
    customClass: {
      container: "position-absolute",
      popup: "swal-glass",
    },
    toast: true,
    position: "top-right",
  });
}

// flatpickr date
$(".date").flatpickr();

// flatpickr datetime
$(".datetime").flatpickr({
  enableTime: true,
  dateFormat: "Y-m-d H:i",
});

// numeric
jQuery(function ($) {
  $("input.numeric").autoNumeric("init", {
    mDec: "0",
    aSep: ".",
    aDec: ",",
  });
});

// Log Off
let log_off = new Date();
log_off.setMinutes(log_off.getMinutes() + 30);
log_off = new Date(log_off);

let int_logoff = setInterval(function () {
  let now = new Date();
  if (now > log_off) {
    alert("Maaf sesi anda telah habis");
    window.location.assign(BASE_URL + "/login/logout");
    clearInterval(int_logoff);
  }
}, 30000);

// Alert Logout
$(function () {
  $(".logout").click(function () {
    if (confirm("Anda yakin ingin keluar?")) {
      return true;
    }
    return false;
  });
});

function alert_success(message) {
  Swal.fire({
    icon: "success",
    title: "Berhasil",
    showConfirmButton: false,
    timer: 1500,
    customClass: {
      popup: "swal-glass",
    },
    text: message,
  });
}

function alert_fail(message) {
  Swal.fire({
    icon: "error",
    title: "Oops...",
    showConfirmButton: false,
    timer: 1500,
    customClass: {
      popup: "swal-glass",
    },
    text: message,
  });
}

//tbl-kat_pemasukan
let tbl_kat_pemasukan = $("#tbl-kat_pemasukan").DataTable({
  responsive: true,
  processing: true,
  ajax: {
    url: BASE_URL + "/pengaturan/get_kat_pemasukan",
    type: "post",
  },
  columns: [{ data: "no" }, { data: "nama_pemasukan" }, { data: "aksi" }],
});

//tbl-kat_pengeluaran
let tbl_kat_pengeluaran = $("#tbl-kat_pengeluaran").DataTable({
  responsive: true,
  processing: true,
  ajax: {
    url: BASE_URL + "/pengaturan/get_kat_pengeluaran",
    type: "post",
  },
  columns: [{ data: "no" }, { data: "nama_pengeluaran" }, { data: "aksi" }],
});

//tbl-kat_rekening
let tbl_kat_rekening = $("#tbl-kat_rekening").DataTable({
  responsive: true,
  processing: true,
  ajax: {
    url: BASE_URL + "/pengaturan/get_kat_rekening",
    type: "post",
  },
  columns: [{ data: "no" }, { data: "nama_rekening" }, { data: "aksi" }],
});

//tbl-transaksi
let tbl_transaksi = $("#tbl-transaksi").DataTable({
  responsive: true,
  processing: true,
  ajax: {
    url: BASE_URL + "/transaksi/get_transaksi",
    type: "post",
  },
  columns: [
    { data: "no" },
    { data: "waktu_transaksi" },
    { data: "judul" },
    { data: "kategori" },
    { data: "rekening" },
    { data: "jumlah" },
    { data: "desc" },
    { data: "aksi" },
  ],
});

//tbl-rekening
let tbl_rekening = $("#tbl-rekening").DataTable({
  responsive: true,
  processing: true,
  ajax: {
    url: BASE_URL + "/rekening/get_saldo",
    type: "post",
  },
  columns: [
    { data: "no" },
    { data: "nama_rekening" },
    { data: "total_pemasukan" },
    { data: "total_pengeluaran" },
    { data: "sisa_saldo" },
  ],
});

//tbl-rekap
let tbl_rekap = $("#tbl-rekap").DataTable({
  responsive: true,
  processing: true,
  ajax: {
    url: BASE_URL + "/rekap/get_rekap",
    type: "post",
  },
  columns: [
    { data: "no" },
    { data: "bulan" },
    { data: "total_pemasukan" },
    { data: "total_pengeluaran" },
    { data: "sisa_saldo" },
    { data: "jumlah_transaksi" },
    { data: "aksi" },
  ],
});

// modal tambah kat_pemasukan
function tambah_kat_pemasukan() {
  $.ajax({
    type: "post",
    url: BASE_URL + "/pengaturan/tambah_kat_pemasukan",
    dataType: "json",
    success: function (response) {
      if (response.data) {
        $(".viewmodal").html(response.data).show();
        $("#modaltambahkatpemasukan").on("shown.bs.modal", function (event) {});
        $("#modaltambahkatpemasukan").modal("show");
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

// modal tambah kat_pengeluaran
function tambah_kat_pengeluaran() {
  $.ajax({
    type: "post",
    url: BASE_URL + "/pengaturan/tambah_kat_pengeluaran",
    dataType: "json",
    success: function (response) {
      if (response.data) {
        $(".viewmodal").html(response.data).show();
        $("#modaltambahkatpengeluaran").on(
          "shown.bs.modal",
          function (event) {}
        );
        $("#modaltambahkatpengeluaran").modal("show");
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

// modal tambah kat_rekening
function tambah_kat_rekening() {
  $.ajax({
    type: "post",
    url: BASE_URL + "/pengaturan/tambah_kat_rekening",
    dataType: "json",
    success: function (response) {
      if (response.data) {
        $(".viewmodal").html(response.data).show();
        $("#modaltambahkatrekening").on("shown.bs.modal", function (event) {});
        $("#modaltambahkatrekening").modal("show");
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

// modal tambah transaksi
function tambah_transaksi(type) {
  $.ajax({
    type: "post",
    url: BASE_URL + "/transaksi/tambah_transaksi",
    dataType: "json",
    data: {
      type: type,
    },
    success: function (response) {
      if (response.data) {
        $(".viewmodal").html(response.data).show();
        $("#modaltambahtransaksi").on("shown.bs.modal", function (event) {});
        $("#modaltambahtransaksi").modal("show");
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

//modal edit kat_pemasukan
function edit_kat_pemasukan(id_pemasukan) {
  $.ajax({
    type: "post",
    url: BASE_URL + "/pengaturan/edit_kat_pemasukan",
    data: {
      id_pemasukan: id_pemasukan,
    },
    dataType: "json",
    success: function (response) {
      if (response.data) {
        $(".viewmodal").html(response.data).show();
        $("#modaleditkatpemasukan").on("shown.bs.modal", function (event) {});
        $("#modaleditkatpemasukan").modal("show");
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

//modal edit kat_pengeluaran
function edit_kat_pengeluaran(id_pengeluaran) {
  $.ajax({
    type: "post",
    url: BASE_URL + "/pengaturan/edit_kat_pengeluaran",
    data: {
      id_pengeluaran: id_pengeluaran,
    },
    dataType: "json",
    success: function (response) {
      if (response.data) {
        $(".viewmodal").html(response.data).show();
        $("#modaleditkatpengeluaran").on("shown.bs.modal", function (event) {});
        $("#modaleditkatpengeluaran").modal("show");
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

//modal edit kat_rekening
function edit_kat_rekening(id_rekening) {
  $.ajax({
    type: "post",
    url: BASE_URL + "/pengaturan/edit_kat_rekening",
    data: {
      id_rekening: id_rekening,
    },
    dataType: "json",
    success: function (response) {
      if (response.data) {
        $(".viewmodal").html(response.data).show();
        $("#modaleditkatrekening").on("shown.bs.modal", function (event) {});
        $("#modaleditkatrekening").modal("show");
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

//modal edit transaksi
function edit_transaksi(id_transaksi) {
  $.ajax({
    type: "post",
    url: BASE_URL + "/transaksi/edit_transaksi",
    data: {
      id_transaksi: id_transaksi,
    },
    dataType: "json",
    success: function (response) {
      if (response.data) {
        $(".viewmodal").html(response.data).show();
        $("#modaledittransaksi").on("shown.bs.modal", function (event) {});
        $("#modaledittransaksi").modal("show");
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

// hapus kat_pemasukan
function hapus_kat_pemasukan(id_pemasukan, nama) {
  Swal.fire({
    title: "Hapus Data",
    html: `Yakin ingin menghapus data <strong>${nama}</strong>?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
    customClass: {
      popup: "swal-glass",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "post",
        url: BASE_URL + "/pengaturan/hapus_kat_pemasukan",
        data: {
          id_pemasukan: id_pemasukan,
        },
        dataType: "json",
        success: function (response) {
          if (response.success == true) {
            alert_success(response.message);
            tbl_kat_pemasukan.ajax.reload(null, false);
          } else {
            alert_fail(response.message);
          }
        },
        error: function (xhr, thrownError) {
          alert_fail(error);
        },
      });
    }
  });
}

// hapus kat_pengeluaran
function hapus_kat_pengeluaran(id_pengeluaran, nama) {
  Swal.fire({
    title: "Hapus Data",
    html: `Yakin ingin menghapus data <strong>${nama}</strong>?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
    customClass: {
      popup: "swal-glass",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "post",
        url: BASE_URL + "/pengaturan/hapus_kat_pengeluaran",
        data: {
          id_pengeluaran: id_pengeluaran,
        },
        dataType: "json",
        success: function (response) {
          if (response.success == true) {
            alert_success(response.message);
            tbl_kat_pengeluaran.ajax.reload(null, false);
          } else {
            alert_fail(response.message);
          }
        },
        error: function (xhr, thrownError) {
          alert_fail(error);
        },
      });
    }
  });
}

// hapus kat_rekening
function hapus_kat_rekening(id_rekening, nama) {
  Swal.fire({
    title: "Hapus Data",
    html: `Yakin ingin menghapus data <strong>${nama}</strong>?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
    customClass: {
      popup: "swal-glass",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "post",
        url: BASE_URL + "/pengaturan/hapus_kat_rekening",
        data: {
          id_rekening: id_rekening,
        },
        dataType: "json",
        success: function (response) {
          if (response.success == true) {
            alert_success(response.message);
            tbl_kat_rekening.ajax.reload(null, false);
          } else {
            alert_fail(response.message);
          }
        },
        error: function (xhr, thrownError) {
          alert_fail(error);
        },
      });
    }
  });
}

// hapus transaksi
function hapus_transaksi(id_transaksi, nama) {
  Swal.fire({
    title: "Hapus Data",
    html: `Yakin ingin menghapus data <strong>${nama}</strong>?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
    customClass: {
      popup: "swal-glass",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "post",
        url: BASE_URL + "/transaksi/hapus_transaksi",
        data: {
          id_transaksi: id_transaksi,
        },
        dataType: "json",
        success: function (response) {
          if (response.success == true) {
            alert_success(response.message);
            tbl_transaksi.ajax.reload(null, false);
          } else {
            alert_fail(response.message);
          }
        },
        error: function (xhr, thrownError) {
          alert_fail(error);
        },
      });
    }
  });
}
