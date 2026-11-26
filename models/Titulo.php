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
         
    }

