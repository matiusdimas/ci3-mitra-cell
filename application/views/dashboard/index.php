<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4>Dashboard</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div>
                            <p><strong>Penjualan Bulan Ini</strong></p>
                            <p>Transaksi Jual = <?= isset($jumlahData) ? $jumlahData : 0; ?></p>
                            <p>Barang Terjual = <?= isset($totalQty) ? $totalQty : 0 ?></p>
                            <p>Pendapatan =
                                <?= "Rp " . number_format(isset($totalPenjualan) ? $totalPenjualan : 0, 0, ',', '.') . ",00" ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-danger text-white h-100">
                    <div class="card-body">
                        <div>
                            <p><strong>Pembelian Bulan Ini</strong></p>
                            <p>Transaksi Beli = <?= isset($jumlahDataBeli) ? $jumlahDataBeli : 0; ?></p>
                            <p>Barang Terbeli = <?= isset($totalQtyBeli) ? $totalQtyBeli : 0 ?></p>
                            <p>Pengeluaran =
                                <?= "Rp " . number_format(isset($totalBeli) ? $totalBeli : 0, 0, ',', '.') . ",00" ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                        Grafik Penjualan
                    </div>
                    <div class="card-body">
                        <canvas id="chart-jual" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                        Grafik Pembelian
                    </div>
                    <div class="card-body">
                        <canvas id="chart-beli" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    function jual() {
        const dataJual = <?= json_encode($chart_jual); ?>;
        const dataBeli = <?= json_encode($chart_beli); ?>;
        const mappedData = dataJual.map(item => ({
            createdAt: new Date(item.createdAt),
            total: parseInt(item.total)
        }));

        const yearMonthTotals = mappedData.reduce((acc, item) => {
            const year = item.createdAt.getFullYear();
            const month = item.createdAt.getMonth() + 1; // Bulan dimulai dari 0
            const yearMonth = `${year}-${month}`;

            if (!acc[yearMonth]) {
                acc[yearMonth] = 0;
            }

            acc[yearMonth] += item.total;

            return acc;
        }, {});
        const yearMonthArray = Object.entries(yearMonthTotals).map(([yearMonth, total]) => ({
            tahun: yearMonth,
            total: total
        }));

        yearMonthArray.sort((a, b) => {
            const [yearA, monthA] = a.tahun.split('-');
            const [yearB, monthB] = b.tahun.split('-');
            if (yearA !== yearB) {
                return yearA - yearB;
            }
            return monthA - monthB;
        });

        new Chart(document.getElementById("chart-jual"), {
            type: 'line',
            data: {
                labels: yearMonthArray.map(d => d.tahun),
                datasets: [
                    {
                        label: "Total Penjualan",
                        data: yearMonthArray.map(d => d.total)
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });
    }
    jual()

    function beli() {
        const dataBeli = <?= json_encode($chart_beli); ?>;
        const mappedData = dataBeli.map(item => ({
            createdAt: new Date(item.createdAt),
            total: parseInt(item.total)
        }));

        const yearMonthTotals = mappedData.reduce((acc, item) => {
            const year = item.createdAt.getFullYear();
            const month = item.createdAt.getMonth() + 1; // Bulan dimulai dari 0
            const yearMonth = `${year}-${month}`;

            if (!acc[yearMonth]) {
                acc[yearMonth] = 0;
            }

            acc[yearMonth] += item.total;

            return acc;
        }, {});
        const yearMonthArray = Object.entries(yearMonthTotals).map(([yearMonth, total]) => ({
            tahun: yearMonth,
            total: total
        }));

        yearMonthArray.sort((a, b) => {
            const [yearA, monthA] = a.tahun.split('-');
            const [yearB, monthB] = b.tahun.split('-');
            if (yearA !== yearB) {
                return yearA - yearB;
            }
            return monthA - monthB;
        });

        new Chart(document.getElementById("chart-beli"), {
            type: 'line',
            data: {
                labels: yearMonthArray.map(d => d.tahun),
                datasets: [
                    {
                        label: "Total Pembelian",
                        data: yearMonthArray.map(d => d.total),
                        borderColor: '##93C3D2',
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });
    }
    beli()
</script>