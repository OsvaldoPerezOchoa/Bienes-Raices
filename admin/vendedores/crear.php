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

    $vendedor = new Vendedor;


    $auth = verificarAutentificacion();

    if (!$auth) {
        header('Location: /');
    }


    //arreglo 
    $errores = Vendedor::errores();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $vendedor = new Vendedor($_POST);

        $errores = $vendedor->validarDatos();

        if (empty($errores)) {

            $vendedor->guardar();
            
        }
    }

    incluirTemplate(nombre: 'header') ?>

    <section class="seccion contenedor">
        <h1>Registrar vendedor</h1>

        <a href="/admin" class="btn btn-verde">Volver</a>

        <?php foreach ($errores as $error) { ?>
            <div class="alerta error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>
        <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
            <?php require '../../includes/template/formularioVendedores.php' ?>
            <input type="submit" value="Registrar Vendedor" class="btn btn-verde">
        </form>
    </section>


    <?php incluirTemplate('footer') ?>

    <script src="../../build/js/app.js"></script>
</body>

</html>