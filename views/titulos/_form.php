<?php if (!empty($errores)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" novalidate>
    <div class="form-group">
        <label>ID (6 caracteres)</label>
        <input type="text" name="id_titulo" maxlength="6" class="form-control"
               value="<?= htmlspecialchars($datos['id_titulo']) ?>" <?= $modo === 'editar' ? 'readonly' : '' ?>>
    </div>

    <div class="form-group">
        <label>Título</label>
        <input type="text" name="titulo" maxlength="60" class="form-control"
               value="<?= htmlspecialchars($datos['titulo']) ?>">
    </div>

    <div class="form-group">
        <label>Tipo</label>
        <input type="text" name="tipo" maxlength="15" class="form-control"
               value="<?= htmlspecialchars($datos['tipo']) ?>">
    </div>

    <div class="form-group">
        <label>Editorial</label>
        <select name="id_pub" class="form-control">
            <option value="">-- Elige una editorial --</option>
            <?php foreach ($editoriales as $e): ?>
                <option value="<?= htmlspecialchars($e['id_pub']) ?>"
                    <?= $e['id_pub'] === $datos['id_pub'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e['nombre_pub']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Precio (opcional)</label>
        <input type="text" name="precio" class="form-control"
               value="<?= htmlspecialchars($datos['precio']) ?>">
    </div>

    <div class="form-group">
        <label>Avance (opcional)</label>
        <input type="text" name="avance" class="form-control"
               value="<?= htmlspecialchars($datos['avance']) ?>">
    </div>

    <div class="form-group">
        <label>Total de ventas (opcional)</label>
        <input type="text" name="total_ventas" class="form-control"
               value="<?= htmlspecialchars($datos['total_ventas']) ?>">
    </div>

    <div class="form-group">
        <label>Notas</label>
        <input type="text" name="notas" maxlength="255" class="form-control"
               value="<?= htmlspecialchars($datos['notas']) ?>">
    </div>

    <div class="form-group">
        <label>Fecha de publicación</label>
        <input type="date" name="fecha_pub" class="form-control"
               value="<?= htmlspecialchars($datos['fecha_pub']) ?>">
    </div>

    <div class="form-group">
        <label>Contrato</label>
        <select name="contrato" class="form-control">
            <option value="1" <?= $datos['contrato'] === '1' ? 'selected' : '' ?>>Sí (1)</option>
            <option value="0" <?= $datos['contrato'] === '0' ? 'selected' : '' ?>>No (0)</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success"><?= $modo === 'editar' ? 'Guardar cambios' : 'Guardar' ?></button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
</form>
