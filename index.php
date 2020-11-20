<?php
require('./src/core/Core.php');

$template = file_get_contents('./template.html');

$core = new Core;
$core->start($_GET);

// echo $template;