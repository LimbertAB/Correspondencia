<?php
session_start();
include("../db/conexion.php");
include("../crud/ListPOO.php");
$enlace=conectar();

$urlParams = explode('/', $_SERVER['REQUEST_URI']);
$functionName = $urlParams[4];
$functionName($urlParams[5]);

function verUser($id){
    $ejecute=pg_query("SELECT u.*,c.nombre as cargos,d.nombre as destinos FROM usuarios as u JOIN cargos as c ON c.id = u.id_cargo JOIN destinos as d ON d.id = u.id_destino WHERE u.id=$id");
    echo json_encode(pg_fetch_assoc($ejecute));
}
function verHoja($id){
    $listPOO= new ListPOO; $result=$listPOO->verhoja($id);
    echo json_encode($result);
}
function Notificacion($id){
    $listPOO= new ListPOO; $result=$listPOO->notificacion();
    echo json_encode($result);
}
function recepcionar($id){
    $listPOO= new ListPOO; $result=$listPOO->recepcionar($id,$_POST['observacion'],$_FILES['archivo']);
    echo json_encode($result);
}
function modificar_recepcionar($id){
    $listPOO= new ListPOO; $result=$listPOO->modificar_recepcionar($id,$_POST['observacion'],$_FILES['archivo']);
    echo json_encode($result);
}
function revisar_hoja($id){
    $listPOO= new ListPOO; $result=$listPOO->revisar_hoja($id);
    echo json_encode($result);
}
function vermiperfil($id){
    $listPOO= new ListPOO; $result=$listPOO->vermiperfil();
    echo json_encode($result);
}
function eliminar_peticion($id){
    $ejecute=pg_query("DELETE FROM peticion WHERE id={$id}");
    $PGSTAT = pg_result_status($ejecute);
    if($PGSTAT == 1){
        echo "ok";
    }else{
        echo "false";
    }
}
function eliminar_hoja($id){
    $listPOO= new ListPOO; $result=$listPOO->eliminarhoja($id);
    echo $result;
}
?>
