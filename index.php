<?php
require('./src/core/Core.php');
require('./src/core/Controller.php');

require('./src/Connection.php');

require('./src/controllers/CadastroController.php');
require('./src/models/CadastroModel.php');

$core = new Core;

$core->start($_GET);
