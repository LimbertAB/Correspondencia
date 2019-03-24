<!DOCTYPE html>
<?php ob_start();$resp=$result['hoja'];$destinos=$result['destinos'];$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];?>
<!DOCTYPE html>
 <html>
 <head>
 	<title>Hoja de Ruta <?php echo $resp['id']?></title>
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
	  <th  rowspan="4" width="20%">
	  </th>
	  <th  width="60%" colspan="3" rowspan="4"><h4 align="center">HOJA DE RUTA</h4></th>
	  <th width="20%" style="background:#ececec">N° DE REGISTRO</th>
	</tr>
	<tr>
	  <td style="text-align:center"><?php echo $resp['id']?></td>
	</tr>
    <tr>
	  <th style="background:#ececec">TRAMITE</th>
	</tr>
    <tr>
	  <td style="text-align:center"><?php echo $resp['tramite'] ?></td>
	</tr>
	<tr>
	  <td >PROCEDENCIA</td>
	  <td colspan="3"><?php echo $resp['procedencia'] ?></td>
      <th style="background:#ececec">CITE</th>
	</tr>
	<tr>
	  <td >REMITENTE</td>
	  <td colspan="3"><?php echo "$resp[remitente]"; ?></td>
	  <td style="text-align:center"><?php echo "$resp[cite]"; ?></td>
	</tr>
	<tr>
	  <td >PLAZO DE RESPUESTA</td>
	  <td colspan="3"><?php echo $resp['plazo']." Dias"?></td>
      <th style="background:#ececec">FECHA Y HORA</th>
	</tr>
	<tr>
	  <td >ADJUNTOS</td>
	  <td colspan="3"><?php echo $resp['adjunto'] ?></td>
	  <td style="text-align:center"> <?php echo "$resp[fecha]"; ?></td>
	</tr>
	<tr>
	  <td >N° DE HOJAS</td>
	  <td colspan="3"><?php echo $resp['num_hojas'] ?></td>
	  <th style="background:#ececec">PRIORIDAD</th>
	</tr>
	<tr>
	  <td >TIPO DE DOCUMENTOS</td>
	  <td colspan="3"><?php echo $resp['tipo'] ?></td>
	  <td style="text-align:center"> <?php echo "$resp[prioridad]"; ?></td>
	</tr>
	<tr>
	  <td >REFERENCIA</td>
	  <td colspan="4"><?php echo $resp['referencia'] ?></td>
	</tr>
	<tr>
	  <td  rowspan="2">AREA DE DESTINO</td>
	  <td width="40%" rowspan="2">
        <?php $aux=0;
	    while ($aux<count($destinos)) {
          echo $aux==count($destinos)-1?$destinos[$aux]['nombre']:$destinos[$aux]['nombre']." - ";
          $aux++;
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
	  <td  colspan="4"><?php echo $resp['usuario'] ?></td>
	</tr>
	</table>
<?php 

for ($i=0; $i < count($destinos); $i++): $row_accion=$destinos[$i]['acciones']; ?>
    <table width="100%" border="1">
        <tr>
            <td colspan="2">ACCION</td>
            <td >Destinatario</td>
            <td colspan="3"><?php echo "aqui con detinos" ?> / encargado por:</td>
        </tr>
        <tr>
            <?php $row_accion=$destinos[$i]['acciones']; ?>
            <td width="30%"><?php echo $row_accion[0]['nombre']?></td>
            <td width="2%"><?php echo $row_accion[0]['estado']==1 ? "x":"";?></td>
            <td width="15%">Plazo respuesta</td>
            <td width="20%"></td>
            <td colspan="2" width="33%" style="padding-right:30px" rowspan="<?php echo count($row_accion) ?>">
            <br><br><br><br><br><br><br><br>
    	    <br><br><br><br>
                <table border="1" width="10%" align="right">
                    <tr>
                        <td colspan="2" align="center" class="firma">...................................................................................<br>Firma y sello</td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td>Hora</td>
                    </tr>
                    <tr>
                        <td>en espera</td>
                        <td>en espera</td>
                    </tr>
                </table>
                <br><br><br>
            </td>
        </tr>
        <tr>
            <td><?php echo $row_accion[1]['nombre']?></td>
            <td><?php echo $row_accion[1]['estado']==1 ? "x":"";?></td>
            <td colspan="2" rowspan="<?php echo count($row_accion) ?>"></td>
        </tr>
        <?php
            for ($j=2; $j < count($row_accion); $j++):?>
                <tr>
                    <td><?php echo $row_accion[$j]['nombre']?></td>
                        <?php 
                            if($row_accion[$j]['estado']==1):
                                echo '<td>x</td>';
                            else:
                                echo '<td></td>';
                            endif;
                    endfor; ?>
                <tr>
            <td>Cordinar con:</td>
            <td colspan="3"></td>
            <td >Con copia a:</td>
            <td width="140px"></td>
        </tr>
    </table>
<?php endfor;?>

 </body>
 </html>