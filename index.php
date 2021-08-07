<?php
$servername = "SQL5102.site4now.net";
$database = "db_a54053_bdprueba";
$username = "db_a54053_bdprueba_admin";
$password = "Marlon1989";

$connectionInfo = array( "Database"=>$database, "UID"=>$username, "PWD"=>$password);
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
//echo "conexion satisfacotria";
//mysqli_close($con);

?>
