<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/RefugiosController.php';

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            RefugiosController::listar();
            break;

        case 'PUT':
        case 'PATCH':
            $id = (int) filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            RefugiosController::actualizarCapacidad($id, read_json_body());
            break;

        default:
            header('Allow: GET, PUT, PATCH');
            json_response(405, ['error' => 'Método no permitido']);
    }
} catch (Throwable $e) {
    error_log($e->getMessage());
    json_response(500, ['error' => 'Error interno del servidor']);
}