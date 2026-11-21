<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Publicador.php';
require_once __DIR__ . '/includes/header.php';

$database = new Database();
$db = $database->getConexion();

$publicador = new Publicador($db);
$lista = $publicador->getAll();
?>

<h1 class="h3 mb-4 text-gray-800">Inicio</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <p>Total de publicadores: <?php echo count($lista); ?></p>
    </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>