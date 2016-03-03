<?php

/* 

 */
$nombre = $_POST['nombre'];
//funcion de acceso (nombre)
require 'config.php';
$conexion = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);


$result = mysqli_query($conexion, "SELECT * FROM pet WHERE name = $nombre");
while ($datos = mysqli_fetch_array($result)){
    echo "-Name: ".$datos['name']."<br/>";
    echo "-Owner: ".$datos['owner']."<br/>";
    echo "-Species: ".$datos['species']."<br/>";
    echo "-Sex: ".$datos['sex']."<br/>";
    echo "-Birth: ".$datos['birth']."<br/>";
    echo "-Death: ".$datos['death']."<br/>";
}
mysqli_free_result($result);
mysqli_close($conexion);

if (isset($_REQUEST['nombre'])){
    $nombre2 = ($_REQUEST['nombre']);
}else{
    echo "No se ha introducido ningun parametro" ."<br/>";
}
?>