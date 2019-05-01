<?php include("includes/header.php");include("includes/aside.php"); ?>
<?php include("../crud/ListPOO.php");
$listPOO = new ListPOO;
$data = $listPOO->backoffice();
$datos = $data['miperfil'];?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content" style="padding:0 0 30px 0">
    <div class="row">
      <section class="col-lg-12" style="background:#3c8dbc">
        <div class="row">
          <div class="col-md-8" style="padding:0;">
            <!-- Widget: user widget style 1 -->

            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div>

              <!-- /.widget-user-image -->
              <h1 style="color:#fff;margin:60px 0 0 90px;font-weight:600">Bienvenido (a): <?=$datos['nombres']?></h1>
              <h3 style="color:#fff;margin:10px 0 100px 90px;font-weight:300">Al sistema de administración <br>de Correspondencias de la Casa <br>Nacional de la Moneda - Potosí</h3>
            </div>
            <!-- /.widget-user -->
          </div>
          <div class="col-md-4" style="padding:20px 30px 0 30px">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-aqua-active" style="background-color:#222d32 !important">
                <h3 class="widget-user-username"><?=$datos['nombres']." ".$datos['apellidos']?> <span class="glyphicon glyphicon-pencil" aria-hidden="true" style="font-size:.5em;cursor:pointer" data-target="#updateusuarioModal" data-toggle="modal"  onclick="verUsuario()"></span></h3>
                <h5 class="widget-user-desc"><?=$datos['cedula']?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="../pages/images/logo.jpg" alt="User Avatar">
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header" style="font-size:1em;font-weight:300"><?=$datos['usuario']?></h5>
                      <span class="description-text">USUARIO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header" style="font-size:1em;font-weight:300"><?=$datos['cargo']?></h5>
                      <span class="description-text">CARGO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header" style="font-size:1em;font-weight:300"><?=$datos['destino']?></h5>
                      <span class="description-text">DESTINO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
      </section>
    </div>
    <div class="row" style="margin:30px 30px 0 30px">
      <?php foreach ($funciones as $key => $value){if ($value == 2):?>
        <div class="col-lg-3 col-xs-6" style="padding:0;margin:0">
          <!-- small box -->
          <div class="small-box bg-aqua" style="padding:0;margin:0">
            <div class="inner">
              <h1 style="margin:0;padding:0;font-weight:600;font-size:4.5em;line-height:60px"><?=$data['usuarios']['total']?></h1>
              <p style="margin:0;font-weight:300">USUARIOS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="usuarios.php" class="small-box-footer">Más detalles... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endif;}?>
      <?php foreach ($funciones as $key => $value){if ($value == 3):?>
        <div class="col-lg-3 col-xs-6" style="padding:0;margin:0">
          <!-- small box -->
          <div class="small-box bg-navy" style="padding:0;margin:0">
            <div class="inner">
              <h1 style="margin:0;padding:0;font-weight:600;font-size:4.5em;line-height:60px"><?=$data['cargos']['total']?></h1>
              <p style="margin:0;font-weight:300">CARGOS</p>
            </div>
            <div class="icon">
              <i class="ion ion-briefcase"></i>
            </div>
            <a href="cargos.php" class="small-box-footer">Más detalles... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endif;}?>
      <?php foreach ($funciones as $key => $value){if ($value == 6):?>
        <div class="col-lg-3 col-xs-6" style="padding:0;margin:0">
          <!-- small box -->
          <div class="small-box bg-yellow" style="padding:0;margin:0">
            <div class="inner">
              <h1 style="margin:0;padding:0;font-weight:600;font-size:4.5em;line-height:60px"><?=$data['destinos']['total']?></h1>
              <p style="margin:0;font-weight:300">DESTINOS</p>
            </div>
            <div class="icon">
              <i class="ion ion-share"></i>
            </div>
            <a href="destinos.php" class="small-box-footer">Más detalles... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endif;}?>
      <?php foreach ($funciones as $key => $value){if ($value == 8):?>
        <div class="col-lg-3 col-xs-6" style="padding:0;margin:0">
          <!-- small box -->
          <div class="small-box bg-teal" style="padding:0;margin:0">
            <div class="inner">
              <h1 style="margin:0;padding:0;font-weight:600;font-size:4.5em;line-height:60px"><?=$data['procedencias']['total']?></h1>
              <p style="margin:0;font-weight:300">PROCEDENCIAS</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-home"></i>
            </div>
            <a href="procedencia.php" class="small-box-footer">Más detalles... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endif;}?>
      <?php foreach ($funciones as $key => $value){if ($value == 10):?>
        <div class="col-lg-3 col-xs-6" style="padding:0;margin:0">
          <!-- small box -->
          <div class="small-box bg-red" style="padding:0;margin:0">
            <div class="inner">
              <h1 style="margin:0;padding:0;font-weight:600;font-size:4.5em;line-height:60px"><?=$data['tipos']['total']?></h1>
              <p style="margin:0;font-weight:300">TIPO DOCUMENTO</p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="tipos.php" class="small-box-footer">Más detalles... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endif;}?>
      <?php foreach ($funciones as $key => $value){if ($value == 9):?>
        <div class="col-lg-3 col-xs-6" style="padding:0;margin:0">
          <!-- small box -->
          <div class="small-box bg-black" style="padding:0;margin:0">
            <div class="inner">
              <h1 style="margin:0;padding:0;font-weight:600;font-size:4.5em;line-height:60px"><?=$data['adjuntos']['total']?></h1>
              <p style="margin:0;font-weight:300">ADJUNTOS</p>
            </div>
            <div class="icon">
              <i class="ion ion-document"></i>
            </div>
            <a href="adjuntos.php" class="small-box-footer">Más detalles... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endif;}?>
      <?php foreach ($funciones as $key => $value){if ($value == 11):?>
        <div class="col-lg-3 col-xs-6" style="padding:0;margin:0">
          <!-- small box -->
          <div class="small-box bg-purple" style="padding:0;margin:0">
            <div class="inner">
              <h1 style="margin:0;padding:0;font-weight:600;font-size:4.5em;line-height:60px"><?=$data['acciones']['total']?></h1>
              <p style="margin:0;font-weight:300">ACCIONES</p>
            </div>
            <div class="icon">
              <i class="ion ion-navicon-round"></i>
            </div>
            <a href="acciones.php" class="small-box-footer">Más detalles... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endif;}?>
      <?php foreach ($funciones as $key => $value){if ($value == 4):?>
        <div class="col-lg-3 col-xs-6" style="padding:0;margin:0">
          <!-- small box -->
          <div class="small-box bg-orange" style="padding:0;margin:0">
            <div class="inner">
              <h1 style="margin:0;padding:0;font-weight:600;font-size:4.5em;line-height:60px"><?=$data['mishojas']['total']?></h1>
              <p style="margin:0;font-weight:300">HOJAS DE RUTA</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-browsers"></i>
            </div>
            <a href="mishojas.php" class="small-box-footer">Más detalles... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endif;}?>
    </div>
  </section>
