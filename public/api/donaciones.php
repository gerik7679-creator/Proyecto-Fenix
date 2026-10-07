<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/DonacionesController.php';

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            DonacionesController::crear(read_json_body());
            break;
        case 'GET':
            json_response(403, ['error' => 'Requiere autenticación']);
            break;
        default:
            header('Allow: GET, POST');
            json_response(405, ['error' => 'Método no permitido']);
    }
} catch (Throwable $e) {
    error_log($e->getMessage());
    json_response(500, ['error' => 'Error interno del servidor']);
}