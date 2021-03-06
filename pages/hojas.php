<?php include("includes/header.php");$permiso=0;
  	foreach($funciones as $key => $value){
    	if ($value==13) {$permiso=1;}
  	}
  	if($permiso==0){?><script>window.location.href = "404.php";</script><?php } include("includes/aside.php");include("../crud/ListPOO.php");
  	$listPOO = new ListPOO;
	$data = $listPOO->listHojaRuta();
	$datos = $data['hoja'];
?> 
<div class="content-wrapper">
	<section class="content">
		<div class="row">
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
					<select name="proveido" id="selectproveido_s" class="form-control select2" style="width:80%;display:none">
						<?php
						$consul = pg_query("SELECT * FROM destinos");
						while ($proveido = pg_fetch_array($consul)) {
							echo "<option value='$proveido[id]'>$proveido[nombre]</option>";
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
						<option value="proveido">Proveido</option>
						<option value="adjunto">Adjuntos</option>
						<option value="tipo">Tipo de Documento</option>
						<option value="revisado">Recepcionados</option>
						<option value="proceso">En Proceso</option>
						<option value="norevisado">No Revisados</option>
					</select>
				</div>
				<button type="submit" class="btn btn-warning" name="buscar">Buscar <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				<div class="btn-group btn-group-sm">
					<a href="../crud/Createpdf.php/PrintHojas/all/?inicio=<?php echo $data['inicio'] ?>&fin=<?php echo $data['fin'] ?>&id=<?php echo $data['id'] ?>&cite=<?php echo $data['cite'] ?>&seleccionado=<?php echo $data['seleccionado'] ?>&remitente=<?php echo $data['remitente'] ?>&proveido=<?php echo $data['proveido'] ?>&procedencia=<?php echo $data['procedencia'] ?>&adjunto=<?php echo $data['adjunto'] ?>&tipo=<?php echo $data['tipo'] ?>" target="_blank"><button title="imprimir hojas de ruta" type="button" class="btn btn-danger btn-xs">PDF</button></a>
					<a href="../crud/Createpdf.php/PrintexcelHojas/all/?inicio=<?php echo $data['inicio'] ?>&fin=<?php echo $data['fin'] ?>&id=<?php echo $data['id'] ?>&cite=<?php echo $data['cite'] ?>&seleccionado=<?php echo $data['seleccionado'] ?>&remitente=<?php echo $data['remitente'] ?>&proveido=<?php echo $data['proveido'] ?>&procedencia=<?php echo $data['procedencia'] ?>&adjunto=<?php echo $data['adjunto'] ?>&tipo=<?php echo $data['tipo'] ?>" target="_blank"><button title="imprimirreporte en EXCEL" type="button" class="btn btn-success btn-xs">XLS</button></a>
					<a href="../crud/Createpdf.php/PrintwordHojas/all/?inicio=<?php echo $data['inicio'] ?>&fin=<?php echo $data['fin'] ?>&id=<?php echo $data['id'] ?>&cite=<?php echo $data['cite'] ?>&seleccionado=<?php echo $data['seleccionado'] ?>&remitente=<?php echo $data['remitente'] ?>&proveido=<?php echo $data['proveido'] ?>&procedencia=<?php echo $data['procedencia'] ?>&adjunto=<?php echo $data['adjunto'] ?>&tipo=<?php echo $data['tipo'] ?>" target="_blank"><button title="imprimirreporte en WORD" type="button" class="btn btn-primary btn-xs">DOC</button></a>
				</div>
			</form>
		</div>
		<div class="box" style="margin:0">
			<div class="box-body">
				<div class="table-responsive">
					<table id="table_data" class="table dataTable table-striped table-bordered table-condensed">
						<thead>
							<tr>
								<th width="5%">N°</th>
								<th width="20%">Remitente</th>
								<th width="20%">Procedencia</th>
								<th width="15%">Proveido</th>
								<th width="10%">Plazo</th>
								<th width="8%">Estado</th>
								<th width="8%">Fecha</th>
								<th width="3%">Ver</th>
								<th width="3%">Imp</th>
								<th width="3%">Arc</th>
								<th width="3%">Edi</th>
								<th width="3%">Eli</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0;
							while ($i < count($datos)) : ?>
								<tr>
									<td class="text-center"><h5>0<?=$datos[$i]['id'] ?></h5></td>
									<td><h5><?=strtolower($datos[$i]['remitente'])?></h5></td>
									<td><h5><?=strtolower($datos[$i]['procedencia'])?></h5></td>
									<td><h5><?=strtolower($datos[$i]['proveido'])?></h5></td>
									<td><h5><?php $mensage = $datos[$i]['diferencia'] > 0 ? $datos[$i]['diferencia'] . " <small>dias restantes</small>" : $mensage = $datos[$i]['diferencia'] == 0 ? "<small style='font-size:1em;color:#ed2e2e'>Ultimo dia</small>" : " Plazo terminado";echo $mensage?></h5></td>
									<td <?=$datos[$i]['color']?>><h5><?=$datos[$i]['mensaje']?></h5></td>
									<td class="text-center"><h5><?=date('d-m-Y', strtotime($datos[$i]['fecha']))?></h5></td>
									<td class="td_btn"><a onclick="verAjax(<?=$datos[$i]['id'] ?>)" data-target="#verhojarutaModal" data-toggle="modal"><button title="ver hoja de ruta" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a></td>
									<td class="td_btn"><a href="../crud/Createpdf.php/PrintHoja/<?=$datos[$i]['id'] ?>" target="_blank"><button title="imprimir hoja de ruta" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></a></td>
									<td class="td_btn"><?php echo $datos[$i]['archivo']==null? '<button class="btn bg-gray-active btn-xs" disabled><span class="glyphicon glyphicon-copy"></span></button></td>': '<a href="../dist/archivos/'.$datos[$i]["archivo"].'" target="_blank"><button title="ver archivo adjuntado" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-copy" aria-hidden="true"></span></button></a>'?></td>
									<td class="td_btn">
										<a onclick="updateAjax(<?=$datos[$i]['id'] ?>)" data-target="#updatehoja_modal" data-toggle="modal"><button title="editar hoja de ruta" type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
									</td>
									<td class="td_btn">
										<a onclick="Eliminarhoja(<?=$datos[$i]['id']?>)"><button title="eliminar hoja de ruta" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
									</td>
										
								</tr>
								<?php $i++;
							endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-12" style="margin:10px">
					<center>
						<a href="../crud/Createpdf.php/printreportePDF/?inicio=<?php echo $data['inicio'] ?>&fin=<?php echo $data['fin'] ?>&id=<?php echo $data['id'] ?>&cite=<?php echo $data['cite'] ?>&seleccionado=<?php echo $data['seleccionado'] ?>&remitente=<?php echo $data['remitente']?>&proveido=<?php echo $data['proveido']?>&procedencia=<?php echo $data['procedencia'] ?>&adjunto=<?php echo $data['adjunto'] ?>&tipo=<?php echo $data['tipo'] ?>" target="_blank"><button title="imprimir reporte" type="button" class="btn btn-success btn-sm">IMPRIMIR REPORTE <span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></a>
					</center>
				</div>
			</div>
			
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
<?php include 'modalverhojaRuta.php'; ?>
<script>
	var prioridad_u, procedencia_u, tipo_u, adjunto_u, destino_u = [],
		destino_old_u = [],
		accion_u = [],
		Get_ID = 0,
		nuevos_destinos = [];nuevos_proveidos = [];FILE_STATUS = true;FILE_STATUS_RESPUESTA = true;
	$(document).ready(function() {
		$('.title_page').text('Administrar Hojas de Ruta');
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
		var selproveido = getUrlParameter('proveido') == undefined ? "" : getUrlParameter('proveido');
		var selestado = getUrlParameter('estado') == undefined ? "" : getUrlParameter('estado');
		$('#selecttipo_s option[value="' + seltipo + '"]').attr('selected', 'selected');
		$('#selectadjunto_s option[value="' + seladjunto + '"]').attr('selected', 'selected');
		$('#selectprocedencia_s option[value="' + selprocedencia + '"]').attr('selected', 'selected');
		$('#selectproveido_s option[value="' + selproveido + '"]').attr('selected', 'selected');
		$('#selectestado_s option[value="' + selestado + '"]').attr('selected', 'selected');
		$('#table_data').DataTable({
			"order": [
				[0, "desc"]
			],
			"dom": "<'row'<'col-sm-6'B><'col-sm-6'>f>" + "<'row'<'col-sm-12't>>" + "<'row'<'col-sm-12'p>>",
			"buttons": [{
					text: 'Nueva Hoja de Ruta',
					className: 'btn btn-primary',
					action: function ( e, dt, node, config ) {
						$('#modal_hoja').modal('show')
					}
				}
			],
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			},
			"aoColumns": [
				null,null,null,null,null,null,null,
				{ "orderSequence": [ "" ] },{ "orderSequence": [ "" ] },
				{ "orderSequence": [ "" ] },{ "orderSequence": [ "" ] },{ "orderSequence": [ "" ] }
			]
		});
		$('#selectseleccion_s').change(function() {
			$('.select2').hide();
			if ($('#selectseleccion_s option:selected').attr('value') == "proceso" || $('#selectseleccion_s option:selected').attr('value') == "revisado" || $('#selectseleccion_s option:selected').attr('value') == "norevisado") {
				$('.select2[name="id"]').show();
			} else {

				$('.select2[name="' + $('#selectseleccion_s option:selected').attr('value') + '"]').show();
			}
		});

		$('#datetimepicker1').datetimepicker({
			locale: 'es',
			format: 'YYYY-MM-DD',
			ignoreReadonly: true
		});
		$('#datetimepicker1_u').datetimepicker({
			locale: 'es',
			format: 'YYYY-MM-DD',
			ignoreReadonly: true
		}).on('dp.change', function(e) {
			function_validate('false');
		});
		$('#inputremitente,#inputremitente_u,#inputcargoremitente,#inputcargoremitente_u,#inputreferencia,#inputreferencia_u').keyup(function() {
			if ($(this).val().trim().length > 1) {
				small_error($(this).attr('toggle'), true);
			} else {
				small_error($(this).attr('toggle'), false);
			}
			function_validate($(this).attr('validate'));
		});
		$('#inputproveido,#inputproveido_u').keyup(function() {
			if ($(this).val().trim().length > 1) {
				small_error($(this).attr('toggle'), true);
			} else {
				small_error($(this).attr('toggle'), false);
			}
			function_validate($(this).attr('validate'));
		});
		$('#inputhoja,#inputhoja_u,#inputplazo,#inputplazo_u').keypress(function(e) {
			yes_number(e);
		}).keyup(function() {
			if (parseInt($(this).val()) > 0) {
				small_error($(this).attr('toggle'), true);
			} else {
				small_error($(this).attr('toggle'), false);
			}
			function_validate($(this).attr('validate'));
		});
		$('#inputcite,#inputcite_u').keyup(function() {
			if ($(this).val().trim().length > 1) {
				small_error($(this).attr('toggle'), true);
			} else {
				small_error($(this).attr('toggle'), false);
			}
			function_validate($(this).attr('validate'));
		});

		$('#btnregistrar_hoja').click(function() {
			var parametros = new FormData($('#form_createhoja')[0]);
			$.ajax({
				data: parametros,
				url: '../crud/UpdatePOO.php/createHoja/',
				type: "POST",
				contentType: false,
				processData: false,
				success: function(obj) {
					if (obj == "true") {
						swal("Mensaje de Alerta!", "La Hoja de Ruta Se Registro Satisfactoriamente", "success");
						setInterval(function() {
							location.reload();
						}, 1500);
					} else {
						swal("Mensaje de Alerta!", "Ocurrio un problema en el registro!!", "error");
					}
				}
			});
		});
		$('#btnupdate_hoja').click(function() {
			var parametros = new FormData($('#form_updatehoja')[0]);cambiosDestinos();
			var accion = [],
				values = $('#selectaccion_u').val();
			for (var i = 0; i < accion_u.length; i++) {
				var aux = 0;
				for (var j = 0; j < values.length; j++) {
					if (values[j] == accion_u[i]) {
						aux++;
					}
				}
				if (aux == 0) {
					parametros.append('accion_u[]', JSON.stringify({
						'id': accion_u[i],
						'estado': false
					}));
					accion.push({
						id: accion_u[i],
						estado: false
					});
				}
			}
			for (var j = 0; j < values.length; j++) {
				aux = 0;
				for (var i = 0; i < accion_u.length; i++) {
					if (values[j] == accion_u[i]) {
						aux++;
					}
				}
				if (aux == 0) {
					parametros.append('accion_u[]', JSON.stringify({
						'id': values[j],
						'estado': true
					}));
					accion.push({
						id: values[j],
						estado: true
					});
				}
			}
			if (nuevos_destinos.length != destino_u.length) {
				if (nuevos_destinos.length > destino_u.length) {
					for (var i = 0; i < nuevos_destinos.length; i++) {
						if (i < destino_u.length) {
							if (nuevos_destinos[i] == destino_u[i]) {
								parametros.append('destinos[]', JSON.stringify({
									'id': nuevos_destinos[i],
									'proveido':nuevos_proveidos[i],
									'estado': 'verdad'
								}));
							} else {
								parametros.append('destinos[]', JSON.stringify({
									'id': nuevos_destinos[i],
									'proveido':nuevos_proveidos[i],
									'estado': 'falso'
								}));
							}
						} else {
							parametros.append('destinos[]', JSON.stringify({
								'id': nuevos_destinos[i],
								'proveido':nuevos_proveidos[i],
								'estado': 'nuevo'
							}));
						}
					}
				} else {
					for (var i = 0; i < destino_u.length; i++) {
						if (i < nuevos_destinos.length) {
							if (nuevos_destinos[i] == destino_u[i]) {
								parametros.append('destinos[]', JSON.stringify({
									'id': nuevos_destinos[i],
									'proveido':nuevos_proveidos[i],
									'estado': 'verdad'
								}));
							} else {
								parametros.append('destinos[]', JSON.stringify({
									'id': nuevos_destinos[i],
									'proveido':nuevos_proveidos[i],
									'estado': 'falso'
								}));
							}
						} else {
							parametros.append('destinos[]', JSON.stringify({
								'id': destino_u[i],
								'proveido':nuevos_proveidos[i],
								'estado': 'eliminar'
							}));
						}
					}
				}
			} else {
				for (var i = 0; i < nuevos_destinos.length; i++) {
					if (nuevos_destinos[i] == destino_u[i]) {
						parametros.append('destinos[]', JSON.stringify({
							'id': nuevos_destinos[i],
							'proveido':nuevos_proveidos[i],
							'estado': 'verdad'
						}));
					} else {
						parametros.append('destinos[]', JSON.stringify({
							'id': nuevos_destinos[i],
							'proveido':nuevos_proveidos[i],
							'estado': 'falso'
						}));
					}
				}
			}
			for (var j = 0; j < destino_old_u.length; j++) {
				parametros.append('id_hojadestino[]', JSON.stringify(destino_old_u[j]));
			}
			parametros.append('id_hoja', Get_ID);
			$.ajax({
				data: parametros,
				url: '../crud/UpdatePOO.php/updateHoja/',
				type: "POST",
				contentType: false,
				processData: false,
				success: function(obj) {
					if (obj == "ok") {
						swal("Mensaje de Alerta!", "La Hoja de Ruta Se Registro Satisfactoriamente", "success");
						setInterval(function() {
							location.reload();
						}, 1500);
					} else {
						swal("Mensaje de Alerta!", "Ocurrio un problema en la actualizacion!!", "error");
					}
				}
			});
		});

		$("#selectaccion").change(function() {
			if ($(this).val() != null) {
				$('#rowaccionerror').removeClass('has-error').addClass('has-success');
			}else{
				$('#rowaccionerror').removeClass('has-success').addClass('has-error');
			}
			function_validate('true');
		});
		$("#selectdestinos").change(function() {
			function_validate('true');
		});
		$('#tabledestino_registro').on('click', '.up', function() {
			var $row = $(this).parents('tr');
			if ($row.index() === 1) return; // Don't go above the header
			$row.prev().before($row.get(0));
		});
		$('#tabledestino_registro').on('click', '.down', function() {
			var $row = $(this).parents('tr');
			$row.next().after($row.get(0));
		});
		$('#selectdestinos').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
			var sel_multi = document.getElementById('selectdestinos');
			if (isSelected) {
				$('#tabledestino_registro').append('<tr class="fila' + sel_multi.options[clickedIndex].value + '"><td style="border: 1px solid black;margin-right:5px"><input type="hidden" name="destino[]" value="' + sel_multi.options[clickedIndex].value + '">' + sel_multi.options[clickedIndex].text + '</td><td style="border: 1px solid black;margin-right:5px"><input type="text" class="form-control" name="proveidos[]" placeholder="describa una descripcion"></td><td style="border: 1px solid black;text-align:center"><a class="up" style="margin-right:5px"><span class="glyphicon glyphicon-menu-up"></span></a><a class="down"><span class="glyphicon glyphicon-menu-down"></span></a></td></tr>');
			} else {
				$('#tabledestino_registro .fila' + sel_multi.options[clickedIndex].value).remove();
			}
		});

		$('#tabledestino_update').on('click', '.up', function() {
			var $row = $(this).parents('tr');
			if ($row.index() === 1) return; // Don't go above the header
			$row.prev().before($row.get(0));
		});
		$('#tabledestino_update').on('click', '.down', function() {
			var $row = $(this).parents('tr');
			$row.next().after($row.get(0));
		});
		$('#selectdestinos_u').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
			var sel_multi = document.getElementById('selectdestinos_u');
			if (isSelected) {
				$('#tabledestino_update').append('<tr class="fila' + sel_multi.options[clickedIndex].value + '"><td style="border: 1px solid black;margin-right:5px"><input type="hidden" value="' + sel_multi.options[clickedIndex].value + '">' + sel_multi.options[clickedIndex].text + '</td><td style="border: 1px solid black;margin-right:5px"><input type="text" class="form-control" name="proveidos[]" placeholder="describa una descripcion"></td><td style="border: 1px solid black;text-align:center"><a class="up" style="margin-right:5px"><span class="glyphicon glyphicon-menu-up"></span></a><a class="down"><span class="glyphicon glyphicon-menu-down"></span></a></td></tr>');
			} else {
				$('#tabledestino_update .fila' + sel_multi.options[clickedIndex].value).remove();
			}
		});
		//$("#selectdestinos_u").change(function(){});
		$("#selectaccion_u").change(function() {
			if ($(this).val() != null) {
				$('#rowaccionerror_u').removeClass('has-error').addClass('has-success');
			}else{
				$('#rowaccionerror_u').removeClass('has-success').addClass('has-error');
			}
			function_validate('false');
		});
		$("#selectprioridad_u,#selectprocedencia_u,#selecttipo_u,#selectadjunto_u").change(function() {
			function_validate('false');
		});
	});

	function verAjax(val) {
		$.ajax({
			url: '../crud/ViewData.php/verHoja/' + val,
			type: 'get',
			success: function(obj) {
				var hoja = JSON.parse(obj),arrayaccion = hoja.accion,arraydestino = hoja.destino,ejecucion=true;
				console.log(hoja);
				Get_ID = hoja.id;
				$('#seccion_accion,#seccion_destino,#navrecorrido').empty();

				//MOSTRAR INFORMACION GENERAL
				if (hoja.permiso == "") {$('#row_admin').show();$('.vcir').text(hoja.fecha);$('.vnombrer').text(hoja.usuario.toLowerCase() + " (" + hoja.cedula + ")");$('.vnombreu').text(hoja.modificado == " " ? ("Hoja de Ruta no modificada") : (hoja.modificado.toLowerCase()));$('.vfechau').text(hoja.fecha_update == null ? ("sin fecha") : (hoja.fecha_update));} else {$('#row_admin').hide();}
				$('.vnombre').text(hoja.remitente.toLowerCase());$('.vcite').text(hoja.cite);
				$('.vproveido').html("<br>"+hoja.proveido.toLowerCase());
				$('.vtramite').text(hoja.tramite);$('.vprocedencia').text(hoja.procedencia.toLowerCase());
				$('.vplazo').text(hoja.plazo + " Dias");$('.vprioridad').text(hoja.prioridad);
				$('.vfecha').text(hoja.fecha_cite);$('.vestado').text(hoja.estado == 1 ? ('Activo') : ('Dado de Baja'));
				$('.vobservacion span').text(hoja.referencia.toLowerCase());

				//MOSTAR PESTAÑA DE DESTINOS
				$('#seccion_destino').append('<div class="hedding-title">' + hoja.fecha.substring(0, 10) + '</div>');
				for (var i = 0; i < arraydestino.length; i++) {
					if (arraydestino[i].estado == 'revisado') {
						var tipo = 'form-steps__item--completed';
						var usuario = arraydestino[i].usuario.toLowerCase();
						var fecha = arraydestino[i].fecha;
						var status = "RECEPCIONADO";
						var color = "terminado";
						var observacion = arraydestino[i].observacion;
						if (arraydestino[i].archivo!=null) {
							observacion=observacion+' <a href="../dist/respuestas/'+arraydestino[i].archivo+'" target="_blank">(Archivo Adjunto)</a>'
						}
					}else{
						if (parseInt(hoja.diferencia) >= 0) {
							if(ejecucion){
								var tipo = 'form-steps__item--proceso';
								var color = "proceso";
								var status = "EN PROCESO";
								var fecha = "FECHA: en ejecucion ...";
								var usuario = "USUARIO: en ejecucion ...";
								var observacion = "OBSERVACIONES: en ejecucion ...";
								ejecucion=false;								
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
					$('#seccion_destino').append('<div class="timeline-article content-right-container ' + color + '"><div class="meta-date"></div><div class="content-box  row row-eq-height"><div class="col-md-2 colorside" height="100%"><h1>' + ((i) + 1) + '<small></br>' + status + '</small></h1></div><div class="col-md-10 title-description"><h1>' + arraydestino[i].nombre.toUpperCase() + '</h1><h5><img> ' + usuario + '</h5><h5><img> ' + fecha + '</h5><h5><img> ' + observacion + '</h5></div></div></div>');
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

	function updateAjax(val) {
		$.ajax({
			url: '../crud/ViewData.php/verHoja/' + val,
			type: 'get',
			success: function(obj) {
				$('#tabledestino_update').empty();
				$("#btnupdate_hoja").attr('disabled', false);
				$('#idgeneral_u,#iddocumento_u,#iddestinos_u').html('<span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span>').css('background','#00a65a');
				small_error(".fila1_u", true);
				small_error(".fila2_u", true);
				small_error(".fila3_u", true);
				small_error(".fila4_u", true);
				small_error(".fila6_u", true);
				small_error(".fila7_u", true);small_error(".fila8_u", true);
				accion_u = [], destino_u = [];
				var data = JSON.parse(obj);
				Get_ID = data.id;
				$('#datetimepicker1_u input').val(data.fecha_cite);
				$('#datetimepicker1_u input').attr('placeholder', data.fecha_cite);
				$('#inputremitente_u').val(data.remitente.toLowerCase());
				$('#inputremitente_u').attr('placeholder', data.remitente.toLowerCase());
				$('#inputcargoremitente_u').val(data.cargo_remitente.toLowerCase());
				$('#inputcargoremitente_u').attr('placeholder', data.cargo_remitente.toLowerCase());
				$('#inputcite_u').val(data.cite.toLowerCase());
				$('#inputcite_u').attr('placeholder', data.cite.toLowerCase());
				$('#inputreferencia_u').val(data.referencia.toLowerCase());
				$('#inputreferencia_u').attr('placeholder', data.referencia.toLowerCase());
				$('#inputproveido_u').val(data.proveido.toLowerCase());
				$('#inputproveido_u').attr('placeholder', data.proveido.toLowerCase());
				$('#inputhoja_u').val(data.num_hojas);
				$('#inputhoja_u').attr('placeholder', data.num_hojas);
				$('#inputplazo_u').val(data.plazo);
				$('#inputplazo_u').attr('placeholder', data.plazo);
				$('#inputfile_u').val("");

				prioridad_u = data.prioridad;
				procedencia_u = data.procedencia_id;
				tipo_u = data.tipo_id;
				adjunto_u = data.adjunto_id;
				$('#selectprioridad_u').selectpicker('val', prioridad_u);
				$('#selectprocedencia_u').selectpicker('val', procedencia_u);
				$('#selecttipo_u').selectpicker('val', tipo_u);
				$('#selectadjunto_u').selectpicker('val', adjunto_u);
				$("#selectprioridad_u,#selectprocedencia_u,#selecttipo_u,#selectadjunto_u").selectpicker('refresh');

				$('#selectdestinos_u,#selectaccion_u').selectpicker('val', '');
				$("#selectdestinos_u,#selectaccion_u").selectpicker('refresh');
				var i = 0;
				while (i < data.destino.length) {
					proveidos=data.destino[i].proveido==null ? "":data.destino[i].proveido
					$('#tabledestino_update').append('<tr class="fila' + data.destino[i].destino_id + '"><td style="border: 1px solid black;margin-right:5px"><input type="hidden" value="' + data.destino[i].destino_id + '">' + data.destino[i].nombre.toUpperCase() + '</td><td style="border: 1px solid black;margin-right:5px"><input type="text" class="form-control" name="proveidos[]" placeholder="describa una descripcion" value="' + proveidos + '"></td><td style="border: 1px solid black;text-align:center"><a class="up" style="margin-right:5px"><span class="glyphicon glyphicon-menu-up"></span></a><a class="down"><span class="glyphicon glyphicon-menu-down"></span></a></td></tr>');
					destino_u.push(data.destino[i].destino_id);
					destino_old_u.push(data.destino[i].id);
					i++;
				}
				i = 0;
				while (i < data.accion.length) {
					if (data.accion[i].estado == 1) {
						accion_u.push(data.accion[i].id);
					}
					i++;
				}
				$('#selectdestinos_u').selectpicker('val', destino_u);
				$('#selectaccion_u').selectpicker('val', accion_u);
				$("#selectdestinos_u,#selectaccion_u").selectpicker('refresh');
			}
		});
	}

	function function_validate(validate) {
		if (validate != "false" && validate == "true") {
			if($('#general_modal .has-error').length>0){
				$('#idgeneral').text($('#general_modal .has-error').length).css('background','red');
			}else{
				$('#idgeneral').html('<span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span>').css('background','#00a65a');
			}
			if($('#documento_modal .has-error').length>0){
				$('#iddocumento').text($('#documento_modal .has-error').length).css('background','red');
			}else{
				$('#iddocumento').html('<span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span>').css('background','#00a65a');
			}
			if($('#destino_modal .has-error').length>0){
				$('#iddestinos').text($('#destino_modal .has-error').length).css('background','red');
			}else{
				$('#iddestinos').html('<span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span>').css('background','#00a65a');
			}
			if (($('.fila1').hasClass('has-success')) && ($('.fila2').hasClass('has-success')) && ($('.fila3').hasClass('has-success')) && ($('.fila4').hasClass('has-success')) && FILE_STATUS && ($('.fila6').hasClass('has-success')) && ($('.fila7').hasClass('has-success')) && ($('.fila8').hasClass('has-success')) && ($('#selectprocedencia').val() != null) && ($('#selecttipo').val() != null) && ($('#selectadjunto').val() != null) && ($('#selectaccion').val() != null)) {
				$("#btnregistrar_hoja").attr('disabled', false);
			} else {
				$("#btnregistrar_hoja").attr('disabled', true);
			}
		} else {
			if($('#general_modal_u .has-error').length>0){
				$('#idgeneral_u').text($('#general_modal_u .has-error').length).css('background','red');
			}else{
				$('#idgeneral_u').html('<span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span>').css('background','#00a65a');
			}
			if($('#documento_modal_u .has-error').length>0){
				$('#iddocumento_u').text($('#documento_modal_u .has-error').length).css('background','red');
			}else{
				$('#iddocumento_u').html('<span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span>').css('background','#00a65a');
			}
			if($('#destino_modal_u .has-error').length>0){
				$('#iddestinos_u').text($('#destino_modal_u .has-error').length).css('background','red');
			}else{
				$('#iddestinos_u').html('<span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span>').css('background','#00a65a');
			}
			if ($('.fila1_u').hasClass('has-success') && $('.fila2_u').hasClass('has-success') && $('.fila3_u').hasClass('has-success') && ($('.fila4_u').hasClass('has-success')) && FILE_STATUS_RESPUESTA && ($('.fila6_u').hasClass('has-success')) && ($('.fila7_u').hasClass('has-success')) && ($('.fila8_u').hasClass('has-success')) && ($('#selectprocedencia_u').val() != null) && ($('#selecttipo_u').val() != null) && ($('#selectadjunto_u').val() != null) && ($('#selectaccion_u').val() != null)) {
				$("#btnupdate_hoja").attr('disabled', false);
			} else {
				$("#btnupdate_hoja").attr('disabled', true);
			}
		}
	}

	function displayPreview(files,etiqueta,estado) {
		if (files.length > 0) {
			fileSize = Math.round(files[0].size / 1024);
			if (fileSize > 0 && fileSize < 2048) {
				$(etiqueta).addClass('hidden');
				if(estado){
					FILE_STATUS = true;
				}else{
					FILE_STATUS_RESPUESTA = true;
				}
			} else {
				$(etiqueta).removeClass('hidden');
				if(estado){
					FILE_STATUS = false;
				}else{
					FILE_STATUS_RESPUESTA = false;
				}
			}
		} else {
			$(etiqueta).removeClass('hidden');
			if(estado){
				FILE_STATUS = true;
			}else{
				FILE_STATUS_RESPUESTA = true;
			}
		}
	}
	//evalua dos arrays si son iguales
	function evaluar_twoarrays(array1, array2) {
		aux = 0;
		if (array1.length > 0) {
			if (array1.length == array2.length) {
				for (var i = 0; i < array2.length; i++) { //[1,2,3]
					for (var j = 0; j < array1.length; j++) { //[2,3,4]
						if (array1[j] == array2[i]) {
							aux++;
						}
					}
				}
				if (aux != array2.length) {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
	//evalua 2 arrays si son iguales en tamaño y orden
	function evaluar_twoarrays2(array1, array2) {
		aux = 0;
		if (array1.length > 0) {
			if (array1.length == array2.length) {
				for (var i = 0; i < array2.length; i++) { //[1,2,3] [1,2,3]
					if (array1[i] != array2[i]) {
						aux++;
					}
				}
				if (aux == 0) {
					return false;
				} else {
					return true;
				}
			} else {
				return true;
			}
		} else {
			return false;
		}
	}

	function validateAjax() {
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere Recepcionar la Hoja de Ruta?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#06c17e",
			confirmButtonText: "Recepcionar Hoja de Ruta!",
			closeOnConfirm: false
		}, function() {
			$.ajax({
				url: '../crud/ViewData.php/recepcionar/' + Get_ID,
				type: 'get',
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

	function cambiosDestinos() {
		var oTable = document.getElementById('tabledestino_update').rows;
		var rows = [];
		nuevos_destinos = [];
		nuevos_proveidos = [];
		for (var i = 0; i < oTable.length; i++) {
			rows.push(oTable[i]);
		}
		for (i = 0; i < rows.length; i++) {
			nuevos_destinos.push(rows[i].getElementsByTagName('td')[0].getElementsByTagName('input')[0].value);
			nuevos_proveidos.push(rows[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0].value);
		}

	}
	function Eliminarhoja(id) {
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere Eliminar la Hoja de Ruta?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#ff5456",
			confirmButtonText: "Eliminar Hoja de Ruta!",
			closeOnConfirm: false
		}, function() {
			$.ajax({
				url: '../crud/ViewData.php/eliminar_hoja/' + id,
				type: 'get',
				success: function(obj) {
					if (obj == "ok") {
						swal("Mensaje de Alerta!", "La Hoja de Ruta se Elimino Satisfactoriamente", "success");
						setInterval(function() {
							location.reload();
						}, 1000);
					} else {
						swal("Mensaje de Alerta!", "La hoja de ruta No se Elimino debido a un problema de conexion: " + obj, "error");
					}
				}
			});
		});

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