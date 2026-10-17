<?php
require_once __DIR__ . '/../../src/db.php';

header('Content-Type: application/json');
$stmt = $pdo->query("SELECT * FROM refugios");
echo json_encode($stmt->fetchAll());