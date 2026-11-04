-- 1. Tabla para registrar las donaciones u ofrecimientos de ayuda (vehículos, alimentos, refugio, etc.)
CREATE TABLE IF NOT EXISTS donaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(30) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabla para registrar las solicitudes de ayuda de la gente que lo necesita (ropa, traslado, alimentos, etc.)
CREATE TABLE IF NOT EXISTS solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(30) NOT NULL,
    tipo_ayuda VARCHAR(50) NOT NULL,
    ubicacion VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabla simple de refugios (por si querés mostrar los lugares disponibles)
CREATE TABLE IF NOT EXISTS refugios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ubicacion VARCHAR(150) NOT NULL,
    capacidad INT DEFAULT 0
);

-- Datos de prueba básicos para los refugios
INSERT INTO refugios (nombre, ubicacion, capacidad) VALUES 
('Gimnasio Municipal', 'Av. 18 de Julio esq. Zorrilla', 50),
('Club Sarandí', 'Rivera 450', 30);