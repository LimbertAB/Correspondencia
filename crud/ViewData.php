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

?>