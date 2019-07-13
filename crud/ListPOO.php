<?php
class ListPOO{
   public $USER_ID=0;
   public $USER_DESTINO=0;
   public $USER_CARGO=0;
   public $ADMINISTRAR_HOJA=0;
   public $VER_HOJA=0;
   public $USER_CONSULTA="";
   function __construct(){
      $this->USER_ID=$_SESSION['id_usu'];
      $ejecute=pg_fetch_assoc(pg_query("SELECT * FROM usuarios WHERE id='{$this->USER_ID}'"));
      $this->USER_DESTINO=$ejecute['id_destino'];
      $this->USER_CARGO=$ejecute['id_cargo'];
      $ejecute=pg_query("SELECT * FROM funcion_cargo WHERE cargo_id='{$this->USER_CARGO}' AND funcion_id=13");
      $this->ADMINISTRAR_HOJA=pg_num_rows($ejecute);
      $ejecute2=pg_query("SELECT * FROM funcion_cargo WHERE cargo_id='{$this->USER_CARGO}' AND funcion_id=4");
      $this->VER_HOJA=pg_num_rows($ejecute2);
      $this->USER_CONSULTA=$this->ADMINISTRAR_HOJA==1 ? "" : " AND destino_id=".$this->USER_DESTINO;
   }
   function listHojaRuta(){
      if($this->ADMINISTRAR_HOJA==1){
         $revisado=true;$norevisado=true;$proceso=true;
         if (isset($_GET['seleccionado'])) {
            if ($_GET['seleccionado']=="revisado" || $_GET['seleccionado']=="proceso" || $_GET['seleccionado']=="norevisado") {
               $id=$_GET['id']==""? "%%" : intval($_GET['id']);
            }else{$id="%%";}
            $seleccionado=$_GET['seleccionado'];
            $procedencia=$_GET['seleccionado']=="procedencia" ? intval($_GET['procedencia']) : "%%";
            $proveido=$_GET['seleccionado']=="proveido" ? "AND hd.destino_id=".intval($_GET['proveido']) : "";
            $tipo=$_GET['seleccionado']=="tipo" ? intval($_GET['tipo']) : "%%";
            $adjunto=$_GET['seleccionado']=="adjunto" ? intval($_GET['adjunto']):"%%";
            $cite=$_GET['seleccionado']=="cite" ? $_GET['cite']="" ? "":strtoupper($_GET['cite']):"";
            $remitente=$_GET['seleccionado']=="remitente" ? $_GET['remitente']=="" ? "" :strtoupper($_GET['remitente']):"";
         }else{
            $seleccionado="cite";$id="%%";$procedencia="%%";$proveido="";$tipo="%%";$adjunto="%%";$cite="";$remitente="";
         }

         $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";
         $cadena="";if(isset($_GET['inicio']) && (isset($_GET['fin']))){if(($_GET['inicio']!="") && ($_GET['fin']!="")){$cadena="AND h.fecha_cite BETWEEN '".$_GET['inicio']."' AND '".$_GET['fin']."'";}}
         $sql=pg_query("SELECT h.*,p.nombre as  procedencia, a.nombre as adjunto, t.nombre as tipo,(h.plazo-(CAST(MAX('{$FECHA_ACTUAL}') AS date) - CAST(MIN(h.fecha) AS date)))as diferencia,
         CONCAT(u.nombres, ' ',u.apellidos) as  usuario
         FROM hojas as h
         JOIN procedencia as p ON p.id = h.procedencia_id
         LEFT JOIN hoja_destino as hd ON hd.hoja_id = h.id
         JOIN adjuntos as a ON a.id = h.adjunto_id
         JOIN tipos as t ON t.id = h.tipo_id
         JOIN usuarios as u ON u.id = h.usuario_id
         WHERE CAST(h.id AS TEXT) LIKE '{$id}' AND CAST(h.procedencia_id AS TEXT) LIKE '{$procedencia}' AND
         CAST(h.tipo_id AS TEXT) LIKE '{$tipo}' AND CAST(h.adjunto_id AS TEXT) LIKE '{$adjunto}' AND
         CAST(UPPER(h.cite) AS TEXT) LIKE '%{$cite}%' AND CAST(UPPER(h.remitente) AS TEXT) LIKE '%{$remitente}%'  {$cadena} {$proveido} GROUP BY h.id,p.nombre,a.nombre,t.nombre,u.nombres,u.apellidos ORDER BY h.id ASC");
         $all = array();while ($rows =  pg_fetch_assoc($sql)) {$all[] = $rows;}
         $hojastotal = array();
         $hojastotal=$this->get_hoja($all,"");
         return ["hoja"=>$hojastotal,"inicio"=>isset($_GET['inicio'])?$_GET['inicio']:"","fin"=>isset($_GET['fin'])?$_GET['fin']:"",
            "id"=>$_GET['id'] ?? "","procedencia"=>$_GET['procedencia']??"","tipo"=>$_GET['tipo']??"","adjunto"=>$_GET['adjunto']??"",
            "remitente"=>$_GET['remitente']??"","proveido"=>$_GET['proveido']??"","cite"=>$cite,"seleccionado"=>$seleccionado];
      }else{
         return ["hoja"=>[]];
      }
   }
   function listmiHojaRuta(){
      if($this->VER_HOJA==1){
         if (isset($_GET['seleccionado'])) {
            if ($_GET['seleccionado']=="revisado" || $_GET['seleccionado']=="proceso" || $_GET['seleccionado']=="norevisado") {
               $id=isset($_GET['id']) ? $_GET['id']=="" ? "%%" : intval($_GET['id']):"%%";
            }else{$id="%%";}
            $seleccionado=$_GET['seleccionado'];
            $procedencia=$_GET['seleccionado']=="procedencia" ? intval($_GET['procedencia']) : "%%";
            $tipo=$_GET['seleccionado']=="tipo" ? intval($_GET['tipo']) : "%%";
            $adjunto=$_GET['seleccionado']=="adjunto" ? intval($_GET['adjunto']):"%%";
            $cite=$_GET['seleccionado']=="cite" ? $_GET['cite']="" ? "":strtoupper($_GET['cite']):"";
            $remitente=$_GET['seleccionado']=="remitente" ? $_GET['remitente']=="" ? "" :strtoupper($_GET['remitente']):"";
         }else{$seleccionado="cite";$id="%%";$procedencia="%%";$tipo="%%";$adjunto="%%";$cite="";$remitente="";}

         $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";
         $cadena="";if(isset($_GET['inicio']) && (isset($_GET['fin']))){if(($_GET['inicio']!="") && ($_GET['fin']!="")){$cadena="AND h.fecha_cite BETWEEN '".$_GET['inicio']."' AND '".$_GET['fin']."'";}}

         $sql=pg_query("SELECT h.*,p.nombre as  procedencia, a.nombre as adjunto, t.nombre as tipo,(h.plazo-(CAST(MAX('{$FECHA_ACTUAL}') AS date) - CAST(MIN(h.fecha) AS date)))as diferencia,
         CONCAT(u.nombres, ' ',u.apellidos) as  usuario
         FROM hoja_destino as hd
         JOIN hojas as h ON hd.hoja_id = h.id
         JOIN procedencia as p ON p.id = h.procedencia_id
         JOIN adjuntos as a ON a.id = h.adjunto_id
         JOIN tipos as t ON t.id = h.tipo_id
         JOIN usuarios as u ON u.id = h.usuario_id
         WHERE hd.destino_id={$this->USER_DESTINO} AND CAST(h.id AS TEXT) LIKE '{$id}' AND CAST(h.procedencia_id AS TEXT) LIKE '{$procedencia}' AND
         CAST(h.tipo_id AS TEXT) LIKE '{$tipo}' AND CAST(h.adjunto_id AS TEXT) LIKE '{$adjunto}' AND
         CAST(UPPER(h.cite) AS TEXT) LIKE '%{$cite}%'AND CAST(UPPER(h.remitente) AS TEXT) LIKE '%{$remitente}%' {$cadena} AND hd.estado<>'espera'
         GROUP BY h.id,p.nombre,a.nombre,t.nombre,u.nombres,u.apellidos ORDER BY h.id ASC");

         $all = array();while ($rows =  pg_fetch_assoc($sql)) {$all[] = $rows;}
         $hojastotal = array();
         $hojastotal=$this->get_hoja($all,"AND destino_id=".$this->USER_DESTINO." AND estado_pendiente IS NULL");
         return ["hoja"=>$hojastotal,"inicio"=>isset($_GET['inicio'])?$_GET['inicio']:"","fin"=>isset($_GET['fin'])?$_GET['fin']:"",
            "id"=>$_GET['id'] ?? "","procedencia"=>$_GET['procedencia']??"","tipo"=>$_GET['tipo']??"","adjunto"=>$_GET['adjunto']??"",
            "remitente"=>$_GET['remitente']??"","cite"=>$cite,"seleccionado"=>$seleccionado,"proveido"=>$_GET['proveido']??""];
      }else {
         return ["hoja"=>[]];
      }
   }
   //(h.plazo-DATE_PART('day','{$FECHA_ACTUAL}' - h.fecha)) as diferencia  postgresql 10 funcionando diferencia
   function verhoja($id){
      if($this->VER_HOJA==1 || $this->ADMINISTRAR_HOJA==1){
         $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";
         $sql=pg_fetch_assoc(pg_query("SELECT h.*,p.nombre as  procedencia,CONCAT(u.nombres, ' ',u.apellidos) as  usuario,u.cedula,a.nombre as adjunto,
         t.nombre as tipo,CONCAT(us.nombres, ' ',us.apellidos) as modificado,(h.plazo-(CAST(MAX('{$FECHA_ACTUAL}') AS date) - CAST(MIN(h.fecha) AS date)))as diferencia
            FROM hojas as h
            JOIN procedencia as p ON p.id = h.procedencia_id JOIN usuarios as u ON u.id = h.usuario_id JOIN adjuntos as a ON a.id = h.adjunto_id JOIN tipos as t ON t.id = h.tipo_id
            LEFT JOIN usuarios as us ON us.id = h.update_user
            WHERE h.id='{$id}' GROUP BY h.id,p.nombre,u.nombres,u.apellidos,u.cedula,a.nombre,t.nombre,us.nombres,us.apellidos"));
         $acciones = array();$destinos = array();
         $destinos=$this->get_destino($id);$acciones=$this->get_accion($id);
         $sql["destino"]=$destinos;$sql["accion"]=$acciones;$sql["permiso"]=$this->USER_CONSULTA;$sql["midestino"]=$this->USER_DESTINO;
         return $sql;
      }else{
         return [];
      }
   }
   function notificacion(){
      $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";
      $sql=pg_query("SELECT (h.plazo - DATE_PART('day', '{$FECHA_ACTUAL}' - h.fecha)) as total FROM hojas as h
         JOIN hoja_destino as hd ON hd.hoja_id=h.id
         WHERE hd.destino_id=".$this->USER_DESTINO." AND ((hd.estado='en proceso' AND hd.respuesta IS NOT NULL) OR hd.estado_pendiente IS NOT NULL OR (hd.estado='en proceso' AND hd.usuario_id IS NULL))");
      $total = 0;
      while ($rows =  pg_fetch_assoc($sql)) {
         if ($rows['total']>=0) {
            $total++;
         }
      }
      $mensaje=pg_fetch_assoc(pg_query("SELECT count(*) as total FROM peticion WHERE respuesta_id_destino={$this->USER_DESTINO} AND respuesta_id_usuario IS NULL"));
      return ["notificacion"=>$total,"mensaje"=>$mensaje['total']];
   }
   function recepcionar($id,$observacion,$archivo){
      $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";
      $sql=pg_fetch_assoc(pg_query("SELECT (plazo-(CAST(MAX('{$FECHA_ACTUAL}') AS date) - CAST(MIN(fecha) AS date)))as diferencia FROM hojas WHERE id='{$id}' GROUP BY plazo"));
      if(intval($sql['diferencia'])>=0){
         $fecha=date('Y-m-d h:i:s');$usuario=$this->USER_ID;$destino=$this->USER_DESTINO;
         if($archivo['error'] == 0) {
            $exploded = explode('.',$_FILES['archivo']['name']);
            $ext = $exploded[count($exploded) - 1]; 
            $name="FILE".date("Ymdhis").".".$ext;
            $sql=pg_query("UPDATE hoja_destino SET archivo='{$name}' WHERE hoja_id={$id} AND destino_id={$destino} AND usuario_id IS NULL");
            $PGSTAT = pg_result_status($sql);
            if($PGSTAT == 1){
                $ruta="../dist/respuestas/".$name;
                move_uploaded_file($archivo['tmp_name'], $ruta);
            }
         }
         $sql_primero=pg_fetch_assoc(pg_query("SELECT destino_id FROM hoja_destino WHERE hoja_id={$id} ORDER BY id asc LIMIT 1"));
         if ($sql_primero['destino_id']==$destino){
            $sql=pg_query("UPDATE hoja_destino SET estado='revisado',fecha='{$fecha}',usuario_id={$usuario},observacion='{$observacion}' WHERE hoja_id={$id} AND destino_id={$destino} AND usuario_id IS NULL");
            $PGSTAT = pg_result_status($sql);
            if($PGSTAT == 1){
               $sql=pg_query("UPDATE hoja_destino SET estado='en proceso' WHERE id IN (SELECT id FROM hoja_destino WHERE hoja_id={$id} AND estado='espera' ORDER BY id ASC LIMIT  1)");
               return "ok";
            }else{
               return false;
            }
         }else{
            $sql=pg_query("UPDATE hoja_destino SET fecha='{$fecha}',usuario_id={$usuario},observacion='{$observacion}' WHERE hoja_id={$id} AND destino_id={$destino} AND usuario_id IS NULL");
            $PGSTAT = pg_result_status($sql);
            if($PGSTAT == 1){
               $sql=pg_query("UPDATE hoja_destino SET estado_pendiente=1 WHERE id IN (SELECT id FROM hoja_destino WHERE hoja_id={$id} AND estado='revisado' ORDER BY id DESC LIMIT  1)");
               return "ok";
            }else{
               return false;
            }
         }
      }else{
         return false;
      }
   }
   function modificar_recepcionar($id,$observacion,$archivo){
      $FECHA_ACTUAL=date('Y-m-d')." 23:59:59";
      $sql=pg_fetch_assoc(pg_query("SELECT (plazo-(CAST(MAX('{$FECHA_ACTUAL}') AS date) - CAST(MIN(fecha) AS date)))as diferencia FROM hojas WHERE id='{$id}' GROUP BY plazo"));
      if(intval($sql['diferencia'])>=0){
         $fecha=date('Y-m-d h:i:s');$usuario=$this->USER_ID;$destino=$this->USER_DESTINO;
         if($archivo['error'] == 0) {
            $exploded = explode('.',$_FILES['archivo']['name']);
            $ext = $exploded[count($exploded) - 1]; 
            $name="FILE".date("Ymdhis").".".$ext;
            $sql=pg_query("UPDATE hoja_destino SET archivo='{$name}' WHERE hoja_id={$id} AND destino_id={$destino}");
            $PGSTAT = pg_result_status($sql);
            if($PGSTAT == 1){
                $ruta="../dist/respuestas/".$name;
                move_uploaded_file($archivo['tmp_name'], $ruta);
            }
         }
         $sql=pg_query("UPDATE hoja_destino SET usuario_id={$usuario},observacion='{$observacion}',respuesta=null WHERE hoja_id={$id} AND destino_id={$destino}");
         $PGSTAT = pg_result_status($sql);
         if($PGSTAT == 1){
            $sql=pg_query("UPDATE hoja_destino SET estado_pendiente=1 WHERE id IN (SELECT id FROM hoja_destino WHERE hoja_id={$id} AND estado='revisado' ORDER BY id DESC LIMIT  1)");
            return "ok";
         }else{
            return false;
         }
      }else{
         return false;
      }
   }
   function revisar_hoja($id){
      $fecha=date('Y-m-d h:i:s');
      $sacarhoja_id=pg_fetch_assoc(pg_query("SELECT hoja_id FROM hoja_destino WHERE id={$id} LIMIT 1"));
      $hoja_id=$sacarhoja_id['hoja_id'];
      if (isset($_POST['observacion'])){
         $observacion=$_POST['observacion'];
         $sql=pg_query("UPDATE hoja_destino SET respuesta='{$observacion}' WHERE id={$id}");
         $PGSTAT = pg_result_status($sql);
         if($PGSTAT == 1){
            $sql=pg_query("UPDATE hoja_destino SET estado_pendiente=null WHERE id IN (SELECT id FROM hoja_destino WHERE hoja_id={$hoja_id} AND estado='revisado' ORDER BY id DESC LIMIT 1)");
            return "ok";
         }else{
            return false;
         }
      }else{
         $sql=pg_query("UPDATE hoja_destino SET estado_pendiente=null WHERE id IN (SELECT id FROM hoja_destino WHERE hoja_id={$hoja_id} AND estado='revisado' ORDER BY id DESC LIMIT 1)");
         $PGSTAT = pg_result_status($sql);
         if($PGSTAT == 1){
            $sql=pg_query("UPDATE hoja_destino SET estado='revisado',fecha='{$fecha}' WHERE id={$id}");
            $PGSTAT = pg_result_status($sql);
            if($PGSTAT == 1){
               $sql=pg_query("UPDATE hoja_destino SET estado='en proceso' WHERE id IN (SELECT id FROM hoja_destino WHERE hoja_id={$hoja_id} AND estado='espera' ORDER BY id ASC LIMIT  1)");
               return "ok";
            }else{
               return false;
            }
         }else{
            return false;
         }
      }
   }
   function imprimir_hojas($id){
        //SELECT * FROM hojas WHERE CAST(remitente_id AS CHAR) LIKE '%%'
        $sql=pg_query("SELECT h.*,p.nombre as  procedencia,CONCAT(u.nombres, ' ',u.apellidos) as  usuario, a.nombre as adjunto, t.nombre as tipo
            FROM hojas as h
            JOIN procedencia as p ON p.id = h.procedencia_id
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
      $sql2=pg_query("SELECT hd.*,CONCAT(u.nombres, ' ',u.apellidos) as usuario,c.nombre as cargo,d.nombre as nombre
         FROM hoja_destino as hd
         LEFT JOIN usuarios as u ON u.id = hd.usuario_id
         LEFT JOIN cargos as c ON c.id = u.id_cargo JOIN destinos as d ON d.id = hd.destino_id
         WHERE hd.hoja_id={$id} ORDER BY hd.id ASC ");
      $destinos = array();while ($rows =  pg_fetch_assoc($sql2)) {$destinos[] = $rows;}
      return $destinos;
   }
   function get_accion($id){
      $sql3=pg_query("SELECT a.*, (SELECT COUNT(*) FROM hoja_accion as ha WHERE ha.accion_id= a.id AND ha.id_hoja='{$id}') AS estado FROM acciones as a");
      $acciones = array();while ($rows =  pg_fetch_assoc($sql3)) {$acciones[] = $rows;}
      return $acciones;
   }
   function get_hoja($all,$query){
      $revisado=true;$norevisado=true;$proceso=true;
      if (isset($_GET['seleccionado'])) {
         if ($_GET['seleccionado']=="revisado" || $_GET['seleccionado']=="proceso" || $_GET['seleccionado']=="norevisado") {
            if($_GET['seleccionado']=="revisado"){
               $revisado=true;$norevisado=false;$proceso=false;
            }if($_GET['seleccionado']=="norevisado"){
               $revisado=false;$norevisado=true;$proceso=false;
            }if($_GET['seleccionado']=="proceso"){
               $revisado=false;$norevisado=false;$proceso=true;
            }
         }
      }
      $hojastotal = array();
      $count=0;
      while ($count < count($all)) {
         $RESTANTE=0;
         if (intval($all[$count]["diferencia"]) >= 0) {$RESTANTE=1;}
         $rowactividad=$all[$count]["id"];
         $row=pg_fetch_assoc(pg_query("SELECT COUNT(*) as total FROM hoja_destino WHERE hoja_id='{$rowactividad}' {$query}"));
         $row1=pg_fetch_assoc(pg_query("SELECT COUNT(*) as faltantes from hoja_destino where hoja_id='{$rowactividad}' {$query} AND estado<>'revisado'"));
         //echo " plazo_activo-> ".$RESTANTE." total->".$row['total']." faltante->".$row1['faltantes']." access->".$revisado."<br>";
         if ($RESTANTE==1 && $proceso && $row['total']>=$row1['faltantes'] && (($row['total']>0 && $row1['faltantes']!=0) || ($row['total']==0 && $row1['faltantes']==0))) {
            $all[$count]['color']="bgcolor='#e2f971'";$all[$count]['mensaje']="Nuevo";
            $all[$count]['total']=$row['total'];$all[$count]['faltantes']=$row1['faltantes'];$all[$count]['estado_plazo']=$RESTANTE;
            $acciones = array();$destinos = array();
            $destinos=$this->get_destino($rowactividad);$acciones=$this->get_accion($rowactividad);
            $all[$count]['destinos']=$destinos;$all[$count]['acciones']=$acciones;array_push($hojastotal,$all[$count]);
         }else{
            if ($row['total']>0 && $row1['faltantes']==0 && $revisado) {
               $all[$count]['color']="bgcolor='#67FF99'";$all[$count]['mensaje']="Atendido";
               $all[$count]['total']=$row['total'];$all[$count]['faltantes']=$row1['faltantes'];$all[$count]['estado_plazo']=$RESTANTE;
               $acciones = array();$destinos = array();
               $destinos=$this->get_destino($rowactividad);$acciones=$this->get_accion($rowactividad);
               $all[$count]['destinos']=$destinos;$all[$count]['acciones']=$acciones;array_push($hojastotal,$all[$count]);
            }else{
               if ($RESTANTE==0 && $norevisado && (($row['total']>0 && $row1['faltantes']>0) || ($row['total']==0 && $row1['faltantes']==0))) {
                  $all[$count]['color']="bgcolor='#f59a9a'";$all[$count]['mensaje']="No Atendido";
                  $all[$count]['total']=$row['total'];$all[$count]['faltantes']=$row1['faltantes'];$all[$count]['estado_plazo']=$RESTANTE;
                  $acciones = array();$destinos = array();
                  $destinos=$this->get_destino($rowactividad);$acciones=$this->get_accion($rowactividad);
                  $all[$count]['destinos']=$destinos;$all[$count]['acciones']=$acciones;array_push($hojastotal,$all[$count]);
               }
            }
         }
         $count=$count+1;
      }
      return $hojastotal;
   }
   function backoffice(){
      $usuarios=pg_fetch_assoc(pg_query("SELECT count(*) as total FROM usuarios"));
      $cargos=pg_fetch_assoc(pg_query("SELECT count(*) as total FROM cargos"));
      $destinos=pg_fetch_assoc(pg_query("SELECT count(*) as total FROM destinos"));
      $procedencias=pg_fetch_assoc(pg_query("SELECT count(*) as total FROM procedencia"));
      $tipos=pg_fetch_assoc(pg_query("SELECT count(*) as total FROM tipos"));
      $adjuntos=pg_fetch_assoc(pg_query("SELECT count(*) as total FROM adjuntos"));
      $acciones=pg_fetch_assoc(pg_query("SELECT count(*) as total FROM acciones"));
      $hojas=pg_fetch_assoc(pg_query("SELECT count(*) as total FROM hojas"));
      $mishojas=pg_fetch_assoc(pg_query("SELECT count(h.*) as total FROM hoja_destino as hd
      JOIN hojas as h ON hd.hoja_id = h.id WHERE hd.destino_id={$this->USER_DESTINO}"));
      $miperfil=pg_fetch_assoc(pg_query("SELECT u.*,c.nombre as cargo,d.nombre as destino FROM usuarios as u 
      JOIN cargos as c ON c.id = u.id_cargo JOIN destinos as d ON d.id = u.id_destino WHERE u.id={$this->USER_ID}"));
      return ["usuarios"=>$usuarios,"cargos"=>$cargos,"destinos"=>$destinos,"procedencias"=>$procedencias,"tipos"=>$tipos,"adjuntos"=>$adjuntos,"acciones"=>$acciones,"hojas"=>$hojas,"mishojas"=>$mishojas,"miperfil"=>$miperfil];
      
   }
   function vermiperfil(){
      $ejecute=pg_fetch_assoc(pg_query("SELECT u.*,c.nombre as cargos,d.nombre as destinos FROM usuarios as u JOIN cargos as c ON c.id = u.id_cargo JOIN destinos as d ON d.id = u.id_destino WHERE u.id={$this->USER_ID}"));
      return $ejecute;
   }
   function listaUsuarios(){
      $sql=pg_query("SELECT u.*,c.nombre as cargo,d.nombre as destino FROM usuarios as u JOIN cargos as c ON c.id = u.id_cargo JOIN destinos as d ON d.id = u.id_destino");
      return $sql;
   }
   function listPeticion(){
      $sql=pg_query("SELECT p.*,d.nombre as destino,rd.nombre as respuesta_destino,
      CONCAT(u.nombres, ' ',u.apellidos) as  usuario_enviado,CONCAT(ru.nombres, ' ',ru.apellidos) as  usuario_recibido
      FROM peticion as p
      JOIN destinos as d ON d.id = p.id_destino
      JOIN destinos as rd ON rd.id = p.respuesta_id_destino
      JOIN usuarios as u ON u.id = p.id_usuario
      LEFT JOIN usuarios as ru ON ru.id = p.respuesta_id_usuario
      WHERE p.id_destino={$this->USER_DESTINO} ORDER BY p.id ASC");

      $sql2=pg_query("SELECT p.*,d.nombre as destino,rd.nombre as respuesta_destino,
      CONCAT(u.nombres, ' ',u.apellidos) as  usuario_enviado,CONCAT(ru.nombres, ' ',ru.apellidos) as  usuario_recibido
      FROM peticion as p
      JOIN destinos as d ON d.id = p.id_destino
      JOIN destinos as rd ON rd.id = p.respuesta_id_destino
      JOIN usuarios as u ON u.id = p.id_usuario
      LEFT JOIN usuarios as ru ON ru.id = p.respuesta_id_usuario
      WHERE p.respuesta_id_destino={$this->USER_DESTINO} ORDER BY p.id ASC");
      // $all = array();while ($rows =  pg_fetch_assoc($sql)) {$all[] = $rows;}
      // $hojastotal = array();
      // $hojastotal=$this->get_hoja($all,"");
      return ["enviado"=>$sql,"recibido"=>$sql2];
   }
   function eliminarhoja($id){
      if($this->ADMINISTRAR_HOJA==1){
         $ejecute=pg_query("DELETE FROM hoja_accion WHERE id_hoja={$id}");
         $ejecute1=pg_query("DELETE FROM hoja_destino WHERE hoja_id={$id}");
         $ejecute2=pg_query("DELETE FROM hojas WHERE id={$id}");
         $PGSTAT = pg_result_status($ejecute2);
         if($PGSTAT == 1){
            return "ok";
         }else{
            return "false";
         }
      }else{
         return "false";
      }
      
   }
}
