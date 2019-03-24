<?php 
session_start();
include("../db/conexion.php");
$enlace=conectar();
if (!empty($_GET['asign_destino'])) {
	$ide=$_GET['asign_destino'];
	$ejecute=pg_query("SELECT * FROM hojas where id=$ide");
	$resp=pg_fetch_array($ejecute);
}
else{
	echo "Connectese con enargado de sistemas";
}

echo json_encode($resp);
 ?>