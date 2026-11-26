<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Publicador.php';

$database = new Database();
$db = $database->getConexion();
$publicador = new Publicador($db);

$id = trim((string) ($_GET['id'] ?? ''));
$registro = $publicador->getById($id);

if ($registro == null) {
    header('Location: listar.php?error=' . urlencode('Publicador no encontrado'));
    exit;
}

$errores = [];
$datos = Publicador::depurar($registro);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = Publicador::depurar($_POST);
    $datos['id_pub'] = $id;
    $errores = Publicador::validar($datos, false);

    if (!$errores) {
        try {
            $publicador->update($id, $datos);
            header('Location: listar.php?mensaje=' . urlencode('Publicador actualizado correctamente'));
            exit;
        } catch (PDOException $e) {
            $errores[] = 'No se pudo actualizar el publicador. Inténtalo de nuevo.';
        }
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<h1 class="h3 mb-4 text-gray-800">Editar Publicador</h1>

<?php if (!empty($errores)) { ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errores as $error) { ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="">
            <div class="form-group">
                <label>ID</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($datos['id_pub']); ?>" disabled>
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre_pub" class="form-control" maxlength="30" value="<?php echo htmlspecialchars($datos['nombre_pub']); ?>" required>
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <input type="text" name="ciudad" class="form-control" maxlength="15" value="<?php echo htmlspecialchars($datos['ciudad']); ?>" required>
            </div>
            <div class="form-group">
                <label>Estado (2 letras)</label>
                <input type="text" name="estado" class="form-control" maxlength="2" value="<?php echo htmlspecialchars($datos['estado']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar cambios</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>
