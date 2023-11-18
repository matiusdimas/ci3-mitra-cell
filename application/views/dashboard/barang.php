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
                <h4>Barang</h4>
            </div>
        </div>
        <div class="mb-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add"><i class="bi bi-plus"></i>
                Add</button>
        </div>
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <form class="modal-content" action="<?= base_url('barang/addBarang') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Masukan Kode Barang</label>
                            <input required value="<?= set_value('kode'); ?>" type="text" class="form-control" id="kode"
                                name="kode" placeholder="Ex = 'BR-IP32'">
                        </div>
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input required value="<?= set_value('nama_barang'); ?>" type="text" class="form-control"
                                id="nama_barang" name="nama_barang" placeholder="Masukkan Barang">
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Pilih Kategori</label>
                            <select id="kategori" class="form-select" aria-label="Default select example"
                                name="id_kategori">
                                <option value="kosong" selected>Open this select menu</option>
                                <?php foreach ($kategori as $k) { ?>
                                    <option value="<?= $k['id'] ?>"><?= $k['kategori_nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Barang
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-striped table-bordered data-table" style="width: 100%">
                        <thead>
                            <tr class="">
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Pokok</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Input By</th>
                                <th>Input At</th>
                                <th>Last Input By</th>
                                <th>Last Input At</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($barang as $bar => $b) { ?>
                                <tr>
                                    <td class="align-middle"><?= $b['kode'] ?></td>
                                    <td class="align-middle"><?= $b['nama'] ?></td>
                                    <td class="align-middle">Rp. <?= number_format($b['harpok'], 0, ',', '.') ?></td>
                                    <td class="align-middle">Rp. <?= number_format($b['harjul'], 0, ',', '.') ?></td>
                                    <td class="align-middle"><?= $b['stok'] ?></td>
                                    <td class="align-middle"><a href="<?= base_url('kategori?query='. $b['kategori_id']) ?> " class="text-decoration-none"><?= $b['kategori_nama'] ?></a></td>
                                    <td class="align-middle"><a href="<?= base_url('user?query='. $b['user_id']) ?> " class="text-decoration-none"><?= $b['inputBy'] ?></td>
                                    <td class="align-middle"><?= $b['createdAt'] ?></td>
                                    <td class="align-middle"><a href="<?= base_url('user?query='. $b['user_id_last_updated']) ?> " class="text-decoration-none"><?= $b['last_inputBy'] ?></td>
                                    <td class="align-middle"><?= $b['updatedAt'] ?></td>
                                    <td>
                                        <button class="btn btn-primary mb-1" data-bs-toggle="modal"
                                            data-bs-target="#update<?= $bar + 1 ?>"><i class="bi bi-pencil-fill"></i>
                                            Update</button>
                                        <button class="btn btn-danger mb-1" data-bs-toggle="modal"
                                            data-bs-target="#delete<?= $bar + 1 ?> "><i class="bi bi-trash"></i>
                                            Delete</button>
                                        <div class="modal fade" id="update<?= $bar + 1 ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <form class="modal-content"
                                                    action="<?= base_url('barang/updateBarang') ?>" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update
                                                            Barang
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" name="kode-old" hidden value="<?= $b['kode'] ?>">
                                                        <input type="text" name="nama-old" hidden value="<?= $b['nama'] ?>">
                                                        <div class="mb-3">
                                                            <label for="kode" class="form-label">Kode Barang</label>
                                                            <input type="text" class="form-control" id="kode" name="kode"
                                                                placeholder="Ex = 'BR-IP220'" value="<?= $b['kode'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nama_barang" class="form-label">Nama
                                                                Barang</label>
                                                            <input type="text" class="form-control" id="nama_barang"
                                                                name="nama_barang" placeholder="Masukkan Barang"
                                                                value="<?= $b['nama'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harpok" class="form-label">Harga Pokok</label>
                                                            <input type="text" class="form-control" id="harpok"
                                                                name="harpok" placeholder="Masukkan Harga Pokok"
                                                                value="<?= $b['harpok'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harjul" class="form-label">Harga Jual</label>
                                                            <input type="text" class="form-control" id="harjul"
                                                                name="harjul" placeholder="Masukkan Harga Jual"
                                                                value="<?= $b['harjul'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="stok" class="form-label">Stok</label>
                                                            <input type="text" class="form-control" id="stok" name="stok"
                                                                placeholder="Masukkan Stok" value="<?= $b['stok'] ?>" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kategori" class="form-label">Pilih Kategori</label>
                                                            <select id="kategori" class="form-select"
                                                                aria-label="Default select example" name="id_kategori">
                                                                <?php foreach ($kategori as $k) { ?>
                                                                    <option value="<?= $k['id'] ?>" <?php if ($k['id'] == $b['kategori_id'])
                                                                          echo 'selected'; ?>>
                                                                        <?= $k['kategori_nama'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="delete<?= $bar + 1 ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Barang
                                                            <?= $b['nama']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('barang/deleteBarang/' . $b['kode']) ?>"
                                                            type="button" class="btn btn-primary">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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