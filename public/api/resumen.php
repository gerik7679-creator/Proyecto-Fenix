<?php
require_once __DIR__ . '/../../src/db.php';

header('Content-Type: application/json');

$voluntarios = $pdo->query("SELECT COUNT(*) FROM donaciones")->fetchColumn();
$refugios = $pdo->query("SELECT COUNT(*) FROM refugios")->fetchColumn();
$pedidos = $pdo->query("SELECT COUNT(*) FROM solicitudes")->fetchColumn();

echo json_encode([
    "voluntarios" => (int)$voluntarios,
    "refugios" => (int)$refugios,
    "pedidos" => (int)$pedidos
]);