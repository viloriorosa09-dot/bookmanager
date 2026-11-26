<?php
require __DIR__ . '/_init.php';

$tiendas = $tienda->getAll();

abrirPagina('Tiendas');
mostrarMensaje();
?>
<a href="crear.php" class="btn btn-success mb-3">Nueva tienda</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>País</th>
                <th>Código postal</th>
                <th>Términos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($tiendas)): ?>
                <tr><td colspan="9" class="text-center">No hay tiendas registradas.</td></tr>
            <?php endif; ?>
            <?php foreach ($tiendas as $t): ?>
                <tr>
                    <td><?= h($t['id_tienda']) ?></td>
                    <td><?= h($t['nombre_tienda']) ?></td>
                    <td><?= h($t['direcc_tienda']) ?></td>
                    <td><?= h($t['ciudad']) ?></td>
                    <td><?= h($t['estado']) ?></td>
                    <td><?= h($t['pais']) ?></td>
                    <td><?= h($t['cod_postal']) ?></td>
                    <td><?= h($t['terminos']) ?></td>
                    <td class="text-nowrap">
                        <a href="editar.php?id=<?= urlencode($t['id_tienda']) ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form method="post" action="eliminar.php" class="d-inline"
                              onsubmit="return confirm('¿Eliminar esta tienda?');">
                            <input type="hidden" name="id_tienda" value="<?= h($t['id_tienda']) ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php cerrarPagina(); ?>
