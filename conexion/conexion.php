<?php
function conexion(){
    $mysqli = new mysqli('localhost','root','','chollosevero2');
    if($mysqli->connect_errno){
        echo 'No se pudo conectar a la BD';
    }
    return $mysqli;
}
?>