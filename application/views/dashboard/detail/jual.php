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
                <h4>Penjualan</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Penjualan
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-striped table-bordered data-table" style="width: 100%">
                        <thead>
                            <tr class="">
                                <th>No Faktur</th>
                                <th>Tanggal Buat</th>
                                <th>Total</th>
                                <th>Jumlah Uang</th>
                                <th>Kembalian</th>
                                <th>Di Input</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jual as $jua => $j) { ?>
                                <tr>
                                    <td class="align-middle"><?= $j['nofak'] ?></td>
                                    <td class="align-middle"><?= $j['createdAt'] ?></td>
                                    <td class="align-middle">Rp. <?= number_format($j['total'], 0, ',', '.') ?></td>
                                    <td class="align-middle">Rp. <?= number_format($j['jml_uang'], 0, ',', '.') ?></td>
                                    <td class="align-middle">Rp. <?= number_format($j['kembalian'], 0, ',', '.') ?></td>
                                    <td class="align-middle"><a href="<?= base_url('user?query=' . $j['user_id']) ?> "
                                            class="text-decoration-none"><?= $j['username'] ?></a></td>
                                    <td>
                                        <a href="detail_jual/detail/<?= $j['nofak'] ?>" class="btn btn-primary mb-1"><i
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