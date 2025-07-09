<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="text-title">Dashboard</h3>
    </div>
</div>

<!-- Spinner -->
<div id="card-loading" class="my-5">
    <div class="glass-spinner mb-3 mx-auto"></div>
    <small class="text-muted d-block text-center">Memuat data rekening...</small>
</div>

<!-- Card container -->
<div class="row" id="card-container" style="display: none;">
    <!-- AJAX content will go here -->
</div>

<!-- Ringkasan Bulan Ini -->
<div class="row" id="rekap-container" style="display: none;">
    <div class="col-md-6 mb-4">
        <div class="card card-glass p-3 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-1 text-uppercase text-muted">Pemasukan Bulan Ini</h6>
                <i class="bi bi-arrow-down-circle-fill text-success fs-4"></i>
            </div>
            <h4 class="fw-bold text-success" id="pemasukan-bulan-ini">Rp 0</h4>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card card-glass p-3 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-1 text-uppercase text-muted">Pengeluaran Bulan Ini</h6>
                <i class="bi bi-arrow-up-circle-fill text-danger fs-4"></i>
            </div>
            <h4 class="fw-bold text-danger" id="pengeluaran-bulan-ini">Rp 0</h4>
        </div>
    </div>
</div>

<!-- Grafik -->
<div class="row" id="chart-container" style="display: none;">
    <div class="col-md-8 mb-4">
        <div class="card card-glass p-3 shadow-sm">
            <h6 class="text-muted text-uppercase mb-2">Grafik Pemasukan vs Pengeluaran</h6>
            <canvas id="lineChart" height="150"></canvas>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-glass p-3 shadow-sm">
            <h6 class="text-muted text-uppercase mb-2">Persentase Penggunaan</h6>
            <canvas id="donutChart"></canvas>
        </div>
    </div>
</div>

<!-- Tips Keuangan -->
<div class="row" id="tips-container" style="display: none;">
    <div class="col-md-4">
        <div class="card card-glass p-3 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-1 text-uppercase text-muted">Tips Keuangan Hari Ini</h6>
                <i class="bi bi-lightbulb text-warning fs-4"></i>
            </div>
            <blockquote class="quote-tips mb-0" id="tips-content">Memuat tips...</blockquote>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Saldo rekening
        $.ajax({
            type: "GET",
            url: BASE_URL + "/home/get_saldo_rekening",
            dataType: "json",
            beforeSend: function() {
                $("#card-loading").show();
                $("#card-container").hide();
            },
            success: function(response) {
                if (response.success) {
                    let html = "";
                    response.data.forEach(function(item) {
                        html += `
                        <div class="col-md-4 mb-4">
                            <div class="card card-glass p-3 shadow">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h6 class="mb-1 text-uppercase text-muted">Saldo Rekening</h6>
                                        <h5 class="fw-bold mb-0">${item.nama_rekening}</h5>
                                    </div>
                                    <div>
                                        <i class="bi bi-wallet2 fs-2 text-primary"></i>
                                    </div>
                                </div>
                                <h4 class="fw-semibold text-success mb-1">Rp ${parseInt(item.sisa_saldo).toLocaleString("id-ID")}</h4>
                                <span class="text-muted fs-7">Update terakhir: ${new Date().toLocaleString("id-ID")}</span>
                            </div>
                        </div>`;
                    });
                    $("#card-container").html(html);
                    $("#card-loading").hide();
                    $("#card-container").fadeIn();
                } else {
                    $("#card-container").html("<div class='text-danger'>Gagal memuat data.</div>");
                }
            },
            error: function() {
                $("#card-loading").hide();
                $("#card-container").html("<div class='text-danger'>Terjadi kesalahan saat memuat data.</div>").show();
            }
        });

        // Ringkasan bulan ini
        $.ajax({
            type: "GET",
            url: BASE_URL + "/home/get_rekap_bulan_ini",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $("#pemasukan-bulan-ini").text(
                        `Rp ${parseInt(response.data.total_pemasukan).toLocaleString("id-ID")}`
                    );
                    $("#pengeluaran-bulan-ini").text(
                        `Rp ${parseInt(response.data.total_pengeluaran).toLocaleString("id-ID")}`
                    );
                    $("#rekap-container").fadeIn();
                }
            }
        });

        // Grafik
        $.ajax({
            type: "GET",
            url: BASE_URL + "/home/get_chart_data",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    const ctxLine = document.getElementById("lineChart").getContext("2d");
                    new Chart(ctxLine, {
                        type: "line",
                        data: {
                            labels: response.data.labels,
                            datasets: [{
                                    label: "Pemasukan",
                                    data: response.data.pemasukan,
                                    borderColor: "#28a745",
                                    backgroundColor: "rgba(40,167,69,0.1)",
                                    tension: 0.4
                                },
                                {
                                    label: "Pengeluaran",
                                    data: response.data.pengeluaran,
                                    borderColor: "#dc3545",
                                    backgroundColor: "rgba(220,53,69,0.1)",
                                    tension: 0.4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: "bottom"
                                }
                            }
                        }
                    });

                    const ctxDonut = document.getElementById("donutChart").getContext("2d");
                    new Chart(ctxDonut, {
                        type: "doughnut",
                        data: {
                            labels: ["Pemasukan", "Pengeluaran"],
                            datasets: [{
                                data: [
                                    response.data.pemasukan.reduce((a, b) => a + b, 0),
                                    response.data.pengeluaran.reduce((a, b) => a + b, 0)
                                ],
                                backgroundColor: ["#28a745", "#dc3545"]
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: "bottom"
                                }
                            }
                        }
                    });

                    $("#chart-container").fadeIn();
                }
            }
        });

        // tips random tiap 5 detik
        const tips = [
            "Catat semua pengeluaran sekecil apa pun.",
            "Sisihkan minimal 10% dari penghasilan untuk tabungan.",
            "Evaluasi pengeluaran bulanan secara berkala.",
            "Hindari hutang konsumtif.",
            "Gunakan aplikasi pencatat keuangan harian.",
            "Buat anggaran bulanan dan patuhi.",
            "Jangan tergoda promo kalau tidak dibutuhkan.",
            "Prioritaskan kebutuhan dibanding keinginan.",
            "Miliki dana darurat minimal 3x pengeluaran bulanan.",
            "Review langganan otomatis yang tidak terpakai."
        ];

        let index = 0;

        function showTip() {
            const $tipsContent = $("#tips-content");
            $tipsContent.fadeOut(300, function() {
                $tipsContent.text("“" + tips[index] + "”");
                $tipsContent.fadeIn(300);
            });

            index = (index + 1) % tips.length;
        }

        // Munculkan container
        $("#tips-container").fadeIn();

        // Tampilkan pertama kali
        showTip();

        // Set interval tiap 5 detik
        setInterval(showTip, 5000);
    });
</script>

<?= $this->endSection(); ?>