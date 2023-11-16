<main class="mt-5 pt-3">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h4>User</h4>
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
                <form class="modal-content" action="<?= base_url('dashboard/addUser') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Masukkan Username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="mitra123"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select" aria-label="Default select example">
                                <option value="0">Pilih Role</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="STAFF">STAFF</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="staffId" class="form-label">Staff</label>
                            <select name="staffId" id="staffId" class="form-select" aria-label="Default select example">
                                <option value="role">Pilih Staff</option>
                                <?php foreach ($staff as $s) { ?>
                                    <option value="<?= $s['id'] ?>"><?= $s['id'] . ' | ' . $s['nama']; ?></option>
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
                <span><i class="bi bi-table me-2"></i></span> Data User
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableKategori" class="table table-striped data-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Staff</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user as $use => $s) { ?>
                                <?php if ($s['username'] !== $this->session->userdata('username')) { ?>
                                    <tr>
                                        <td class="align-middle"><?= $use + 1 ?></td>
                                        <td class="align-middle"><?= $s['username'] ?></td>
                                        <td class="align-middle"><?= $s['role'] ?></td>
                                        <td class="align-middle"><?= $s['nama'] ?></td>
                                        <td>
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#update<?= $use + 1 ?>"><i class="bi bi-pencil-fill"></i>
                                                Update</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#reset<?= $use + 1 ?>"><i class="bi bi-pencil-fill"></i>
                                                Reset</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete<?= $use + 1 ?> "><i class="bi bi-trash"></i>
                                                Delete</button>
                                            <div class="modal fade" id="update<?= $use + 1 ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">

                                                    <form class="modal-content" action="<?= base_url('dashboard/updateUser') ?>"
                                                        method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Update User
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="text" hidden name='user_id'
                                                                    value="<?= $s['user_id'] ?>">
                                                                <label for="upt_username<?= $use + 1 ?>" class="form-label">
                                                                    Username
                                                                </label>
                                                                <input type="text" name="username-old" hidden readonly
                                                                    value="<?= $s['username'] ?>">
                                                                <input type="text" class="form-control"
                                                                    id="upt_username<?= $use + 1 ?>" name="upt_username"
                                                                    placeholder="Masukkan Kategori"
                                                                    value="<?= $s['username'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="upt_role<?= $use + 1 ?>" class="form-label">
                                                                    Role
                                                                </label>
                                                                <select name="upt_role" id="upt_role<?= $use + 1 ?>"
                                                                    class="form-select" aria-label="Default select example">
                                                                    <option value="<?= $s['role'] ?>"><?= $s['role'] ?></option>
                                                                    <option value="ADMIN">ADMIN</option>
                                                                    <option value="STAFF">STAFF</option>
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

                                            <div class="modal fade" id="reset<?= $use + 1 ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Reset Password
                                                                <?= $s['username']; ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?= base_url('dashboard/resetUser/' . $s['user_id']) ?>"
                                                                type="button" class="btn btn-primary">Reset</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="delete<?= $use + 1 ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus User
                                                                <?= $s['username']; ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?= base_url('dashboard/deleteUser/' . $s['user_id']) ?>"
                                                                type="button" class="btn btn-primary">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>