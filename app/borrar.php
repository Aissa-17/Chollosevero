<?php
session_start();
require '../conexion/conexion.php';
$conexion = conexion();

$id = $_GET['id'];
if($id){
    $sql = "DELETE FROM chollo WHERE id=$id";
    $resultado = $conexion->query($sql);

    if($resultado){
        header('Location: usuario.php');
        exit();
    }else {
        echo "Si ves esto es porque el chollo no se ha borrado";
        exit();
    }
}else {
    header('Location:index.php');
}
?>