<?php
require_once __DIR__ . '/../../src/db.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("INSERT INTO solicitudes (nombre, telefono, tipo_ayuda, ubicacion) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$data['nombre'] ?? '', $data['telefono'] ?? '', $data['tipo_ayuda'] ?? '', $data['ubicacion'] ?? ''])) {
        echo json_encode(["success" => true]);
        exit;
    }
    http_response_code(400);
    echo json_encode(["error" => "Error al guardar"]);
} elseif ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM solicitudes ORDER BY id DESC");
    echo json_encode($stmt->fetchAll());
} elseif ($method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $stmt = $pdo->prepare("DELETE FROM solicitudes WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["success" => true]);
        exit;
    }
    http_response_code(400);
    echo json_encode(["error" => "ID no proporcionado"]);
}