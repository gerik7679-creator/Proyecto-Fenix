<?php

declare(strict_types=1);

function jsonResponse(
    array $data,
    int $status = 200
): never {
    http_response_code($status);

    header('Content-Type: application/json; charset=utf-8');

    echo json_encode(
        $data,
        JSON_UNESCAPED_UNICODE
    );

    exit;
}


function getJsonBody(): array
{
    $input = file_get_contents('php://input');

    if (!$input) {
        return [];
    }

    $data = json_decode($input, true);

    if (!is_array($data)) {
        jsonResponse([
            'error' => 'JSON inválido'
        ], 400);
    }

    return $data;
}


function requireMethod(string $method): void
{
    if ($_SERVER['REQUEST_METHOD'] !== $method) {
        header('Allow: ' . $method);

        jsonResponse([
            'error' => 'Método no permitido'
        ], 405);
    }
}
