<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/http.php';

final class DonacionesController
{
    private const TIPOS = ['transporte', 'insumos', 'alojamiento', 'voluntario'];

    public static function crear(array $body): void
    {
        $nombre   = trim((string) ($body['nombre'] ?? ''));
        $telefono = trim((string) ($body['telefono'] ?? ''));
        $tipo     = trim((string) ($body['tipo'] ?? ''));

        if ($nombre === '' || mb_strlen($nombre) > 255) {
            json_response(400, ['error' => 'Nombre inválido']);
        }
        if (!preg_match('/^[0-9+()\-\s]{6,20}$/', $telefono)) {
            json_response(400, ['error' => 'Teléfono inválido']);
        }
        if (!in_array($tipo, self::TIPOS, true)) {
            json_response(400, ['error' => 'Tipo de colaboración inválido']);
        }

        $pdo = db();
        $pdo->prepare('INSERT INTO donaciones (nombre, telefono, tipo) VALUES (?, ?, ?)')
            ->execute([$nombre, $telefono, $tipo]);

        json_response(201, ['id' => (int) $pdo->lastInsertId(), 'status' => 'creada']);
    }
}