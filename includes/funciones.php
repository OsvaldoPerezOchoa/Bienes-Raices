<?php 

function incluirTemplate(string $nombre, bool $inicio = false){
    include __DIR__ . "/template/{$nombre}.php";
}