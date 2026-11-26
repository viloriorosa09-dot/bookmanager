<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Titulo.php';
require_once __DIR__ . '/../../models/Publicador.php';

$db = new Database();
$conexion = $db->getConexion();
$titulo = new Titulo($conexion);
$publicador = new Publicador($conexion);
$editoriales = $publicador->getAll();
$idsEditoriales = array_column($editoriales, 'id_pub');

$modo = 'crear';
$errores = [];
$datos = Titulo::depurar([]);
$datos['contrato'] = '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = Titulo::depurar($_POST);
    $errores = Titulo::validar($datos, true, $idsEditoriales);

    if (!$errores && $titulo->getById($datos['id_titulo']) !== null) {
        $errores[] = 'Ya existe un título con ese ID.';
    }

    if (!$errores) {
        try {
            $titulo->create($datos);
            header('Location: listar.php?mensaje=' . urlencode('Título creado correctamente.'));
            exit;
        } catch (PDOException $e) {
            $errores[] = 'No se pudo guardar el título. Inténtalo de nuevo.';
        }
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>
<h1 class="h3 mb-4 text-gray-800">Nuevo título</h1>

<?php require __DIR__ . '/_form.php'; ?>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
