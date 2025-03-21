<?php
session_start();
require '../conexion/conexion.php';
$conexion = conexion();

if(isset($_SESSION['usuario'])){
    if($_SESSION['usuario'] == 'admin'){
        header('Location: admin.php');
    }
}
$usuario = $_SESSION['usuario'];
$sql = "SELECT * FROM usuario WHERE usuario ='$usuario'";
$resultado = $conexion->query($sql);
$id;
if($row = $resultado->fetch_assoc()){
    $id = $row['id'];
}

$sql2 = "SELECT * FROM chollo WHERE id_usuario=$id";
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
            <button class="chollo-btn"><a href="crear_chollo.php?id=<?php echo $id;?>">Crear nuevo chollo</a></button>
            <button class="chollo-btn"><a href="logout.php">Cerrar sesión</a></button>
    </header>
<h2>Tus Chollos</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Url</th>
                <th>Acciones</th>
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
                    echo "<td>
                        <button><a href='editar.php?id=".$row['id']."'>Editar</a></button>
                        <button><a href='borrar.php?id=".$row['id']."'>Borrar</a></button>
                    </td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>