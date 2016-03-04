 <?php
/* este fichero realizará la conexión a la base de datos
 Toma los valores del fichero acceso.php */
 if (isset($_REQUEST['nombre']) && !empty($_POST['nombre'])){
 require 'config.php';
 //conexion a la base de datos
$conexion = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
//tabla con la que trabajaremos
$pet = mysqli_real_escape_string($conexion, $_REQUEST['nombre']);
//consulta SQL
$result = mysqli_query($conexion, "SELECT * FROM pet WHERE name ='".$pet."'");
if ($result -> num_rows == 0){
    echo "No a introducido un parametro valido.</br>";
}  else {
    echo "<form action='modifica.php method='post'>";
    while($datos = mysqli_fetch_array($result)){
    echo "-Name: <input type='text' name='name' value='".$datos['name']."</br>";
    echo "-Owner: <input type='text' name='owner' value='".$datos['owner']."</br>";
    echo "-Species: <input type='text' name='species' value=' ".$datos['species']."</br>";
    echo "-Sex: <input type='text' name='sex' value=' ".$datos['sex']."</br>";
    echo "-Birth: <input type='text' name='birth' value=' ".$datos['birth']."</br>";
    echo "-Death: <input type='text' name='death' value=' ".$datos['death']."</br>";
    }}
mysqli_close($conexion);
echo "<input type='submit value='Guarda cambios'> ";
echo "<input type='reset' value='cancelar cambios'></form>";
}else{
    echo "No se a introducido ningun parametro"."<br/>";
}