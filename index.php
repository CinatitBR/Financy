<?php
require('./src/core/Core.php');
require('./src/core/Controller.php');

require('./src/Connection.php');

require('./src/controllers/CadastroController.php');

$core = new Core;

$core->start();
