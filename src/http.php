<?php
declare(strict_types=1);

function json_response(int $status, array $data): never {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function read_json_body(): array {
    $raw = file_get_contents('php://input');
    if ($raw === '' || strlen($raw) > 1048576) {
        json_response(400, ['error' => 'Cuerpo vacío o demasiado grande']);
    }
    $data = json_decode($raw, true);
    if (!is_array($data)) {
        json_response(400, ['error' => 'JSON inválido']);
    }
    return $data;
}