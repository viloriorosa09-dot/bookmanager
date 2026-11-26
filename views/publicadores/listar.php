<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Publicador.php';
require_once __DIR__ . '/../../includes/header.php';

$database = new Database();
$db = $database->getConexion();

$publicador = new Publicador($db);
$lista = $publicador->getAll();
?>

<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Publicadores</h1>
    <a href="crear.php" class="btn btn-success">Nuevo Publicador</a>
</div>

<?php if (isset($_GET['mensaje'])) { ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($_GET['mensaje']); ?>
    </div>
<?php } ?>

<?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php } ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $fila) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila['id_pub']); ?></td>
                            <td><?php echo htmlspecialchars($fila['nombre_pub']); ?></td>
                            <td><?php echo htmlspecialchars($fila['ciudad']); ?></td>
                            <td><?php echo htmlspecialchars($fila['estado']); ?></td>
                            <td>
                                <a href="editar.php?id=<?php echo htmlspecialchars($fila['id_pub']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                <form method="POST" action="eliminar.php" class="d-inline" onsubmit="return confirm('¿Seguro que quieres eliminar este publicador?');">
                                    <input type="hidden" name="id_pub" value="<?php echo htmlspecialchars($fila['id_pub']); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>