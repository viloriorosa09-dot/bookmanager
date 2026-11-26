<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Tienda.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$tienda = new Tienda((new Database())->getConexion());

function h(?string $texto): string
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function mensaje(string $tipo, string $texto): void
{
    $_SESSION['mensaje'] = ['tipo' => $tipo, 'texto' => $texto];
}

function mostrarMensaje(): void
{
    if (empty($_SESSION['mensaje'])) {
        return;
    }
    $m = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
    echo '<div class="alert alert-' . h($m['tipo']) . '">' . h($m['texto']) . '</div>';
}

function abrirPagina(string $titulo): void
{
    $header = __DIR__ . '/../../includes/header.php';
    if (is_file($header)) {
        require $header;
    } else {
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="utf-8">'
            . '<meta name="viewport" content="width=device-width, initial-scale=1">'
            . '<title>' . h($titulo) . '</title>'
            . '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">'
            . '</head><body><div class="container py-4">';
    }
    echo '<h1 class="h3 mb-4 text-gray-800">' . h($titulo) . '</h1>';
}

function cerrarPagina(): void
{
    $footer = __DIR__ . '/../../includes/footer.php';
    if (is_file($footer)) {
        require $footer;
    } else {
        echo '</div></body></html>';
    }
}
