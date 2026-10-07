<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/http.php';

final class RefugiosController
{
    // Refugios para el mapa y el panel
    public static function listar(): void
    {
        $rows = db()->query("SELECT * FROM refugios WHERE estado = 'abierto' LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
        jsonResponse(['refugios' => $rows], 200);
    }

    // Actualizar ocupación desde el admin
    public static function actualizarCapacidad(int $id, array $body): void
    {
        if ($id < 1) {
            jsonResponse(['error' => 'ID de refugio inválido'], 400);
        }

        $ocupacion = filter_var($body['ocupacion'] ?? null, FILTER_VALIDATE_INT);
        if ($ocupacion === false || $ocupacion < 0) {
            jsonResponse(['error' => 'La ocupación debe ser un entero mayor o igual a 0'], 400);
        }

        $pdo = db();
        $stmt = $pdo->prepare('SELECT capacidad_total FROM refugios WHERE id = ?');
        $stmt->execute([$id]);
        $refugio = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$refugio) {
            jsonResponse(['error' => 'Refugio no encontrado'], 404);
        }

        if ($ocupacion > (int) $refugio['capacidad_total']) {
            jsonResponse(['error' => 'La ocupación supera la capacidad del refugio'], 400);
        }

        $upd = $pdo->prepare('UPDATE refugios SET ocupacion_actual = ? WHERE id = ?');
        $upd->execute([$ocupacion, $id]);

        jsonResponse([
            'message'   => 'Capacidad de refugio actualizada',
            'id'        => $id,
            'ocupacion' => $ocupacion,
        ], 200);
    }
}