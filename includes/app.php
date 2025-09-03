<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

$db = conectardb();

use App\Main;

Main::setDB($db);
