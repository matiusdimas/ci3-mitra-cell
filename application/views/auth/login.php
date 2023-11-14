<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <title><?= $title ?></title>
    <style>
        body {
            background-image: url('<?= base_url('assets/img/hp2.jpg') ?>');
            background-size: cover;
            display: grid;
            place-content: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <form action="<?= base_url('auth/login') ?>" method="post" class="bg-white rounded shadow row">
        <div class="card py-3 px-4">
            <h1 class="text-center">Mitra Cell Phone</h1>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Input Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="*******">
            </div>
            <?= $this->session->flashdata('pesan'); ?>
            <button type="submit" class="btn btn-primary mb-2">Login</button>
        </div>
    </form>
</body>

<script src="<?= base_url('assets/') ?>js/bootstrap.bundle.min.js"></script>

</body>

</html>