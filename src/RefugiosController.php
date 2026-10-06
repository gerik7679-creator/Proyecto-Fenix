<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/http.php';

final class RefugiosController
{
    // Refugios para el mapa y el panel
    public static function listar(): void
    {
        $rows = db()->query('SELECT * FROM refugios')->fetchAll();
        json_response(200, ['refugios' => $rows]);
    }

    // Actualizar ocupación desde el admin
    public static function actualizarCapacidad(int $id, array $body): void
    {
        if ($id < 1) {
            json_response(400, ['error' => 'ID de refugio inválido']);
        }

        $ocupacion = filter_var($body['ocupacion'] ?? null, FILTER_VALIDATE_INT);
        if ($ocupacion === false || $ocupacion < 0) {
            json_response(400, ['error' => 'La ocupación debe ser un entero mayor o igual a 0']);
        }

        $pdo = db();
        $stmt = $pdo->prepare('SELECT capacidad FROM refugios WHERE id = ?');
        $stmt->execute([$id]);
        $refugio = $stmt->fetch();

        if (!$refugio) {
            json_response(404, ['error' => 'Refugio no encontrado']);
        }
        if ($ocupacion > (int) $refugio['capacidad']) {
            json_response(400, ['error' => 'La ocupación supera la capacidad del refugio']);
        }

        $upd = $pdo->prepare('UPDATE refugios SET ocupacion = ? WHERE id = ?');
        $upd->execute([$ocupacion, $id]);

        json_response(200, [
            'message'   => 'Capacidad de refugio actualizada',
            'id'        => $id,
            'ocupacion' => $ocupacion,
        ]);
    }
}