<?php

require_once __DIR__ . '/../interfaces/ListableInterface.php';
require_once __DIR__ . '/../interfaces/CrudInterface.php';

class Publicador implements CrudInterface
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM publicadores";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(string $id): ?array
    {
        $sql = "SELECT * FROM publicadores WHERE id_pub = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $resultado = $stmt->fetch();

        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }

    public function create(array $datos): bool
    {
        $sql = "INSERT INTO publicadores (id_pub, nombre_pub, ciudad, estado) VALUES (:id_pub, :nombre_pub, :ciudad, :estado)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_pub' => $datos['id_pub'],
            ':nombre_pub' => $datos['nombre_pub'],
            ':ciudad' => $datos['ciudad'],
            ':estado' => $datos['estado']
        ]);
    }

    public function update(string $id, array $datos): bool
    {
        $sql = "UPDATE publicadores SET nombre_pub = :nombre_pub, ciudad = :ciudad, estado = :estado WHERE id_pub = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre_pub' => $datos['nombre_pub'],
            ':ciudad' => $datos['ciudad'],
            ':estado' => $datos['estado'],
            ':id' => $id
        ]);
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM publicadores WHERE id_pub = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function tieneTitulos($id)
    {
        $sql = "SELECT COUNT(*) FROM titulos WHERE id_pub = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $cantidad = $stmt->fetchColumn();

        if ($cantidad > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function depurar(array $post): array
    {
        $datos = [];
        foreach (['id_pub', 'nombre_pub', 'ciudad', 'estado'] as $campo) {
            $datos[$campo] = trim((string) ($post[$campo] ?? ''));
        }
        $datos['estado'] = strtoupper($datos['estado']);
        return $datos;
    }

    public static function validar(array $datos, bool $validarId): array
    {
        $errores = [];

        if ($validarId && !preg_match('/^[A-Za-z0-9]{1,4}$/', $datos['id_pub'])) {
            $errores[] = 'El ID debe tener de 1 a 4 letras o números.';
        }

        $limites = [
            'nombre_pub' => ['Nombre', 30],
            'ciudad'     => ['Ciudad', 15],
        ];
        foreach ($limites as $campo => [$etiqueta, $maximo]) {
            if ($datos[$campo] === '') {
                $errores[] = "El campo $etiqueta es obligatorio.";
            } elseif (mb_strlen($datos[$campo]) > $maximo) {
                $errores[] = "El campo $etiqueta admite como máximo $maximo caracteres.";
            }
        }

        if (!preg_match('/^[A-Z]{2}$/', $datos['estado'])) {
            $errores[] = 'El estado debe tener exactamente 2 letras.';
        }

        return $errores;
    }
}
