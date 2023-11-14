<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4>Jual</h4>
            </div>
        </div>
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
                <?= validation_errors('<div>', '</div>') ?><button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        <?php } ?>
        <?= $this->session->flashdata('pesan') ?>
        <div id="pesan" class="alert alert-danger alert-dismissible text-center fade show d-none" role="alert">
            <div>Barang Tersebut Sudah ada Di Table</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="mb-3">
            <div class="col-2">
                <div>
                    <label for="myInput">Cari Kode Barang</label>
                    <input id="myInput" type="text" placeholder="Ex = BR-IP20" class="form-control mb-1">
                </div>
                <div class="position-relative">
                    <ul id="myList" class="list-group position-absolute border">
                        <?php foreach ($barang as $b) { ?>
                            <button class="list-group-item list-group-item-action d-none"><?= $b['kode'] ?></button>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div>
                <div class="row g-3">
                    <div class="col-auto col-md-2">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" value="" readonly id="kode">
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" readonly>
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="harpok">Harpok Barang</label>
                        <input type="text" class="form-control" id="harpok" readonly>
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="harjul">Harjul Barang</label>
                        <input type="text" class="form-control" id="harjul" readonly>
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control" id="stok" readonly>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-auto col-md-2">
                        <label for="qty">Qty</label>
                        <input type="number" class="form-control" id="qty" value="1">
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="diskon">diskon (%)</label>
                        <input type="number" class="form-control" id="diskon" value="0">
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="total">total</label>
                        <input type="text" class="form-control" id="total" readonly>
                    </div>
                    <div class="col-auto col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success" id="addButton">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <form action="<?= base_url('dashboard/addJual') ?>" method="post">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-table me-2"></i></span> Data Jual
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped " style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Pokok</th>
                                    <th>Harga Jual</th>
                                    <th>Qty</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4 me-5">
                <div class="d-flex gap-3">
                    <div class="d-grid gap-2">
                        <div>
                            <div class="col-auto">
                                <label for="total_harga" class="col-form-label">Total Harga</label>
                            </div>
                        </div>
                        <div>
                            <div class="col-auto">
                                <label for="jumlah_uang" class="col-form-label">Jumlah Uang</label>
                            </div>
                        </div>
                        <div>
                            <div class="col-auto">
                                <label for="kembalian" class="col-form-label">Kembalian</label>
                            </div>
                        </div>
                        <div>
                            <div class="col-auto">
                                <label></label>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <div class="col-auto">
                            <input type="text" id="total_harga" name="total_harga" class="form-control" readonly
                                value="0" />
                        </div>
                        <div class=" col-auto">
                            <input type="text" value="Rp. " id="jumlah_uang" name="jumlah_uang" class="form-control">
                        </div>
                        <div class="col-auto">
                            <input type="text" id="kembalian" name="kembalian" class="form-control" readonly value="0">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" type="submit">Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<script>
    var barangData = <?php echo json_encode($barang); ?>
</script>
<script src="<?= base_url('assets/js/dashboard/jual.js') ?>"></script>