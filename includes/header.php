<?php
require_once __DIR__ . '/app.php';
$pagina = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BookManager</title>
    <link href="<?= BASE_URL ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book"></i>
                </div>
                <div class="sidebar-brand-text mx-3">BookManager</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item <?php if (basename($pagina) == 'index.php') { echo 'active'; } ?>">
                <a class="nav-link" href="<?= BASE_URL ?>index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item <?php if (strpos($pagina, 'tiendas') !== false) { echo 'active'; } ?>">
                <a class="nav-link" href="<?= BASE_URL ?>views/tiendas/listar.php">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Tiendas</span>
                </a>
            </li>

            <li class="nav-item <?php if (strpos($pagina, 'publicadores') !== false) { echo 'active'; } ?>">
                <a class="nav-link" href="<?= BASE_URL ?>views/publicadores/listar.php">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Publicadores</span>
                </a>
            </li>

            <li class="nav-item <?php if (strpos($pagina, 'titulos') !== false) { echo 'active'; } ?>">
                <a class="nav-link" href="<?= BASE_URL ?>views/titulos/listar.php">
                    <i class="fas fa-fw fa-book-open"></i>
                    <span>Títulos</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>
                <div class="container-fluid">