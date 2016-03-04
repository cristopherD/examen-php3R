 <?php
session_start();
include 'config.php';
//VARIABLES DEL FORMULARIO
$anyo = $_REQUEST['anyo'];
$mes = $_REQUEST['mes'];
$dia = $_REQUEST['dia'];
$fecha = $anyo . "-" . $mes ."-" . $dia;

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
if(($anyo=='') || ($mes=='') || ($dia=='')){
    echo 'No ha introducido alguno de los datos';
}
elseif($result->num_rows==0){
    echo "No existen datos para la fecha que ha introducido";
}
elseif($result->num_rows>0){
    while ($row = $result->fetch_assoc()) {
//Asignamos nuevas variables para hacer mas sencillo el formulario
        $name = $row['name'];
        $owner = $row['owner'];
        $species = $row['species'];
        $sex = $row['sex'];
        $birth = $row['birth'];
    }       
echo "<form method='post' action=modifica.php>"
        . "Nombre:<input name='nombre' type=text value='$name'/> </br>"
        . "Duenyo:<input name='duenyo' type=text value='$owner'/> </br>"
        . "Especie:<input name='especie' type=text value='$species'/> </br>"
        . "Sexo:<select name='sexo'>"
        . "<option>m</option>"
        . "<option>f</option>"
        . " </select></br>"
        . "Cumpleanyos:<input type=text value='$birth' readonly/> </br>"
        . "<input type='submit' name='enviar'>";


}
//VAMOS A GUARDAR ESTAS VARIABLES PARA USARLAS MAS ADELANTE
$_SESSION['name'] = $name;
$_SESSION['owner'] = $owner;
$_SESSION['species'] = $species;
$_SESSION['sex'] = $sex;
$_SESSION['fecha'] = $fecha;