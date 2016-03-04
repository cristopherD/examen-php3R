<?php
session_start();
include 'config.php';
//VARIABLES DEL FORMULARIO
$owner = $_REQUEST['owner'];


//CONEXION A LA BD
$conex = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if($conex->connect_errno){
    die("Error al conectarnos a la base de datos: ".$conex->connect_errno);
}
//EVITAMOS INYECCION
$safe_owner = mysqli_real_escape_string($conex, $owner);

//SENTENCIA SQL
$sql = "SELECT * FROM pet WHERE owner = '$safe_owner' ";

//Enviamos consulta
$result = $conex->query($sql);

//Comprobamos resultados
if($owner==''){
    echo 'No ha introducido alguno de los datos';
}
elseif($result->num_rows==0){
    echo "No existen datos para el duenyo que ha introducido";
}
elseif($result->num_rows>0){
    while ($row = $result->fetch_assoc()) {
echo "<a href=acceso3.php >Nombre:</a>" . " " . $row['name'] . "</br>";
echo "Duenyo:" . " " . $row['owner']."</br>";
echo "Especie:" . " " . $row['species']."</br>";
$_SESSION['fecha'] = $row['birth'];
}}
//Nos guardamos la variable fecha para utilizarla despues en acceso3.php
