<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/http.php';

final class SolicitudesController
{
    public static function crear(array $body): void
    {
        $nombre    = trim((string) ($body['nombre'] ?? ''));
        $telefono  = trim((string) ($body['telefono'] ?? ''));
        $tipo      = trim((string) ($body['tipo_ayuda'] ?? ''));
        $ubicacion = trim((string) ($body['ubicacion'] ?? ''));

        if ($nombre === '' || mb_strlen($nombre) > 255) {
            json_response(400, ['error' => 'Nombre inválido']);
        }
        if (!preg_match('/^[0-9+()\-\s]{6,20}$/', $telefono)) {
            json_response(400, ['error' => 'Teléfono inválido']);
        }
        if ($tipo === '' || mb_strlen($tipo) > 100) {
            json_response(400, ['error' => 'Tipo de ayuda inválido']);
        }
        if ($ubicacion === '' || mb_strlen($ubicacion) > 1000) {
            json_response(400, ['error' => 'Ubicación inválida']);
        }

        $stmt = db()->prepare(
            'INSERT INTO solicitudes (nombre, telefono, tipo_ayuda, ubicacion) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$nombre, $telefono, $tipo, $ubicacion]);

        json_response(201, ['id' => (int) db()->lastInsertId(), 'status' => 'creada']);
    }

    // Solo cifras, sin datos personales: es público
    public static function resumen(): void
    {
        $row = db()->query('SELECT COUNT(*) AS total FROM solicitudes')->fetch();
        json_response(200, ['total' => (int) $row['total']]);
    }
}