<?php
require('./src/core/Core.php');

require('./src/Db.php');

require('./src/controllers/CadastroController.php');

require('./src/models/CadastroModel.php');

// Base template
$template = file_get_contents('./template.html');

$core = new Core;

// Get content returned from start method
ob_start();
  $core->start($_GET);
  $content = ob_get_contents();
ob_end_clean();

// Insert content into template
$populated_template = str_replace('{{ content }}', $content, $template);
echo $populated_template;