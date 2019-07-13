<?php
use PhpParser\Node\Stmt\Catch_;
use Mockery\Exception;

session_start();
include("../db/conexion.php");
include("../crud/ListPOO.php");
$enlace=conectar();

$urlParams = explode('/', $_SERVER['REQUEST_URI']);
$functionName = $urlParams[4];
echo "llegando";
if(isset($urlParams[6])){
    $functionName($urlParams[5],$urlParams[6]);
}else{
    $functionName($urlParams[5]);
}

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
function eliminar_objeto($table,$id){
    $ejecute=pg_query("DELETE FROM {$table} WHERE id={$id}");
    $PGSTAT = pg_result_status($ejecute);
    if($PGSTAT == 1){
        echo "ok";
    }else{
        $ejecute=pg_query("UPDATE {$table} SET estado=0 WHERE id={$id}");
        $PGSTAT = pg_result_status($ejecute);
        if($PGSTAT == 1){
            echo "ok";
        }else{
            echo "false";
        }
    }
       
}
function alta_objeto($table,$id){
    $ejecute=pg_query("UPDATE {$table} SET estado=1 WHERE id={$id}");
    $PGSTAT = pg_result_status($ejecute);
    if($PGSTAT == 1){
        echo "ok";
    }else{
        echo "false";
    }
}
function backup($id){
    echo 'llegando';
    exec('set PGPASSWORD="fersistem" ./pg_dump --dbname=postgresql://postgres:fersistem@127.0.0.1:5432/correspondencias > backup/mydbdumpiii.sql',$output);
    print_r($output);

    shell_exec('set PGPASSWORD="fersistem" ./pg_dump --dbname=postgresql://postgres:fersistem@127.0.0.1:5432/correspondencias > backup/mydbdumpooo.sql',$output);
    print_r($output);

    shell_exec('set PGPASSWORD="fersistem" ./pg_dump --dbname=postgresql://postgres:fersistem@127.0.0.1:5432/correspondencias > backup/mydbdumpuu.sql');

    exec('set PGPASSWORD="fersistem" ./pg_dump --dbname=postgresql://postgres:fersistem@127.0.0.1:5432/correspondencias > backup/mydbeee.sql',$output);
    print_r($output);

    // set PGPASSWORD="fersistem" pg_dump -C -D -O -U correspondencias > d:\nombre_del_respaldo.bak
    // $string = "./pg_dump --dbname=postgresql://postgres:fersistem@127.0.0.1:5432/correspondencias > D:\mydbdump.sql"; 
    // exec($string);
    // shell_exec($string);
    // $dump= "./bin/pg_dump correspondencias > ./correspondencias.sql";
    // if(exec($dump))
    // {
    // echo "Copia realizada con exito";
    // }
    // else { echo "Ha fallado la copia"; }

    // pg_dump --dbname=postgresql://postgres:fersistem@127.0.0.1:5432/correspondencias > D:\dbbackup.sql


    // exec('./bin/pg_dump --dbname=postgresql://postgres:fersistem@127.0.0.1:5432/correspondencias > dbbackup.sql',$output);
    // print_r($output);
    // shell_exec('./bin/pg_dump --dbname=postgresql://postgres:fersistem@127.0.0.1:5432/correspondencias > dbbackup2.sql');
    // exec('pg_dump -h localhost -U postgres -W -F t correspondencias > database_dump_file.sql');

    // exec('PGPASSWORD="fersistem" pg_dump -i -h localhost -p 5432 -U postgres -F c -b -v -f dumpfilename.dump correspondencias');
    // $string = "export PGPASSWORD=fersistem && export PGUSER=postgres && ./bin/pg_dump -h localhost db_name correspondencias > ./correspondencias2.sql && unset PGPASSWORD && unset PGUSER"; 
    // $return=exec($string);
    // shell_exec($string);
    // echo "addd".$return;
}
?>
