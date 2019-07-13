<!DOCTYPE html>
<?php ob_start();$resp=$result;$destinos=$result['destino'];$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Hoja de Ruta <?php echo $resp['id']?></title>
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
		<script type="text/php">
			if ( isset($pdf) ) {
				$font = Font_Metrics::get_font("helvetica");
				$pdf->page_text(300, 760, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0,0,0));
				$date=date('d-m-Y');
				$pdf->page_text(530, 760, "Fecha: {$date}", $font, 6, array(0,0,0));
			}
		</script>
		<table id="header" width="100%" border="1" style="margin:0">
			<tr>
				<th width="20%"><img src="../pages/images/logo_fundacion.png" height="47px"></th>
				<th width="60%"><h1 align="center" style="margin:0px;font-family:Arial, Helvetica, sans-serif;font-weight:800;color:#535353">CASA NACIONAL <br>DE LA MONEDA</h1></th>
				<th width="20%"><img src="../pages/images/logo.png" height="47px" ></th>
			</tr>
		</table>
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
					<td>CARGO REMITENTE</td>
					<td colspan="3"><?php echo $resp['cargo_remitente']?></td>
					<th style="background:#ececec">FECHA CITE</th>
				</tr>
				<tr>
					<td>ADJUNTOS</td>
					<td colspan="3"><?php echo $resp['adjunto'] ?></td>
					<td style="text-align:center"> <?php echo "$resp[fecha_cite]"; ?></td>
				</tr>
				<tr>
					<td >N° DE HOJAS</td>
					<td colspan="3"><?php echo $resp['num_hojas'] ?></td>
					<th style="background:#ececec">FECHA REGISTRO</th>
				</tr>
				<tr>
					<td >TIPO DE DOCUMENTOS</td>
					<td colspan="3"><?php echo $resp['tipo'] ?></td>
					<td style="text-align:center"> <?php echo "$resp[fecha]";?></td>
				</tr>
				<tr>
					<td >REFERENCIA</td>
					<td colspan="4"><?php echo $resp['referencia'] ?></td>
				</tr>
				<tr>
					<td rowspan="2">AREA DE DESTINO</td>
					<td rowspan="2"><?php $aux=0;while ($aux<count($destinos)){echo $aux==count($destinos)-1 ? strtolower($destinos[$aux]['nombre']):strtolower($destinos[$aux]['nombre'])." - ";$aux++;}?></td>
					<td>NOMBRE</td>
					<td colspan="2"><?=strtolower($destinos[0]['usuario'])?></td>
				</tr>
				<tr>
					<td >CARGO</td>
					<td  colspan="2"><?=strtolower($destinos[0]['cargo'])?></td>
				</tr>
				<tr>
					<td >GESTOR VC</td>
					<td  colspan="4"><?php echo $resp['usuario'] ?></td>
				</tr>
			</table>
		<?php for ($i=0; $i < count($destinos); $i++): $row_accion=$result['accion'];
		$proveidos=$destinos[$i]['proveido']==null ? $resp['proveido']:$destinos[$i]['proveido']==""?$resp['proveido']:$destinos[$i]['proveido'];?>
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
					<td colspan="2" rowspan="<?=count($row_accion)?>" width="33%" style="vertical-align:text-top"><h3 style="text-align:center;font-weight:800;color:#535353;margin-top:0">PROVEIDO<small style="color:#313131;font-weight:300"><br><?=$proveidos?></small></h3></td>
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
				<table border="1" width="145px" style="position:absolute;right:0;margin-top:-79px;" >
					<tr>
						<td colspan="2" align="center" style="border:1px solid white">......................................................<br>Firma y sello</td>
					</tr>
					<tr>
						<td>Fecha</td>
						<td>Hora</td>
					</tr>
					<tr>
						<td><?=$destinos[$i]['fecha']==null?"en espera":date('Y-m-d', strtotime($destinos[$i]['fecha']))?></td>
						<td><?=$destinos[$i]['fecha']==null?"en espera":date('h:i:s', strtotime($destinos[$i]['fecha']))?></td>
					</tr>
					<tr><td colspan="2" style="border:1px solid #fff;"></td></tr>
					<tr><td colspan="2" style="border:1px solid #fff;"></td></tr>
				</table>
			</table>
		<?php endfor;?>
 </body>
 </html>
