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
    $pas_usu=password_hash($_POST['pas_usu'], PASSWORD_BCRYPT);
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
        $pass=password_hash($_POST['password'], PASSWORD_BCRYPT);
        pg_query("UPDATE usuarios SET password='{$pass}' WHERE id=".$_POST['id']."");
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
    $cargo_remitente=$_POST['cargo_remitente'];
    $adjunto=$_POST['adjunto'];
    $num_hojas=$_POST['num_hojas'];
    $tipo=$_POST['tipo'];
    $plazo=$_POST['plazo'];
    $cite=$_POST['cite'];
    $fecha_cite=$_POST['fecha'];
    $prioridad=$_POST['prioridad'];
    $referencia=$_POST['referencia'];
    $proveido=$_POST['proveido'];
    $user=$_SESSION['id_usu'];
    $fecha=date('Y-m-d h:i:s');
    //obtengo el ultimo id de hoja
    $ultimoid=pg_fetch_assoc(pg_query("SELECT max(id) as id FROM hojas"));
    $ultimo=$ultimoid['id']+1;$tramite="CNM-".$ultimo."/".date("Y");
    if($_FILES['archivo']['error'] == 0) {
        $exploded = explode('.',$_FILES['archivo']['name']);
        $ext = $exploded[count($exploded) - 1]; 
        $name="FILE".date("Ymdhis").".".$ext;
        $sql = pg_query("INSERT INTO hojas (procedencia_id,remitente,cargo_remitente,adjunto_id,num_hojas,tipo_id,referencia,usuario_id,fecha,fecha_cite,plazo,cite,tramite,archivo,prioridad,estado,proveido) values('{$procedencia}','{$remitente}','{$cargo_remitente}','{$adjunto}','{$num_hojas}','{$tipo}','{$referencia}','{$user}','{$fecha}','{$fecha_cite}','{$plazo}','{$cite}','{$tramite}','{$name}','{$prioridad}',1,'{$proveido}')");
        $PGSTAT = pg_result_status($sql);
        if($PGSTAT == 1){
            $ruta="../dist/archivos/".$name;
            move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        }
    }else{
        $sql = pg_query("INSERT INTO hojas (procedencia_id,remitente,cargo_remitente,adjunto_id,num_hojas,tipo_id,referencia,usuario_id,fecha,fecha_cite,plazo,cite,tramite,prioridad,estado,proveido) values('{$procedencia}','{$remitente}','{$cargo_remitente}','{$adjunto}','{$num_hojas}','{$tipo}','{$referencia}','{$user}','{$fecha}','{$fecha_cite}','{$plazo}','{$cite}','{$tramite}','{$prioridad}',1,'{$proveido}')");
    }
    $PGSTAT = pg_result_status($sql);
    if($PGSTAT == 1){
        $ui=pg_fetch_assoc(pg_query("SELECT max(id) as id FROM hojas"));
		$id=$ui['id'];

        $destino=isset($_POST['destino'])?$_POST['destino']:[];$affects=0;
        $proveidos=isset($_POST['proveidos'])?$_POST['proveidos']:[];   
		for ($i=0; $i <count($destino) ; $i++) {
            $estado=$i==0?"en proceso":"espera";
			$sql = pg_query("INSERT INTO hoja_destino (hoja_id,destino_id,proveido,estado) values($id,$destino[$i],'{$proveidos[$i]}','{$estado}')");
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
    
    if($_FILES['archivo']['error'] == 0) {
        $exploded = explode('.',$_FILES['archivo']['name']);
        $ext = $exploded[count($exploded) - 1]; 
        $name="FILE".date("Ymdhis").".".$ext;
        $sql=pg_query("UPDATE hojas SET archivo='{$name}'WHERE id={$id}");
        $PGSTAT = pg_result_status($sql);
        echo "llegada archivo por el if".$PGSTAT;
        if($PGSTAT == 1){
           echo "llegada archivo por el if de pdstat";
            $ruta="../dist/archivos/".$name;
            move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        }
    }
    $procedencia=$_POST['procedencia'];$remitente=$_POST['remitente'];
    $cargo_remitente=$_POST['cargo_remitente'];
	$adjunto=$_POST['adjunto'];$num_hojas=$_POST['num_hojas'];
    $tipo=$_POST['tipo'];$referencia=$_POST['referencia'];
	 $plazo=$_POST['plazo'];$cite=$_POST['cite'];
    $fecha_cite=$_POST['fecha_cite'];$prioridad=$_POST['prioridad'];$proveido=$_POST['proveido'];
    $user=$_SESSION['id_usu'];$fecha_update=date("Y-m-d h:i:s");

   $sql=pg_query("UPDATE hojas SET procedencia_id={$procedencia},remitente='{$remitente}',cargo_remitente='{$cargo_remitente}',adjunto_id={$adjunto},
        num_hojas={$num_hojas},tipo_id={$tipo},referencia='{$referencia}',fecha_cite='{$fecha_cite}',plazo={$plazo},
        cite='{$cite}',prioridad='{$prioridad}',update_user={$user},fecha_update='{$fecha_update}',proveido='{$proveido}' WHERE id={$id}");
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
        if(isset($_POST['destinos'])){
            for ($i=0;$i<count($_POST['destinos']);$i++) {
                $destino=(array) json_decode($_POST['destinos'][$i]);
                $id_hojadestino=isset($_POST['id_hojadestino'][$i]) ? json_decode($_POST['id_hojadestino'][$i]) : "";
                $id_destino=$destino['id'];
                $proveidos=$destino['proveido'];
                switch ($destino['estado']) {
                    case 'verdad':
                        pg_query("UPDATE hoja_destino SET proveido='{$proveidos}' WHERE id={$id_hojadestino}");
                        break;
                    case 'falso':
                        pg_query("UPDATE hoja_destino SET destino_id={$id_destino}, proveido='{$proveidos}' WHERE id={$id_hojadestino}");
                        break;
                    case 'nuevo':
                        if($i==0){
                            $sql = pg_query("INSERT INTO hoja_destino (hoja_id,destino_id,proveido,estado) values({$id},{$id_destino},'{$proveidos}','en proceso')");
                        }else{
                            $sql = pg_query("INSERT INTO hoja_destino (hoja_id,destino_id,proveido,estado) values({$id},{$id_destino},'{$proveidos}','espera')");
                        }
                        break;
                    case 'eliminar':
                        $sql=pg_query("DELETE from hoja_destino where id={$id_hojadestino}");
                        break;
               }
            }
        }
        echo "ok";
    }
    else{
        echo "error";
    }
}
function ver_usuario($var){
    $sql="SELECT * FROM usuarios WHERE UPPER(usuario) = UPPER('{$var}')";
    $resultado=pg_query($sql);
    return pg_num_rows($resultado);
}
function createPeticion(){
    $id_usuario=$_SESSION['id_usu'];
    $ID_DESTINO=pg_fetch_assoc(pg_query("SELECT id_destino from usuarios WHERE id={$id_usuario}"));
    $ID_DESTINO=$ID_DESTINO['id_destino'];
    $respuesta_id_destino=$_POST['id_destino'];
    $descripcion=strtolower(trim($_POST['descripcion']));
    $fecha=date('Y-m-d h:i:s');
    if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $exploded = explode('.',$_FILES['archivo']['name']);
        $ext = $exploded[count($exploded) - 1]; 
        $name="FILE".date("Ymdhis").".".$ext;
        $sql = pg_query("INSERT INTO peticion (id_destino,descripcion,archivo,fecha,id_usuario,respuesta_id_destino) values({$ID_DESTINO},'{$descripcion}','{$name}','{$fecha}',{$id_usuario},{$respuesta_id_destino})");
        $PGSTAT = pg_result_status($sql);
        if($PGSTAT == 1){
            $ruta="../dist/archivos/".$name;
            move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
            echo "true";
        }else{
            echo "false";
        }
    }else{
        $sql = pg_query("INSERT INTO peticion (id_destino,descripcion,fecha,id_usuario,respuesta_id_destino) values({$ID_DESTINO},'{$descripcion}','{$fecha}',{$id_usuario},{$respuesta_id_destino})");
        $PGSTAT = pg_result_status($sql);
        if($PGSTAT == 1){
            echo "true";
        }else{
            echo "false";
        }
    }
}
function responderPeticion(){
    $id=$_POST['id'];
    $id_usuario=$_SESSION['id_usu'];
    $ID_DESTINO=pg_fetch_assoc(pg_query("SELECT id_destino from usuarios WHERE id={$id_usuario}"));
    $ID_DESTINO=$ID_DESTINO['id_destino'];
    $descripcion=strtolower(trim($_POST['descripcion']));
    $fecha=date('Y-m-d h:i:s');
    if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $exploded = explode('.',$_FILES['archivo']['name']);
        $ext = $exploded[count($exploded) - 1]; 
        $name="FILE".date("Ymdhis").".".$ext;
        $sql = pg_query("UPDATE peticion SET respuesta_descripcion='{$descripcion}',respuesta_archivo='{$name}',respuesta_fecha='{$fecha}',respuesta_id_usuario={$id_usuario} WHERE respuesta_id_destino={$ID_DESTINO} AND id={$id}");
        $PGSTAT = pg_result_status($sql);
        if($PGSTAT == 1){
            $ruta="../dist/archivos/".$name;
            move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
            echo "true";
        }else{
            echo "false";
        }
    }else{
        $sql = pg_query("UPDATE peticion SET respuesta_descripcion='{$descripcion}',respuesta_fecha='{$fecha}',respuesta_id_usuario={$id_usuario} WHERE respuesta_id_destino={$ID_DESTINO} AND id={$id}");
        $PGSTAT = pg_result_status($sql);
        if($PGSTAT == 1){
            echo "true";
        }else{
            echo "false";
        }
    }
}
function modificarUnDato(){
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $tabla=$_POST['tabla'];
    if(ver_nombre($tabla,$nombre,$id)==0){
        if ($tabla=="destinos") {
            $descripcion=$_POST['descripcion'];
            $sql = pg_query("UPDATE {$tabla} SET nombre='{$nombre}',descripcion='{$descripcion}' WHERE id={$id}");
        }else{
            $sql = pg_query("UPDATE {$tabla} SET nombre='{$nombre}' WHERE id={$id}");
        }
        $PGSTAT = pg_result_status($sql);
        if($PGSTAT == 1){
            echo "true";
        }else{
            echo "false";
        }
    }else{
        echo "duplicado";
    }
}
function ver_nombre($table,$nombre,$id){
    $sql="SELECT * FROM {$table} WHERE UPPER(nombre) = UPPER('{$nombre}') AND id<>{$id}";
    $resultado=pg_query($sql);
    return pg_num_rows($resultado);
}