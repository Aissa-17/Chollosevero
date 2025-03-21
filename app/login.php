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
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuario WHERE usuario='$usuario' AND password=SHA2('$password',256)";
    $resultado = mysqli_query($conexion,$sql);

    if(mysqli_num_rows($resultado) == 1){
        $_SESSION['usuario'] = $usuario;
        if($usuario == 'admin'){
            header('Location: admin.php');
        }else {
            header('Location: usuario.php');
        }
    }else {
        $_SESSION['error'] = "Usuario incorrecto";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <form action="login.php" method='post'>
        <?php if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);}?><br>
        <label>Usuario:</label>
        <input type="text" name="usuario"><br>
        <label>Contraseña:</label>
        <input type="password" name="password"><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>