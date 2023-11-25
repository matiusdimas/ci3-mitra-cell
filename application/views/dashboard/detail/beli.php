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
        <div class="row align-items-end mb-3">
            <div class="col-3">
                <label for="tahun" class="form-label">Pilih Tahun</label>
                <select class="form-select" id="tahun" aria-label="Default select example">
                    <option value="0">Semua Tahun</option>
                    <?php foreach ($tahun as $t) { ?>
                        <?php if (isset($tahun_query) && $tahun_query === $t) { ?>
                            <option value="<?= $t ?>" selected><?= $tahun_query ?></option>
                        <?php } else { ?>
                            <option value="<?= $t ?>"><?= $t ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
            <div class="col-3">
                <label for="bulan" class="form-label">Pilih Bulan</label>
                <select class="form-select" id="bulan" aria-label="Default select example">
                    <option value="0">Semua Bulan</option>
                    <?php foreach ($bulan as $b) { ?>
                        <?php if (isset($bulan_query) && $bulan_query === $b) { ?>
                            <option value="<?= $b ?>" selected><?= date('F', mktime(0, 0, 0, $b, 1)) ?></option>
                        <?php } else { ?>
                            <option value="<?= $b ?>"><?= date('F', mktime(0, 0, 0, $b, 1)) ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
            <?php if (isset($tahun_query)) { ?>
                <div class="col-3">
                    <a href="detail_beli/laporanPdf/<?= $tahun_query . '/' . $bulan_query ?>" target="_blank"
                        class="btn btn-success"><i class="bi bi-printer-fill"></i>
                        Print</a>
                </div>
            <?php } ?>
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
                                        <a href="detail_beli/pdf/<?= $b['nofak'] ?>" target="_blank"
                                            class="btn btn-success mb-1"><i class="bi bi-printer-fill"></i>
                                            Print</a>
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
<script>
    $('#tahun, #bulan').on('change', function () {
        var selectedTahun = $('#tahun').val();
        var selectedBulan = $('#bulan').val();

        var baseUrl = window.location.href.split('?')[0]; // Mengambil bagian sebelum tanda '?'
        var queryParams = {};

        if (selectedTahun && selectedTahun !== '0') {
            queryParams['tahun'] = selectedTahun;
        }
        if (selectedBulan && selectedBulan !== '0') {
            queryParams['bulan'] = selectedBulan;
        }

        var queryString = $.param(queryParams); // Mengubah objek menjadi string query

        var finalUrl = baseUrl;
        if (queryString !== '') {
            finalUrl += '?' + queryString;
        }

        window.location.href = finalUrl;
    });

</script>