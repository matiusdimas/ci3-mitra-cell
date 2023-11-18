<main class="mt-5 pt-3">
    <div class="container-fluid">
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
                <?= validation_errors('<div>', '</div>') ?><button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        <?php } ?>

        <?= $this->session->flashdata('pesan'); ?>
        <div class="row">
            <div class="col-md-12">
                <h4>Detail Beli</h4>
            </div>
        </div>
        <div class="my-2">
            <button class="btn btn-success mb-1"><i class="bi bi-printer-fill"></i>
                Print
            </button>
            <button class="btn btn-secondary mb-1" onclick="window.history.go(-1)">
                Back
            </button>
        </div>
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Detail Beli
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-striped table-bordered data-table" style="width: 100%">
                        <thead>
                            <tr class="">
                                <th>No Faktur</th>
                                <th>Barang Kode</th>
                                <th>Nama Barang</th>
                                <th>Harga Barang</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($beli as $bel => $b) { ?>
                                <tr>
                                    <td class="align-middle"><?= $b['beli_nofak'] ?></td>
                                    <td class="align-middle"><a href="<?= base_url('barang?query=' . $b['barang_kode']) ?> "
                                            class="text-decoration-none"><?= $b['barang_kode'] ?></a></td>

                                    <td class="align-middle"><?= $b['nama'] ?></td>
                                    <td class="align-middle">Rp. <?= number_format($b['harga'], 0, ',', '.') ?></td>
                                    <td class="align-middle"><?= $b['jumlah'] ?></td>
                                    <td class="align-middle">Rp. <?= number_format($b['total'], 0, ',', '.') ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>