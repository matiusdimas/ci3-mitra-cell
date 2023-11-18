<main class="mt-5 pt-3">
    <div class="container-fluid">

        <?= form_error(
            'nama_kategori',
            '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">',
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
        ); ?>
        <?= form_error(
            'update_nama_kategori',
            '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">',
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
        ); ?>
        <?= $this->session->flashdata('pesan_tambah'); ?>
        <?= $this->session->flashdata('pesan_update'); ?>
        <?= $this->session->flashdata('pesan_delete'); ?>
        <div class="row">
            <div class="col-md-12">
                <h4>Kategori</h4>
            </div>
        </div>
        <div class="mb-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add"><i class="bi bi-plus"></i>
                Add</button>
        </div>
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" action="<?= base_url('kategori/addKategori') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                placeholder="Masukkan Kategori">
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
                <span><i class="bi bi-table me-2"></i></span> Data Kategori
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableKategori" class="table table-striped data-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kategori as $kat => $k) { ?>
                                <tr>
                                    <td><?= $kat + 1 ?></td>
                                    <td><?= $k['kategori_nama'] ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#update<?= $kat + 1 ?>"><i class="bi bi-pencil-fill"></i>
                                            Update</button>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete<?= $kat + 1 ?> "><i class="bi bi-trash"></i>
                                            Delete</button>
                                        <div class="modal fade" id="update<?= $kat + 1 ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">

                                                <form class="modal-content"
                                                    action="<?= base_url('kategori/updateKategori') ?>" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update
                                                            Kategori
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="text" hidden name='id' value="<?= $k['id'] ?>">
                                                            <label for="update_nama_kategori" class="form-label">Nama
                                                                Kategori</label>
                                                            <input type="text" class="form-control"
                                                                id="update_nama_kategori" name="update_nama_kategori"
                                                                placeholder="Masukkan Kategori"
                                                                value="<?= $k['kategori_nama'] ?>">
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

                                        <div class="modal fade" id="delete<?= $kat + 1 ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori
                                                            <?= $k['kategori_nama']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('kategori/hapusKategori/' . $k['id']) ?>"
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