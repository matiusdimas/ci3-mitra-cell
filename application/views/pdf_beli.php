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
    <div class="container mt-5">
        <h2 class="text-center">Mitra Cell</h2>
        <p class="text-center">Faktur Beli</p>
        <p class="text-center">No. <?= $nofak ?></p>
        <p class="text-center"><?= $tanggal ?></p>
        <p class="text-center">SUPPLIER : <?= $supplier_kode ?></p>
        <div class="">
            <div class="">
                <div class="">
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
                            <?php foreach ($detail_beli as $i => $d) { ?>
                                <tr>
                                    <td><?= $d['barang_kode'] ?></td>
                                    <td><?= $d['nama'] ?></td>
                                    <td>Rp. <?= number_format($d['harga'], 0, ',', '.') ?></td>
                                    <td><?= $d['jumlah'] ?></td>
                                    <td>Rp. <?= number_format($d['total'], 0, ',', '.') ?></td>
                                </tr>
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
            </div>
        </div>
        <div class="d-flex justify-content-end mt-4 me-5">
            <div class="d-flex gap-3">
                <div class="d-grid gap-2">
                    <table id="example" class="" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($beli as $b) { ?>
                                <tr>
                                    <td>
                                        Rp. <?= number_format($b['total'], 0, ',', '.') ?>
                                    </td>
                                </tr>
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
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>