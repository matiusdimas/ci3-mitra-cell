<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4>Supplier</h4>
            </div>
        </div>
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
                <?= validation_errors('<div>', '</div>') ?><button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        <?php } ?>
        <?= $this->session->flashdata('pesan'); ?>
        <div class="mb-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add"><i class="bi bi-plus"></i>
                Add</button>
        </div>
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <form class="modal-content" action="<?= base_url('dashboard/addSupplier') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Supplier</label>
                            <input required value="<?= set_value('kode'); ?>" type="text" class="form-control" id="kode"
                                name="kode" placeholder="Ex = 'SUP-IR20'">
                        </div>
                        <div class="mb-3">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input required value="<?= set_value('nama_supplier'); ?>" type="text" class="form-control"
                                id="nama_supplier" name="nama_supplier" placeholder="Masukkan Nama Supplier">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input required value="<?= set_value('alamat'); ?>" type="text" class="form-control"
                                id="alamat" name="alamat" placeholder="Masukkan Alamat">
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input required value="<?= set_value('no_telp'); ?>" type="text" class="form-control"
                                id="no_telp" name="no_telp" placeholder="Masukkan no_telp">
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
                <span><i class="bi bi-table me-2"></i></span> Data Supplier
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-striped table-bordered data-table" style="width: 100%">
                        <thead>
                            <tr class="">
                                <th>No</th>
                                <th>Nama Supplier</th>
                                <th>Alamat Supplier</th>
                                <th>No Telp</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($supplier as $sup => $s) { ?>
                                <tr>
                                    <td class="align-middle"><?= $s['kode'] ?></td>
                                    <td class="align-middle"><?= $s['nama'] ?></td>
                                    <td class="align-middle"><?= $s['alamat'] ?></td>
                                    <td class="align-middle"><?= $s['no_telp'] ?></td>
                                    <td class="align-middle"><?= $s['username'] ?></td>
                                    <td class="align-middle"><?= $s['createdAt'] ?></td>
                                    <td class="align-middle"><?= $s['updatedAt'] ?></td>
                                    <td>
                                        <button class="btn btn-primary mb-1" data-bs-toggle="modal"
                                            data-bs-target="#update<?= $sup + 1 ?>"><i class="bi bi-pencil-fill"></i>
                                            Update</button>
                                        <button class="btn btn-danger mb-1" data-bs-toggle="modal"
                                            data-bs-target="#delete<?= $sup + 1 ?> "><i class="bi bi-trash"></i>
                                            Delete</button>
                                        <div class="modal fade" id="update<?= $sup + 1 ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <form class="modal-content"
                                                    action="<?= base_url('dashboard/updateSupplier') ?>" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update
                                                            Supplier
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" name="kode-old" hidden value="<?= $s['kode'] ?>">
                                                        <input type="text" name="nama-old" hidden value="<?= $s['nama'] ?>">
                                                        <div class="mb-3">
                                                            <label for="kode" class="form-label">Kode</label>
                                                            <input type="text" class="form-control" id="kode" name="kode"
                                                                placeholder="Masukkan Nama Supplier"
                                                                value="<?= $s['kode'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nama_supplier" class="form-label">Nama
                                                                Supplier</label>
                                                            <input type="text" class="form-control" id="nama_supplier"
                                                                name="nama_supplier" placeholder="Masukkan Nama Supplier"
                                                                value="<?= $s['nama'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">Alamat
                                                                Supplier</label>
                                                            <input type="text" class="form-control" id="alamat"
                                                                name="alamat" placeholder="Masukkan Alamat"
                                                                value="<?= $s['alamat'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="no_telp" class="form-label">No Telp</label>
                                                            <input type="text" class="form-control" id="no_telp"
                                                                name="no_telp" placeholder="Masukkan No Telp"
                                                                value="<?= $s['no_telp'] ?>">
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

                                        <div class="modal fade" id="delete<?= $sup + 1 ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Supplier
                                                            <?= $s['nama']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('dashboard/deleteSupplier/' . $s['kode']) ?>"
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