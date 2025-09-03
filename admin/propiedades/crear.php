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
    use App\Vendedor;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager;

    $propiedad = new Propiedad;


    $auth = verificarAutentificacion();

    if (!$auth) {
        header('Location: /');
    }

    $vendedores = Vendedor::all();

    //arreglo 
    $errores = Propiedad::errores();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $propiedad = new Propiedad($_POST);

        $nombreimagen = md5(uniqid(rand(), true)) . '.jpg';

        if ($_FILES['imagen']['tmp_name']) {
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 600);
            $propiedad->setImagen($nombreimagen);
        }

        $errores = $propiedad->validarDatos();

        if (empty($errores)) {

            $carpetaImagenes = '../../imagenes/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $image->save($carpetaImagenes . $nombreimagen);

            $propiedad->guardar();
            
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
            <?php require '../../includes/template/formulario.php' ?>
            <input type="submit" value="Crear Propiedad" class="btn btn-verde">
        </form>
    </section>


    <?php incluirTemplate('footer') ?>

    <script src="../../build/js/app.js"></script>
</body>

</html>