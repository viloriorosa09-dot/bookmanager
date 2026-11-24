<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Titulo.php';
require_once __DIR__ . '/../../models/Publicador.php';

$db = new Database();
$conexion = $db->getConexion();
$titulo = new Titulo($conexion);
$publicador = new Publicador($conexion);
$editoriales = $publicador->getAll();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'id_titulo'    => trim($_POST['id_titulo'] ?? ''),
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

    if ($datos['id_titulo'] === '' || $datos['titulo'] === '' || $datos['tipo'] === ''
        || $datos['id_pub'] === '' || $datos['notas'] === '' || $datos['fecha_pub'] === ''
        || $datos['contrato'] === '') {
        $error = 'Completa todos los campos obligatorios.';
    } elseif ($datos['precio'] !== '' && !is_numeric($datos['precio'])) {
        $error = 'El precio debe ser un número.';
    } else {
        $titulo->create($datos);
        header('Location: listar.php');
        exit;
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>
<h1 class="h3 mb-4 text-gray-800">Nuevo título</h1>

<?php if ($error !== ''): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label>ID (6 caracteres)</label>
        <input type="text" name="id_titulo" maxlength="6" class="form-control"
               value="<?= htmlspecialchars($_POST['id_titulo'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Título</label>
        <input type="text" name="titulo" maxlength="60" class="form-control"
               value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Tipo</label>
        <input type="text" name="tipo" maxlength="15" class="form-control"
               value="<?= htmlspecialchars($_POST['tipo'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Editorial</label>
        <select name="id_pub" class="form-control">
            <option value="">-- Elige una editorial --</option>
            <?php foreach ($editoriales as $e): ?>
                <option value="<?= htmlspecialchars($e['id_pub']) ?>">
                    <?= htmlspecialchars($e['nombre_pub']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Precio (opcional)</label>
        <input type="text" name="precio" class="form-control"
               value="<?= htmlspecialchars($_POST['precio'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Avance (opcional)</label>
        <input type="text" name="avance" class="form-control"
               value="<?= htmlspecialchars($_POST['avance'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Total de ventas (opcional)</label>
        <input type="text" name="total_ventas" class="form-control"
               value="<?= htmlspecialchars($_POST['total_ventas'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Notas</label>
        <input type="text" name="notas" maxlength="255" class="form-control"
               value="<?= htmlspecialchars($_POST['notas'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Fecha de publicación</label>
        <input type="date" name="fecha_pub" class="form-control"
               value="<?= htmlspecialchars($_POST['fecha_pub'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Contrato</label>
        <select name="contrato" class="form-control">
            <option value="1">Sí (1)</option>
            <option value="0">No (0)</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>