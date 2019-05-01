<?php include("includes/header.php"); ?>
<?php include("includes/aside.php"); ?>
<?php include("../crud/ListPOO.php");
$listPOO = new ListPOO;
$data = $listPOO->listmiHojaRuta();
$datos = $data['hoja']; ?>
<!--Control de mensajes-->
<?php if (isset($_SESSION['mensaje'])) { ?>
	<script type="text/javascript">
		alert("<?php echo $_SESSION['mensaje'] ?>")
	</script>
	<?php unset($_SESSION["mensaje"]);
} ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12 form-inline">
				<h1 align="center" style="margin:0 0 20px 0;font-weight:600">MIS HOJAS DE RUTA </h1>
			</div>
			<form id="formAvanzada" class="form-inline" autocomplete="off" aria-expanded="true" style="padding:20px">
				<div class="form-group col-md-4" style="margin:0;padding:0">
					<label class="control-label fecha" style="margin: 0 -4px;padding-top: 7px;padding-left:0;float:left;position:absolute">Fecha:</label>
					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" style="padding:0 0px 0 40px">
						<input type="date" name="inicio" class="form-control" value="<?php echo $data['inicio'] ?>" style="padding:5px 0 5px 10px;width:100%">
					</div>
					<label class="control-label fecha" style="margin: 0 0 0 0px;padding-top: 7px;padding-left:0;float:left;position:absolute">a</label>
					<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" style="padding:0 0 0 8px">
						<input type="date" name="fin" class="form-control" value="<?php echo $data['fin'] == "" ? date('Y-m-d') : $data['fin'] ?>" style="padding:5px 0 5px 10px;width:100%">
					</div>

				</div>
				<div class="form-group col-md-3" style="margin:0;padding:0 0 0 5px">
					<label>Criterio</label>
					<input type="text" class="form-control select2" name="cite" placeholder="Ejemplo: AB001" value="<?php echo $data['cite'] ?>" style="width:80%;display:none">
					<input type="number" class="form-control select2" name="id" placeholder="Hoja de ruta ejemplo: 10" value="<?php echo $data['id'] ?>" style="width:80%;display:none">
					<select name="procedencia" id="selectprocedencia_s" class="form-control select2 recepcionado proceso norevisado" data-placeholder="Seleccione" style="width:80%;display:none">
						<?php
						$consul = pg_query("SELECT * FROM procedencia");
						while ($procedencia = pg_fetch_array($consul)) {
							echo "<option value='$procedencia[id]'>$procedencia[nombre]</option>";
						}
						?>
					</select>
					<input type="text" class="form-control select2" name="remitente" placeholder="Ejemplo: Maria Mercedez Condori" value="<?php echo $data['remitente'] ?>" style="width:80%;display:none">
					<select name="adjunto" id="selectadjunto_s" class="form-control select2" style="width:80%;display:none">
						<?php
						$consul = pg_query("SELECT * FROM adjuntos");
						while ($remitente = pg_fetch_array($consul)) {
							echo "<option value='$remitente[id]'>" . strtolower($remitente[nombre]) . "</option>";
						}
						?>
					</select>
					<select name="tipo" id="selecttipo_s" class="form-control select2" style="width:80%;display:none">
						<?php
						$consul = pg_query("SELECT * FROM tipos");
						while ($remitente = pg_fetch_array($consul)) {
							echo "<option value='$remitente[id]'>" . strtolower($remitente[nombre]) . "</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group" style="margin:0;padding:0">
					<label>Seleccione:</label>
					<select name="seleccionado" id="selectseleccion_s" class="form-control">
						<option value="cite">Cite</option>
						<option value="procedencia">Procedencia</option>
						<option value="remitente">Remitente</option>
						<option value="adjunto">Adjuntos</option>
						<option value="tipo">Tipo de Documento</option>
						<option value="revisado">Recepcionados</option>
						<option value="proceso">En Proceso</option>
						<option value="norevisado">No Revisados</option>
					</select>
				</div>
				<button type="submit" class="btn btn-warning" name="buscar">Buscar <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				<a href="../crud/Createpdf.php/PrintmisHojas/all/?inicio=<?php echo $data['inicio'] ?>&fin=<?php echo $data['fin'] ?>&id=<?php echo $data['id'] ?>&cite=<?php echo $data['cite'] ?>&seleccionado=<?php echo $data['seleccionado'] ?>&remitente=<?php echo $data['remitente'] ?>&procedencia=<?php echo $data['procedencia'] ?>&adjunto=<?php echo $data['adjunto'] ?>&tipo=<?php echo $data['tipo'] ?>" target="_blank"><button title="imprimir hojas de ruta" type="button" class="btn btn-danger btn-xs">Pdf</button></a>
				<button type="submit" class="btn btn-success btn-xs">Excel</button>
				<button type="submit" class="btn btn-primary btn-xs">Word</button>
			</form>
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
								<th width="9%">FECHA CITE</th>
								<th width="11%">OPCIONES</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0;
							while ($i < count($datos)) : ?>
								<tr>
									<td>
										<h5>0<?php echo $datos[$i]['id'] ?></h5>
									</td>
									<td>
										<h5><?php echo strtolower($datos[$i]['remitente']) ?></h5>
									</td>
									<td>
										<h5><?php echo strtolower($datos[$i]['procedencia']) ?></h5>
									</td>
									<td>
										<h5><?php echo strtolower($datos[$i]['referencia']) ?></h5>
									</td>
									<td>
										<h5><?php $mensage = $datos[$i]['diferencia'] > 0 ? $datos[$i]['diferencia'] . " <small>dias restantes</small>" : $mensage = $datos[$i]['diferencia'] == 0 ? "<small style='font-size:1em;color:#ed2e2e'>Ultimo dia</small>" : " Plazo terminado";
											echo $mensage; ?></h5>
									</td>
									<td <?php echo $datos[$i]['color']; ?>>
										<h5><?php echo $datos[$i]['mensaje']; ?></h5>
									</td>
									<td style="text-align:center">
										<h5><?php echo $datos[$i]['fecha_cite'] ?></h5>
									</td>
									<td style="vertical-align:middle;text-align:center">
										<a onclick="verAjax(<?php echo $datos[$i]['id'] ?>)" data-target="#verhojarutaModal" data-toggle="modal"><button title="ver hoja de ruta" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
										<a href="../crud/Createpdf.php/PrintHoja/<?php echo $datos[$i]['id'] ?>" target="_blank"><button title="imprimir hoja de ruta" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></a>
										<a href="../dist/archivos/<?php echo $datos[$i]['archivo'] ?>" target="_blank"><button title="ver archivo adjuntado" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-copy" aria-hidden="true"></span></button></a>
									</td>
								</tr>
								<?php $i++;
							endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<center>
				<a href="../crud/Createpdf.php/printmireportePDF/?inicio=<?php echo $data['inicio'] ?>&fin=<?php echo $data['fin'] ?>&id=<?php echo $data['id'] ?>&cite=<?php echo $data['cite'] ?>&seleccionado=<?php echo $data['seleccionado'] ?>&remitente=<?php echo $data['remitente'] ?>&procedencia=<?php echo $data['procedencia'] ?>&adjunto=<?php echo $data['adjunto'] ?>&tipo=<?php echo $data['tipo'] ?>" target="_blank"><button title="imprimir reporte" type="button" class="btn btn-success btn-sm">IMPRIMIR REPORTE <span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></a>
			</center>
		</div>
	</section>
</div>

<style>
	.pdfobject-container {
		height: 50rem;
		border: 0.1rem solid #565555;
	}

	td>h5 {
		margin: 0
	}

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

	.tab-content {
		background: #fff;
	}

	.tab-menu {
		-webkit-box-sizing: border-box;
	}

	div.dataTables_wrapper div.dataTables_paginate {
		float: none;
		text-align: left
	}
</style>
<?php include 'modalverhojaRuta.php';
include 'modal_validarhoja.php'; ?>
<script>
	var prioridad_u, procedencia_u, tipo_u, adjunto_u, destino_u = [],
		accion_u = [],
		Get_ID = 0,
		estado_destino = false,
		estado_accion = false;
	$(document).ready(function() {
		var seleccionado = getUrlParameter('seleccionado');
		$('#selectseleccion_s option[value="' + seleccionado + '"]').attr('selected', 'selected');

		if (seleccionado == "proceso" || seleccionado == "revisado" || seleccionado == "norevisado") {
			$('.select2[name="id"]').show();
		} else {
			$('.select2[name="' + $('#selectseleccion_s option:selected').attr('value') + '"]').show();
		}
		var seltipo = getUrlParameter('tipo') == undefined ? "" : getUrlParameter('tipo');
		var seladjunto = getUrlParameter('adjunto') == undefined ? "" : getUrlParameter('adjunto');
		var selprocedencia = getUrlParameter('procedencia') == undefined ? "" : getUrlParameter('procedencia');
		var selestado = getUrlParameter('estado') == undefined ? "" : getUrlParameter('estado');
		$('#selecttipo_s option[value="' + seltipo + '"]').attr('selected', 'selected');
		$('#selectadjunto_s option[value="' + seladjunto + '"]').attr('selected', 'selected');
		$('#selectprocedencia_s option[value="' + selprocedencia + '"]').attr('selected', 'selected');
		$('#selectestado_s option[value="' + selestado + '"]').attr('selected', 'selected');
		$('#example1').DataTable({
			"order": [
				[0, "desc"]
			],
			"dom": '<"top"f>t<"bottom"p>'
		});
		$('#selectseleccion_s').change(function() {
			$('.select2').hide();
			if ($('#selectseleccion_s option:selected').attr('value') == "proceso" || $('#selectseleccion_s option:selected').attr('value') == "revisado" || $('#selectseleccion_s option:selected').attr('value') == "norevisado") {
				$('.select2[name="id"]').show();
			} else {

				$('.select2[name="' + $('#selectseleccion_s option:selected').attr('value') + '"]').show();
			}
		});
		$('#inputvalidarhoja').keyup(function() {
			if ($(this).val().trim().length > 4) {
				$("#btn_validarhoja").attr('disabled', false);
			}else{
				$("#btn_validarhoja").attr('disabled', true);
			}
		});
		$('#inputvalidarhoja_u').keyup(function() {
			if ($(this).val().trim().length > 4) {
				$("#btn_validarhoja_u").attr('disabled', false);
			}else{
				$("#btn_validarhoja_u").attr('disabled', true);
			}
		});
		$('#btn_validarhoja').click(function() {
			console.log('click');
			
			var parametros = new FormData($('#formvalidarhoja')[0]);
			console.log(parametros);
			$.ajax({
				data: parametros,
				url: '../crud/ViewData.php/recepcionar/'+Get_ID,
				type: 'POST',
				contentType: false,
				processData: false,
				
				success: function(obj) {
					if (JSON.parse(obj) == "ok") {
						swal("Mensaje de Alerta!", "La Hoja de Ruta se Recepciono Satisfactoriamente", "success");
						setInterval(function() {
							location.reload();
						}, 1000);
					} else {
						swal("Mensaje de Alerta!", "La hoja de ruta No se Recepciono debido a un problema de conexion: " + obj, "error");
						setInterval(function() {
							location.reload();
						}, 1000);
					}
				}
				
			});
		});
		$('#btn_validarhoja_u').click(function() {
			var parametros = new FormData($('#formvalidarhoja_u')[0]);
			$.ajax({
				data: parametros,
				url: '../crud/ViewData.php/modificar_recepcionar/'+Get_ID,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function(obj) {
					if (JSON.parse(obj) == "ok") {
						swal("Mensaje de Alerta!", "La Hoja de Ruta se Recepciono Satisfactoriamente", "success");
						setInterval(function() {
							location.reload();
						}, 1000);
					} else {
						swal("Mensaje de Alerta!", "La hoja de ruta No se Recepciono debido a un problema de conexion: " + obj, "error");
						setInterval(function() {
							location.reload();
						}, 1000);
					}
				}
			});
		});
	});

	function verAjax(val) {
		$.ajax({
			url: '../crud/ViewData.php/verHoja/' + val,
			type: 'get',
			success: function(obj) {
				var hoja = JSON.parse(obj),arrayaccion = hoja.accion,arraydestino = hoja.destino,ejecucion=true,validaotro=false,mifila=0;
				console.log(hoja);
				Get_ID = hoja.id;
				$('#seccion_accion,#seccion_destino,#navrecorrido').empty();
				//MOSTRAR INFORMACION GENERAL
				if (hoja.permiso == "") {$('#row_admin').show();$('.vcir').text(hoja.fecha);$('.vnombrer').text(hoja.usuario.toLowerCase() + " (" + hoja.cedula + ")");$('.vnombreu').text(hoja.modificado == " " ? ("Hoja de Ruta no modificada") : (hoja.modificado.toLowerCase()));$('.vfechau').text(hoja.fecha_update == null ? ("sin fecha") : (hoja.fecha_update));} else {$('#row_admin').hide();}
				$('.vnombre').text(hoja.remitente.toLowerCase());$('.vcite').text(hoja.cite);
				$('.vtramite').text(hoja.tramite);$('.vprocedencia').text(hoja.procedencia.toLowerCase());
				$('.vplazo').text(hoja.plazo + " Dias");$('.vprioridad').text(hoja.prioridad);
				$('.vfecha').text(hoja.fecha_cite);$('.vestado').text(hoja.estado == 1 ? ('Activo') : ('Dado de Baja'));
				$('.vobservacion span').text(hoja.referencia.toLowerCase());

				//MOSTAR PESTAÑA DE DESTINOS
				$('#seccion_destino').append('<div class="hedding-title">' + hoja.fecha.substring(0, 10) + '</div>');
				for (var i = 0; i < arraydestino.length; i++) {
					if (arraydestino[i].destino_id == hoja.midestino) {
						mifila=i;validaotro=true;
						if (parseInt(hoja.diferencia) >= 0) {
							if (arraydestino[i].usuario_id == null) {
								botonvalidar='<button class="btn btn-sm btn_validar_proceso" type="button" data-target="#modalvalidarhoja" data-toggle="modal">REVISAR HOJA <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
							}else{
								if (arraydestino[i].estado == 'revisado') {
									botonvalidar='<button class="btn btn-sm btn_validar_success">REVISADO <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>';
								}else{
									if (arraydestino[i].respuesta!=null) {
										botonvalidar='<button class="btn btn-xs btn_validar_proceso" type="button" data-target="#modalvalidarhoja_u" data-toggle="modal">MODIFICAR RESPUESTA <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
										$('#inputvalidarhoja_u').val(arraydestino[i].observacion);
										$('#observacion_superior').html('<strong>OBSERVACION: </strong>'+arraydestino[i].respuesta);
									}
								}
							}
						} else {
							if (arraydestino[i].usuario_id == null) {
								botonvalidar='<button class="btn btn-sm btn_validar_error">NO REVISADO <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
							}else{
								botonvalidar='<button class="btn btn-sm btn_validar_success">REVISADO <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>';
							}
						}
					}else{
						botonvalidar='';
					}
					if (arraydestino[i].estado == 'revisado') {
						if (validaotro && (mifila+1)==i) {
							botonvalidar='<button class="btn btn-xs btn_validar_success">validado <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>';
						}
						var tipo = 'form-steps__item--completed';
						var usuario = arraydestino[i].usuario.toLowerCase();
						var fecha = arraydestino[i].fecha;
						var status = "RECEPCIONADO";
						var color = "terminado";
						var observacion = arraydestino[i].observacion;
						if (validaotro && arraydestino[i].archivo!=null) {
							observacion=observacion+' <a href="../dist/respuestas/'+arraydestino[i].archivo+'" target="_blank">(Archivo Adjunto)</a>'
						}
					}else{
						if (parseInt(hoja.diferencia) >= 0) {
							if(ejecucion){
								var tipo = 'form-steps__item--proceso';
								var color = "proceso";
								ejecucion=false;
								if (arraydestino[i].usuario_id==null) {
									var status = "EN PROCESO";
									var fecha = "FECHA: en ejecucion ...";
									var usuario = "USUARIO: en ejecucion ...";
									var observacion = "OBSERVACIONES: en ejecucion ...";
								}else{
									var status = "RECEPCIONADO";
									var fecha = arraydestino[i].fecha;
									var usuario = arraydestino[i].usuario.toLowerCase();
									var observacion = arraydestino[i].observacion;
									if (validaotro && arraydestino[i].archivo!=null) {
										observacion=observacion+' <a href="../dist/respuestas/'+arraydestino[i].archivo+'" target="_blank">(Archivo Adjunto)</a>'
									}
								}
								if (validaotro && (mifila+1)==i) {
									if (arraydestino[i].usuario_id!=null && arraydestino[i].respuesta==null) {
										botonvalidar='<button class="btn btn-xs btn_validar_success"  onclick="validateaprobadoAjax('+arraydestino[i].id+')">validar <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button><button class="btn btn-xs btn_validar_error" onclick="validateAjax('+arraydestino[i].id+')">rechazar <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
									}
								}
							}else{
								var tipo = '';
								var usuario = "USUARIO: Aun no se recepciono";
								var fecha = "FECHA: A la espera";
								var status = "ESPERA";
								var color = "espera";
								var observacion = "OBSERVACION: En Espera";
							}
							
						} else {
							var tipo = 'form-steps__item--nocompleted';
							var usuario = "Hoja de Ruta no recepcionada";
							var fecha = "Sin fecha";
							var status = "NO RECEPCIONADO";
							var color = "error";
							var observacion = "No Fue Recepcionado";
						}
					}
					
					if (i == 0) {
						$('#navrecorrido').append('<div class="form-steps__item ' + tipo + '"><div class="form-steps__item-content"><span class="form-steps__item-icon">0' + (i + 1) + '</span><span class="form-steps__item-text">' + arraydestino[i].nombre.toUpperCase() + '</span></div></div>');
					} else {
						$('#navrecorrido').append('<div class="form-steps__item ' + tipo + '"><div class="form-steps__item-content"><span class="form-steps__item-icon">0' + (i + 1) + '</span><span class="form-steps__item-line"></span><span class="form-steps__item-text">' + arraydestino[i].nombre.toUpperCase() + '</span></div></div>');
					}
					$('#seccion_destino').append('<div class="timeline-article content-right-container ' + color + '"><div class="meta-date"></div><div class="content-box  row row-eq-height"><div class="col-md-2 colorside" height="100%"><h1>' + ((i) + 1) + '<small></br>' + status + '</small></h1></div><div class="col-md-10 title-description"><h1>' + arraydestino[i].nombre.toUpperCase()+ botonvalidar+ '</h1><h5><img> ' + usuario + '</h5><h5><img> ' + fecha + '</h5><h5><img> ' + observacion + '</h5></div></div></div>');
				}
				var theDate = new Date(hoja.fecha.substring(0, 4), hoja.fecha.substring(5, 7), hoja.fecha.substring(8, 10));
				var myNewDate = new Date(theDate);
				myNewDate.setDate(myNewDate.getDate() + parseInt(hoja.plazo));
				var mes = myNewDate.getMonth() > 9 ? (myNewDate.getMonth()) : ("0" + myNewDate.getMonth());
				var dia = myNewDate.getDate() > 9 ? (myNewDate.getDate()) : ("0" + myNewDate.getDate());
				$('#seccion_destino').append('<div class="hedding-title" style="margin-top:25px">' + myNewDate.getFullYear() + "-" + mes + "-" + dia + '</div>');

				//MOSTRAR PESTAÑA GENERAL
				$('.vtipo').text(hoja.tipo.toLowerCase());$('.vhojas').text(hoja.num_hojas + " hojas");
				$('.vadjunto').text(hoja.adjunto.toLowerCase());$('.varchivo').text(hoja.archivo);
				//MOSTRAR PESTAÑA DE ACCIONES
				for (var i = 0; i < arrayaccion.length; i++) {var check = arrayaccion[i].estado == "1" ? ("checkedok") : ("nochecked");$('#seccion_accion').append('<h5 class="col-md-4" style="margin:3px 0 3px 0;font-style: italic"><img src="../pages/images/' + check + '.png" style="margin-right:10px;height:24px">' + arrayaccion[i].nombre + '</h5>');}
				//MOSTRAR PESTAÑA DE VER ARCHIVO
				PDFObject.embed("../dist/archivos/" + hoja.archivo, "#archivopdf");
			}
		});
	}

	function validateAjax(id) {
		$('#verhojarutaModal').modal('toggle');
		console.log('vamos a rechazar'+id);
		swal({
			title: "Recharar Respuesta",
			text: "Detalle el motivo para poder subsanar los errores ",
			type: "input",
			input: 'text',
			showCancelButton: true,
			confirmButtonColor: "#ff0101",
			confirmButtonText: "Recharar respuesta!",
			inputPlaceholder: "Detalle una observacion",
			closeOnConfirm: false,
			showLoaderOnConfirm: true
		}, function(inputValue) {
			if (inputValue === false) {
				$('#verhojarutaModal').modal('toggle');
				return false
			};
			if (inputValue === "") {
				swal.showInputError("campo obligatorio!");
				return false
			} else {
				$.ajax({
					url: '../crud/ViewData.php/revisar_hoja/'+id,
					type: 'POST',
					data: {
						"observacion": inputValue
					},
					success: function(obj) {
						if (JSON.parse(obj) == "ok") {
							swal("Mensaje de Alerta!", "La Hoja de Ruta se Recepciono Satisfactoriamente", "success");
							setInterval(function() {
								location.reload();
							}, 1000);
						} else {
							swal("Mensaje de Alerta!", "La hoja de ruta No se Recepciono debido a un problema de conexion: " + obj, "error");
							setInterval(function() {
								location.reload();
							}, 1000);
						}
					}
				});
			}
		});
	}
	function validateaprobadoAjax(id) {
		$('#verhojarutaModal').modal('toggle');
		console.log("vamos a aprovar"+id);
		$.ajax({
			url: '../crud/ViewData.php/revisar_hoja/'+id,
			type: 'GET',
			success: function(obj) {
				if (JSON.parse(obj) == "ok") {
					swal("Mensaje de Alerta!", "La Hoja de Ruta se Recepciono Satisfactoriamente", "success");
					setInterval(function() {
						location.reload();
					}, 1000);
				} else {
					swal("Mensaje de Alerta!", "La hoja de ruta No se Recepciono debido a un problema de conexion: " + obj, "error");
					setInterval(function() {
						location.reload();
					}, 1000);
				}
			}
		});	
	}
	function getUrlParameter(sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName, i;
		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : sParameterName[1];
			}
		}
	};
	function displayPreview(files,estado) {
		var etiqueta="";
		if (!estado) {
			var etiqueta="_u"
		}
		var filename = $("#chooseFile"+etiqueta).val();
		if (files.length > 0) {
			fileSize = Math.round(files[0].size / 1024);
			if (fileSize > 0 && fileSize < 2048 && files[0].type == "application/pdf") {
				$(".file-upload").addClass('active');
				$("#noFile"+etiqueta).text(filename.replace("C:\\fakepath\\", ""));
			} else {
				$(".file-upload").removeClass('active');
				$("#noFile"+etiqueta).text("Tamaño maximo de 2mb (no soportado)");
			}
		} else {
			$(".file-upload").removeClass('active');
			$("#noFile"+etiqueta).text("Ningun archivo seleccionado...");
		}

	}
</script>
<!-- /.content-wrapper -->
<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 2.4.0
	</div>
	<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>

<!-- Control de configuracion de pagina -->
<div class="control-sidebar-bg"></div>
</div>
<!-- Control de modalaes -->
<?php include('includes/modales.php'); ?>
<!-- Control de configuracion de pie de de js pagina -->
<?php include('includes/pie.php'); ?>