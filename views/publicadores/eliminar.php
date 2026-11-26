<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Publicador.php';

$database = new Database();
$db = $database->getConexion();
$publicador = new Publicador($db);

$id = $_GET['id'] ?? '';

if ($id == '') {
    header('Location: listar.php?error=ID no válido');
    exit;
}

if ($publicador->tieneTitulos($id)) {
    header('Location: listar.php?error=No se puede eliminar porque este publicador tiene títulos registrados');
    exit;
}

$publicador->delete($id);
header('Location: listar.php?mensaje=Publicador eliminado correctamente');
exit;