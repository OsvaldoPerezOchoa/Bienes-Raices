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

    require 'includes/config/database.php';

    $db = conectardb();

    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (!$email) {
            $errores[] = "El email es obligatorio o no es valido";
        }
        if (!$password) {
            $errores[] = "El password es obligatorio";
        }

        if (empty($errores)) {

            $query = "SELECT * FROM usuarios WHERE email = '$email';";
            $resultado = mysqli_query($db, $query);

            if ($resultado->num_rows) {
                $usuario = mysqli_fetch_assoc($resultado);
                $auth = password_verify($password, $usuario['password']);

                if ($auth) {
                    session_start();

                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                } else {
                    $errores[] = "La contraseña es incorrecta";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }


    require 'includes/funciones.php';
    incluirTemplate('header', $inicio = true) ?>

    <main class="contenedor seccion contenido-centrado">
        <h2>Iniciar Sesión</h2>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Ingrese su email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
            </fieldset>
            <input type="submit" value="Iniciar sesion" class="btn btn-verde">
        </form>
    </main>

    <?php incluirTemplate('footer') ?>

    <script src="build/js/app.js"></script>
</body>

</html>