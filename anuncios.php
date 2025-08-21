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

    incluirTemplate('header') ?>

    <main class="contenedor seccion">
        <h2>Casas y Departamentos en Venta</h2>
        <?php
        $limite = 10;
        include 'includes/template/anuncios.php';
        ?>
    </main>

    <?php incluirTemplate('footer') ?>

    <script src="build/js/app.js"></script>
</body>

</html>