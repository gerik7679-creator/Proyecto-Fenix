<?php
declare(strict_types=1);

function db(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;

    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4',
        getenv('DB_HOST') ?: 'db', getenv('DB_NAME') ?: 'fenix_db');

    $pdo = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASSWORD'), [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    $pdo->exec("CREATE TABLE IF NOT EXISTS solicitudes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        telefono VARCHAR(50) NOT NULL,
        tipo_ayuda VARCHAR(100) NOT NULL,
        ubicacion TEXT NOT NULL,
        estado VARCHAR(50) DEFAULT 'Pendiente',
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $pdo->exec("CREATE TABLE IF NOT EXISTS refugios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        direccion VARCHAR(255) NOT NULL,
        ocupacion INT DEFAULT 0,
        capacidad INT NOT NULL,
        estado VARCHAR(50) DEFAULT 'Disponible'
    )");
    return $pdo;
}