 <?php
session_start();
include 'config.php';
//VARIABLES DEL FORMULARIO

$anyo = $_REQUEST['anyo'];
$mes = $_REQUEST['mes'];
$dia = $_REQUEST['dia'];
$fechatemporal = $_SESSION['fecha'];
if ($fechatemporal==''){
   $fecha = $anyo . "-" . $mes ."-" . $dia; 
}
else {
    $fecha = $fechatemporal;
}


//CONEXION A LA BD
$conex = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if($conex->connect_errno){
    die("Error al conectarnos a la base de datos: ".$conex->connect_errno);
}
//EVITAMOS INYECCION
$safe_fecha = mysqli_real_escape_string($conex, $fecha);

//SENTENCIA SQL
$sql = "SELECT * FROM pet WHERE birth = '$safe_fecha' ";

//Enviamos consulta
$result = $conex->query($sql);

//Comprobamos resultados

if($result->num_rows==0){
    echo "No existen datos para la fecha que ha introducido";
}
elseif($result->num_rows>0){
    while ($row = $result->fetch_assoc()) {
echo "Nombre:" . " " . $row['name'] . "</br>";
echo "Duenyo:" . " " . $row['owner']."</br>";
echo "Especie:" . " " . $row['species']."</br>";
echo "Sexo:" . " " . $row['sex']."</br>";
echo "Fecha Nacimiento:" . " " . $row['birth']."</br>";
}}