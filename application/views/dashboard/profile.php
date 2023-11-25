<main class="mt-5 pt-3">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h4>Profile</h4>
            </div>
        </div>
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
                <?= validation_errors('<div>', '</div>') ?><button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        <?php } ?>
        <?= $this->session->flashdata('pesan'); ?>
        <form action="<?= base_url('profile/updateprofile') ?>" method="post" class="d-grid gap-2">
            <?php foreach ($profile as $pro => $p) { ?>
                <div class="col-auto col-md-4">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $p['username'] ?>">
                </div>
                <div class="col-auto col-md-4">
                    <label for="password">New Password</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Input New Password">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="<?= base_url() ?>">Back</a>
                </div>
            <?php } ?>
        </form>
    </div>
</main>