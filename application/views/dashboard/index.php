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
                        Area Chart Example
                    </div>
                    <div class="card-body">
                        <canvas class="chart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                        Area Chart Example
                    </div>
                    <div class="card-body">
                        <canvas class="" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>