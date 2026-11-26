<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Titulo.php';

$db = new Database();
$titulo = new Titulo($db->getConexion());
$titulos = $titulo->getAll();

require_once __DIR__ . '/../../includes/header.php';
?>

<h1 class="h3 mb-4 text-gray-800">Títulos</h1>

<?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['mensaje']) ?></div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<a href="crear.php" class="btn btn-primary mb-3">Nuevo título</a>

<div class="table-responsive">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th><th>Título</th><th>Tipo</th>
            <th>Editorial</th><th>Precio</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($titulos)): ?>
        <tr><td colspan="6" class="text-center">No hay títulos registrados.</td></tr>
        <?php endif; ?>
        <?php foreach ($titulos as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['id_titulo']) ?></td>
            <td><?= htmlspecialchars($t['titulo']) ?></td>
            <td><?= htmlspecialchars($t['tipo']) ?></td>
            <td><?= htmlspecialchars($t['id_pub']) ?></td>
            <td><?= htmlspecialchars((string)$t['precio']) ?></td>
            <td class="text-nowrap">
                <a href="editar.php?id=<?= urlencode($t['id_titulo']) ?>" class="btn btn-sm btn-warning">Editar</a>
                <form method="post" action="eliminar.php" class="d-inline"
                      onsubmit="return confirm('¿Eliminar este título?');">
                    <input type="hidden" name="id_titulo" value="<?= htmlspecialchars($t['id_titulo']) ?>">
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
