<?php 
session_start();
include("conexion.php");
$enlace=conectar();
$user=$_POST["user"];
$pass=$_POST["pass"];
//hacemos la consulta
$consulta="SELECT * FROM usuarios where usuario='$user' AND password='$pass' ";
//ejecutamos la consulta mas la conexion
$ejecute=pg_query($consulta);
//encontramos la cantidad de datos
$cont=pg_num_rows($ejecute);
//almacenamos en una variable todos los datos
$datos=pg_fetch_array($ejecute);
//consulta de si existe usuario
if ($cont==0) {
	$_SESSION['mensaje'] ="Usuario o contraseña incorrecto";//nombre
	header("location:../index.php");
}
else
{
	$_SESSION['nombres'] = $datos['nombres'];//nombre
	$_SESSION['id_usu'] = $datos['id'];//id de usuario
	header("location:../pages/index.php");
}
 ?>
