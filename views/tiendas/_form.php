<?php if (!empty($errores)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errores as $error): ?>
                <li><?= h($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" novalidate>
    <div class="form-group mb-3">
        <label for="id_tienda">ID (hasta 4 caracteres)</label>
        <input type="text" class="form-control" id="id_tienda" name="id_tienda" maxlength="4"
               value="<?= h($datos['id_tienda']) ?>" <?= $modo === 'editar' ? 'readonly' : 'required' ?>>
    </div>
    <div class="form-group mb-3">
        <label for="nombre_tienda">Nombre</label>
        <input type="text" class="form-control" id="nombre_tienda" name="nombre_tienda" maxlength="40"
               value="<?= h($datos['nombre_tienda']) ?>" required>
    </div>
    <div class="form-group mb-3">
        <label for="direcc_tienda">Dirección</label>
        <input type="text" class="form-control" id="direcc_tienda" name="direcc_tienda" maxlength="40"
               value="<?= h($datos['direcc_tienda']) ?>" required>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="ciudad">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" maxlength="15"
                   value="<?= h($datos['ciudad']) ?>" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" maxlength="2"
                   value="<?= h($datos['estado']) ?>" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="pais">País</label>
            <input type="text" class="form-control" id="pais" name="pais" maxlength="3"
                   value="<?= h($datos['pais']) ?>" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="cod_postal">Código postal</label>
            <input type="text" class="form-control" id="cod_postal" name="cod_postal" maxlength="5"
                   value="<?= h($datos['cod_postal']) ?>" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="terminos">Términos</label>
            <input type="text" class="form-control" id="terminos" name="terminos" maxlength="6"
                   value="<?= h($datos['terminos']) ?>" required>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
</form>
