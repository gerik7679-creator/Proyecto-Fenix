<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/http.php';

final class RefugiosController
{
    // Refugios para el mapa y el panel
    public static function listar(): void
    {
<<<<<<< HEAD
        $rows = db()->query("SELECT * FROM refugios WHERE estado = 'abierto' LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
        jsonResponse(['refugios' => $rows], 200);
=======
        $rows = db()->query('SELECT * FROM refugios')->fetchAll();
        json_response(200, ['refugios' => $rows]);
>>>>>>> 28521abea7cb6678039b1014254eccc63930864a
    }

    // Actualizar ocupación desde el admin
    public static function actualizarCapacidad(int $id, array $body): void
    {
        if ($id < 1) {
<<<<<<< HEAD
            jsonResponse(['error' => 'ID de refugio inválido'], 400);
=======
            json_response(400, ['error' => 'ID de refugio inválido']);
>>>>>>> 28521abea7cb6678039b1014254eccc63930864a
        }

        $ocupacion = filter_var($body['ocupacion'] ?? null, FILTER_VALIDATE_INT);
        if ($ocupacion === false || $ocupacion < 0) {
<<<<<<< HEAD
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
=======
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
>>>>>>> 28521abea7cb6678039b1014254eccc63930864a
    }
}