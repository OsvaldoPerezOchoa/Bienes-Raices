<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>Actualizar Propiedad</title>
</head>

<body>
    <?php
    require '../../includes/App.php';

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager;

    $auth = verificarAutentificacion();

    if (!$auth) {
        header('Location: /');
    }

    $db = conectardb();

    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
    }

    // Cargar propiedad existente
    $propiedad = Propiedad::find($id);

    $vendedores = Vendedor::all();

    $errores = Propiedad::errores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Actualizar valores del objeto con los POST
        $args = [];
        $args['titulo'] = $_POST['titulo'] ?? null;
        $args['precio'] = $_POST['precio'] ?? null;
        $args['descripcion'] = $_POST['descripcion'] ?? null;
        $args['wc'] = $_POST['wc'] ?? null;
        $args['habitaciones'] = $_POST['habitaciones'] ?? null;
        $args['estacionamiento'] = $_POST['estacionamiento'] ?? null;
        $args['vendedor_id'] = $_POST['vendedor'] ?? '1';

        $propiedad->actualizarDatos($args);

        $errores = $propiedad->validarDatos();

        $nombreimagen = md5(uniqid(rand(), true)) . '.jpg';

        if ($_FILES['imagen']['tmp_name']) {
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 600);
            $propiedad->setImagen($nombreimagen);
        }

        if (empty($errores)) {
            //almacenar la imagen
            if ($_FILES['imagen']['tmp_name']) {
                $carpetaImagenes = '../../imagenes/';
                $image->save($carpetaImagenes . $nombreimagen);
            }
            $resultado = $propiedad->crear();
        }
    }

    incluirTemplate('header');
    ?>

    <section class="seccion contenedor">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="btn btn-verde">Volver</a>

        <?php foreach ($errores as $error) { ?>
            <div class="alerta error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php require '../../includes/template/formulario.php' ?>
            <input type="submit" value="Actualizar propiedad" class="btn btn-verde">
        </form>
    </section>

    <?php incluirTemplate('footer') ?>

    <script src="../../build/js/app.js"></script>
</body>

</html>