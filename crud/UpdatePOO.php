<?php
session_start();
include("../db/conexion.php");
$enlace=conectar();

$urlParams = explode('/', $_SERVER['REQUEST_URI']);
$functionName = $urlParams[4];
$functionName();

function CreateUser(){
    $nom_usu=$_POST['nom_usu'];
	$ape_usu=$_POST['ape_usu'];
	$ced_usu=$_POST['ced_usu'];
	$usu_usu=$_POST['usu_usu'];
    $pas_usu=$_POST['pas_usu'];
    $car_usu=$_POST['id_cargo'];
    $des_usu=$_POST['id_destino'];
    if(ver_usuario($_POST['usu_usu'])==0){
        $sql=pg_query("INSERT INTO usuarios (nombres, apellidos, cedula, usuario, password,id_cargo,id_destino,estado) values('{$nom_usu}','{$ape_usu}','{$ced_usu}','{$usu_usu}','{$pas_usu}','{$car_usu}','{$des_usu}',1)");
        Retorno($sql);
    }else{
        echo "duplicado";
    }
}
function updateUser(){
    if($_POST['password']!=""){
        pg_query("UPDATE usuarios SET password='".$_POST['password']."'WHERE id=".$_POST['id']."");
    }
    if($_POST['usuario']==""){
        $sql=pg_query("UPDATE usuarios SET cedula='".$_POST['cedula']."',nombres='".$_POST['nombre']."',
            apellidos='".$_POST['apellido']."',id_cargo='".$_POST['cargo']."',id_destino='".$_POST['destino']."' WHERE id=".$_POST['id']."");
        Retorno($sql);
    }else{
        if(ver_usuario($_POST['usuario'])==0){
            $sql=pg_query("UPDATE usuarios SET cedula='".$_POST['cedula']."',usuario='".$_POST['usuario']."',nombres='".$_POST['nombre']."',
                apellidos='".$_POST['apellido']."',id_cargo='".$_POST['cargo']."',id_destino='".$_POST['destino']."' WHERE id=".$_POST['id']."");
            Retorno($sql);
        }else{
            echo "duplicado";

        }
    }

}
function Retorno($sql){
    $PGSTAT = pg_result_status($sql);
    if($PGSTAT == 1){
        echo "ok";
    }else{
        return false;
    }
}
function createHoja(){
    $procedencia=$_POST['procedencia'];
	$remitente=$_POST['remitente'];
	$adjunto=$_POST['adjunto'];
	$num_hojas=$_POST['num_hojas'];
	$tipo=$_POST['tipo'];
	$plazo=$_POST['plazo'];
    $cite=$_POST['cite'];
    $fecha=$_POST['fecha'];
    $prioridad=$_POST['prioridad'];
    $referencia=$_POST['referencia'];
	$user=$_SESSION['id_usu'];
    //obtengo el ultimo id de hoja
    $ultimoid=pg_fetch_assoc(pg_query("SELECT max(id) as id FROM hojas"));
    $ultimo=$ultimoid['id']+1;

	$tramite="CNM-".$ultimo."/".date("Y");
	$name="FILE".date("Ymdhis").".pdf";
	$ruta="../dist/archivos/".$name;
    $sql = pg_query("INSERT INTO hojas (procedencia,remitente_id,adjunto_id,num_hojas,tipo_id,referencia,usuario_id,fecha,plazo,cite,tramite,archivo,prioridad,estado) values('{$procedencia}','{$remitente}','{$adjunto}','{$num_hojas}','{$tipo}','{$referencia}','{$user}','{$fecha}','{$plazo}','{$cite}','{$tramite}','{$name}','{$prioridad}',1)");
    $PGSTAT = pg_result_status($sql);
    if($PGSTAT == 1){
        move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        $ui=pg_fetch_assoc(pg_query("SELECT max(id) as id FROM hojas"));
		$id=$ui['id'];

		$destino=$_POST['destino'];$affects=0;
		for ($i=0; $i <count($destino) ; $i++) {
			$sql = pg_query("INSERT INTO hoja_destino (hoja_id,destino_id,estado) values($id,$destino[$i],'en proceso')");
            $PGSTAT = pg_result_status($sql);
            if($PGSTAT == 1){
                $affects++;
            }
        }
        if($affects==count($destino)){
            $accion=$_POST['accion'];$affects=0;
            for ($i=0; $i <count($accion) ; $i++) {
                $sql = pg_query("INSERT INTO hoja_accion (id_hoja,accion_id) values($id,$accion[$i])");
                $PGSTAT = pg_result_status($sql);
                if($PGSTAT == 1){
                    $affects++;
                }
            }
            if($affects==count($accion)){echo "true";
            }else{echo "false";}
        }else{echo "false";}
	}
}
function updateHoja(){
    $id=$_POST['id_hoja'];
    $name="FILE".date("Ymdhis").".pdf";
    if($_FILES['archivo']['error'] == 0) {
        $sql=pg_query("UPDATE hojas SET archivo='{$name}'WHERE id={$id}");
        $PGSTAT = pg_result_status($sql);
        if($PGSTAT == 1){
            $ruta="../dist/archivos/".$name;
            move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        }
    }
    $procedencia=$_POST['procedencia'];$remitente=$_POST['remitente'];
	$adjunto=$_POST['adjunto'];$num_hojas=$_POST['num_hojas'];
    $tipo=$_POST['tipo'];$referencia=$_POST['referencia'];
	$plazo=$_POST['plazo'];$cite=$_POST['cite'];
    $fecha=$_POST['fecha'];$prioridad=$_POST['prioridad'];
    $user=$_SESSION['id_usu'];$fecha_update=date("Y-m-d h:i:s");

    $sql=pg_query("UPDATE hojas SET procedencia='{$procedencia}',remitente_id={$remitente},adjunto_id={$adjunto},
        num_hojas={$num_hojas},tipo_id={$tipo},referencia='{$referencia}',fecha='{$fecha}',plazo={$plazo},
        cite='{$cite}',prioridad='{$prioridad}',update_user={$user},fecha_update='{$fecha_update}' WHERE id={$id}");
    $PGSTAT = pg_result_status($sql);
    if($PGSTAT == 1){
        if(isset($_POST['accion_u'])){
            for ($i=0;$i<count($_POST['accion_u']);$i++) {
                $accion=(array) json_decode($_POST['accion_u'][$i]);
                $id_accion=$accion['id'];
                if ($accion['estado']) {
                    $sql = pg_query("INSERT INTO hoja_accion (id_hoja,accion_id) values({$id},{$id_accion})");
                }else{
                    $sql=pg_query("DELETE from hoja_accion where id_hoja={$id} AND accion_id={$id_accion}");
                }
            }
        }
        if(isset($_POST['destino_u'])){
            for ($i=0;$i<count($_POST['destino_u']);$i++) {
                $destino=(array) json_decode($_POST['destino_u'][$i]);
                $id_destino=$destino['id'];
                if ($destino['estado']) {
                    $sql = pg_query("INSERT INTO hoja_destino (hoja_id,destino_id,estado) values({$id},{$id_destino},'en proceso')");
                }else{
                    $sql=pg_query("DELETE from hoja_destino where hoja_id={$id} AND destino_id={$id_destino}");
                }
            }
        }
        echo "ok";
	}
}
function ver_usuario($var){
    $sql="SELECT * FROM usuarios WHERE UPPER(usuario) = UPPER('{$var}')";
    $resultado=pg_query($sql);
    return pg_num_rows($resultado);
}
