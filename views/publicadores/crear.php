<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Publicador.php';

$database = new Database();
$db = $database->getConexion();
$publicador = new Publicador($db);

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pub = trim($_POST['id_pub']);
    $nombre_pub = trim($_POST['nombre_pub']);
    $ciudad = trim($_POST['ciudad']);
    $estado = trim($_POST['estado']);

    if ($id_pub == '' || $nombre_pub == '' || $ciudad == '' || $estado == '') {
        $error = 'Todos los campos son obligatorios.';
    } else if ($publicador->getById($id_pub) != null) {
        $error = 'Ya existe un publicador con ese ID.';
    } else {
        $datos = [
            'id_pub' => $id_pub,
            'nombre_pub' => $nombre_pub,
            'ciudad' => $ciudad,
            'estado' => $estado
        ];
        $publicador->create($datos);
        header('Location: listar.php?mensaje=Publicador creado correctamente');
        exit;
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<h1 class="h3 mb-4 text-gray-800">Nuevo Publicador</h1>

<?php if ($error != '') { ?>
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php } ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="">
            <div class="form-group">
                <label>ID (4 caracteres)</label>
                <input type="text" name="id_pub" class="form-control" maxlength="4" required>
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre_pub" class="form-control" maxlength="30" required>
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <input type="text" name="ciudad" class="form-control" maxlength="15" required>
            </div>
            <div class="form-group">
                <label>Estado (2 letras)</label>
                <input type="text" name="estado" class="form-control" maxlength="2" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>