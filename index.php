<?php

define('WEB_DIR', str_replace("\\", '/', __DIR__));

require  'vncore/initialize.php';

$core = new Core();
$core->vnwork($core);
