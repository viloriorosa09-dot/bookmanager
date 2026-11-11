<?php
class Database
{
    private PDO $conexion;

    public function __construct()
    {
        $archivo = __DIR__ . '/config.local.php';
        $config = file_exists($archivo) ? require $archivo : [];

        $host = $config['host'] ?? (getenv('DB_HOST') ?: 'localhost');
        $dbname = $config['dbname'] ?? (getenv('DB_NAME') ?: 'dblibreria');
        $user = $config['user'] ?? (getenv('DB_USER') ?: 'root');
        $pass = $config['pass'] ?? (getenv('DB_PASS') ?: '');
        $charset = $config['charset'] ?? 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        try {
            $this->conexion = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            throw new RuntimeException('No se pudo conectar a la base de datos.');
        }
    }

    public function getConexion(): PDO
    {
        return $this->conexion;
    }
}
