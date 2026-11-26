<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/header.php';

$database = new Database();
$db = $database->getConexion();

$stmtTiendas = $db->prepare("SELECT COUNT(*) FROM tiendas");
$stmtTiendas->execute();
$totalTiendas = $stmtTiendas->fetchColumn();

$stmtPublicadores = $db->prepare("SELECT COUNT(*) FROM publicadores");
$stmtPublicadores->execute();
$totalPublicadores = $stmtPublicadores->fetchColumn();

$stmtTitulos = $db->prepare("SELECT COUNT(*) FROM titulos");
$stmtTitulos->execute();
$totalTitulos = $stmtTitulos->fetchColumn();
?>

<h1 class="h3 mb-4 text-gray-800">Inicio</h1>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tiendas</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalTiendas; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Publicadores</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalPublicadores; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Títulos</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalTitulos; ?></div>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>