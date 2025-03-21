<?php
session_start();
require '../conexion/conexion.php';
$conexion = conexion();

if(isset($_SESSION['usuario'])){
    if($_SESSION['usuario'] == 'admin'){
        header('Location: admin.php');
    }else {
        header('Location: usuario.php');
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (empty($nombre) || empty($usuario) || empty($password) || empty($email)) {
        echo "Todos los campos son obligatorios.";
        exit;
      }

    $sql = "INSERT INTO usuario(nombre, usuario, password, email) VALUES ('$nombre','$usuario',SHA2('$password',256),'$email')";
    $resultado = $conexion->query($sql);

    if($resultado){
        $_SESSION['usuario'] == $usuario;
        header('Location: usuario.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <form action="register.php" method="post">
        <label>Nombre</label>
        <input type="text" name="nombre" id="nombre"><br>
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <label for="email">Email</label>
        <input type="email" name="email"><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>