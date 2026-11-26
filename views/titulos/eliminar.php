<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Titulo.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar.php');
    exit;
}

$db = new Database();
$titulo = new Titulo($db->getConexion());

$id = trim((string) ($_POST['id_titulo'] ?? ''));

if ($titulo->getById($id) === null) {
    $destino = 'error=' . urlencode('El título indicado no existe.');
} elseif ($titulo->tieneRegistros($id)) {
    $destino = 'error=' . urlencode('No se puede eliminar: el título tiene ventas, autores o derechos asociados.');
} else {
    try {
        $titulo->delete($id);
        $destino = 'mensaje=' . urlencode('Título eliminado correctamente.');
    } catch (PDOException $e) {
        $destino = 'error=' . urlencode('No se pudo eliminar el título. Inténtalo de nuevo.');
    }
}

header('Location: listar.php?' . $destino);
exit;
