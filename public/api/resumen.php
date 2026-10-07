<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/db.php';
require_once __DIR__ . '/../../src/http.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        header('Allow: GET');
        json_response(405, ['error' => 'Método no permitido']);
    }
    $pdo = db();
    json_response(200, [
        'pedidos_atendidos' => (int) $pdo->query("SELECT COUNT(*) FROM solicitudes WHERE estado = 'Atendida'")->fetchColumn(),
        'ofertas'           => (int) $pdo->query('SELECT COUNT(*) FROM donaciones')->fetchColumn(),
        'refugios_abiertos' => (int) $pdo->query("SELECT COUNT(*) FROM refugios WHERE estado <> 'Cerrado'")->fetchColumn(),
    ]);
} catch (Throwable $e) {
    error_log($e->getMessage());
    json_response(500, ['error' => 'Error interno del servidor']);
}