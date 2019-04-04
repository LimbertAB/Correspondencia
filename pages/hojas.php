<?php include("includes/header.php"); ?>
<?php include("includes/aside.php"); ?>
<?php include("../crud/ListPOO.php");$listPOO= new ListPOO; $data=$listPOO->listHojaRuta();$datos=$data['hoja'];?>
<!--Control de mensajes-->
<?php if (isset($_SESSION['mensaje'])) {?>
	<script type="text/javascript"> alert("<?php echo $_SESSION['mensaje'] ?>")</script>
<?php unset( $_SESSION["mensaje"] );}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php if ($con_funciones==1):?>
		<div class="fab" data-placement="top" title="Registrar Hoja de Ruta" data-target="#modal_hoja" data-toggle="modal"> + </div>
		<div class="fab2"><a data-toggle="tooltip" data-placement="top" title="Imprimir Reporte" href="../crud/Createpdf.php/loadPDF/?inicio=<?php echo $data['inicio']?>&fin=<?php echo $data['fin']?>&estado=all&remitente=all" target="_blank" style="color:#ffcccc"><span class="glyphicon glyphicon-print" aria-hidden="true" style="font-size: 30px;text-align: center;vertical-align: top;padding-top: 9px;"></span></a></div>
	<?php else:?>
		<div class="fab"><a data-toggle="tooltip" data-placement="top" title="Imprimir Reporte" href="../crud/Createpdf.php/loadPDF/?inicio=<?php echo $data['inicio']?>&fin=<?php echo $data['fin']?>&estado=all&remitente=all" target="_blank" style="color:#fff"><span class="glyphicon glyphicon-print" aria-hidden="true" style="font-size: 40px;text-align: center;vertical-align: top;padding-top: 9px;"></span></a></div>
	<?php endif; ?>
	<section class="content">
		<div class="row">
			<div class="col-md-12 form-inline" >
				<h1 align="center" style="margin:0 0 20px 0;font-weight:600">HOJAS DE RUTA </h1>
				<div class="tab">
					<div class="form-busq tab">
						<h4>
						 <span class="titulo pull-left">BUSQUEDA AVANZADA DE HOJAS DE RUTA</span>
						</h4>
					</div>
					<span class="glyphicon btn-collapse glyphicon-minus" data-toggle="collapse" href="#formAvanzada" aria-expanded="true" style="text-align:left;"></span>
					<div class="tab-content">
						<div id="f-avanzada" class="tab-pane fade in  active">
							<form id="formAvanzada" class="form-horizontal collapse in" autocomplete="off" aria-expanded="true">
								<div class="row" style="padding:8px 20px 8px;display:table;">
										<div class="form-group col-md-6" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Fecha:</label>
											<div class="col-sm-9">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:0 8px 0 0">
													<input type="date" name="inicio" class="bg-info form-control" value="<?php echo $data['inicio']?>" style="width: 100%;padding:5px 0 5px 10px">
												</div>
												<label class="control-label fecha" style="margin: 0 -4px;padding-top: 7px;padding-left:0;float:left">a</label>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:0 0 0 8px">
												  <input type="date" name="fin" class="form-control" value="<?php echo $data['fin']==""?date('Y-m-d'):$data['fin']?>" max="<?php echo date('Y-m-d')?>" style="width: 100%;padding:5px 0 5px 10px">
												</div>
											</div>
										</div>
										<div class="form-group col-md-6" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Hoja Ruta:</label>
											<div class="col-sm-9">
												<input type="number" class="form-control" name="id" placeholder="Ejemplo: 10" style="width: 100%;" value="<?php echo $data['id']?>">
											</div>
										</div>
										<div class="form-group col-md-6 col-sm-12 col-xs-12" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Cite:</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="cite" placeholder="Ejemplo: Banco Central de Bolivia" style="width: 100%;" value="<?php echo $data['cite']?>">
											</div>
										</div>
										<div class="form-group col-md-6 col-sm-12 col-xs-12" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Remitente:</label>
											<div class="col-sm-9">
												<select name="remitente" id="selectremitente_s" class="form-control select2" data-placeholder="Seleccione" style="width: 100%;">
												  <option value="">Todos</option>
												  <?php
													 $consul=pg_query("SELECT CONCAT(nombres ,' ', apellidos) as nombres,id FROM remitentes");
													 while ($remitente=pg_fetch_array($consul)) {
														echo "<option value='$remitente[id]'>$remitente[nombres]</option>";
													 }
												  ?>
												</select>
											</div>
										</div>
										<div class="form-group col-md-6 col-sm-12 col-xs-12" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Procedencia:</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="procedencia" placeholder="Ejemplo: Banco Central de Bolivia" style="width: 100%;" value="<?php echo $data['procedencia']?>">
											</div>
										</div>
										<div class="form-group col-md-6 col-sm-12 col-xs-12" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Referencia:</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="referencia" placeholder="Ejemplo: Archivo de suma importancia" style="width: 100%;" value="<?php echo $data['referencia']?>">
											</div>
										</div>
										<div class="form-group col-md-6 col-sm-12 col-xs-12" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Estado:</label>
											<div class="col-sm-9">
												<select name="estado" id="selectestado_s" class="form-control select2" data-placeholder="Seleccione" style="width: 100%;">
													<option value="">Todos</option>
													<option value="revisado">Recepcionados</option>
													<option value="proceso">En Proceso</option>
													<option value="norevisado">No Revisados</option>
												</select>
											</div>
										</div>
										<div class="form-group col-md-6 col-sm-12 col-xs-12" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Adjunto:</label>
											<div class="col-sm-9">
												<select name="adjunto" id="selectadjunto_s" class="form-control select2" data-placeholder="Seleccione" style="width: 100%;">
												  <option value="">Todos</option>
												  <?php
													 $consul=pg_query("SELECT * FROM adjuntos");
													 while ($remitente=pg_fetch_array($consul)) {
														echo "<option value='$remitente[id]'>".strtolower($remitente[nombre])."</option>";
													 }
												  ?>
												</select>
											</div>
										</div>
										<div class="form-group col-md-6 col-sm-12 col-xs-12" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Tipo documento:</label>
											<div class="col-sm-9">
												<select name="tipo" id="selecttipo_s" class="form-control select2" data-placeholder="Seleccione" style="width: 100%;">
												  <option value="">Todos</option>
												  <?php
													 $consul=pg_query("SELECT * FROM tipos");
													 while ($remitente=pg_fetch_array($consul)) {
														echo "<option value='$remitente[id]'>".strtolower($remitente[nombre])."</option>";
													 }
												  ?>
												</select>
											</div>
										</div>
										<div class="form-group col-md-6" style="margin:5px 0 5px 0">
											<label for="inputEmail3" class="col-sm-3 control-label">Numero Hojas:</label>
											<div class="col-sm-9">
												<input type="number" name="hojas" class="form-control" placeholder="Ejemplo: 10" style="width: 100%;" value="<?php echo $data['num_hojas']?>">
											</div>
										</div>
								</div>
								<div class="col-xs-12 control-label btns" style="padding:10px;background:#fff">
									<button type="submit" class="btn btn-primary btn-sm" name="buscar">Buscar <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
									<input class="btn btn-default btn-sm limpiarForm" type="button" value="Limpiar" autocomplete="off">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box">
			<div class="box-body">
				<div class="table-responsive">
					<table id="example1" class="table dataTable table-hover table-striped table-bordered table-condensed">
						<thead>
							<tr style="background:#b5b5b5;color:#000000">
								<th width="5%">N°</th>
								<th width="20%">REMITENTE</th>
								<th width="20%">PROCEDENCIA</th>
								<th width="15%">REFERENCIA</th>
								<th width="10%">PLAZO</th>
								<th width="10%">ESTADO</th>
								<th width="9%">FECHA</th>
								<th width="11%">OPCIONES</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0;while($i<count($datos)):?>
								<tr>
									<td><h5>0<?php echo $datos[$i]['id'] ?></h5></td>
									<td><h5><?php echo strtolower($datos[$i]['remitente'])?></h5></td>
									<td><h5><?php echo strtolower($datos[$i]['procedencia'])?></h5></td>
									<td><h5><?php echo strtolower($datos[$i]['referencia'])?></h5></td>
									<td><h5><?php $mensage=$datos[$i]['diferencia']>=0? ($datos[$i]['diferencia']+1)." <small>dia restante</small>": " Plazo terminado";echo $mensage; ?></h5></td>
									<td <?php echo $datos[$i]['color'];?>><h5><?php echo $datos[$i]['mensaje'];?></h5></td>
									<td  style="text-align:center"><h5><?php echo date('Y-m-d', strtotime($datos[$i]['fecha']))?></h5></td>
									<td style="vertical-align:middle;text-align:center">
										<a onclick="verAjax(<?php echo $datos[$i]['id'] ?>)" data-target="#verhojarutaModal" data-toggle="modal"><button title="ver hoja de ruta" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
										<a href="../crud/Createpdf.php/PrintHoja/<?php echo $datos[$i]['id'] ?>" target="_blank"><button title="imprimir hoja de ruta" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></a>
										<a href="../dist/archivos/<?php echo $datos[$i]['archivo'] ?>" target="_blank"><button title="ver archivo adjuntado" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-copy" aria-hidden="true"></span></button></a>
										<?php if($con_funciones==1):?>
											<?php if($datos[$i]['total'] == $datos[$i]['faltantes'] && $datos[$i]['estado_plazo'] == 1):?>
												<a onclick="updateAjax(<?php echo $datos[$i]['id'] ?>)" data-target="#updatehoja_modal" data-toggle="modal"><button title="editar hoja de ruta" type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
												<a onclick="bajaAjax(<?php echo $datos[$i]['id'] ?>)"><button title="eliminar hoja de ruta" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
											<?php endif;?>
										<?php endif?>
									</td>
								</tr>
							<?php $i++;endwhile;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<center>
				<a href="../crud/Createpdf.php/PrintHojas/all/?inicio=<?php echo $data['inicio']?>&fin=<?php echo $data['fin']?>&id=<?php echo $data['id']?>&cite=<?php echo $data['cite']?>&remitente=<?php echo $data['remitente']?>&procedencia=<?php echo $data['procedencia']?>&referencia=<?php echo $data['referencia']?>&estado=<?php echo $data['estado']?>&adjunto=<?php echo $data['adjunto']?>&tipo=&hojas=<?php echo $data['num_hojas']?>"  target="_blank"><button title="imprimir hoja de ruta" type="button" class="btn btn-success btn-sm">IMPRIMIR HOJAS DE RUTA <span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></a>
			</center>
		</div>
	</section>
