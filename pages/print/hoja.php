<?php 

session_start();
include("../../db/conexion.php");
$enlace=conectar();
$ide=$_GET['ide'];
$sql="SELECT re.nombres as nom_remitente, re.apellidos as ape_remitente, ad.nombre as adjunto, ti.nombre as tipo, hd.id as ide, hd.estado, hd.observacion as obs,hd.fecha, de.nombre as destino, u.nombres as nom_usu, u.apellidos as ape_usu, ho.*
            FROM remitentes re, adjuntos ad, tipos ti, hoja_destino hd, destinos de, hojas ho, usuarios u
            WHERE re.id=ho.remitente_id AND ad.id=ho.adjunto_id AND ti.id=ho.tipo_id AND u.id=ho.usuario_id 
            AND hd.hoja_id=ho.id AND hd.destino_id=de.id AND ho.id=$ide order by ide asc";
$ejecute=pg_query($sql);
$ejecute2=pg_query($sql);
$ejecute3=pg_query($sql);
$resp=pg_fetch_array($ejecute);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<style type="text/css">
 		body{
 			font-family: serif;
 			font-size: 59%;
 		}
 		table, tr, td{
 			 border-collapse: collapse;
 			 padding-left: 10px;
 		}
 		.firma{
 			border-left: 1px #fff solid;
 			border-top: 1px #fff solid;
 			border-right: 1px #fff solid;
 		}
 	</style>
 </head>
 <body><br>
 <table class="table-hover" width="100%" border="1">
	<tr>
	  <th  rowspan="2" width="20%">
	  </th>
	  <th  colspan="3" rowspan="2"><h4 align="center">HOJA DE RUTA</h4></th>
	  <th width="20%">N° DE REGISTRO <br> <?php echo $resp['id'] ?></th>
	</tr>
	<tr>
	  <td >TRAMITE <br>12343</td>
	</tr>
	<tr>
	  <td >PROCEDENCIA</td>
	  <td colspan="3"><?php echo $resp['procedencia'] ?></td>
	  <td >CITE</td>
	</tr>
	<tr>
	  <td >REMITENTE</td>
	  <td colspan="3"><?php echo "$resp[nom_remitente]"." $resp[ape_remitente]"; ?></td>
	  <td ></td>
	</tr>
	<tr>
	  <td >CARGO REMITENTE</td>
	  <td colspan="3"></td>
	  <td >FECHA Y HORA</td>
	</tr>
	<tr>
	  <td >ADJUNTOS</td>
	  <td colspan="3"><?php echo $resp['adjunto'] ?></td>
	  <td ></td>
	</tr>
	<tr>
	  <td >N° DE HOJAS</td>
	  <td colspan="3"><?php echo $resp['num_hojas'] ?></td>
	  <td ></td>
	</tr>
	<tr>
	  <td >TIPO DE DOCUMENTOS</td>
	  <td colspan="3"><?php echo $resp['tipo'] ?></td>
	  <td ></td>
	</tr>
	<tr>
	  <td >REFERENCIA</td>
	  <td colspan="4"><?php echo $resp['referencia'] ?></td>
	</tr>
	<tr>
	  <td  rowspan="2">AREA DE DESTINO</td>
	  <td width="40%" rowspan="2">
	    <?php
	    while ($resp2=pg_fetch_array($ejecute2)) {
	      echo "$resp2[destino] - ";
	    }
	     ?>
	  </td>
	  <td width="10%">NOMBRE</td>
	  <td colspan="2"></td>
	</tr>
	<tr>
	  <td >CARGO</td>
	  <td colspan="2"></td>
	</tr>
	<tr>
	  <td >GESTOR VC</td>
	  <td  colspan="4"><?php echo "$resp[nom_usu]"." $resp[ape_usu]" ?></td>
	</tr>
	</table>
	<br><br>
<?php 
while ($resp3=pg_fetch_array($ejecute3)) {
	$sqls=pg_query("SELECT * FROM acciones");
	$cant=pg_num_rows($sqls);
	$cant2=$cant+1;
	$acciones=pg_fetch_array($sqls);
?>
	<table width="100%" border="1">
  <tr>
    <td colspan="2" width="15%">ACCION</td>
    <td width="5%">Destinatario</td>
    <td width="40%" colspan="3"><?php echo $resp3['destino'] ?> / encargado por:</td>
  </tr>
  <tr>
    <td></td>
    <td width="2%"></td>
    <td>Plazo respuesta</td>
    <td width="100px"></td>
    <td colspan="2" rowspan="<?php echo $cant2 ?>">
    	<br><br><br><br><br><br><br><br>
    	<br><br><br><br><br><br><br><br>
    		<table border="1" width="10%" align="right">
	    		<tr>
	    			<td colspan="2" align="center" class="firma">...................................................................................<br>Firma y sello</td>
	    		</tr>
	    		<tr>
	    			<td>Fecha</td>
	    			<td>Hora</td>
	    		</tr>
	    		<tr>
	    			<td><br></td>
	    			<td></td>
	    		</tr>
	    	</table>
    </td>
  </tr>
  <tr>
    <td><?php echo $acciones['nombre'];echo $cant; ?></td>
    <td></td>
    <td colspan="2" rowspan="<?php echo $cant ?>"></td>
  </tr>
  <?php
	while ($acciones=pg_fetch_array($sqls)) {
  ?>
	<tr>
	    <td><?php echo $acciones['nombre'] ?></td>
	    <td></td>
  </tr>
  <?php
		# code...
	}

   ?>
  
  
  <tr>
    <td>Cordinar con:</td>
    <td colspan="3"></td>
    <td >Con copia a:</td>
    <td width="140px"></td>
  </tr>
</table>
<br><br>
<?php 
}
 ?>
 <script>
function myFunction() {
    window.print();
    window.location="javascript:history.back(1)";
    window.close();
}
myFunction();
</script>
 </body>
 </html>