<?php include("includes/header.php"); ?>
<?php include("includes/aside.php"); ?>
<?php include("../crud/ListPOO.php");
$listPOO = new ListPOO;
$data = $listPOO->listPeticion();
$enviado = $data['enviado'];
$recibido = $data['recibido']; ?>

<div class="content-wrapper">
	<section class="content">
		<div class="box" style="margin:0">
			<div class="box-body">
				<ul role="tablist" style="padding:0px;" class="nav nav-tabs nav-justified">
					<li role="presentation" class="active"><a style="padding:0 15px 0 15px" href="#enviados" aria-controls="enviados" role="tab" data-toggle="tab">ENVIADOS<h5 class="badge" style="background:#3c8dbc;margin-left:10px"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></h5></a></li>
					<li role="presentation"><a style="padding:0 15px 0 15px" href="#recibidos" aria-controls="recibidos" role="tab" data-toggle="tab">RECIBIDOS<h5 class="badge" style="background:#3c8dbc;margin-left:10px"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></h5></a></li>
				</ul>
				<div class="row">
					<div class="row tab-content" style="margin:0px;padding:20px">
						<div id="enviados" role="tabpanel" class="tab-pane active">
							<div class="table-responsive">
								<table id="table_data" class="table dataTable table-striped table-bordered table-condensed" width="100%">
									<thead>
										<tr>
											<td>id</td>
											<td>Descripción</td>
											<td>Fecha</td>
											<td>Destino</td>
											<td>Respuesta</td>
											<td>Fecha Respuesta</td>
											<td>eli</td>
										</tr>
									</thead>
									<tbody>
										<?php while ($row = pg_fetch_assoc($enviado)) :?>
											<tr class="<?=$row['respuesta_descripcion']==null?"danger":"success"?>">
												<td class="text-center">
													<h5>0<?= $row['id'] ?></h5>
												</td>
												<td>
													<h5><?php echo strtolower($row['descripcion']);
														echo $row['archivo'] != null ? '<a href="../dist/archivos/' . $row["archivo"] . '" target="_blank"> <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></a>' : "" ?></h5>
												</td>
												<td>
													<h5><?= $row['fecha'] ?></h5>
												</td>
												<td>
													<h5><?= $row['respuesta_destino'] == null ? "en espera" : strtolower($row['respuesta_destino']) ?></h5>
												</td>
												<td>
													<h5><?php echo $row['respuesta_descripcion']==null ? "en espera":strtolower($row['respuesta_descripcion']);
														echo $row['respuesta_archivo'] != null ? '<a href="../dist/archivos/' . $row["respuesta_archivo"] . '" target="_blank"> <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></a>' : "" ?></h5>
												</td>
												
												<td>
													<h5><?= $row['respuesta_fecha'] == null ? "en espera" : $row['respuesta_fecha'] ?></h5>
												</td>
												<td class="td_btn"><button title="eliminar petición" onclick="EliminarPeticion(<?=$row['id']?>)" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div id="recibidos" role="tabpanel" class="tab-pane">
							<div class="table-responsive">
								<table id="table_data2" class="table dataTable table-striped table-bordered table-condensed" width="100%">
									<thead>
										<tr>
											<td>id</td>
											<td>Descripción</td>
											<td>Fecha</td>
											<td>Origen</td>
											<td>Respuesta</td>
											<td>Fecha Respuesta</td>
											<td>eli</td>
										</tr>
									</thead>
									<tbody>
										<?php while ($row = pg_fetch_assoc($recibido)) : ?>
											<tr class="<?=$row['respuesta_descripcion']==null?"danger":"success"?>">
												<td class="text-center">
													<h5>0<?= $row['id'] ?></h5>
												</td>
												<td>
													<h5><?php echo strtolower($row['descripcion']); echo $row['archivo'] != null ? '<a href="../dist/archivos/' . $row["archivo"] . '" target="_blank"> <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></a>' : "" ?></h5>
												</td>
												<td>
													<h5><?= $row['fecha'] ?></h5>
												</td>
												<td>
													<h5><?= $row['respuesta_destino'] == null ? "en espera" : strtolower($row['destino']) ?></h5>
												</td>
												<td>
													<h5><?php echo $row['respuesta_descripcion'] == null ? "en espera" : strtolower($row['respuesta_descripcion']); echo $row['respuesta_archivo'] != null ? '<a href="../dist/archivos/' . $row["respuesta_archivo"] . '" target="_blank"> <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></a>' : "" ?></h5>
												</td>
												<td>
													<h5><?= $row['respuesta_fecha'] == null ? "en espera" : $row['respuesta_fecha'] ?></h5>
												</td>
												<td class="td_btn"><button title="responder petición" onclick="ResponderPeticion(<?= $row['id'] ?>)" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
