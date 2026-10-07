<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/SolicitudesController.php';

try {
    $metodo = $_SERVER['REQUEST_METHOD'];

    if ($metodo === 'POST') {
        SolicitudesController::crear(read_json_body());
    } elseif ($metodo === 'GET' && isset($_GET['resumen'])) {
        SolicitudesController::resumen();
    } elseif ($metodo === 'GET') {
        json_response(403, ['error' => 'Requiere autenticación']);
    } else {
        header('Allow: GET, POST');
        json_response(405, ['error' => 'Método no permitido']);
    }
} catch (Throwable $e) {
    error_log($e->getMessage());
    json_response(500, ['error' => 'Error interno del servidor']);
}