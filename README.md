# 🦅 Proyecto Fénix — Sistema de Gestión de Refugios y Solicitudes

[![Node.js](https://img.shields.io/badge/Node.js-v18%2B-green.svg)](https://nodejs.org/)
[![Express](https://img.shields.io/badge/Express-v4.x-blue.svg)](https://expressjs.com/)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED.svg?logo=docker&logoColor=white)](https://www.docker.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Plataforma web integral para la administración, monitoreo de capacidad en tiempo real e interconexión geográfica de refugios de emergencia, junto con la gestión y recepción de solicitudes de asistencia.

📌 Tabla de ContenidosCaracterísticas PrincipalesArquitectura y Estructura del ProyectoRequisitos PreviosInstalación y ConfiguraciónDespliegue con DockerDocumentación de la APITecnologías UtilizadasLicencia✨ Características Principales🏢 Gestión de Refugios: Registro, monitoreo de ocupación y actualización dinámica de capacidad.📋 Gestión de Solicitudes: Módulo centralizado para procesar solicitudes de ingreso y asistencia.🗺️ Mapeo Interactivo: Visualización geográfica de refugios para usuarios y administradores.👨‍💼 Panel Administrativo: Interfaz intuitiva para gestión y control interno.🐳 Entorno Containerizado: Configuración rápida lista para producción mediante Docker y Docker Compose.📂 Arquitectura y Estructura del ProyectoEl proyecto sigue el patrón MVC (Modelo-Vista-Controlador) desacoplado en el backend para garantizar escalabilidad y mantenimiento modular:Plaintextfenix_paginaWeb PRO/
├── app/                      # Módulo de la aplicación backend
│   └── package.json          # Dependencias internas del servidor
├── config/
│   └── db.js                 # Conexión a la base de datos
├── controllers/
│   ├── refugiosController.js   # Lógica de negocio para refugios
│   └── solicitudesController.js # Lógica de negocio para solicitudes
├── routes/
│   ├── refugiosRoutes.js     # Endpoints de refugios
│   └── solicitudesRoutes.js   # Endpoints de solicitudes
├── css/                      # Estilos de la interfaz web
├── js/                       # Scripts del cliente (mapa, scripts de vistas)
├── 404.html                  # Página de error 404 personalizada
├── admin.html                # Panel de administración
├── index.html                # Vista principal de usuario
├── docker-compose.yml        # Configuración de servicios (App + DB)
├── dockerfile                # Imagen Docker de la aplicación
├── package.json              # Configuración y dependencias raíz
└── server.js                 # Punto de entrada de la aplicación Express
🚀 Requisitos PreviosAntes de comenzar, asegúrate de contar con las siguientes herramientas instaladas:Node.js (Versión 18 o superior)npm (Gestor de paquetes)Docker Desktop (Opcional, para ejecución containerizada)🛠️ Instalación y ConfiguraciónClonar el repositorio:Bashgit clone [https://github.com/gerik7679-creator/Proyecto-Fenix.git](https://github.com/gerik7679-creator/Proyecto-Fenix.git)
cd Proyecto-Fenix
Instalar dependencias:Bashnpm install
Configurar variables de entorno:Crea un archivo .env en la raíz del proyecto basándote en la configuración de la base de datos:Code snippetPORT=3000
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=tu_contraseña
DB_NAME=fenix_db
Iniciar el servidor en modo desarrollo:Bashnpm start
La aplicación estará disponible en http://localhost:3000.🐳 Despliegue con DockerPara levantar la infraestructura completa (Servidor Web + Base de Datos) de forma automatizada:Construir y levantar los contenedores:Bashdocker-compose up -d --build
Verificar estado de los servicios:Bashdocker-compose ps
Detener el entorno:Bashdocker-compose down
📡 Documentación de la APIRefugios (/routes/refugiosRoutes.js)MétodoEndpointDescripciónGET/Obtiene la lista completa de refugios registrados.PATCH/:id/ocupacionActualiza el estado de capacidad de un refugio específico.Solicitudes (/routes/solicitudesRoutes.js)MétodoEndpointDescripciónGET/Lista todas las solicitudes de asistencia.POST/Crea una nueva solicitud de ingreso/asistencia.💻 Tecnologías UtilizadasBackend: Node.js, Express.jsFrontend: HTML5, CSS3, JavaScript (ES6+), Leaflet / OpenStreetMap (Integración del mapa)Base de Datos: MySQL / PostgreSQLDevOps: Docker, Docker ComposeControl de Versiones: Git, GitHub📄 LicenciaEste proyecto está bajo la Licencia MIT. Consulta el archivo LICENSE para obtener más información.Desarrollado con ❤️ por gerik7679-creator y f-cardozo.¿Cómo agregarlo a tu proyecto desde VS Code?En la barra lateral izquierda del Explorador de VS Code, crea un nuevo archivo con el nombre exacto README.md en la raíz de tu carpeta.Pega el contenido anterior.Para subirlo a GitHub, ejecuta en la terminal:

git add README.md
git commit -m "docs: agregar README.md profesional"
git push origin main