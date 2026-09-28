const db = require('../config/db');

// Obtener refugios para el mapa y panel
exports.getRefugios = (req, res) => {
  db.all("SELECT * FROM refugios", [], (err, rows) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json({ refugios: rows });
  });
};

// Actualizar capacidad ocupada desde el admin
exports.updateCapacidad = (req, res) => {
  const { id } = req.params;
  const { ocupacion } = req.body;

  db.run("UPDATE refugios SET ocupacion = ? WHERE id = ?", [ocupacion, id], function(err) {
    if (err) return res.status(500).json({ error: err.message });
    res.json({ message: "Capacidad de refugio actualizada", id, ocupacion });
  });
};