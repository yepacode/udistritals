<?php
//$conn = pg_connect("host=192.168.10.201 port=5432 dbname=db_pse user=postgres password=postgres");
// $conn = pg_connect("host=192.168.0.101 port=3010 dbname=db_pse user=postgres password=P0stgr3sSQL");
// $conn = pg_connect("host=192.168.10.21 port=5432 dbname=db_pse user=postgres password=postgres"); // prod
// if (pg_ErrorMessage($conn)) {
//     echo "<p><b>Ocurrio un error conectando a la base de datos: .</b></p>";
//     exit;
// }

// Pruebas pse
$host = '192.168.2.6';
$port = '2010';
$user = 'postgres';
$clave = 'P0stgr3sSQL';
$dbname = 'db_pse';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$clave");

if (!$conn) {
    echo "Error al conectarse a la base de datos.";
    exit;
}
?>
