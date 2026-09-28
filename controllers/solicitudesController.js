const db = require('../config/db');

// Obtener todas las solicitudes (para el panel admin)
exports.getSolicitudes = (req, res) => {
  db.all("SELECT * FROM solicitudes ORDER BY creado_en DESC", [], (err, rows) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json({ solicitudes: rows });
  });
};

// Crear nueva solicitud de ayuda (desde la web pública)
exports.createSolicitud = (req, res) => {
  const { nombre, telefono, tipo_ayuda, ubicacion } = req.body;

  if (!nombre || !telefono || !tipo_ayuda || !ubicacion) {
    return res.status(400).json({ error: "Faltan datos requeridos." });
  }

  const sql = `INSERT INTO solicitudes (nombre, telefono, tipo_ayuda, ubicacion) VALUES (?, ?, ?, ?)`;
  db.run(sql, [nombre, telefono, tipo_ayuda, ubicacion], function(err) {
    if (err) return res.status(500).json({ error: err.message });
    res.status(201).json({
      message: "Solicitud registrada con éxito",
      id: this.lastID
    });
  });
};

// Cambiar estado de una solicitud (Atendida, En Proceso, Pendiente)
exports.updateEstadoSolicitud = (req, res) => {
  const { id } = req.params;
  const { estado } = req.body;

  db.run("UPDATE solicitudes SET estado = ? WHERE id = ?", [estado, id], function(err) {
    if (err) return res.status(500).json({ error: err.message });
    res.json({ message: "Estado actualizado", id, estado });
  });
};