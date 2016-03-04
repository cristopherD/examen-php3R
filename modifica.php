<?php
session_start();
//VARIABLES DE FORMULARIO
include 'config.php';
$name2 = $_REQUEST['nombre'];
$owner2 = $_REQUEST['duenyo'];
$species2 = $_REQUEST['especie'];
$sex2 = $_REQUEST['sexo'];
$fecha = $_SESSION['fecha'];
//VARIABLES DE SESION (comprobar si no se ha modificado ningun campo)
$name = $_SESSION['name'];
$owner = $_SESSION['owner'];
$species = $_SESSION['species'];
$sex = $_SESSION['sex'];


//CONEXION A LA BD
$conex = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if($conex->connect_errno){
    die("Error al conectarnos a la base de datos: ".$conex->connect_errno);
}

//Si el campo esta vacio 
if(($name2=='') || ($sex2=='') || ($owner2=='') || ($species2=='')){
    echo "Uno de los campos está vacio";
}
    
// Si no se ha modificado ningun dato no se ejecutara el programa
if(($name2==$name) && ($sex2==$sex) && ($owner2==$owner) && ($species2==$species))
    echo "No ha modificado ningun campo";
else {
   $sql2 = "UPDATE `pet` SET `name`= '$name2',`owner`= '$owner2',`species`= '$species2',`sex`='$sex2' WHERE birth = '$fecha'";
$result2 = $conex->query($sql2);          
 
}
