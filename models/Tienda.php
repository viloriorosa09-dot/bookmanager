<?php
require_once __DIR__ . '/../interfaces/ListableInterface.php';
require_once __DIR__ . '/../interfaces/CrudInterface.php';

class Tienda implements CrudInterface
{
    private const CAMPOS = [
        'id_tienda',
        'nombre_tienda',
        'direcc_tienda',
        'ciudad',
        'estado',
        'pais',
        'cod_postal',
        'terminos',
    ];

    public function __construct(private PDO $db)
    {
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM tiendas ORDER BY id_tienda')->fetchAll();
    }

    public function getById(string $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM tiendas WHERE id_tienda = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public function create(array $datos): bool
    {
        $sql = 'INSERT INTO tiendas
                    (id_tienda, nombre_tienda, direcc_tienda, ciudad, estado, pais, cod_postal, terminos)
                VALUES
                    (:id_tienda, :nombre_tienda, :direcc_tienda, :ciudad, :estado, :pais, :cod_postal, :terminos)';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id_tienda' => $datos['id_tienda'],
            ':nombre_tienda' => $datos['nombre_tienda'],
            ':direcc_tienda' => $datos['direcc_tienda'],
            ':ciudad' => $datos['ciudad'],
            ':estado' => $datos['estado'],
            ':pais' => $datos['pais'],
            ':cod_postal' => $datos['cod_postal'],
            ':terminos' => $datos['terminos'],
        ]);
    }

    public function update(string $id, array $datos): bool
    {
        $sql = 'UPDATE tiendas SET
                    nombre_tienda = :nombre_tienda,
                    direcc_tienda = :direcc_tienda,
                    ciudad = :ciudad,
                    estado = :estado,
                    pais = :pais,
                    cod_postal = :cod_postal,
                    terminos = :terminos
                WHERE id_tienda = :id_tienda';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nombre_tienda' => $datos['nombre_tienda'],
            ':direcc_tienda' => $datos['direcc_tienda'],
            ':ciudad' => $datos['ciudad'],
            ':estado' => $datos['estado'],
            ':pais' => $datos['pais'],
            ':cod_postal' => $datos['cod_postal'],
            ':terminos' => $datos['terminos'],
            ':id_tienda' => $id,
        ]);
    }

    public function delete(string $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM tiendas WHERE id_tienda = :id');

        return $stmt->execute([':id' => $id]);
    }

    public function tieneRegistros(string $id): bool
    {
        $sql = 'SELECT
                    (SELECT COUNT(*) FROM ventas WHERE id_tienda = :v)
                  + (SELECT COUNT(*) FROM detalle_venta WHERE id_tienda = :d)
                  + (SELECT COUNT(*) FROM descuento WHERE id_tienda = :c)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':v' => $id, ':d' => $id, ':c' => $id]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public static function depurar(array $post): array
    {
        $datos = [];
        foreach (self::CAMPOS as $campo) {
            $datos[$campo] = trim((string) ($post[$campo] ?? ''));
        }
        $datos['estado'] = strtoupper($datos['estado']);
        $datos['pais'] = strtoupper($datos['pais']);

        return $datos;
    }

    public static function validar(array $datos, bool $validarId): array
    {
        $errores = [];

        if ($validarId && !preg_match('/^[A-Za-z0-9]{1,4}$/', $datos['id_tienda'])) {
            $errores[] = 'El ID debe tener de 1 a 4 letras o números.';
        }

        $limites = [
            'nombre_tienda' => ['Nombre', 40],
            'direcc_tienda' => ['Dirección', 40],
            'ciudad' => ['Ciudad', 15],
            'terminos' => ['Términos', 6],
        ];
        foreach ($limites as $campo => [$etiqueta, $maximo]) {
            if ($datos[$campo] === '') {
                $errores[] = "El campo $etiqueta es obligatorio.";
            } elseif (mb_strlen($datos[$campo]) > $maximo) {
                $errores[] = "El campo $etiqueta admite como máximo $maximo caracteres.";
            }
        }

        if (!preg_match('/^[A-Z]{2}$/', $datos['estado'])) {
            $errores[] = 'El estado debe tener 2 letras.';
        }
        if (!preg_match('/^[A-Z]{1,3}$/', $datos['pais'])) {
            $errores[] = 'El país debe tener de 1 a 3 letras.';
        }
        if (!preg_match('/^[0-9]{5}$/', $datos['cod_postal'])) {
            $errores[] = 'El código postal debe tener 5 números.';
        }

        return $errores;
    }
}
