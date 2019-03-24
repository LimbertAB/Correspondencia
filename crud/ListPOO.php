<?php
class ListPOO{
    public $USER_ID=0;
    public $USER_DESTINO=0;
    public $USER_CARGO=0;
    public $USER_PERMISO=0;
    
    function __construct(){
        $this->USER_ID=$_SESSION['id_usu'];
        $ejecute=pg_fetch_assoc(pg_query("SELECT * FROM usuarios WHERE id='{$this->USER_ID}'"));
        $this->USER_DESTINO=$ejecute['id_destino'];
        $this->USER_CARGO=$ejecute['id_cargo'];
        $ejecute=pg_query("SELECT * FROM funcion_cargo WHERE cargo_id='{$this->USER_CARGO}' AND funcion_id=13");
        $this->USER_PERMISO=pg_num_rows($ejecute);
    }
    function listHojaRuta(){
        $inicioconsulta=$this->USER_PERMISO==1?"WHERE":"AND";
        $cadena="";
        if(isset($_GET['inicio']) && (isset($_GET['fin']))){
            if(($_GET['inicio']!="") && ($_GET['fin']!="")){
                $cadena=$inicioconsulta." h.fecha BETWEEN '".$_GET['inicio']."' AND '".$_GET['fin']."' ";
            }
        }
        if($cadena!=""){
            if(isset($_GET['remitentes'])){
                if($_GET['remitentes']!="all"&&$_GET['remitentes']!=null){
                    $cadena="AND h.remitente_id='".$_GET['remitentes']."' ";
                }
            }
        }else{
            if(isset($_GET['remitentes'])){
                if($_GET['remitentes']!="all"&&$_GET['remitentes']!=null){
                    $cadena=$inicioconsulta." h.remitente_id='".$_GET['remitentes']."' ";
                }
            }
        }
        if($this->USER_PERMISO==1){
            $sql=pg_query("SELECT h.*,CONCAT(r.nombres, ' ',r.apellidos) as  remitente, a.nombre as adjunto, t.nombre as tipo
            FROM hojas as h
            JOIN remitentes as r ON r.id = h.remitente_id
            JOIN adjuntos as a ON a.id = h.adjunto_id
            JOIN tipos as t ON t.id = h.tipo_id
            {$cadena} ORDER BY (h.id) asc");
        }else{
            $sql=pg_query("SELECT h.*,CONCAT(r.nombres, ' ',r.apellidos) as  remitente, a.nombre as adjunto, t.nombre as tipo
            FROM hoja_destino as hd
            JOIN hojas as h ON hd.hoja_id = h.id
            JOIN remitentes as r ON r.id = h.remitente_id
            JOIN adjuntos as a ON a.id = h.adjunto_id
            JOIN tipos as t ON t.id = h.tipo_id
            WHERE hd.destino_id={$this->USER_DESTINO} {$cadena}");
        }
        $all = array();
        while ($rows =  pg_fetch_assoc($sql)) {
            $all[] = $rows;
        }
        $count=0;
        while ($count < count($all)) {
            $rowactividad=$all[$count]["id"];
            $row=pg_fetch_assoc(pg_query("SELECT COUNT(*) as total FROM hoja_destino WHERE hoja_id='{$rowactividad}'"));
            $row1=pg_fetch_assoc(pg_query("SELECT COUNT(*) as estado FROM hoja_destino WHERE hoja_id='{$rowactividad}' AND estado = 'revisado'"));
            $all[$count]['estado']=$row1['estado'];$all[$count]['total']=$row['total']==0?"":$row['total'];
            $count=$count+1;
        }
        return ["hoja"=>$all,"inicio"=>isset($_GET['inicio'])?$_GET['inicio']:"","fin"=>isset($_GET['fin'])?$_GET['fin']:"","estados"=>"","remitentes"=>""];
    }
    function verhoja($id){
        $sql=pg_query("SELECT h.*,CONCAT(r.nombres, ' ',r.apellidos) as  remitente,CONCAT(u.nombres, ' ',u.apellidos) as  usuario, a.nombre as adjunto, t.nombre as tipo
            FROM hojas as h
            JOIN remitentes as r ON r.id = h.remitente_id
            JOIN usuarios as u ON u.id = h.usuario_id
            JOIN adjuntos as a ON a.id = h.adjunto_id
            JOIN tipos as t ON t.id = h.tipo_id
            WHERE h.id='{$id}'");
        $sql2=pg_query("SELECT hd.*,CONCAT(u.nombres, ' ',u.apellidos) as usuario, d.nombre as nombre
            FROM hoja_destino as hd
            LEFT JOIN usuarios as u ON u.id = hd.usuario_id
            JOIN destinos as d ON d.id = hd.destino_id
            WHERE hd.hoja_id='{$id}'");
        $destinos = array();
        while ($rows =  pg_fetch_assoc($sql2)) {$destinos[] = $rows;}
        $a=0;
        while ($a < count($destinos)) {
            $hojadestino=$destinos[$a]['id'];
            $sql3=pg_query("SELECT a.*, (SELECT COUNT(*) FROM hoja_accion as ha WHERE ha.accion_id= a.id AND ha.id_hojadestino='{$hojadestino}') AS estado FROM acciones as a");
            $acciones=array();
            while ($rows =  pg_fetch_assoc($sql3)) {
                $acciones[] = $rows;
            }
            $destinos[$a]['acciones']=$acciones;
            $a++;
        }
         
        return ["hoja"=>pg_fetch_assoc($sql),"destinos"=>$destinos];
    }
}

