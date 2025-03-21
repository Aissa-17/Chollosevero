<?php
session_start();
require '../conexion/conexion.php';
$conexion = conexion();

if(isset($_SESSION['usuario'])){
    if($_SESSION['usuario'] !== 'admin'){ 
        header('Location: usuario.php');
    }
}

$sql1="SELECT * FROM usuario";
$sql2="SELECT * FROM chollo";
$resultado1 = $conexion->query($sql1);
$resultado2 = $conexion->query($sql2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<header>
            <h1>🔥 Chollos del Momento 🔥</h1>
            <button class="chollo-btn"><a href="crear_chollo.php?id=1">Crear nuevo chollo</a></button>
            <button class="chollo-btn"><a href="logout.php">Cerrar sesión</a></button>
    </header>
    <h2>Usuarios</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $resultado1->fetch_assoc()){
                    echo "<tr><td>".$row['id']."</td>";
                    echo "<td>".$row['nombre']."</td>";
                    echo "<td>".$row['usuario']."</td>";
                    echo "<td>".$row['password']."</td>";
                    echo "<td>".$row['email']."<td></tr>";
                }
            ?>
        </tbody>
    </table>
    <h2>Chollos</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Url</th>
                <th>Id del Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $resultado2->fetch_assoc()){
                    echo "<tr><td>".$row['id']."</td>";
                    echo "<td>".$row['titulo']."</td>";
                    echo "<td>".$row['descripcion']."</td>";
                    echo "<td>".$row['precio']."</td>";
                    echo "<td>".$row['url']."</td>";
                    echo "<td>".$row['id_usuario']."</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>