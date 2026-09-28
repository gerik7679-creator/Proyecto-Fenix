const express = require('express');
const router = express.Router();
const refugiosController = require('../controllers/refugiosController');

router.get('/', refugiosController.getRefugios);
router.patch('/:id/ocupacion', refugiosController.updateCapacidad);

module.exports = router;