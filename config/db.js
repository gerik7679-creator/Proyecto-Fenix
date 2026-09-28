// config/db.js
const mysql = require('mysql2');

const pool = mysql.createPool({
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'fenix_user',
  password: process.env.DB_PASSWORD || 'fenix_password123',
  database: process.env.DB_NAME || 'fenix_db',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

// Crear tablas iniciales al conectar
const initDb = () => {
  const solicitudesTable = `
    CREATE TABLE IF NOT EXISTS solicitudes (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(255) NOT NULL,
      telefono VARCHAR(50) NOT NULL,
      tipo_ayuda VARCHAR(100) NOT NULL,
      ubicacion TEXT NOT NULL,
      estado VARCHAR(50) DEFAULT 'Pendiente',
      creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
  `;

  const refugiosTable = `
    CREATE TABLE IF NOT EXISTS refugios (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(255) NOT NULL,
      direccion VARCHAR(255) NOT NULL,
      ocupacion INT DEFAULT 0,
      capacidad INT NOT NULL,
      estado VARCHAR(50) DEFAULT 'Disponible'
    );
  `;

  pool.query(solicitudesTable, (err) => {
    if (err) console.error("Error al crear tabla solicitudes:", err);
  });

  pool.query(refugiosTable, (err) => {
    if (err) console.error("Error al crear tabla refugios:", err);
  });
};

initDb();

module.exports = pool.promise();