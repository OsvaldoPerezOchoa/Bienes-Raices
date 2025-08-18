<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
    

?>

<header class="header <?php echo $inicio  ? 'inicio' : '' ?>">
    <div class="contenedor contenido-header">
        <div class="navbar">
            <a href="/">
                <img src="/src/img/logo.svg" alt="logotipo">
            </a>
            <div class="mobil-menu">
                <img src="/build/img/barras.svg" alt="menu-hamburgesa">
            </div>

            <div class="derecha">
                <img class="dark-mode" src="/build/img/dark-mode.svg">
                <nav class="nav">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                    <?php if($auth) : ?>
                            <a href="cerrarsesion.php">Cerrar Sesion</a>
                    <?php endif ?>
                </nav>
            </div>
        </div>
    </div>
</header>