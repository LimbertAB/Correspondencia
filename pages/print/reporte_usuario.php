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
                    font-weight:200;font-size: .64em;
               }
               h3{
                    margin: 0;padding: 0;
               }

               span#procent {display: block;position: absolute;left: 50%;top: 104%;font-size: 50px;transform: translate(-50%, -50%);color: #545454;}
               span#procent::after {content: '%';}
               .canvas-wrap {position: relative;width: 300px;height: 300px;}
          </style>
     </head>
     <body >
          <script type="text/php">
			if ( isset($pdf) ) {
				$font = Font_Metrics::get_font("helvetica");
				$pdf->page_text(40, 760, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0,0,0));
			}
		</script>
          <img src="../pages/images/logo.jpg" width="60px" style="position: absolute;top:-20px;z-index:10">
          <h5 style="z-index:10;margin-top:2px;line-height: 1em;margin-left:65px">CASA NACIONAL DE LA MONEDA<br><small> Potosi - Bolivia</small></h5>
          <center><h3 style="font-weight:700">REPORTE DE USUARIOS</h3></center>
          
          <table width="100%" style="margin-top:10px"  width="100%" cellspacing="0" cellpadding="0">
               <thead style="background:#bdbdbd;text-align:center">
                    <tr>
                        <td width="5%">Nº</td>
                        <td width="35%">NOMBRES</td>
                        <td width="10%">CEDULA</td>
                        <td width="20%">DESTINO</td>
                        <td width="20%">CARGO</td>
                        <td style="padding:3px" width="10%">ESTADO</td>
                    </tr>
               </thead>
               <tbody>
                <?php $aux=1;while ($datos=pg_fetch_assoc($result)) {?>
                    <tr>
                        <td><?=$aux?></td>
                        <td style="padding: 8px 5px 8px 10px;text-align:left"><?php echo strtolower($datos['nombres'])." ".strtolower($datos['apellidos'])?></td>
                        <td style="padding: 8px"><?php echo $datos['cedula'] ?></td>
                        <td style="padding: 8px 5px 8px 10px;text-align:left"><?php echo strtolower($datos['destino'])?></td>
                        <td style="padding: 8px 5px 8px 10px;text-align:left"><?php echo strtolower($datos['cargo'])?></td>
                        <td style="padding: 8px"><?= $datos['estado']==1?"Activo":"De Baja";$aux++;?></td>
                    </tr>
                <?php } ?>
               </tbody>
          </table>
     </body>
</html>
