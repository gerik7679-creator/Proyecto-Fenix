# 🦅 Proyecto Fénix — Red Solidaria de Apoyo Emergente

Plataforma web integral orientada al departamento de Durazno (Uruguay) para la coordinación rápida, gestión de refugios, solicitudes de asistencia y registro de colaboraciones durante emergencias comunitarias.

---

## 📌 Características Principales

* 🏠 **Centros de Alojamiento y Refugios:** Visualización de refugios habilitados, ubicaciones y capacidad estimada.
* 📋 **Gestión de Solicitudes (S.O.S):** Registro de pedidos de ayuda con actualización de estado en tiempo real.
* 🤝 **Registro de Colaboraciones:** Espacio para voluntarios y donaciones (insumos, transporte, alojamiento).
* ⚙️ **Panel de Administración:** Control con borrado lógico (*soft delete*) para activar/desactivar registros sin perder historial.
* 📲 **Notificación Vía WhatsApp:** Enlaces directos preconfigurados para comunicación instantánea con la central de coordinación.
* 🐳 **Infraestructura Contenerizada:** Entorno completo listo para ejecutar con Docker y Docker Compose.

---

## 🛠️ Tecnologías Utilizadas

* **Frontend:** HTML5, CSS3 (con animaciones neón), JavaScript (ES6+ / Fetch API).
* **Backend:** PHP 8.x (API RESTful), PDO para conexión segura a base de datos.
* **Base de Datos:** MySQL 8.0.
* **Gestión de Entorno:** Docker, Docker Compose, phpMyAdmin.

---

## 📂 Estructura del Proyecto

```text
Proyecto-Fenix/
├── public/
│   ├── api/
│   │   ├── donaciones.php
│   │   ├── refugios.php
│   │   ├── resumen.php
│   │   └── solicitudes.php
│   ├── css/
│   │   └── estilos.css
│   ├── js/
│   │   └── script.js
│   ├── admin.html
│   └── index.html
├── src/
│   ├── db.php
│   ├── DonacionesController.php
│   ├── RefugiosController.php
│   └── solicitudesController.php
├── docker-compose.yml
├── dockerfile
├── init.sql
└── .env