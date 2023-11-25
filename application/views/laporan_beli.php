<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?>/</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="mt-5">
        <h2 class="text-center">Mitra Cell</h2>
        <p class="text-center"><?= $title ?></p>
        <p class="text-center">Total Pembelian Rp. <?= number_format($totalBeli, 0, ',', '.') ?></p>
        <div>
            <div>
                <div>
                    <?php
                    foreach ($beli as $i => $b) { ?>
                        <div class="border rounded p-3 border-dark mb-3">
                            <div class="d-flex gap-3">
                                <div>
                                    <p>No Faktur : <?= $b['nofak'] ?></p>
                                    <p>Supplier : <?= $b['supplier_kode'] ?></p>
                                </div>
                                <div>
                                    <p>Tanggal : <?= $b['createdAt'] ?></p>
                                    <p>Total :Rp. <?= number_format($b['total'], 0, ',', '.') ?></p>
                                </div>
                            </div>
                            <table id="example" class="table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Barang Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail_beli as $db) { ?>
                                        <?php if ($db['beli_nofak'] == $b['nofak']) { ?>
                                            <tr>
                                                <td><?= $db['barang_kode'] ?></td>
                                                <td><?= $db['nama'] ?></td>
                                                <td>Rp. <?= number_format($db['harga'], 0, ',', '.') ?></td>
                                                <td><?= $db['jumlah'] ?></td>
                                                <td>Rp. <?= number_format($db['total'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>