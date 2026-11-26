<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Publicador.php';

$database = new Database();
$db = $database->getConexion();
$publicador = new Publicador($db);

$errores = [];
$datos = Publicador::depurar([]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = Publicador::depurar($_POST);
    $errores = Publicador::validar($datos, true);

    if (!$errores && $publicador->getById($datos['id_pub']) != null) {
        $errores[] = 'Ya existe un publicador con ese ID.';
    }

    if (!$errores) {
        try {
            $publicador->create($datos);
            header('Location: listar.php?mensaje=' . urlencode('Publicador creado correctamente'));
            exit;
        } catch (PDOException $e) {
            $errores[] = 'No se pudo guardar el publicador. Inténtalo de nuevo.';
        }
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<h1 class="h3 mb-4 text-gray-800">Nuevo Publicador</h1>

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
                <label>ID (4 caracteres)</label>
                <input type="text" name="id_pub" class="form-control" maxlength="4" value="<?php echo htmlspecialchars($datos['id_pub']); ?>" required>
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
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>
