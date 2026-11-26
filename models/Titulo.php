<?php
// 1. Cargar las interfaces (contrato que debemos cumplir)
require_once __DIR__ . '/../interfaces/ListableInterface.php';
require_once __DIR__ . '/../interfaces/CrudInterface.php';

// 2. La clase promete tener getAll, getById, create, update y delete
class Titulo implements CrudInterface
{
    // 3. Aqui se guarda la conexion a la base de datos
    private PDO $db;

    //4. Al crear un Titulo, se le entrega la conexion
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM titulos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // Devuelve un titulo por su ID, o null si no existe
    public function getById(string $id): ?array
    {
        $sql = "SELECT * FROM titulos WHERE id_titulo = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id'=> $id]);
        return $stmt->fetch() ?: null;
    }
    // Interta un titulo nuevo
    public function create(array $datos): bool
    {
        $sql = "INSERT INTO titulos
                (id_titulo, titulo, tipo, id_pub, precio, avance, total_ventas, notas, fecha_pub, contrato)
                VALUES
                (:id_titulo, :titulo, :tipo, :id_pub, :precio, :avance, :total_ventas, :notas, :fecha_pub, :contrato)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_titulo' => $datos['id_titulo'],
            ':titulo'    => $datos['titulo'],
            ':tipo'      => $datos['tipo'],
            ':id_pub'    => $datos['id_pub'],
            ':precio'    => $datos['precio'] !== '' ? (float)$datos['precio'] : null,
            ':avance'    => $datos['avance'] !== '' ? (float)$datos['avance'] : null,
            ':total_ventas'    => $datos['total_ventas'] !== '' ? (int)$datos['total_ventas'] : null,
            ':notas'     => $datos['notas'],
            ':fecha_pub' => $datos['fecha_pub'],
            ':contrato'  => $datos['contrato']

        ]);
    }
        // actualiza un titulo existente
        public function update(string $id, array $datos): bool
        {
            $sql = "UPDATE titulos SET
                    titulo = :titulo, tipo = :tipo, id_pub = :id_pub,
                    precio = :precio, avance = :avance, total_ventas = :total_ventas,
                    notas = :notas, fecha_pub = :fecha_pub, contrato = :contrato
                    WHERE id_titulo = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':titulo'          => $datos['titulo'],
                ':tipo'            => $datos['tipo'],
                ':id_pub'          => $datos['id_pub'],
                ':precio'          => $datos['precio'] !== '' ? (float)$datos['precio'] : null,
                ':avance'          => $datos['avance'] !== '' ? (float)$datos['avance'] : null,
                ':total_ventas'    => $datos['total_ventas'] !== '' ? (int)$datos['total_ventas'] : null,
                ':notas'           => $datos['notas'],
                ':fecha_pub'       => $datos['fecha_pub'],
                ':contrato'        => $datos['contrato'],
                ':id'              =>$id
            ]);
        }
        // Eliminar un titlulo por su ID
        public function delete(string $id): bool
        {
            $sql = "DELETE FROM titulos WHERE id_titulo = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }

    public function tieneRegistros(string $id): bool
    {
        $sql = "SELECT
                    (SELECT COUNT(*) FROM detalle_venta WHERE id_titulo = :v)
                  + (SELECT COUNT(*) FROM titulo_autor WHERE id_titulo = :a)
                  + (SELECT COUNT(*) FROM derechos WHERE id_titulo = :d)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':v' => $id, ':a' => $id, ':d' => $id]);
        return (int) $stmt->fetchColumn() > 0;
    }

    public static function depurar(array $post): array
    {
        $campos = ['id_titulo', 'titulo', 'tipo', 'id_pub', 'precio', 'avance',
                   'total_ventas', 'notas', 'fecha_pub', 'contrato'];
        $datos = [];
        foreach ($campos as $campo) {
            $datos[$campo] = trim((string) ($post[$campo] ?? ''));
        }
        return $datos;
    }

    public static function validar(array $datos, bool $validarId, array $idsEditoriales): array
    {
        $errores = [];

        if ($validarId && !preg_match('/^[A-Za-z0-9]{1,6}$/', $datos['id_titulo'])) {
            $errores[] = 'El ID debe tener de 1 a 6 letras o números.';
        }

        $limites = [
            'titulo' => ['Título', 60],
            'tipo'   => ['Tipo', 15],
            'notas'  => ['Notas', 255],
        ];
        foreach ($limites as $campo => [$etiqueta, $maximo]) {
            if ($datos[$campo] === '') {
                $errores[] = "El campo $etiqueta es obligatorio.";
            } elseif (mb_strlen($datos[$campo]) > $maximo) {
                $errores[] = "El campo $etiqueta admite como máximo $maximo caracteres.";
            }
        }

        if (!in_array($datos['id_pub'], $idsEditoriales, true)) {
            $errores[] = 'Elige una editorial de la lista.';
        }

        foreach (['precio' => 'El precio', 'avance' => 'El avance'] as $campo => $etiqueta) {
            if ($datos[$campo] !== '' && (!is_numeric($datos[$campo]) || (float) $datos[$campo] < 0)) {
                $errores[] = "$etiqueta debe ser un número mayor o igual a 0.";
            }
        }

        if ($datos['total_ventas'] !== '' && !preg_match('/^[0-9]+$/', $datos['total_ventas'])) {
            $errores[] = 'El total de ventas debe ser un número entero mayor o igual a 0.';
        }

        $fecha = DateTime::createFromFormat('Y-m-d', $datos['fecha_pub']);
        if (!$fecha || $fecha->format('Y-m-d') !== $datos['fecha_pub']) {
            $errores[] = 'La fecha de publicación no es válida.';
        }

        if (!in_array($datos['contrato'], ['0', '1'], true)) {
            $errores[] = 'El contrato debe ser Sí (1) o No (0).';
        }

        return $errores;
    }
}
