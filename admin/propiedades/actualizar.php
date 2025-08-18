<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>Document</title>
</head>

<body>
    <?php

    require '../../includes/funciones.php';
    $auth = verificarAutentificacion();

    if(!$auth){
        header('Location: /');
    }

    require '../../includes/config/database.php';
    $db = conectardb();



    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
    }

    $queryPropiedad = "SELECT * FROM propiedades WHERE id = $id";
    $resultadoPropiedad = mysqli_query($db, $queryPropiedad);
    $propiedad = mysqli_fetch_assoc($resultadoPropiedad);

    $vendedores = "SELECT * FROM vendedores";
    $resultadoVendedores = mysqli_query($db, $vendedores);

    //arreglo 
    $errores = [];
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedor = $propiedad['vendedor_id'];
    $imagenPropiedad = $propiedad['imagen'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db,  $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedor = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        $imagen = $_FILES['imagen'];

        if (!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }

        if (!$precio) {
            $errores[] = "Debes añadir un precio";
        }

        if (!$descripcion) {
            $errores[] = "Debes añadir una descripcion";
        }

        if (!$wc) {
            $errores[] = "Debes añadir un numero de wc";
        }

        if (!$habitaciones) {
            $errores[] = "Debes añadir un numero de habitaciones";
        }

        if (!$estacionamiento) {
            $errores[] = "Debes añadir un numero de estacionamiento";
        }

        if (!$vendedor) {
            $errores[] = "Debes añadir un vendedor";
        }

        $medida = 1000 * 2000;

        if ($imagen['size'] > $medida) {
            $errores[] = 'La imagen es muy pesada';
        }


        if (empty($errores)) {
            $carpetaImagenes = '../../imagenes/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            if ($imagen['name']) {
                unlink($carpetaImagenes . $propiedad['imagen']);

                $nombreimagen = md5(uniqid(rand(), true)) . '.jpg';

                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes .  $nombreimagen);
            }else{
                $nombreimagen = $propiedad['imagen'];
            }



            $query = "UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreimagen',  descripcion = '$descripcion',  wc = $wc,  
            habitaciones = $habitaciones,  estacionamiento = $estacionamiento,  vendedor_id = '$vendedor' WHERE id=$id";

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                header('Location: /admin?resultado=2');
            }
        }
    }

    incluirTemplate(nombre: 'header') ?>

    <section class="seccion contenedor">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="btn btn-verde">Volver</a>

        <?php foreach ($errores as $error) { ?>
            <div class="alerta error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" required value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" required value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpg" name="imagen">

                <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-propiedad">

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>

                <label for="habitaciones">Numero de Habitaciones:</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="99" required value="<?php echo $habitaciones; ?>">

                <label for="wc">Numero de Baños:</label>
                <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="99" required value="<?php echo $wc; ?>">

                <label for="estacionamiento">Numero de estacionamientos:</label>
                <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="99" required value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor" required>
                    <option value="">-- Vendedores --</option>
                    <?php while ($row = mysqli_fetch_assoc($resultadoVendedores)): ?>
                        <option <?php echo $vendedor === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] . ' ' . $row['apellido']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>
            <input type="submit" value="Actualizar propiedad" class="btn btn-verde">
        </form>
    </section>


    <?php incluirTemplate('footer') ?>

    <script src="../../build/js/app.js"></script>
</body>

</html>