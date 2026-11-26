<?php
require __DIR__ . '/_init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar.php');
    exit;
}

$id = trim((string) ($_POST['id_tienda'] ?? ''));

if ($tienda->getById($id) === null) {
    mensaje('danger', 'La tienda indicada no existe.');
} elseif ($tienda->tieneRegistros($id)) {
    mensaje('warning', 'No se puede eliminar: la tienda tiene ventas o descuentos asociados.');
} else {
    try {
        $tienda->delete($id);
        mensaje('success', 'Tienda eliminada correctamente.');
    } catch (PDOException $e) {
        mensaje('danger', 'No se pudo eliminar la tienda. Inténtalo de nuevo.');
    }
}

header('Location: listar.php');
exit;
