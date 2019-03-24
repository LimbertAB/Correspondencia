<?php 
session_start();
include("../db/conexion.php");
$enlace=conectar();
if (!empty($_POST['ca'])) {
	$ide=$_POST['ide'];
	$nombre=$_POST['nombre'];
	$descrip=$_POST['descrip'];
	if (empty($_POST['nombre'])) {
		$resp=1;
	}
	elseif (empty($_POST['funciones'])) {
		$resp=2;
	}
	else{
		$funcion=$_POST['funciones'];
		$ejecute=pg_query("SELECT * FROM cargos where nombre='$nombre' and id<>$ide");
		$cont=pg_num_rows($ejecute);
		$datos=pg_fetch_array($ejecute);
		if ($cont>0) {
			$resp=3;
		}
		else{
			$sql = "UPDATE cargos SET nombre = '".$nombre."', descripcion = '".$descrip."' where id=$ide";
				pg_query($enlace, $sql);
			//elimino todo segun el ide
			$eliminar=pg_query("DELETE FROM funcion_cargo where cargo_id=$ide");
			for ($i=0; $i <count($funcion) ; $i++) { 
				$sql_funcion_cargo = "INSERT INTO funcion_cargo (funcion_id,cargo_id) values($funcion[$i],$ide)";
				pg_query($sql_funcion_cargo);
			}
			$resp=0;
		}
	}
		
}
else{
	echo "Connectese con enargado de sistemas";
}

echo json_encode($resp);
 ?>