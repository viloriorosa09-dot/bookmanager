<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Publicador.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar.php');
    exit;
}

$database = new Database();
$db = $database->getConexion();
$publicador = new Publicador($db);

$id = trim((string) ($_POST['id_pub'] ?? ''));

if ($id == '' || $publicador->getById($id) == null) {
    $destino = 'error=' . urlencode('Publicador no encontrado');
} elseif ($publicador->tieneTitulos($id)) {
    $destino = 'error=' . urlencode('No se puede eliminar porque este publicador tiene títulos registrados');
} else {
    try {
        $publicador->delete($id);
        $destino = 'mensaje=' . urlencode('Publicador eliminado correctamente');
    } catch (PDOException $e) {
        $destino = 'error=' . urlencode('No se pudo eliminar el publicador. Inténtalo de nuevo.');
    }
}

header('Location: listar.php?' . $destino);
exit;
