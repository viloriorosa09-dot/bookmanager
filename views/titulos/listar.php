<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Titulo.php';

$db = new Database();
$titulo = new Titulo($db->getConexion());
$titulos = $titulo->getAll();

require_once __DIR__ . '/../../includes/header.php';
?>

<h1 class="h3 mb-4 text-gray-800">Títulos</h1>
<a href="crear.php" class="btn btn-primary mb-3">Nuevo título</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th><th>Título</th><th>Tipo</th>
            <th>Editorial</th><th>Precio</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($titulos as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['id_titulo']) ?></td>
            <td><?= htmlspecialchars($t['titulo']) ?></td>
            <td><?= htmlspecialchars($t['tipo']) ?></td>
            <td><?= htmlspecialchars($t['id_pub']) ?></td>
            <td><?= htmlspecialchars((string)$t['precio']) ?></td>
            <td>
                <a href="editar.php?id=<?= urlencode($t['id_titulo']) ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="eliminar.php?id=<?= urlencode($t['id_titulo']) ?>" class="btn btn-sm btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
<a href="eliminar.php?id=<?= urlencode($t['id_titulo']) ?>" class="btn btn-sm btn-danger"
   onclick="return confirm('¿Eliminar este título?')">Eliminar</a>