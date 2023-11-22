<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4>Beli</h4>
            </div>
        </div>
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
                <?= validation_errors('<div>', '</div>') ?><button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        <?php } ?>
        <?= $this->session->flashdata('pesan') ?>
        <div id="pesanSupplier" class="alert alert-danger alert-dismissible text-center fade show d-none" role="alert">
            <div>Kode Supplier Tidak Boleh Beda</div>
            <button type="button" class="btn-close hilang" aria-label="Close"></button>
        </div>
        <div id="pesanBarang" class="alert alert-danger alert-dismissible text-center fade show d-none" role="alert">
            <div>Kode Barang Sudah Ada Di Table</div>
            <button type="button" class="btn-close hilang" aria-label="Close"></button>
        </div>
        <div class="my-3">
            <div>
                <div class="row g-3">
                    <div class="btn-group col-auto col-md-2">
                        <div class="d-grid">
                            <label for="supplierButton">Cari Supplier</label>
                            <button class="btn border dropdown-toggle" type="button" id="supplierButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Supplier
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="supplierButton">
                                <li class="mx-2"><input type="text" class="form-control" id="supplierFilter"
                                        placeholder="Cari Kode">
                                </li>
                                <?php foreach ($supplier as $s) { ?>
                                    <li class="dropdown-item supplierItem"><?= $s['kode'] . ' | ' . $s['nama'] ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-group col-auto col-md-2">
                        <div class="d-grid">
                            <label for="barangButton">Cari Barang</label>
                            <button class="btn border dropdown-toggle" type="button" id="barangButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Barang
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="barangButton">
                                <li class="mx-2"><input type="text" class="form-control" id="barangFilter"
                                        placeholder="Cari Kode">
                                </li>
                                <?php foreach ($barang as $s) { ?>
                                    <li class="dropdown-item barangItem"><?= $s['kode'] . ' | ' . $s['nama'] ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-auto col-md-2">
                        <label for="kodeSupplier">Kode Supplier</label>
                        <input type="text" class="form-control" value="" readonly id="kodeSupplier">
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="kodeBarang">Kode Barang</label>
                        <input type="text" class="form-control" value="" readonly id="kodeBarang">
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="namaBarang">Nama Barang</label>
                        <input type="text" class="form-control" id="namaBarang" readonly>
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="harga">Harga Barang</label>
                        <input type="text" class="form-control" id="harga">
                    </div>
                    <div class="col-auto col-md-2">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah">
                    </div>
                </div>
                <div class="row g-3">
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
        <form id="formbeli" action="<?= base_url('beli/addBeli') ?>" method="post" target="_blank">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-table me-2"></i></span> Data Beli
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped " style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Kode Supplier</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Jumlah</th>
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
                                <label></label>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <div class="col-auto">
                            <input type="text" id="intTotalHarga" name="intTotalHarga" hidden value='' />
                            <input type="text" id="totalHarga" class="form-control" readonly value="0" />
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-printer-fill"></i>
                                Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<script>
    var barangData = <?php echo json_encode($barang); ?>;
    var supplierData = <?php echo json_encode($supplier); ?>;
</script>
<script src="<?= base_url('assets/js/dashboard/beli.js?v=3') ?>"></script>