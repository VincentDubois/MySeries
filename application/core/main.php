<?php
require_once 'application/core/blade.php';
require_once 'application/core/type.php';
require_once 'application/core/date.php';
require_once 'application/core/token.php';
require_once 'application/config/config.php';
require_once 'application/config/routes.php';

$routing_result =  route();
$file = $routing_result['file'];
extract($routing_result);
require $file;

 ?>
