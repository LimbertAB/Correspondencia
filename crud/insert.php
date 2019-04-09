<?php
session_start();
include("../db/conexion.php");
$enlace=conectar();
//registro de cargos
if (!empty($_POST['ca'])) {
	$nombre=$_POST['nombre'];
	$descrip=$_POST['descrip'];
	if (empty($_POST['nombre'])) {
		$resp=1;
	}
	elseif (empty($_POST['funcion'])) {
		$resp=2;
	}
	else{
		$funcion=$_POST['funcion'];
		$ejecute=pg_query("SELECT * FROM cargos where nombre='$nombre'");
		$cont=pg_num_rows($ejecute);
		$datos=pg_fetch_array($ejecute);
		if ($cont>0) {
			$resp=3;
		}
		else{
			$sql_cargo = "INSERT INTO cargos (nombre,descripcion) values('".$nombre."', '".$descrip."')";
			pg_query($sql_cargo);
			//obtengo el ultimo registro insertado
			$ui=pg_query("SELECT max(id) as id FROM cargos");
			$ultimoid=pg_fetch_array($ui);
			for ($i=0; $i <count($funcion) ; $i++) {
				$sql_funcion_cargo = "INSERT INTO funcion_cargo (funcion_id,cargo_id) values($funcion[$i],$ultimoid[id])";
				pg_query($sql_funcion_cargo);
			}
			$resp=0;
		}
	}

}
//insertar destino
elseif (!empty($_POST['dest'])) {
	$nombre=$_POST['nombre'];
	$descrip=$_POST['descrip'];
	$ejecute=pg_query("SELECT * FROM destinos where nombre='$nombre'");
	$cont=pg_num_rows($ejecute);
	$datos=pg_fetch_array($ejecute);
	if ($cont>0) {
		$resp=2;
	}
	elseif ($nombre=="") {
		$resp=1;
	}
	else{
		$sql = "INSERT INTO destinos (nombre, descripcion) values('".$nombre."', '".$descrip."')";
		pg_query($sql);
		$resp=0;
	}
}
//insertar tipos
elseif (!empty($_POST['tip'])) {
	$nombre=$_POST['nombre'];
	$ejecute=pg_query("SELECT * FROM tipos where nombre='$nombre'");
	$cont=pg_num_rows($ejecute);
	$datos=pg_fetch_array($ejecute);
	if ($cont>0) {
		$resp=2;
	}
	elseif ($nombre=="") {
		$resp=1;
	}
	else{
		$sql = "INSERT INTO tipos (nombre) values('".$nombre."')";
		pg_query($sql);
		$resp=0;
	}
}
//insertar aduntos
elseif (!empty($_POST['adj'])) {
	$nombre=$_POST['nombre'];
	$ejecute=pg_query("SELECT * FROM adjuntos where nombre='$nombre'");
	$cont=pg_num_rows($ejecute);
	$datos=pg_fetch_array($ejecute);
	if ($cont>0) {
		$resp=2;
	}
	elseif ($nombre=="") {
		$resp=1;
	}
	else{
		$sql = "INSERT INTO adjuntos (nombre) values('".$nombre."')";
		pg_query($sql);
		$resp=0;
	}
}
//insertar accioines
elseif (!empty($_POST['acc'])) {
	$nombre=$_POST['nombre'];
	$ejecute=pg_query("SELECT * FROM acciones where nombre='$nombre'");
	$cont=pg_num_rows($ejecute);
	$datos=pg_fetch_array($ejecute);
	if ($cont>0) {
		$resp=2;
	}
	elseif ($nombre=="") {
		$resp=1;
	}
	else{
		$sql = "INSERT INTO acciones (nombre) values('".$nombre."')";
		pg_query($sql);
		$resp=0;
	}
}
//insertar procedencia
elseif (!empty($_POST['proc'])) {
	$nombre=$_POST['nombre'];
	if ($nombre=="") {
		$resp=1;
	}else{
		$sql=pg_query("SELECT * FROM procedencia WHERE UPPER(nombre) = UPPER('{$nombre}')");
		if (pg_num_rows($sql)==0) {
			$sql = "INSERT INTO procedencia (nombre,estado) values('{$nombre}',1)";
			pg_query($sql);
			$resp=0;
		}else{
			$resp=1;
		}
	}
}

//insertar acciones
elseif (!empty($_POST['des_accion'])) {
	$id_hd=$_POST['id'];
	$observacion=$_POST['observacion'];
	$estado=$_POST['estado'];
	$fecha=date("Y-M-D");
	if (empty($_POST['accion'])) {
		$resp=1;
	}
	elseif ($estado=="no revisado") {
		$resp=2;
	}
	elseif ($estado=="en proceso") {
		$resp=3;
	}
	else{

		$accion=$_POST['accion'];
		//eliminamos toda la tabla hoja_accion segun el id
		pg_query("DELETE FROM hoja_accion where hoja_id=$id_hd");
		//inserto en la tabla hoja_accion
		for ($i=0; $i <count($accion) ; $i++) {
			$sql = "INSERT INTO hoja_accion (hoja_id,accion_id) values($id_hd,$accion[$i])";
			pg_query($sql);
		}
		//modificamos para la siguiente destino(en proceso)
		if ($estado=='revisado') {
			//modificamos la tabla hoja_accion
			pg_query($enlace,"UPDATE hoja_destino SET estado = '".$estado."', observacion = '".$observacion."', usuario_id = $_SESSION[id_usu] WHERE id=$id_hd");
			$id_hd=$id_hd+1;
			$ejecute=pg_query("SELECT * FROM hoja_destino where id=$id_hd");
			$cont=pg_num_rows($ejecute);
			if ($cont>0) {
				pg_query($enlace,"UPDATE hoja_destino SET estado = 'en proceso' WHERE id=$id_hd");
			}
		}
		else{
			pg_query($enlace,"UPDATE hoja_destino SET estado = 'rechazado' WHERE id=$id_hd");
		}
		$resp=0;
	}
}
else{
	$resp=404;
}
echo json_encode($resp);

 ?>
