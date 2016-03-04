<?php
/* */
if (isset($_POST['nombre'])&& !empty($_POST['nombre'])){

//funcion de acceso (nombre)
require 'config.php';
$conexion = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
$pet = mysqli_real_escape_string($conexion, $_POST['nombre']);

$result = mysqli_query($conexion, "SELECT * FROM pet WHERE name ='".$pet.".");
if ($result-> num_rows == 0 ){
    echo "Nombre invalido.<br/>";
}else{
    $datos = mysqli_fetch_array($result);
    $fieldsOk = 0;
if (isset($_POST['name']) && !empty($_POST['name'])){
        $name = mysqli_real_escape_string($conexion, $_POST['name']);
          if (isset($_POST['owner']) && !empty($_POST['owner'])){
           $owner = mysqli_real_escape_string($conexion, $_POST['owner']);
            if (isset($_POST['species']) && !empty($_POST['species'])){
            $species = mysqli_real_escape_string($conexion, $_POST['species']);
            if (isset($_POST['sex']) && !empty($_POST['sex'])){
             $sex = mysqli_real_escape_string($conexion, $_POST['sex']);
                if (isset($_POST['birth']) && !empty($_POST['birth'])){
                $birth = mysqli_real_escape_string($conexion, $_POST['birth']);
                    if (isset($_POST['death']) && !empty($_POST['death'])){
                    $death = mysqli_real_escape_string($conexion, $_POST['death']);
                    $fieldsOk =1;
    
                    }
}
}
if(!$fieldsOk){
    die("Error: Hay campos en blanco <br/>");
}
$strinOrig = $datos["name"].$datos["owner"].$datos["species"].$datos["sex"].$datos["birth"].$datos["death"];
$strinNew = $name.$owner.$species.$sex.$birth.$death;
if ($strinNew == $strinOrig){
    die ("ERROR: No ha modificado ningun campo");
}
$result = mysqli_query($conexion, "UPDATE pet set name= '".$name.
        "', owner='".$owner.
        "', species='".$species.
        "', sex='".$sex.
        "', birth='".$birth.
        "', death='".$death.
        "' WHERE name = '".$pet."'");
echo "REGISTRO actualizado<br/>";
            }
}else{
    echo "No se ha introducido nombre" ."<br/>";
}

?>