</div>
<style>
	div.dataTables_wrapper div.dataTables_paginate {
		float: none;
		text-align: left
	}
</style>
<?php include 'modalnuevapeticion.php';include 'modalresponderpeticion.php'; ?>
<script>
	var Get_ID = 0,FILE_STATUS = true;FILE_STATUS_RESPUESTA = true;
	$(document).ready(function() {
		$('.title_page').text('Lista de Peticion de Información');
		$('#table_data').DataTable({
			"order": [
				[0, "desc"]
			],
			"dom": "<'row'<'col-sm-6'B><'col-sm-6'>f>" + "<'row'<'col-sm-12't>>" + "<'row'<'col-sm-12'p>>",
			"buttons": [{
				text: 'Nueva Peticion',
				className: 'btn bg-purple',
				action: function(e, dt, node, config) {
					$('#modal_pedido').modal('show')
				}
			}],
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			},
			"aoColumns": [
				null, null, null, null, null, null,
				{
					"orderSequence": [""]
				}
			]
		});
		$('#table_data2').DataTable({
			"order": [
				[0, "desc"]
			],
			"dom": "<'row'<'col-sm-6'><'col-sm-6'>f>" + "<'row'<'col-sm-12't>>" + "<'row'<'col-sm-12'p>>",
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			},
			"aoColumns": [
				null, null, null, null, null, null,
				{
					"orderSequence": [""]
				}
			]
		});
		$("#btnnueva_peticion").click(function(e) {
			var valid = this.form.checkValidity();
			$("#valid").html(valid);
			if (valid) {
				e.preventDefault();
				if (FILE_STATUS) {
					var parametros = new FormData($('#form_peticion')[0]);
					$.ajax({
						data: parametros,
						url: '../crud/UpdatePOO.php/createPeticion/',
						type: "POST",
						contentType: false,
						processData: false,
						success: function(obj) {
							var res = JSON.parse(obj);
							if (res == "false") {
								swal("Mensaje de Alerta!", "La peticion no se envio.. Vuelva a intentarlo!", "error");
								setInterval(function() {
									location.reload();
								}, 1500);
							} else {
								swal("Mensaje de Alerta!", "La petición se envio Satisfactoriamente", "success");
								setInterval(function() {
									location.reload();
								}, 1500);
							}
						}
					});
				}
			}
		});
		$("#btnresponder_peticion").click(function(e) {
			var valid = this.form.checkValidity(); 
			$("#valid").html(valid);
			if (valid) {
				e.preventDefault();
				if (FILE_STATUS_RESPUESTA) {
					var parametros = new FormData($('#form_respuesta_peticion')[0]);
					parametros.append('id', Get_ID);
					$.ajax({
						data: parametros,
						url: '../crud/UpdatePOO.php/responderPeticion/',
						type: "POST",
						contentType: false,
						processData: false,
						success: function(obj) {
							var res = JSON.parse(obj);
							console.log(res);
							if (res == "false") {
								swal("Mensaje de Alerta!", "La peticion no se respondio.. Vuelva a intentarlo!", "error");
								setInterval(function() {
									location.reload();
								}, 1500);
							} else {
								swal("Mensaje de Alerta!", "Se respondio la petición Satisfactoriamente", "success");
								setInterval(function() {
									location.reload();
								}, 1500);
							}
						}
					});
				}
			}
		});
	});
	function verAjax(val) {
		console.log(val);
		Get_ID = val;
	}
	function displayPreview(files,etiqueta,estado) {
		if (files.length > 0) {
			fileSize = Math.round(files[0].size / 1024);
			if (fileSize > 0 && fileSize < 2048 && files[0].type == "application/pdf") {
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
	function EliminarPeticion(id) {
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere Eliminar Petición?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#ff5456",
			confirmButtonText: "Eliminar Petición!",
			closeOnConfirm: false
		}, function() {
			$.ajax({
				url: '../crud/ViewData.php/eliminar_peticion/' + id,
				type: 'get',
				success: function(obj) {
					if (obj == "ok") {
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
	function ResponderPeticion(id) {
		Get_ID=id;
		$('#modal_respuesta_pedido').modal('show')
	}
</script>
</div>
<?php include('includes/pie.php');?>