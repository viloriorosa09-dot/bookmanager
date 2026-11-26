<?php
require __DIR__ . '/_init.php';

$modo = 'crear';
$errores = [];
$datos = Tienda::depurar([]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = Tienda::depurar($_POST);
    $errores = Tienda::validar($datos, true);

    if (!$errores && $tienda->getById($datos['id_tienda']) !== null) {
        $errores[] = 'Ya existe una tienda con ese ID.';
    }

    if (!$errores) {
        try {
            $tienda->create($datos);
            mensaje('success', 'Tienda creada correctamente.');
            header('Location: listar.php');
            exit;
        } catch (PDOException $e) {
            $errores[] = 'No se pudo guardar la tienda. Inténtalo de nuevo.';
        }
    }
}

abrirPagina('Nueva tienda');
require __DIR__ . '/_form.php';
cerrarPagina();
