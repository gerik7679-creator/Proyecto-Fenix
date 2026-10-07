<?php
<<<<<<< HEAD
// src/refugios.php
declare(strict_types=1);

require_once __DIR__ . '/http.php';
require_once __DIR__ . '/RefugiosController.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    RefugiosController::listar();
} else {
    jsonResponse(['error' => 'Método no permitido'], 405);
=======
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
>>>>>>> 28521abea7cb6678039b1014254eccc63930864a
}