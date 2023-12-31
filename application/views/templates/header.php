<?php
function activeNavbar($name, $active_navbar)
{
    return $name == $active_navbar ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css" />
    <title><?= $title ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
            </button>
            <a class="navbar-brand me-auto ms-lg-2 ms-3 mt-lg-1 text-uppercase fw-bold"
                href="<?= base_url() ?>"><strong>Mitra
                    Cell</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar"
                aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="topNavBar">
                <ul class="navbar-nav d-flex ms-auto my-3 my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-fill"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">

                    <?php if ($this->session->userdata('role') === 'STAFF') { ?>
                        <li>
                            <a href="<?= base_url('jual') ?>"
                                class="mt-2 nav-link px-3 <?= activeNavbar('jual', $active_navbar) ?>">
                                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                <span>Jual</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?= base_url('dashboard') ?>"
                                class="mt-2 nav-link px-3 <?= activeNavbar('dashboard', $active_navbar) ?>">
                                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link px-3 sidebar-link <?= activeNavbar('jual', $active_navbar) ?> <?= activeNavbar('beli', $active_navbar) ?>"
                                data-bs-toggle="collapse" href="#pesan">
                                <span class="me-2"><i class="bi bi-journal-text"></i></span>
                                <span>Input Pesanan</span>
                                <span class="ms-auto">
                                    <span class="right-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </span>
                                </span>
                            </a>
                            <div class="collapse" id="pesan">
                                <ul class="navbar-nav ps-3">
                                    <li>
                                        <a href="<?= base_url('jual') ?>"
                                            class="nav-link px-3 <?= activeNavbar('jual', $active_navbar) ?>">
                                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                            <span>Jual</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('beli') ?>"
                                            class="nav-link px-3 <?= activeNavbar('beli', $active_navbar) ?>">
                                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                            <span>Beli</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="nav-link px-3 sidebar-link <?= activeNavbar('supplier', $active_navbar) ?> <?= activeNavbar('kategori', $active_navbar) ?> <?= activeNavbar('barang', $active_navbar) ?>"
                                data-bs-toggle="collapse" href="#data">
                                <span class="me-2"><i class="bi bi-box-seam"></i></span>
                                <span>Data Barang</span>
                                <span class="ms-auto">
                                    <span class="right-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </span>
                                </span>
                            </a>
                            <div class="collapse" id="data">
                                <ul class="navbar-nav ps-3">
                                    <li>
                                        <a href="<?= base_url('supplier') ?>"
                                            class="nav-link px-3 <?= activeNavbar('supplier', $active_navbar) ?>">
                                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                            <span>Supplier</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('kategori') ?>"
                                            class="nav-link px-3 <?= activeNavbar('kategori', $active_navbar) ?>">
                                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                            <span>Kategori</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('barang') ?>"
                                            class="nav-link px-3 <?= activeNavbar('barang', $active_navbar) ?>">
                                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                            <span>Barang</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="nav-link px-3 sidebar-link <?= activeNavbar('pembelian', $active_navbar) ?> <?= activeNavbar('penjualan', $active_navbar) ?>"
                                data-bs-toggle="collapse" href="#layouts">
                                <span class="me-2"><i class="bi bi-archive-fill"></i></span>
                                <span>Detail</span>
                                <span class="ms-auto">
                                    <span class="right-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </span>
                                </span>
                            </a>
                            <div class="collapse" id="layouts">
                                <ul class="navbar-nav ps-3">
                                    <li>
                                        <a href="<?= base_url('detail_beli') ?>"
                                            class="nav-link px-3 <?= activeNavbar('pembelian', $active_navbar) ?>">
                                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                            <span>Beli</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('detail_jual') ?>"
                                            class="nav-link px-3 <?= activeNavbar('penjualan', $active_navbar) ?>">
                                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                            <span>Jual</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="nav-link px-3 sidebar-link <?= activeNavbar('user', $active_navbar) ?> <?= activeNavbar('staff', $active_navbar) ?>"
                                data-bs-toggle="collapse" href="#user">
                                <span class="me-2"><i class="bi bi-people-fill"></i></span>
                                <span>Data User</span>
                                <span class="ms-auto">
                                    <span class="right-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </span>
                                </span>
                            </a>
                            <div class="collapse" id="user">
                                <ul class="navbar-nav ps-3">
                                    <li>
                                        <a href="<?= base_url('user') ?>"
                                            class="nav-link px-3 <?= activeNavbar('user', $active_navbar) ?>">
                                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                            <span>User</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('staff') ?>"
                                            class="nav-link px-3 <?= activeNavbar('staff', $active_navbar) ?>">
                                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                            <span>Staff</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    <?php } ?>
                    <li class="my-4">
                        <hr class="dropdown-divider bg-light" />
                    </li>
                    <li>
                        <a href="<?= base_url('profile') ?>"
                            class="nav-link px-3 <?= activeNavbar('profile', $active_navbar) ?>">
                            <span class="me-2"><i class="bi bi-person-fill"></i></span>
                            <span>Profile</span>
                        </a>
                        <a href="<?= base_url('auth/logout') ?>" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-box-arrow-in-left"></i></span>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>