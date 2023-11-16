<main class="mt-5 pt-3">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h4>Staff</h4>
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
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" action="<?= base_url('dashboard/addStaff') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Staff</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
                        </div>
                        <div class="mb-3">
                            <label for="noKtp" class="form-label">No Ktp</label>
                            <input type="text" class="form-control" id="noKtp" name="noKtp"
                                placeholder="Masukkan No Ktp">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="Masukkan Alamat">
                        </div>
                        <div class="mb-3">
                            <label for="noHp" class="form-label">No Hp</label>
                            <input type="text" class="form-control" id="noHp" name="noHp" placeholder="Masukkan No Hp">
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
                <span><i class="bi bi-table me-2"></i></span> Data Staff
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableKategori" class="table table-striped data-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Ktp</th>
                                <th>Alamat</th>
                                <th>No Hp</th>
                                <th>createdAt</th>
                                <th>updatedAt</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($staff as $sta => $s) { ?>
                                <tr>
                                    <td class="align-middle"><?= $sta + 1 ?></td>
                                    <td class="align-middle"><?= $s['nama'] ?></td>
                                    <td class="align-middle"><?= $s['no_ktp'] ?></td>
                                    <td class="align-middle"><?= $s['alamat'] ?></td>
                                    <td class="align-middle"><?= $s['no_hp'] ?></td>
                                    <td class="align-middle"><?= $s['createdAt'] ?></td>
                                    <td class="align-middle"><?= $s['updatedAt'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#update<?= $sta + 1 ?>"><i class="bi bi-pencil-fill"></i>
                                            Update</button>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete<?= $sta + 1 ?> "><i class="bi bi-trash"></i>
                                            Delete</button>
                                        <div class="modal fade" id="update<?= $sta + 1 ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <form class="modal-content"
                                                    action="<?= base_url('dashboard/updateStaff') ?>" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Update Staff
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="upt_nama<?= $sta + 1 ?>" class="form-label">
                                                                Nama Staff
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                id="upt_nama<?= $sta + 1 ?>" name="upt_nama"
                                                                placeholder="Masukkan Nama" value="<?= $s['nama'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="upt_noKtp<?= $sta + 1 ?>" class="form-label">
                                                                No Ktp
                                                            </label>
                                                            <input type="text" name="noKtp-old" hidden readonly
                                                                value="<?= $s['no_ktp'] ?>">
                                                            <input type="text" class="form-control"
                                                                id="upt_noKtp<?= $sta + 1 ?>" name="upt_noKtp"
                                                                placeholder="Masukkan No Ktp" value="<?= $s['no_ktp'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="upt_alamat<?= $sta + 1 ?>" class="form-label">
                                                                Alamat
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                id="upt_alamat<?= $sta + 1 ?>" name="upt_alamat"
                                                                placeholder="Masukkan Alamat" value="<?= $s['alamat'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="upt_noHp<?= $sta + 1 ?>" class="form-label">
                                                                No Hp
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                id="upt_noHp<?= $sta + 1 ?>" name="upt_noHp"
                                                                placeholder="Masukkan No Hp" value="<?= $s['no_hp'] ?>">
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
                                        <div class="modal fade" id="delete<?= $sta + 1 ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Staff
                                                            <?= $s['nama']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('dashboard/deleteStaff/' . $s['id']) ?>"
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