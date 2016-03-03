<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
 <?php
/* 
este fichero realizará la conexión a la base de datos
 * Toma los valores del fichero acceso.php
 */
include 'config.php';
$conexion = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if ($conexion->connect_errno){
//si se produce algun error finaliza con mensaje de error
    die("Error de Conexion:" .$conexion->connect_error);
}
//consulta SQL
$sql = "SELECT * " . "FROM pet";
$result = $conexion->query($sql);
echo "";
echo '<table border ="1">'; //iniciar tabla
echo '<tr>';
echo "<td>name</td>";
echo "<td>owner</td>";
echo "<td>species</td>";
echo "<td>sex</td>";
echo "<td>birth</td>";
echo "<td>death</td>";
echo '</tr>';
while($datos = $result->fetch_assoc()){
    echo '<tr>';
    echo "<td>".$datos['name']."</td>";
    echo "<td>".$datos['owner']."</td>";
    echo "<td>".$datos['species']."</td>";
    echo "<td>".$datos['sex']."</td>";
    echo "<td>".$datos['birth']."</td>";
    echo "<td>".$datos['death']."</td>";
    echo '</tr>';
}
//fin de la tabla
echo "</table>";
?>
 </body>
</html>