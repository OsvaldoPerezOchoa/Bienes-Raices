<?php 

function incluirTemplate(string $nombre, bool $inicio = false){
    include "includes/template/{$nombre}.php";
}