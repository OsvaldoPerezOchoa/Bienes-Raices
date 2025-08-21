<?php

function conectardb() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'bines_raices');

    if(!$db){
        echo "Error no se pudo conectar a la db";
        exit;
    }

    return $db;
    
}