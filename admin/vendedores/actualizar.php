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

    use App\Vendedor;

    $vendedor = new Vendedor();


    $auth = verificarAutentificacion();

    if (!$auth) {
        header('Location: /');
    }

    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
    }

    $vendedor = Vendedor::find($id);

    //arreglo 
    $errores = Vendedor::errores();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $args = [];
        $args['nombre'] = $_POST['nombre'] ?? null;
        $args['apellido'] = $_POST['apellido'] ?? null;
        $args['telefono'] = $_POST['telefono'] ?? null;
        
        $vendedor->actualizarDatos($args);

        $errores = $vendedor->validarDatos();

        if (empty($errores)) {
            //almacenar la imagen
            $resultado = $vendedor->crear();
        }
    }

    incluirTemplate(nombre: 'header') ?>

    <section class="seccion contenedor">
        <h1>Actualizar vendedor</h1>

        <a href="/admin" class="btn btn-verde">Volver</a>

        <?php foreach ($errores as $error) { ?>
            <div class="alerta error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>
        <form class="formulario" method="POST">
            <?php require '../../includes/template/formularioVendedores.php' ?>
            <input type="submit" value="Guardar cambios de Vendedor" class="btn btn-verde">
        </form>
    </section>


    <?php incluirTemplate('footer') ?>

    <script src="../../build/js/app.js"></script>
</body>

</html>