<?php
class ListPOO{
   public $USER_ID=0;
   public $USER_DESTINO=0;
   public $USER_CARGO=0;
   public $USER_PERMISO=0;
   public $USER_CONSULTA="";
   function __construct(){
      $this->USER_ID=$_SESSION['id_usu'];
      $ejecute=pg_fetch_assoc(pg_query("SELECT * FROM usuarios WHERE id='{$this->USER_ID}'"));
      $this->USER_DESTINO=$ejecute['id_destino'];
      $this->USER_CARGO=$ejecute['id_cargo'];
      $ejecute=pg_query("SELECT * FROM funcion_cargo WHERE cargo_id='{$this->USER_CARGO}' AND funcion_id=13");
      $this->USER_PERMISO=pg_num_rows($ejecute);
      $this->USER_CONSULTA=$this->USER_PERMISO==1 ? "" : " AND destino_id=".$this->USER_DESTINO;
   }
   function listHojaRuta(){
      $id=isset($_GET['id']) ? $_GET['id'] != "" ? intval($_GET['id']):"%%":"%%";
      $remitente=isset($_GET['remitente']) ? $_GET['remitente'] != ""? intval($_GET['remitente']):"%%":"%%";
      $tipo=isset($_GET['tipo']) ? $_GET['tipo'] != "" ? intval($_GET['tipo']):"%%":"%%";
      $adjunto=isset($_GET['adjunto']) ? $_GET['adjunto'] != "" ? intval($_GET['adjunto']):"%%":"%%";
      $hojas=isset($_GET['hojas']) ? $_GET['hojas'] != "" ? intval($_GET['hojas']):"%%":"%%";
      $referencia=isset($_GET['referencia']) ? strtoupper($_GET['referencia']):"";
      $procedencia=isset($_GET['procedencia']) ? strtoupper($_GET['procedencia']):"";
      $cite=isset($_GET['cite']) ? strtoupper($_GET['cite']):"";
      $estado=isset($_GET['estado']) ? strtoupper($_GET['estado']):"";
      $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";$estados;
      $cadena="";if(isset($_GET['inicio']) && (isset($_GET['fin']))){if(($_GET['inicio']!="") && ($_GET['fin']!="")){$cadena="AND h.fecha BETWEEN '".$_GET['inicio']."' AND '".$_GET['fin']."'";}}

      if($this->USER_PERMISO==1){
         $sql=pg_query("SELECT h.*,CONCAT(r.nombres, ' ',r.apellidos) as  remitente, a.nombre as adjunto, t.nombre as tipo,(h.plazo-DATE_PART('day','{$FECHA_ACTUAL}' - h.fecha)) as diferencia,CONCAT(u.nombres, ' ',u.apellidos) as  usuario
         FROM hojas as h
         JOIN remitentes as r ON r.id = h.remitente_id
         JOIN adjuntos as a ON a.id = h.adjunto_id
         JOIN tipos as t ON t.id = h.tipo_id
         JOIN usuarios as u ON u.id = h.usuario_id
         WHERE CAST(h.id AS TEXT) LIKE '{$id}' AND CAST(h.remitente_id AS TEXT) LIKE '{$remitente}' AND
         CAST(h.tipo_id AS TEXT) LIKE '{$tipo}' AND CAST(h.adjunto_id AS TEXT) LIKE '{$adjunto}' AND CAST(h.num_hojas AS TEXT) LIKE '{$hojas}' AND
         CAST(UPPER(h.procedencia) AS TEXT) LIKE '%{$procedencia}%' AND CAST(UPPER(h.cite) AS TEXT) LIKE '%{$cite}%'AND CAST(UPPER(h.referencia) AS TEXT) LIKE '%{$referencia}%'
         {$cadena}");$estados="";
      }else{
         $sql=pg_query("SELECT h.*,CONCAT(r.nombres, ' ',r.apellidos) as  remitente, a.nombre as adjunto, t.nombre as tipo,(h.plazo-DATE_PART('day','{$FECHA_ACTUAL}' - h.fecha)) as diferencia,CONCAT(u.nombres, ' ',u.apellidos) as  usuario
         FROM hoja_destino as hd
         JOIN hojas as h ON hd.hoja_id = h.id
         JOIN remitentes as r ON r.id = h.remitente_id
         JOIN adjuntos as a ON a.id = h.adjunto_id
         JOIN tipos as t ON t.id = h.tipo_id
         JOIN usuarios as u ON u.id = h.usuario_id
         WHERE hd.destino_id={$this->USER_DESTINO} AND CAST(h.id AS TEXT) LIKE '{$id}' AND CAST(h.remitente_id AS TEXT) LIKE '{$remitente}' AND
         CAST(h.tipo_id AS TEXT) LIKE '{$tipo}' AND CAST(h.adjunto_id AS TEXT) LIKE '{$adjunto}' AND CAST(h.num_hojas AS TEXT) LIKE '{$hojas}' AND
         CAST(UPPER(h.procedencia) AS TEXT) LIKE '%{$procedencia}%' AND CAST(UPPER(h.cite) AS TEXT) LIKE '%{$cite}%'AND CAST(UPPER(h.referencia) AS TEXT) LIKE '%{$referencia}%' {$cadena}");
         $estados="";$estados=$this->USER_CONSULTA;
      }
      $all = array();while ($rows =  pg_fetch_assoc($sql)) {$all[] = $rows;}
      $hojastotal = array();
      $count=0;$i=0;
      while ($count < count($all)) {
         $RESTANTE=0;
         //echo " id-> ".$all[$count]["id"]." diferencia-> ".$all[$count]["diferencia"]." plazo-> ". $all[$count]["plazo"]." estados-> ". $estados." ";
         if (intval($all[$count]["diferencia"]) >= 0) {$RESTANTE=1;}
         $rowactividad=$all[$count]["id"];
         $row=pg_fetch_assoc(pg_query("SELECT COUNT(*) as total FROM hoja_destino WHERE hoja_id='{$rowactividad}' {$estados}"));
         $row1=pg_fetch_assoc(pg_query("SELECT COUNT(*) as faltantes from hoja_destino where hoja_id='{$rowactividad}' {$estados} AND usuario_id IS NULL"));
         $revisado=true;$norevisado=true;$proceso=true;
         if(isset($_GET['estado']) && $_GET['estado'] !=""){
            if($_GET['estado']=="revisado"){
               $revisado=true;$norevisado=false;$proceso=false;
            }if($_GET['estado']=="norevisado"){
               $revisado=false;$norevisado=true;$proceso=false;
            }if($_GET['estado']=="proceso"){
               $revisado=false;$norevisado=false;$proceso=true;
            }
         }
         //echo " plazo_activo-> ".$RESTANTE." total->".$row['total']." faltante->".$row1['faltantes']." access->".$revisado."<br>";
         if ($RESTANTE==1 && $row['total']>0 && $row['total']>=$row1['faltantes'] && $proceso && $row1['faltantes']!=0) {
            $all[$count]['color']="bgcolor='#e2f971'";$all[$count]['mensaje']="En Proceso";
            $all[$count]['total']=$row['total'];$all[$count]['faltantes']=$row1['faltantes'];$all[$count]['estado_plazo']=$RESTANTE;
            $acciones = array();$destinos = array();
            $destinos=$this->get_destino($rowactividad);$acciones=$this->get_accion($rowactividad);
            $all[$count]['destinos']=$destinos;$all[$count]['acciones']=$acciones;array_push($hojastotal,$all[$count]);
         }else{
            if ($row['total']>0 && $row1['faltantes']==0 && $revisado) {
               $all[$count]['color']="bgcolor='#67FF99'";$all[$count]['mensaje']="Recepcionado";
               $all[$count]['total']=$row['total'];$all[$count]['faltantes']=$row1['faltantes'];$all[$count]['estado_plazo']=$RESTANTE;
               $acciones = array();$destinos = array();
               $destinos=$this->get_destino($rowactividad);$acciones=$this->get_accion($rowactividad);
               $all[$count]['destinos']=$destinos;$all[$count]['acciones']=$acciones;array_push($hojastotal,$all[$count]);
            }else{
               if ($RESTANTE==0 && $row['total']>0 && $row1['faltantes']>0 && $norevisado) {
                  $all[$count]['color']="bgcolor='#f59a9a'";$all[$count]['mensaje']="No Recepcionado";
                  $all[$count]['total']=$row['total'];$all[$count]['faltantes']=$row1['faltantes'];$all[$count]['estado_plazo']=$RESTANTE;
                  $acciones = array();$destinos = array();
                  $destinos=$this->get_destino($rowactividad);$acciones=$this->get_accion($rowactividad);
                  $all[$count]['destinos']=$destinos;$all[$count]['acciones']=$acciones;array_push($hojastotal,$all[$count]);
               }
            }
         }

         $count=$count+1;
      }
      return ["hoja"=>$hojastotal,"inicio"=>isset($_GET['inicio'])?$_GET['inicio']:"","fin"=>isset($_GET['fin'])?$_GET['fin']:"",
         "id"=>$_GET['id'] ?? "","remitente"=>$_GET['remitente']??"","tipo"=>$_GET['tipo']??"","adjunto"=>$_GET['adjunto']??"",
         "num_hojas"=>$_GET['hojas']??"","cite"=>$cite,"procedencia"=>$procedencia,"referencia"=>$referencia,"estado"=>$_GET['estado']];
   }
   function verhoja($id){
      $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";
      $sql=pg_fetch_assoc(pg_query("SELECT h.*,CONCAT(r.nombres, ' ',r.apellidos) as  remitente,CONCAT(u.nombres, ' ',u.apellidos) as  usuario,u.cedula,a.nombre as adjunto,
      t.nombre as tipo,CONCAT(us.nombres, ' ',us.apellidos) as modificado,(h.plazo-DATE_PART('day','{$FECHA_ACTUAL}' - h.fecha)) as diferencia
         FROM hojas as h
         JOIN remitentes as r ON r.id = h.remitente_id JOIN usuarios as u ON u.id = h.usuario_id JOIN adjuntos as a ON a.id = h.adjunto_id JOIN tipos as t ON t.id = h.tipo_id
         LEFT JOIN usuarios as us ON us.id = h.update_user
         WHERE h.id='{$id}'"));
      $acciones = array();$destinos = array();
      $destinos=$this->get_destino($id);$acciones=$this->get_accion($id);
      $sql["destino"]=$destinos;$sql["accion"]=$acciones;$sql["permiso"]=$this->USER_CONSULTA;
      return $sql;
   }
   function notificacion(){
      if($this->USER_PERMISO!=1){
         $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";
         $sql=pg_query("SELECT (h.plazo - DATE_PART('day', '{$FECHA_ACTUAL}' - h.fecha)) as total FROM hojas as h
            JOIN hoja_destino as hd ON hd.hoja_id=h.id
            WHERE hd.destino_id=".$this->USER_DESTINO." AND hd.usuario_id IS NULL");
         $total = 0;
         while ($rows =  pg_fetch_assoc($sql)) {
            if ($rows['total']>=0) {
               $total++;
            }
         }
         return $total;
      }else{
         return 0;
      }
   }
   function recepcionar($id){
      $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";
      $sql=pg_fetch_assoc(pg_query("SELECT (plazo-DATE_PART('day','{$FECHA_ACTUAL}' - fecha)) as diferencia FROM hojas WHERE id='{$id}'"));
      if(intval($sql['diferencia'])>=0){
         $fecha=date('Y-m-d h:i:s');$usuario=$this->USER_ID;$destino=$this->USER_DESTINO;
         $sql=pg_query("UPDATE hoja_destino SET estado='revisado',fecha='{$fecha}',
         usuario_id={$usuario} WHERE hoja_id={$id} AND destino_id={$destino} AND usuario_id IS NULL");
         $PGSTAT = pg_result_status($sql);
         if($PGSTAT == 1){
            return "ok";
         }else{
            return false;
         }
      }else{
         return false;
      }

   }
   function imprimir_hojas($id){
        //SELECT * FROM hojas WHERE CAST(remitente_id AS CHAR) LIKE '%%'
        $sql=pg_query("SELECT h.*,CONCAT(r.nombres, ' ',r.apellidos) as  remitente,CONCAT(u.nombres, ' ',u.apellidos) as  usuario, a.nombre as adjunto, t.nombre as tipo
            FROM hojas as h
            JOIN remitentes as r ON r.id = h.remitente_id
            JOIN usuarios as u ON u.id = h.usuario_id
            JOIN adjuntos as a ON a.id = h.adjunto_id
            JOIN tipos as t ON t.id = h.tipo_id");
            $destinos = array();
            while ($rows =  pg_fetch_assoc($sql2)) {$destinos[] = $rows;}
        $sql2=pg_query("SELECT hd.*,CONCAT(u.nombres, ' ',u.apellidos) as usuario, d.nombre as nombre
            FROM hoja_destino as hd
            LEFT JOIN usuarios as u ON u.id = hd.usuario_id
            JOIN destinos as d ON d.id = hd.destino_id
            WHERE hd.hoja_id={$id}".$this->USER_CONSULTA."");
        $destinos = array();
        while ($rows =  pg_fetch_assoc($sql2)) {$destinos[] = $rows;}

        $sql3=pg_query("SELECT a.*, (SELECT COUNT(*) FROM hoja_accion as ha WHERE ha.accion_id= a.id AND ha.id_hoja='{$id}') AS estado FROM acciones as a");
        $acciones = array();
        while ($rows =  pg_fetch_assoc($sql3)) {$acciones[] = $rows;}

         $sql["destino"]=$destinos;$sql["accion"]=$acciones;$sql["permiso"]=$this->USER_CONSULTA;
        return $sql;
    }
   function get_destino($id){
      $sql2=pg_query("SELECT hd.*,CONCAT(u.nombres, ' ',u.apellidos) as usuario, d.nombre as nombre
         FROM hoja_destino as hd
         LEFT JOIN usuarios as u ON u.id = hd.usuario_id JOIN destinos as d ON d.id = hd.destino_id
         WHERE hd.hoja_id={$id} {$this->USER_CONSULTA}");
      $destinos = array();while ($rows =  pg_fetch_assoc($sql2)) {$destinos[] = $rows;}
      return $destinos;
   }
   function get_accion($id){
      $sql3=pg_query("SELECT a.*, (SELECT COUNT(*) FROM hoja_accion as ha WHERE ha.accion_id= a.id AND ha.id_hoja='{$id}') AS estado FROM acciones as a");
      $acciones = array();while ($rows =  pg_fetch_assoc($sql3)) {$acciones[] = $rows;}
      return $acciones;
   }
}
