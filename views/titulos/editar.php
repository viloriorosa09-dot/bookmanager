<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Titulo.php';
require_once __DIR__ . '/../../models/Publicador.php';

$db = new Database();
$conexion = $db->getConexion();
$titulo = new Titulo($conexion);
$publicador = new Publicador($conexion);
$editoriales = $publicador->getAll();

$id = $_GET['id'] ?? '';
$actual = $titulo->getById($id);

if ($actual === null) {
    header('Location: listar.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'titulo'       => trim($_POST['titulo'] ?? ''),
        'tipo'         => trim($_POST['tipo'] ?? ''),
        'id_pub'       => trim($_POST['id_pub'] ?? ''),
        'precio'       => trim($_POST['precio'] ?? ''),
        'avance'       => trim($_POST['avance'] ?? ''),
        'total_ventas' => trim($_POST['total_ventas'] ?? ''),
        'notas'        => trim($_POST['notas'] ?? ''),
        'fecha_pub'    => trim($_POST['fecha_pub'] ?? ''),
        'contrato'     => trim($_POST['contrato'] ?? ''),
    ];

    if ($datos['titulo'] === '' || $datos['tipo'] === '' || $datos['id_pub'] === ''
        || $datos['notas'] === '' || $datos['fecha_pub'] === '' || $datos['contrato'] === '') {
        $error = 'Completa todos los campos obligatorios.';
    } elseif ($datos['precio'] !== '' && !is_numeric($datos['precio'])) {
        $error = 'El precio debe ser un número.';
    } else {
        $titulo->update($id, $datos);
        header('Location: listar.php');
        exit;
    }
    $actual = array_merge($actual, $datos);
}

require_once __DIR__ . '/../../includes/header.php';
?>
<h1 class="h3 mb-4 text-gray-800">Editar título</h1>

<?php if ($error !== ''): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label>ID</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($actual['id_titulo']) ?>" readonly>
    </div>

    <div class="form-group">
        <label>Título</label>
        <input type="text" name="titulo" maxlength="60" class="form-control"
               value="<?= htmlspecialchars($actual['titulo']) ?>">
    </div>

    <div class="form-group">
        <label>Tipo</label>
        <input type="text" name="tipo" maxlength="15" class="form-control"
               value="<?= htmlspecialchars($actual['tipo']) ?>">
    </div>

    <div class="form-group">
        <label>Editorial</label>
        <select name="id_pub" class="form-control">
            <?php foreach ($editoriales as $e): ?>
                <option value="<?= htmlspecialchars($e['id_pub']) ?>"
                    <?= $e['id_pub'] === $actual['id_pub'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e['nombre_pub']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Precio (opcional)</label>
        <input type="text" name="precio" class="form-control"
               value="<?= htmlspecialchars((string)$actual['precio']) ?>">
    </div>

    <div class="form-group">
        <label>Avance (opcional)</label>
        <input type="text" name="avance" class="form-control"
               value="<?= htmlspecialchars((string)$actual['avance']) ?>">
    </div>

    <div class="form-group">
        <label>Total de ventas (opcional)</label>
        <input type="text" name="total_ventas" class="form-control"
               value="<?= htmlspecialchars((string)$actual['total_ventas']) ?>">
    </div>

    <div class="form-group">
        <label>Notas</label>
        <input type="text" name="notas" maxlength="255" class="form-control"
               value="<?= htmlspecialchars($actual['notas']) ?>">
    </div>

    <div class="form-group">
        <label>Fecha de publicación</label>
        <input type="date" name="fecha_pub" class="form-control"
               value="<?= htmlspecialchars(substr($actual['fecha_pub'], 0, 10)) ?>">
    </div>

    <div class="form-group">
        <label>Contrato</label>
        <select name="contrato" class="form-control">
            <option value="1" <?= $actual['contrato'] === '1' ? 'selected' : '' ?>>Sí (1)</option>
            <option value="0" <?= $actual['contrato'] === '0' ? 'selected' : '' ?>>No (0)</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar cambios</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>