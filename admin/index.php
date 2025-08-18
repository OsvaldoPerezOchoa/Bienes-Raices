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
    require '../includes/funciones.php';
    $auth = verificarAutentificacion();

    if(!$auth){
        header('Location: /');
    }

    require '../includes/config/database.php';
    $db = conectardb();

    $query = 'SELECT * FROM propiedades';

    $resultadoConsulta = mysqli_query($db, $query);

    $resultado = $_GET['resultado'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {

            $query = "SELECT imagen FROM propiedades WHERE id = $id";
            $respuesta = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($respuesta);

            unlink('../imagenes/' . $propiedad['imagen']);

            $query = "DELETE FROM propiedades WHERE id = $id";
            $respuesta = mysqli_query($db, $query);

            if ($respuesta) {
                header("Location: /admin?resultado=3");
            }
        }
    }

    incluirTemplate('header') ?>



    <section class="seccion contenedor">
        <h1>administrador</h1>
        <?php if ($resultado == 1): ?>
            <p class="alerta exito">Anuncio publicado correctamente</p>
        <?php elseif ($resultado == 2): ?>
            <p class="alerta exito">Anuncio Actualizado correctamente</p>
        <?php elseif ($resultado == 3): ?>
            <p class="alerta exito">Anuncio Eliminado correctamente</p>
        <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="btn btn-verde">nueva propiedad</a>


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
                <?php while ($propiedades = mysqli_fetch_assoc($resultadoConsulta)): ?>
                    <tr>
                        <td><?php echo $propiedades['id']; ?></td>
                        <td><?php echo $propiedades['titulo']; ?></td>
                        <td><img src="/imagenes/<?php echo $propiedades['imagen']; ?>" class="imagen-tabla"></td>
                        <td>$<?php echo $propiedades['precio']; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedades['id']; ?>">
                                <input type="submit" class="btn btn-rojo" value="Eliminar">
                            </form>
                            <a class="btn btn-amarillo" href="admin/propiedades/actualizar.php?id=<?php echo $propiedades['id'] ?> ">Actualizar</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>

        </table>
    </section>

    <?php incluirTemplate('footer') ?>

    <script src="../../build/js/app.js"></script>
</body>

</html>