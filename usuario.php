<?php 

require 'includes/config/database.php';

$db = conectardb();

$email = "correo@correo.com";
$password = "123456";
$nombre = "osvaldo";

$passwordHash = password_hash($password,PASSWORD_DEFAULT);

$query = "INSERT INTO usuarios (email, password, nombre) VALUES ('$email', '$passwordHash', '$nombre');";
$resultado = mysqli_query($db,$query);