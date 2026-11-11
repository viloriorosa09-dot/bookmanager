<?php
require __DIR__ . '/config/database.php';

$db = new Database();
$tablas = $db->getConexion()->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

echo 'Conectado. Tablas: ' . implode(', ', $tablas);
