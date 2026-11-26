<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Titulo.php';

$db = new Database();
$titulo = new Titulo($db->getConexion());

$id = $_GET['id'] ?? '';

if ($id !== '') {
    $titulo->delete($id);
}

header('Location: listar.php');
exit;