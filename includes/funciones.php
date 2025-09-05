<?php

define('TEMPLATES_URL', '/template');
define('FUNCIONES_URL', 'funciones.php');

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


function debugg($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function validarContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

function mostrarMensaje($codigo){
    $mensaje = '';

    switch($codigo){
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}