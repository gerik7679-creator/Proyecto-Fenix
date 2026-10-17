<?php
require_once __DIR__ . '/../../src/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $nombre = $data['nombre'] ?? '';
    $telefono = $data['telefono'] ?? '';
    $tipo = $data['tipo'] ?? '';

    if (!empty($nombre) && !empty($telefono) && !empty($tipo)) {
        $stmt = $pdo->prepare("INSERT INTO donaciones (nombre, telefono, tipo) VALUES (?, ?, ?)");
        if ($stmt->execute([$nombre, $telefono, $tipo])) {
            echo json_encode(["success" => true]);
            exit;
        }
    }
    http_response_code(400);
    echo json_encode(["error" => "Datos incompletos"]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM donaciones ORDER BY id DESC");
    echo json_encode($stmt->fetchAll());
}