<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Publicador.php';

$database = new Database();
$db = $database->getConexion();
$publicador = new Publicador($db);

$id = $_GET['id'] ?? '';
$registro = $publicador->getById($id);

if ($registro == null) {
    header('Location: listar.php?error=Publicador no encontrado');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_pub = trim($_POST['nombre_pub']);
    $ciudad = trim($_POST['ciudad']);
    $estado = trim($_POST['estado']);

    if ($nombre_pub == '' || $ciudad == '' || $estado == '') {
        $error = 'Todos los campos son obligatorios.';
    } else {
        $datos = [
            'nombre_pub' => $nombre_pub,
            'ciudad' => $ciudad,
            'estado' => $estado
        ];
        $publicador->update($id, $datos);
        header('Location: listar.php?mensaje=Publicador actualizado correctamente');
        exit;
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<h1 class="h3 mb-4 text-gray-800">Editar Publicador</h1>

<?php if ($error != '') { ?>
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php } ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="">
            <div class="form-group">
                <label>ID</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($registro['id_pub']); ?>" disabled>
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre_pub" class="form-control" maxlength="30" value="<?php echo htmlspecialchars($registro['nombre_pub']); ?>" required>
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <input type="text" name="ciudad" class="form-control" maxlength="15" value="<?php echo htmlspecialchars($registro['ciudad']); ?>" required>
            </div>
            <div class="form-group">
                <label>Estado (2 letras)</label>
                <input type="text" name="estado" class="form-control" maxlength="2" value="<?php echo htmlspecialchars($registro['estado']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar cambios</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>