</div>
<style>
	.pdfobject-container { height: 50rem; border: 0.1rem solid #565555;}
	td>h5{margin:0}
	.form-busq {
		display: table;
		background: #eee none repeat scroll 0 0;
		width: 100%;
		padding: 8px 20px 8px;
		background: #7095c1;
	}
	.form-busq h4 {
		color: #fff;
		margin: 0;
	}
	.glyphicon.btn-collapse {
		color: #fff;
		cursor: pointer;
		float: right;
		font-size: 14px;
		margin: -28px 19px 15px 0;
	}
	.tab-content{
		background: #fff;
	}
	.tab-menu{
		-webkit-box-sizing: border-box;
	}
	div.dataTables_wrapper div.dataTables_paginate {float:none; text-align:left}
</style>
<?php include 'modalverhojaRuta.php'; ?>
<script>
	 var prioridad_u,remitente_u,tipo_u,adjunto_u,destino_u=[],accion_u=[],Get_ID=0,estado_destino=false,estado_accion=false;
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip()
		var seltipo=getUrlParameter('tipo')==undefined?"":getUrlParameter('tipo');
		var seladjunto=getUrlParameter('adjunto')==undefined?"":getUrlParameter('adjunto');
		var selremitente=getUrlParameter('remitente')==undefined?"":getUrlParameter('remitente');
		var selestado=getUrlParameter('estado')==undefined?"":getUrlParameter('estado');
		$('#selecttipo_s option[value="'+seltipo+'"]').attr('selected','selected');
		$('#selectadjunto_s option[value="'+seladjunto+'"]').attr('selected','selected');
		$('#selectremitente_s option[value="'+selremitente+'"]').attr('selected','selected');
		$('#selectestado_s option[value="'+selestado+'"]').attr('selected','selected');
		$('#example1').DataTable( {
		  "order": [[ 0, "desc" ]],"dom": '<"top"f>t<"bottom"p>'
		});
		$('.limpiarForm').click(function(){
			$('#formAvanzada').find(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
		});

		$('#datetimepicker1').datetimepicker({
		  locale: 'es',format: 'YYYY-MM-DD HH:mm:00',ignoreReadonly: true
		}).on('dp.change', function(e){
		  //validate_fecha("","true");
		});
		$('#datetimepicker1_u').datetimepicker({
		  locale: 'es',format: 'YYYY-MM-DD HH:mm:00',ignoreReadonly: true
		}).on('dp.change', function(e){
		  function_validate('false');
		});
		$('#inputprocedencia,#inputprocedencia_u,#inputreferencia,#inputreferencia_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>3){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputhoja,#inputhoja_u,#inputplazo,#inputplazo_u').keypress(function(e){yes_number(e);}).keyup(function(){if(parseInt($(this).val())>0){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		  $('#inputcite,#inputcite_u').keyup(function(){if($(this).val().trim().length>1){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$("#selectdestinos,#selectaccion").change(function(){function_validate('true');});
		$("#selectdestinos_u").change(function(){
		  estado_destino=evaluar_twoarrays($('#selectdestinos_u').val()|| [],destino_u);
		  function_validate('false');});
		$("#selectaccion_u").change(function(){
		  estado_accion=evaluar_twoarrays($('#selectaccion_u').val()|| [],accion_u);
		  function_validate('false');});
		$("#selectprioridad_u,#selectremitente_u,#selecttipo_u,#selectadjunto_u").change(function(){function_validate('false');});
		$('#btnregistrar_hoja').click(function(){
		  var parametros=new FormData($('#form_createhoja')[0]);
		  $.ajax({
			 data:parametros,
			 url: '../crud/UpdatePOO.php/createHoja/',
			 type:"POST",
			 contentType:false,
			 processData:false,
			 success:function(obj){
				if (obj=="false") {
				}else{
				  swal("Mensaje de Alerta!", "La Hoja de Ruta Se Registro Satisfactoriamente" , "success");
				  setInterval(function(){ location.reload();}, 1500);
				}
			 }
		  });
		  });
		$('#btnupdate_hoja').click(function(){
		  var parametros=new FormData($('#form_updatehoja')[0]);
		  var accion=[],values=$('#selectaccion_u').val();
		  for (var i = 0; i < accion_u.length; i++) {var aux=0;for (var j = 0; j < values.length; j++) {if(values[j]==accion_u[i]){aux++;}}if(aux==0){parametros.append('accion_u[]',JSON.stringify({'id':accion_u[i],'estado':false}));accion.push({id:accion_u[i],estado:false});}}
		  for (var j = 0; j < values.length; j++) {aux=0;for (var i = 0; i < accion_u.length; i++) {if(values[j]==accion_u[i]){aux++;}}if(aux==0){parametros.append('accion_u[]',JSON.stringify({'id':values[j],'estado':true}));accion.push({id:values[j],estado:true});}}
		  var destinos=[],values=$('#selectdestinos_u').val();
		  for (var i = 0; i < destino_u.length; i++) {var aux=0;for (var j = 0; j < values.length; j++) {if(values[j]==destino_u[i]){aux++;}}if(aux==0){parametros.append('destino_u[]',JSON.stringify({'id':destino_u[i],'estado':false}));destinos.push({id:destino_u[i],estado:false});}}
		  for (var j = 0; j < values.length; j++) {aux=0;for (var i = 0; i < destino_u.length; i++) {if(values[j]==destino_u[i]){aux++;}}if(aux==0){parametros.append('destino_u[]',JSON.stringify({'id':values[j],'estado':true}));destinos.push({id:values[j],estado:true});}}

		  parametros.append('id_hoja',Get_ID);
		  $.ajax({
			 data:parametros,
			 url: '../crud/UpdatePOO.php/updateHoja/',
			 type:"POST",
			 contentType:false,
			 processData:false,
			 success:function(obj){
				console.log(obj);

				if (obj=="false") {
				}else{
				  swal("Mensaje de Alerta!", "La Hoja de Ruta Se Modifico Satisfactoriamente" , "success");
				  setInterval(function(){ location.reload();}, 1500);
				}
			 }
			 });
		});
	 });
	function verAjax(val){
		$.ajax({
		  	url: '../crud/ViewData.php/verHoja/'+val,
		  	type: 'get',
		  	success:function(obj){
			 	var hoja = JSON.parse(obj);console.log(hoja);Get_ID=hoja.id;
			 	PDFObject.embed("../dist/archivos/"+hoja.archivo, "#archivopdf");
			 	var arrayaccion = hoja.accion,arraydestino = hoja.destino;
			 	$('#seccion_accion,#seccion_destino').empty();
			 	for (var i = 0; i < arrayaccion.length; i++) {
					var check=arrayaccion[i].estado=="1" ? ("checkedok"):("nochecked");
					$('#seccion_accion').append('<h5 class="col-md-4" style="margin:3px 0 3px 0;font-style: italic"><img src="../pages/images/'+check+'.png" style="margin-right:10px;height:24px">'+arrayaccion[i].nombre+'</h5>');
			 	}
			 	for (var i = 0; i < arraydestino.length; i++) {
					if (arraydestino[i].usuario_id==null) {
						if (parseInt(hoja.diferencia)>=0) {
							var check="rotate";
							var usuario="Aun no se recepciono";
							var fecha="A la espera";
							var status= "En Proceso";
						}else{
							var check="error";
							var usuario="Hoja de Ruta no recepcionada";
							var fecha="Sin fecha";
							var status= "No Recepcionado";
						}
					}else{
						var check="ok";
						var usuario=arraydestino[i].usuario.toLowerCase();
						var fecha=arraydestino[i].fecha;
						var status= "Recepcionado";
					}

					$('#seccion_destino').append('<div class="col-sm-12 col-md-6 col-xs-12" style="background-color:#fff;background-clip:content-box;padding:15px"><div class="col-md-9 col-sm-9 col-xs-9" style="padding:0 0px 0 15px"><h3 style="color:#a2a2a2;font-weight:700;margin:15px 0 2px 0"><small class="badge" style="background:#f3c51d;margin-right:10px;color:#fff;font-size:1.2em">'+((i)+1)+'</small>'+arraydestino[i].nombre.toUpperCase()+'</h3><div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin:20px 0 0 20px;padding:0"><div class="col-md-2 col-sm-2 col-xs-2" style="margin:0;padding:0"><img src="../pages/images/businessman.png"></div><div class="col-md-10 col-sm-10 col-xs-10" style="margin:0px;padding:0"><h4 style="font-weight:800;margin:0px;color:#0bc3d6">RECEPCIONADO POR</h4><h5 style="margin:0;font-style: italic">'+usuario+'</h5></div></div><div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin:20px 0 0 20px;padding:0"><div class="col-md-2 col-sm-2 col-xs-2" style="margin:0;padding:0"><img src="../pages/images/calendario.png"></div><div class="col-md-10 col-sm-10 col-xs-10" style="margin:0px;padding:0"><h4 style="font-weight:800;margin:0px;color:#0bc3d6">FECHA</h4><h5 style="margin:0;font-style: italic">'+fecha+'</h5></div></div><div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin:20px 0 0 20px;padding:0"><div class="col-md-2 col-sm-2 col-xs-2" style="margin:0;padding:0"><img src="../pages/images/'+check+'.png"></div><div class="col-md-10 col-sm-10 col-xs-10" style="margin:0px;padding:0"><h4 style="font-weight:800;margin:0px;color:#0bc3d6">ESTADO</h4><h5 style="margin:0;font-style: italic">'+status+'</h5></div></div></div><div class="col-md-3 col-sm-3 col-xs-3" style="padding:0"><img src="../pages/images/personajuridica.png" style="margin:0;width: 100% !important;float:right"></div></div>');
			 	}
				$('.vnombre').text(hoja.remitente.toLowerCase());
				$('.vcite').text(hoja.cite);
				$('.vtramite').text(hoja.tramite);
				$('.vprocedencia').text(hoja.procedencia.toLowerCase());
				$('.vplazo').text(hoja.plazo+" Dias");
				$('.vfecha').text(hoja.fecha);
				$('.vtipo').text(hoja.tipo.toLowerCase());
				$('.vprioridad').text(hoja.prioridad);
				$('.vhojas').text(hoja.num_hojas+" hojas");
				$('.vadjunto').text(hoja.adjunto.toLowerCase());
				$('.vestado').text(hoja.estado==1?('Activo'):('Dado de Baja'));
				$('.varchivo').text(hoja.archivo);
				$('.vobservacion span').text(hoja.referencia.toLowerCase());
				if(hoja.permiso==""){
					$('#btnnovalidado,#btnvalidado').hide();
					$('#row_admin').show();
					$('.vnombrer').text(hoja.usuario.toLowerCase());
					$('.vnombreu').text(hoja.modificado==" "?("Hoja de Ruta no modificada"):(hoja.modificado.toLowerCase()));
					$('.vfechau').text(hoja.fecha_update==null?("sin fecha"):(hoja.fecha_update));
					$('.vcir').text(hoja.cedula);
				}else{
					$('#row_admin').hide();
					if (arraydestino.length>0 && parseInt(hoja.diferencia)>=0) {
						console.log("aqui"+parseInt(hoja.diferencia));
					  	$('#btnvalidado').hide();$('#btnnovalidado').show();
					}else{
					  	if(arraydestino[0].usuario_id != null){
							console.log("aqui2"+parseInt(hoja.diferencia));
						 	$('#btnnovalidado').hide();$('#btnvalidado').show();
					  	}else{
							console.log("aqui3"+parseInt(hoja.diferencia));
						 	$('#btnnovalidado,#btnvalidado').hide();
					  	}
					}
				}
		  	}
		});
	}
	function updateAjax(val){
		$.ajax({
		  url: '../crud/ViewData.php/verHoja/'+val,
		  type: 'get',
		  success:function(obj){
			 $("#btnupdate_hoja").attr('disabled', true);small_error(".fila1_u",true);small_error(".fila2_u",true);small_error(".fila3_u",true);small_error(".fila4_u",false);small_error(".fila5_u",true);small_error(".fila6_u",true);
			 accion_u=[],destino_u=[],estado_destino=false,estado_accion=false;
			 var data = JSON.parse(obj);Get_ID=data.id;
			 $('#datetimepicker1_u input').val(data.fecha);$('#datetimepicker1_u input').attr('placeholder',data.fecha);
			 $('#inputprocedencia_u').val(data.procedencia.toLowerCase());$('#inputprocedencia_u').attr('placeholder',data.procedencia.toLowerCase());
			 $('#inputcite_u').val(data.cite.toLowerCase());$('#inputcite_u').attr('placeholder',data.cite.toLowerCase());
			 $('#inputreferencia_u').val(data.referencia.toLowerCase());$('#inputreferencia_u').attr('placeholder',data.referencia.toLowerCase());
			 $('#inputhoja_u').val(data.num_hojas);$('#inputhoja_u').attr('placeholder',data.num_hojas);
			 $('#inputplazo_u').val(data.plazo);$('#inputplazo_u').attr('placeholder',data.plazo);$('#inputfile_u').val("");

			 prioridad_u=data.prioridad;remitente_u=data.remitente_id;tipo_u=data.tipo_id;adjunto_u=data.adjunto_id;
			 $('#selectprioridad_u').selectpicker('val', prioridad_u);
			 $('#selectremitente_u').selectpicker('val', remitente_u);
			 $('#selecttipo_u').selectpicker('val', tipo_u);
			 $('#selectadjunto_u').selectpicker('val', adjunto_u);
			 $("#selectprioridad_u,#selectremitente_u,#selecttipo_u,#selectadjunto_u").selectpicker('refresh');

			 $('#selectdestinos_u,#selectaccion_u').selectpicker('val', '');
			 $("#selectdestinos_u,#selectaccion_u").selectpicker('refresh');
			 var i=0;while (i<data.destino.length) {destino_u.push(data.destino[i].destino_id);i++;}
			 i=0;while (i<data.accion.length) {if(data.accion[i].estado==1){accion_u.push(data.accion[i].id);}i++;}
			 $('#selectdestinos_u').selectpicker('val', destino_u);
			 $('#selectaccion_u').selectpicker('val', accion_u);
			 $("#selectdestinos_u,#selectaccion_u").selectpicker('refresh');
		  }
		});
	 }
	function function_validate(validate){
		if(validate!="false"&&validate=="true"){
		  if(($('.fila1').hasClass('has-success'))&&($('.fila2').hasClass('has-success'))&&($('.fila3').hasClass('has-success'))&&($('.fila4').hasClass('has-success'))&&($('.fila5').hasClass('has-success'))&&($('.fila6').hasClass('has-success'))&&($('#selectremitente').val()!=null)&&($('#selecttipo').val()!=null)&&($('#selectadjunto').val()!=null)&&($('#selectdestinos').val()!=null)&&($('#selectaccion').val()!=null)){
				$("#btnregistrar_hoja").attr('disabled', false);}else{$("#btnregistrar_hoja").attr('disabled', true);}
		}else{
		  if($('.fila1_u').hasClass('has-success') && $('.fila2_u').hasClass('has-success') && $('.fila3_u').hasClass('has-success') && ($('.fila5_u').hasClass('has-success'))&&($('.fila6_u').hasClass('has-success'))&&($('#selectremitente_u').val()!=null)&&($('#selecttipo_u').val()!=null)&&($('#selectadjunto_u').val()!=null)&&($('#selectdestinos_u').val()!=null)&&($('#selectaccion_u').val()!=null)){
			 console.log("aqui3");
			 if (($('#inputfile_u').val()=="") || ($('.fila4_u').hasClass('has-success'))) {
				console.log("aqui4");
				if(($('#inputprocedencia_u').attr('placeholder')!=$('#inputprocedencia_u').val().trim().toLowerCase()) ||
				  ($('#inputcite_u').attr('placeholder')!=$('#inputcite_u').val().trim().toLowerCase())  ||
				  ($('#inputreferencia_u').attr('placeholder')!=$('#inputreferencia_u').val().trim().toLowerCase())  ||
				  ($('#inputhoja_u').attr('placeholder')!=$('#inputhoja_u').val()) ||
				  ($('#inputplazo_u').attr('placeholder')!=$('#inputplazo_u').val()) || estado_accion || estado_destino ||
				  ($('#selectprioridad_u option:selected').attr('value')!=prioridad_u) ||
				  ($('#selectremitente_u option:selected').attr('value')!=remitente_u) ||
				  ($('#selecttipo_u option:selected').attr('value')!=tipo_u) ||
				  ($('#selectadjunto_u option:selected').attr('value')!=adjunto_u) ||
				  ($('#datetimepicker1_u input').attr('placeholder')!=$('#datetimepicker1_u input').val()) ||
				  ($('.fila4_u').hasClass('has-success'))
				){
				  $("#btnupdate_hoja").attr('disabled', false);
				}else{$("#btnupdate_hoja").attr('disabled', true);}
			 }else{$("#btnupdate_hoja").attr('disabled', true);}
		  }else{$("#btnupdate_hoja").attr('disabled', true);}
		}
	 }
	function displayPreview(files,etiqueta) {
		if(files.length>0){
		  fileSize = Math.round(files[0].size/1024);
		  if(fileSize>0 && files[0].type=="application/pdf"){
			 small_error(etiqueta,true);
		  }else{
			 small_error(etiqueta,false);
		  }
		}else{
		  small_error(etiqueta,false);
		}
		if(etiqueta==".fila4"){
		  function_validate('true');
		}else{function_validate('false');}
	 }
	function evaluar_twoarrays(array1,array2){aux=0;
		if (array1.length>0) {
		  if (array1.length==array2.length) {
			 for (var i = 0; i < array2.length; i++) {//[1,2,3]
				for (var j = 0; j < array1.length; j++) {//[2,3,4]
				  if(array1[j]==array2[i]){aux++;}
				}
			 }
			 if (aux!=array2.length) {
				return true;
			 }else{return false;}
		  }else{
			 return true;
		  }
		}else{
		  return false;
		}
	 }
	function validateAjax(){
		swal({
		  title: "¿Estás seguro?",
		  text: "Esta Seguro que quiere Recepcionar la Hoja de Ruta?",
		  type: "warning",
		  showCancelButton: true,confirmButtonColor: "#06c17e",
		  confirmButtonText: "Recepcionar Hoja de Ruta!",
		  closeOnConfirm: false
		},function(){
		  $.ajax({
			 url: '../crud/ViewData.php/recepcionar/'+Get_ID,
			 type: 'get',
			 success:function(obj){
				if (JSON.parse(obj)=="ok") {
				  swal("Mensaje de Alerta!", "La Hoja de Ruta se Recepciono Satisfactoriamente", "success");
				  setInterval(function(){location.reload();}, 1000);
				}else{
				  swal("Mensaje de Alerta!", "La hoja de ruta No se Recepciono debido a un problema de conexion: "+obj , "error");
				  setInterval(function(){location.reload();}, 1000);
				}
			 }
		  });
		});

	 }
	function getUrlParameter(sParam) {var sPageURL = decodeURIComponent(window.location.search.substring(1)),sURLVariables = sPageURL.split('&'),sParameterName,i;for (i = 0; i < sURLVariables.length; i++) {sParameterName = sURLVariables[i].split('='); if (sParameterName[0] === sParam) {return sParameterName[1] === undefined ? true : sParameterName[1];}}};

  </script>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
	 <div class="pull-right hidden-xs">
		<b>Version</b> 2.4.0
	 </div>
	 <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
	 reserved.
  </footer>

<!-- Control de configuracion de pagina -->
<div class="control-sidebar-bg"></div>
</div>
<!-- Control de modalaes -->
<?php include('includes/modales.php'); ?>
<!-- Control de configuracion de pie de de js pagina -->
<?php include('includes/pie.php'); ?>
