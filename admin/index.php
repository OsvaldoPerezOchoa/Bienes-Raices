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
    require '../includes/App.php';

    use App\Propiedad;
    use App\Vendedor;

    $auth = verificarAutentificacion();

    if (!$auth) {
        header('Location: /');
    }

    $respropiedades = Propiedad::all();
    $resvendedores = Vendedor::all();

    $resultado = $_GET['resultado'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {

            $tipo = $_POST['tipo'];

            if (validarContenido($tipo)) {
                if ($tipo === 'vendedor') {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                } else if ($tipo === 'propiedad') {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }

    incluirTemplate('header') ?>



    <section class="seccion contenedor">
        <h1>administrador</h1>
        <?php 
            $mensaje = mostrarMensaje(intval($resultado));
            if($mensaje): ?>
            <p class="alerta exito"><?php echo ($mensaje); ?></p>
        <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="btn btn-verde">nueva propiedad</a>

        <h2>Propiedades</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($respropiedades as $propiedades): ?>
                    <tr>
                        <td><?php echo $propiedades->id; ?></td>
                        <td><?php echo $propiedades->titulo; ?></td>
                        <td><img src="/imagenes/<?php echo $propiedades->imagen; ?>" class="imagen-tabla"></td>
                        <td>$<?php echo $propiedades->precio; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedades->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="btn btn-rojo" value="Eliminar">
                            </form>
                            <a class="btn btn-amarillo" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedades->id ?>">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>

        <h2>Vendedores</h2>
        <a href="/admin/vendedores/crear.php" class="btn btn-verde">nuevo vendedor</a>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($resvendedores as $vendedor): ?>
                    <tr>
                        <td><?php echo $vendedor->id; ?></td>
                        <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                        <td><?php echo $vendedor->telefono; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="btn btn-rojo" value="Eliminar">
                            </form>
                            <a class="btn btn-amarillo" href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id ?>">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>

    </section>

    <?php incluirTemplate('footer') ?>

    <script src="../../build/js/app.js"></script>
</body>

</html>