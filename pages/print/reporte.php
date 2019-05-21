<!DOCTYPE html>
<?php ob_start();$resultado=$result['hoja'];$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
//$mes=$months[intval($resultado['month']) - 1];
?>
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>Reporte de Hojas de Ruta</title>
          <style>
               html, body {
                    height: 100%;
                    font-family: Arial, Helvetica, sans-serif;
                    padding-top: 55px
               }
               table td{
                    border: 1px solid #8b8b8b;
               }
               table{
                    border: 1px solid #8b8b8b;
               }
               p {
                    font-family: Arial, Helvetica, sans-serif;
                    text-align: justify;
                    margin: 0;
                    padding: 0;
                    text-align: center;
               }
               h4 {
                    font-family: Arial, Helvetica, sans-serif;
                    font-weight: 600;
                    font-size: .9em;
                    margin: 2px 1px 2px 10px;
               }
               h6{
                    font-weight: 200;
                    font-size: .64em;
                    margin: 0px;
                    text-align: center;
               }
               td{
               line-height: 1em;
               padding: 0;
               margin: 0;
               text-align: center;
               }
               tr{
                    padding: 0;
                    margin: 0;
               }
               small{
                    font-weight: 200;
                    color: #757575;
                    font-size: .98em;
               }
               h5{
                    margin:3px;padding:0;
                    font-weight:200;font-size: .77em;
               }
               h3{
                    margin: 0;padding: 0;
               }

               span#procent {display: block;position: absolute;left: 50%;top: 104%;font-size: 50px;transform: translate(-50%, -50%);color: #545454;}
               span#procent::after {content: '%';}
               .canvas-wrap {position: relative;width: 300px;height: 300px;}
               #header,#header th { position: fixed; left: 0px; top: 0px; height: 50px; text-align: center; }
          </style>
     </head>
     <body >
          <script type="text/php">
			if ( isset($pdf) ) {
				$font = Font_Metrics::get_font("helvetica");
                    $pdf->page_text(380, 580, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0,0,0));
                    $date=date('d-m-Y');
                    $pdf->page_text(710, 580, "Fecha: {$date}", $font, 6, array(0,0,0));
			}
		</script>
          
          <table id="header" width="100%" border="0">
			<tr>
				<th width="20%"><img src="../pages/images/logo.jpg" height="50px"></th>
				<th width="60%"><h1 align="center" style="margin:10px 0 0 0;font-family:Arial, Helvetica, sans-serif;font-weight:800;color:#535353;line-height:20px">CASA NACIONAL DE LA MONEDA <small style="color:#000;font-size:.7em"><br>Reporte de Hojas de Ruta</small> </h1></th>
				<th width="20%"><img src="../pages/images/logo.jpg" height="50px" ></th>
			</tr>
		</table>
          <table width="100%" style="margin-top:10px"  width="100%" cellspacing="0" cellpadding="0">
               <thead style="background:#bdbdbd;text-align:center">
                    <tr>
                         <td width="5%">Nº</td>
                         <td width="20%">PROCEDENCIA</td>
                         <td width="20%">REMITENTE</td>
                         <td width="10%">TIPO</td>
                         <td width="10%">HOJAS</td>
                         <td width="15%">REFERENCIAS</td>
                         <td width="10%">FECHA CITE</td>
                         <td style="padding:3px" width="10%">ESTADO</td>
                    </tr>
               </thead>
               <tbody>
                    <?php for($i=0;$i< count($resultado);$i++){?>
                         <tr>
                              <td><h5>00<?php echo $resultado[$i]['id'] ?></h5></td>
                              <td><h5><?php echo strtolower($resultado[$i]['procedencia'])?></h5></td>
                              <td><h5><?php echo strtolower($resultado[$i]['remitente'])?></h5></td>
                              <td><h5><?php echo strtolower($resultado[$i]['adjunto'])?></h5></td>
                              <td><h5><?php echo $resultado[$i]['num_hojas'] ?> <small><?php echo strtolower($resultado[$i]['tipo'])?></small></h5></td>
                              <td style="line-height: 1em;"><h5><?php echo strtolower($resultado[$i]['referencia'])?></td>
                              <td style="line-height: 1em;"><h5><?php echo $resultado[$i]['fecha_cite'];?></h5></td>
                              <td <?php echo $resultado[$i]['color'];?>><h5><?php echo $resultado[$i]['mensaje'];?></h5></td>

                         </tr>
                    <?php } ?>
               </tbody>
          </table>
     </body>
</html>
