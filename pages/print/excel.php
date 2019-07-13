<?php 

header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8");
header("Content-Disposition: attachment;filename=reporte_excel.xls");
header("Cache-Control: max-age=0");
header("Expires: 0");

?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Hojas de Ruta</title>
		<style type="text/css">
			body{
				font-family: serif;
				font-size: 59%;
				padding-top: 55px
			}
			table, tr, td{
				border-collapse: collapse;
				padding-left: 10px;
			}
			#header,#header th { position: fixed; left: 0px; top: 0px; height: 50px; text-align: center; }
		</style>
 	</head>
	<body>
		<?php for ($x=0; $x < count($result['hoja']); $x++): $row_accion=$result['hoja'][$x]['acciones'];$destinos=$result['hoja'][$x]['destinos'];$resp=$result['hoja'][$x];?>
			<table class="table-hover" width="100%" border="1">
				<tr>
					<th  rowspan="4" width="20%">
					</th>
					<th  width="60%" colspan="3" rowspan="4"><h4 align="center">HOJA DE RUTA</h4></th>
					<th width="20%" colspan="2" style="background:#ececec">No DE REGISTRO</th>
				</tr>
				<tr>
					<td style="text-align:center" colspan="2"><?php echo $resp['id']?></td>
				</tr>
				<tr>
					<th style="background:#ececec" colspan="2">TRAMITE</th>
				</tr>
				<tr>
					<td style="text-align:center" colspan="2"><?php echo $resp['tramite'] ?></td>
				</tr>
				<tr>
					<td >PROCEDENCIA</td>
					<td colspan="3"><?php echo $resp['procedencia'] ?></td>
					<th style="background:#ececec" colspan="2">CITE</th>
				</tr>
				<tr>
					<td >REMITENTE</td>
					<td colspan="3"><?php echo "$resp[remitente]"; ?></td>
					<td style="text-align:center" colspan="2"><?php echo "$resp[cite]"; ?></td>
				</tr>
				<tr>
					<td>CARGO REMITENTE</td>
					<td colspan="3"><?php echo $resp['cargo_remitente']?></td>
					<th style="background:#ececec" colspan="2">FECHA CITE</th>
				</tr>
				<tr>
					<td>ADJUNTOS</td>
					<td colspan="3"><?php echo $resp['adjunto'] ?></td>
					<td style="text-align:center" colspan="2"> <?php echo "$resp[fecha_cite]"; ?></td>
				</tr>
				<tr>
					<td >N° DE HOJAS</td>
					<td colspan="3"><?php echo $resp['num_hojas'] ?></td>
					<th style="background:#ececec" colspan="2">FECHA REGISTRO</th>
				</tr>
				<tr>
					<td >TIPO DE DOCUMENTOS</td>
					<td colspan="3"><?php echo $resp['tipo'] ?></td>
					<td style="text-align:center" colspan="2"> <?php echo "$resp[fecha]";?></td>
				</tr>
				<tr>
					<td >REFERENCIA</td>
					<td colspan="5"><?php echo $resp['referencia'] ?></td>
				</tr>
				<tr>
					<td rowspan="2">AREA DE DESTINO</td>
					<td rowspan="2"><?php $aux=0;while ($aux<count($destinos)){echo $aux==count($destinos)-1 ? $destinos[$aux]['nombre']:$destinos[$aux]['nombre']." - ";$aux++;}?></td>
					<td>NOMBRE</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td >CARGO</td>
					<td  colspan="3"></td>
				</tr>
				<tr>
					<td >GESTOR VC</td>
					<td  colspan="5"><?php echo $resp['usuario'] ?></td>
				</tr>
			</table>
			<?php for ($i=0; $i < count($destinos); $i++): ?>
				<table width="100%" border="1" style="page-break-inside: avoid;">
	        		<tr style="background:#e8e8e8">
						<td colspan="2">ACCION</td>
						<td >Destinatario</td>
						<td colspan="3"><?php echo $destinos[$i]['nombre']?></td>
	        		</tr>
	        		<tr>
						<td width="30%"><?php echo $row_accion[0]['nombre']?></td>
						<td width="2%"><?php echo $row_accion[0]['estado']==1 ? "x":"";?></td>
						<td width="15%">Plazo respuesta</td>
						<td width="20%"><?php echo $resp['plazo']." Dias"?></td>
						<td colspan="2" rowspan="<?=count($row_accion)?>" width="33%" style="vertical-align:text-top"><h3 style="text-align:center;font-weight:800;color:#000;margin-top:0;font-size:1.2em">PROVEIDO<small style="color:#000;font-weight:300;font-size:.9em"><br><?=$resp['proveido']?></small></h3></td>
					</tr>
					<tr>
						<td><?php echo $row_accion[1]['nombre']?></td>
						<td><?php echo $row_accion[1]['estado']==1 ? "x":"";?></td>
						<td colspan="2" rowspan="<?=count($row_accion)-1?>"></td>
					</tr>
        			<?php for ($j=2; $j < count($row_accion); $j++):?>
						<tr>
							<td><?php echo $row_accion[$j]['nombre']?></td>
							<?php if($row_accion[$j]['estado']==1):
								echo '<td>x</td></tr>';
							else:
								echo '<td></td></tr>';
							endif;
					endfor;?>
					<tr>
						<td>Cordinar con:</td>
						<td colspan="3"></td>
						<td width="10%">Con copia a:</td>
						<td width="20%"></td>
					</tr>
				</table>
			<?php endfor;?>
		<?php endfor;?>
 </body>
 </html>
