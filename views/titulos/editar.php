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

$id = trim((string) ($_GET['id'] ?? ''));
$actual = $titulo->getById($id);

if ($actual === null) {
    header('Location: listar.php?error=' . urlencode('El título indicado no existe.'));
    exit;
}

$modo = 'editar';
$errores = [];
$datos = Titulo::depurar($actual);
$datos['fecha_pub'] = substr($datos['fecha_pub'], 0, 10);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = Titulo::depurar($_POST);
    $datos['id_titulo'] = $id;
    $errores = Titulo::validar($datos, false, $idsEditoriales);

    if (!$errores) {
        try {
            $titulo->update($id, $datos);
            header('Location: listar.php?mensaje=' . urlencode('Título actualizado correctamente.'));
            exit;
        } catch (PDOException $e) {
            $errores[] = 'No se pudo actualizar el título. Inténtalo de nuevo.';
        }
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>
<h1 class="h3 mb-4 text-gray-800">Editar título</h1>

<?php require __DIR__ . '/_form.php'; ?>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