</div>
<?php include 'modal_profile.php'; ?>
<script>
  var id_cargos_u=0,id_destinos_u=0,id_usuario=0;
  $(document).ready(function(){
      $("#togglepassword,#togglepassword_u").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        }else {
          input.attr("type", "password");
        }
      });
      $('#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>3){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate();});
      $('#inputapellido_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>3){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate();});
      $('#inputusuario_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>2){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate();});
		  $('#inputci_u').keypress(function(e){yes_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate();});
		  $('#inputpassword_u').keyup(function(){if($(this).val().trim().length>4){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate();});
      $('#buttonupdate').click(function(){
        var user=$('#inputusuario_u').val().trim().toLowerCase();
        if($('#inputusuario_u').attr('placeholder')==$('#inputusuario_u').val().trim().toLowerCase()){user="";}
        $.ajax({
          url: '../crud/UpdatePOO.php/updateUser/',
          type: 'post',
          data:{id:id_usuario,
            nombre:$('#inputnombre_u').val(),
            apellido:$('#inputapellido_u').val(),
            cedula:$('#inputci_u').val(),
            usuario:user,
            password:$('#inputpassword_u').val(),
            cargo:id_cargos_u,
            destino:id_destinos_u},
          success:function(obj){
            if(obj==false){
              swal("Mensaje de Alerta!", "Usuario no modificado. Ocurrio un Error Inesperado!", "error");
              setInterval(function(){ location.reload() }, 1500);
            }
            if(obj=="ok"){
              swal("Mensaje de Alerta!", "Usuario Modificado Satisfactoriamente!", "success");
              setInterval(function(){ location.reload() }, 1500);
            }
            if(obj=="duplicado"){
              $('#error_update').show();
            }
          }
        });
		  });
    });
  function verUsuario(){
      $('#error_update').hide();
      $.ajax({
        url: '../crud/ViewData.php/vermiperfil/0',
        type: 'get',
        success:function(obj){
          console.log(obj);
          
          $('#selectcargo_u').selectpicker('val', '');
          $('#selectdestino_u').selectpicker('val', '');
          $("#selectcargo_u,#selectdestino_u").selectpicker('refresh');

          var data = JSON.parse(obj);id_usuario=data.id;
          $('.unombre h5').html(data.nombres+"<br>"+data.apellidos);$('.unombre p').text(data.cedula);$('.ulogin').text(data.usuario);
          $('.ucargo').text(data.cargos);$('.udestino').text(data.destinos);

          $('#inputnombre_u').val(data.nombres.toLowerCase());$('#inputnombre_u').attr('placeholder',data.nombres.toLowerCase());
          $('#inputapellido_u').val(data.apellidos.toLowerCase());$('#inputapellido_u').attr('placeholder',data.apellidos.toLowerCase());
          $('#inputusuario_u').val(data.usuario.toLowerCase());$('#inputusuario_u').attr('placeholder',data.usuario.toLowerCase());
          $('#inputci_u').val(data.cedula);$('#inputci_u').attr('placeholder',data.cedula);
          $('#inputpassword_u').val("");$('#inputpassword_u').removeClass('has-success').addClass('has-error');
          id_cargos_u=data.id_cargo;id_destinos_u=data.id_destino;
        }
      });
    }
    function function_validate(){
				if($('.fila1_u').hasClass('has-success') && $('.fila2_u').hasClass('has-success') && $('.fila3_u').hasClass('has-success') && $('.fila4_u').hasClass('has-success')){
					if (($('#inputpassword_u').val().trim()=="") || ($('.fila3_u').hasClass('has-success'))) {

						if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) ||
              ($('#inputapellido_u').attr('placeholder')!=$('#inputapellido_u').val().trim().toLowerCase())  ||
              ($('#inputusuario_u').attr('placeholder')!=$('#inputusuario_u').val().trim().toLowerCase())  ||
              ($('#inputci_u').attr('placeholder')!=$('#inputci_u').val()) ||
              ($('.fila5_u').hasClass('has-success'))
						){
							$("#buttonupdate").attr('disabled', false);
						}else{$("#buttonupdate").attr('disabled', true);}
					}else{$("#buttonupdate").attr('disabled', true);}
				}else{$("#buttonupdate").attr('disabled', true);}
		}
</script>
<!-- Control de configuracion de pagina -->
<?php include('includes/config_pag.php'); ?>
<div class="control-sidebar-bg"></div>
</div>
<!-- Control de configuracion de pie de de js pagina -->
<?php include('includes/pie.php'); ?>