<?php 
session_start();
include("conexion.php");
$enlace=conectar();
$user=$_POST["user"];
$pass=$_POST["pass"];
//hacemos la consulta
$consulta="SELECT u.* FROM usuarios as u JOIN cargos as c ON c.id = u.id_cargo WHERE u.usuario='{$user}' AND c.estado=1 AND u.estado=1";
//ejecutamos la consulta mas la conexion
$ejecute=pg_query($consulta);
if(pg_num_rows($ejecute)==1){
	$datos=pg_fetch_assoc($ejecute);
	if (password_verify($pass, $datos['password'])){
		$_SESSION['nombres'] = $datos['nombres'];//nombre
		$_SESSION['id_usu'] = $datos['id'];//id de usuario
		header("location:../pages/index2.php");
	}else{
		$_SESSION['mensaje'] ="Contraseña incorrecta";
		header("location:../index.php");
	}
}else{
	$_SESSION['mensaje'] ="El Usuario no existe";
	header("location:../index.php");
}
 ?>
