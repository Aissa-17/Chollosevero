<?php
session_start();
require '../conexion/conexion.php';
$conexion = conexion();

$id = $_GET['id'] ?? "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'] ?? "";
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $url = $_POST['url'];

    $sql = "UPDATE chollo SET titulo='$titulo',descripcion='$descripcion',precio=$precio,url='$url' WHERE id=$id";
    $resultado = $conexion->query($sql);
    if($resultado){
         header('Location: usuario.php');
    }else {
        echo "No se ha podido editar :(";
        exit();
    }
}
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
<h2>Editar Chollo con ID: <?php echo $id ?></h2>
    <form action="editar.php" method="post">
        <input type="hidden" value="<?php echo $id?>" name="id">
      <label for="titulo">Título</label>
      <input type="text" id="titulo" name="titulo" required>

      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion" required></textarea>

      <label for="precio">Precio</label>
      <input type="number" id="precio" name="precio" required>

      <label for="url">URL</label>
      <input type="text" id="url" name="url" required>

      <input type="submit" value="Actualizar Chollo">
    </form>
  </div>
</body>
</html>