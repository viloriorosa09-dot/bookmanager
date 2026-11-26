<?php
require __DIR__ . '/_init.php';

$modo = 'editar';
$errores = [];
$id = trim((string) ($_GET['id'] ?? $_POST['id_tienda'] ?? ''));
$actual = $tienda->getById($id);

if ($actual === null) {
    mensaje('danger', 'La tienda indicada no existe.');
    header('Location: listar.php');
    exit;
}

$datos = $actual;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = Tienda::depurar($_POST);
    $datos['id_tienda'] = $id;
    $errores = Tienda::validar($datos, false);

    if (!$errores) {
        try {
            $tienda->update($id, $datos);
            mensaje('success', 'Tienda actualizada correctamente.');
            header('Location: listar.php');
            exit;
        } catch (PDOException $e) {
            $errores[] = 'No se pudo actualizar la tienda. Inténtalo de nuevo.';
        }
    }
}

abrirPagina('Editar tienda');
require __DIR__ . '/_form.php';
cerrarPagina();
