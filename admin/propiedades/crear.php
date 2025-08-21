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

    require '../../includes/App.php';

    use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

    $propiedad = new Propiedad();   


    $auth = verificarAutentificacion();

    if (!$auth) {
        header('Location: /');
    }

    $db = conectardb();

    $vendedores = "SELECT * FROM vendedores";
    $resultadoVendedores = mysqli_query($db, $vendedores);

    //arreglo 
    $errores = Propiedad::errores();
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedor = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $propiedad = new Propiedad($_POST);

        $nombreimagen = md5(uniqid(rand(), true)) . '.jpg';

        if ($_FILES['imagen']['tmp_name']) {
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800,600);
            $propiedad->setImagen($nombreimagen);
        }

        $errores = $propiedad->validarDatos();

        if (empty($errores)) {

            $carpetaImagenes = '../../imagenes/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $image->save($carpetaImagenes . $nombreimagen);

            $resultado = $propiedad->guardar();
            if ($resultado) {
                header('Location: /admin?resultado=1');
            }
        }
    }

    incluirTemplate(nombre: 'header') ?>

    <section class="seccion contenedor">
        <h1>Administrador</h1>

        <a href="/admin" class="btn btn-verde">Volver</a>

        <?php foreach ($errores as $error) { ?>
            <div class="alerta error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo htmlspecialchars($titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" required value="<?php echo htmlspecialchars($precio); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpg" name="imagen">

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>

                <label for="habitaciones">Numero de Habitaciones:</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="99" required value="<?php echo htmlspecialchars($habitaciones); ?>">

                <label for="wc">Numero de Baños:</label>
                <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="99" required value="<?php echo htmlspecialchars($wc); ?>">

                <label for="estacionamiento">Numero de estacionamientos:</label>
                <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="99" required value="<?php echo htmlspecialchars($estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor_id" required>
                    <option value="">-- Vendedores --</option>
                    <?php while ($row = mysqli_fetch_assoc($resultadoVendedores)): ?>
                        <option <?php echo $vendedor === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] . ' ' . $row['apellido']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>
            <input type="submit" value="Crear Propiedad" class="btn btn-verde">
        </form>
    </section>


    <?php incluirTemplate('footer') ?>

    <script src="../../build/js/app.js"></script>
</body>

</html>