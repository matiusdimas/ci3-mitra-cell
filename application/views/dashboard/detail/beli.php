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
                <h4>Pembelian</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Pembelian
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-striped table-bordered data-table" style="width: 100%">
                        <thead>
                            <tr class="">
                                <th>No Faktur</th>
                                <th>Tanggal Buat</th>
                                <th>Supplier</th>
                                <th>Di Input</th>
                                <th>Total</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($beli as $bel => $b) { ?>
                                <tr>
                                    <td class="align-middle"><?= $b['nofak'] ?></td>
                                    <td class="align-middle"><?= $b['createdAt'] ?></td>
                                    <td class="align-middle"><a
                                            href="<?= base_url('supplier?query=' . $b['supplier_kode']) ?> "
                                            class="text-decoration-none"><?= $b['supplier_kode'] ?></a></td>
                                    <td class="align-middle"><a href="<?= base_url('user?query=' . $b['user_id']) ?> "
                                            class="text-decoration-none"><?= $b['username'] ?></a></td>
                                    <td class="align-middle">Rp. <?= number_format($b['total'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="detail_beli/detail/<?= $b['nofak'] ?>" class="btn btn-primary mb-1"><i
                                                class="bi bi-list-ol"></i>
                                            Detail</a>
                                        <button class="btn btn-success mb-1"><i class="bi bi-printer-fill"></i>
                                            Print</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>