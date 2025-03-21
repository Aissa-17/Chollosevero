<?php
session_start();
require 'conexion/conexion.php';
$conexion = conexion();

if(isset($_SESSION['usuario'])){
    if($_SESSION['usuario'] == 'admin'){
        header('Location: app/admin.php');
    }else {
        header('Location: app/usuario.php');
    }
}

$sql = "SELECT * FROM chollo";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a chollosevero</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>  
    <header>
            <h1>🔥 Chollos del Momento 🔥</h1>
            <button class="chollo-btn"><a href="app/login.php">Iniciar sesion</a></button>
            <button class="chollo-btn"><a href="app/register.php">Registrarse</a></button>
    </header>

    <section class="chollos-container">
    <?php while ($row = $resultado->fetch_assoc()): ?>
        <div class="chollo-card">
            <img src="<?php echo ($row['url']); ?>" alt="<?php echo $row['titulo']; ?>">
            <h2><?php echo $row['titulo']; ?></h2>
            <p><?php echo $row['descripcion']; ?></p>
            <p class="precio">
                <span class="precio-original"><?php echo $row['precio']; ?>€</span>
            </p>
        </div>
    <?php endwhile; ?>
</section>
</body>
</html>