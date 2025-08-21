<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Document</title>
</head>

<body>
    <?php
    require 'includes/App.php';
    $db = conectardb();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /');
    }

    $query = "SELECT * FROM propiedades WHERE id = $id";

    $resultado = mysqli_query($db, $query);

    if (mysqli_num_rows($resultado) === 0) {
        header('Location: /');
    }

    incluirTemplate('header') ?>

    <section class="contenedor seccion contenido-centrado">
        <?php while ($propiedad = mysqli_fetch_assoc($resultado)): ?>
            <h2><?php echo $propiedad['titulo'] ?></h2>

            <img src="imagenes/<?php echo $propiedad['imagen'] ?>">

            <div class="resumen-propiedad">
                <p class="precio">$<?php echo $propiedad['precio'] ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono baño">
                        <p><?php echo $propiedad['wc'] ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad['estacionamiento'] ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?php echo $propiedad['habitaciones'] ?></p>
                    </li>
                </ul>
                <p><?php echo $propiedad['descripcion'] ?></p>
            </div>
        <?php endwhile ?>

    </section>

    <?php incluirTemplate('footer') ?>

    <script src="build/js/app.js"></script>
</body>

</html>