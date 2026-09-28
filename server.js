const express = require('express');
const cors = require('cors');
const solicitudesRoutes = require('./routes/solicitudesRoutes');
const refugiosRoutes = require('./routes/refugiosRoutes');

const app = express();
const PORT = process.env.PORT || 3000;

// Middlewares
app.use(cors());
app.use(express.json());
app.use(express.static('./')); // Servir archivos estáticos del frontend

// Rutas API
app.use('/api/solicitudes', solicitudesRoutes);
app.use('/api/refugios', refugiosRoutes);

// Servidor levantado
app.listen(PORT, () => {
  console.log(`🔥 FENIX API Express levantada en http://localhost:${PORT}`);
});