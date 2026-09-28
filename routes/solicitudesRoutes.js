const express = require('express');
const router = express.Router();
const solicitudesController = require('../controllers/solicitudesController');

router.get('/', solicitudesController.getSolicitudes);
router.post('/', solicitudesController.createSolicitud);
router.patch('/:id/estado', solicitudesController.updateEstadoSolicitud);

module.exports = router;