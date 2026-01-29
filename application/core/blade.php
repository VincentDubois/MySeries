<?php //Création de la variable $blade
require 'vendor/autoload.php';
use eftec\bladeone\BladeOne;

$views = 'application/views';
$cache = 'application/views/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_DEBUG);
?>
