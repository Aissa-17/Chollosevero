<?php
session_start();
require '../conexion/conexion.php';
$conexion = conexion();

if(isset($_SESSION['usuario'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $url = $_POST['url'];

        $sql = "INSERT INTO chollo (titulo,descripcion,precio,url,id_usuario) VALUES ('$titulo','$descripcion',$precio,'$url',$id)";
        $resultado = $conexion->query($sql);

        if($resultado){
            if($_SESSION['usuario'] == 'admin'){
                header('Location: admin.php');
                exit;
            }else {
                header('Location:usuario.php');
            }
        }else {
            echo "No se han podido añadir los datos";
            exit;
        }
    }
    $id = $_GET['id'] ?? "";
}else {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Crear Nuevo Chollo</title>
  <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
      color: #333;
      padding: 20px;
    }
    .container {
      max-width: 500px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #007BFF;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }
    input[type="text"],
    input[type="number"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    textarea {
      resize: vertical;
    }
    input[type="submit"] {
      width: 100%;
      background-color: #007BFF;
      color: #fff;
      padding: 12px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Crear Nuevo Chollo</h2>
    <form action="crear_chollo.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <label for="titulo">Título</label>
      <input type="text" id="titulo" name="titulo" placeholder="Ingresa el título del chollo" required>
      
      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion" rows="4" placeholder="Describe el chollo" required></textarea>
      
      <label for="precio">Precio</label>
      <input type="number" step="0.01" id="precio" name="precio" placeholder="Ingresa el precio" required>
      
      <label for="url">URL</label>
      <input type="text" id="url" name="url"  required>
      
      <input type="submit" value="Crear Chollo">
    </form>
  </div>
</body>
</html>