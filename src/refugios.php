<?php
// src/refugios.php
declare(strict_types=1);

require_once __DIR__ . '/http.php';
require_once __DIR__ . '/RefugiosController.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    RefugiosController::listar();
} else {
    jsonResponse(['error' => 'Método no permitido'], 405);
}