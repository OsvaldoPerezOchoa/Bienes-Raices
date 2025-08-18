<?php

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include __DIR__ . "/template/{$nombre}.php";
}

function verificarAutentificacion() : bool{
    session_start();
    $auth = $_SESSION['login'];
    if ($auth) {
        return true;
    }
    return false;
}
