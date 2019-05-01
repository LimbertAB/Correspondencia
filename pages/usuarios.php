<?php include("includes/header.php"); ?>
<?php include("includes/aside.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if(isset($_GET['registrar'])){?>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form id="frmusuario">
              <div class="box-body" style="background: #fff;">
                <input type="hidden"  name="usu" value="algo">
                <div class="form-group has-feedback  has-error fila1" style="padding:5px">
                  <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRES</label>
                  <input type="text" name="nom_usu" id="inputnombre" class="form-control" validate="true" toggle=".fila1" placeholder="Ejemplo: Alejandra">
                  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback  has-error fila2" style="padding:5px">
                  <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">APELIDOS</label>
                  <input type="text" name="ape_usu" id="inputapellido" class="form-control" validate="true" toggle=".fila2" placeholder="Ejemplo: Torrez Ruiz">
                  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback  has-error fila3" style="padding:5px">
                  <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CEDULA DE IDENTIDAD</label>
                  <input type="text" name="ced_usu" id="inputci" class="form-control" validate="true" toggle=".fila3" placeholder="Ejemplo: 5570345">
                  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback has-error fila4" style="padding:5px">
                  <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRE DE USUARIO</label>
                  <input type="text" name="usu_usu" id="inputusuario" class="form-control" validate="true" toggle=".fila4" placeholder="Ejemplo: alejandra">
                  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                  <em style="color:#cf6666;display:none" id="error_registro_u">El nombre de usuario ya esta en uso!</em>
                </div>
                <div class="form-group has-feedback has-error fila5" style="padding:5px">
                  <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CONTRASEÑA</label>
                  <input type="password" name="pas_usu" autocomplete="false" autocorrect="off" class="form-control" id="inputpassword" validate="true" placeholder="Minimo 5 caracteres" toggle=".fila5">
                  <span toggle="#inputpassword" id="togglepassword_u" class="fa fa-fw fa-eye field-icon"></span>
                </div>
                <div class="form-group" style="padding:5px" id="ok_cargo15">
                  <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CARGO</label>
                  <div class='input-group'>
                    <select id="selectcargo" name="id_cargo" class="form-control selectpicker show-tick" data-live-search="true">
                      <?php $ejecute=pg_query("SELECT * FROM cargos");
                        while ($datos=pg_fetch_array($ejecute)) { ?>
                          <option value="<?php echo $datos['id'] ?>" data-subtext="<?php echo $datos['descripcion'];?>"><?php echo strtoupper($datos['nombre'])?></option>
                        <?php
                          }
                        ?>
                    </select>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  </div>
                </div>
                <div class="form-group" style="padding:5px" id="ok_cargo16">
                  <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">DESTINO</label>
                  <div class='input-group'>
                    <select id="selectdestino" name="id_destino" class="form-control selectpicker show-tick" data-live-search="true">
                      <?php
                        $ejecute=pg_query("SELECT * FROM destinos");
                        while ($datos=pg_fetch_array($ejecute)) {
                          ?>
                          <option value="<?php echo $datos['id'] ?>" data-subtext="<?php echo $datos['descripcion'];?>"><?php echo strtoupper($datos['nombre'])?></option>
                          <?php
                        }
                      ?>
                    </select>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-warning">
            <div class="box-footer" style="padding:20px">
              <a href="usuarios.php"><button class="btn bg-orange col-md-12" style="margin-top:0px">Cancelar</button></a>
              <button class="btn bg-navy col-md-12" style="margin-top:10px" id="btnregistrar" disabled onclick="reg_usuario()">Guardar Registro</button>
            </div>
          </div>  
        </div>
      </div>
    </section>
    <?php }else{?>
      <section class="content-header">
        <h1 style="font-weight:700;color: #525252;">LISTA DE USUARIOS</h1>
        <ol class="breadcrumb" style="padding-top:0">
          <li><a href="usuarios.php?registrar=true"><button type="button" class="btn bg-purple btn-sm">Registrar Nuevo Usuario</button></a></li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <table style="font-style: oblique;" id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr style="background:#a5a5a5">
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Cedula</th>
                      <th>Destino</th>
                      <th>Cargos</th>
                      <th width="3%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php
                  $ejecute=pg_query("SELECT u.*,c.nombre as cargo,d.nombre as destino FROM usuarios as u JOIN cargos as c ON c.id = u.id_cargo JOIN destinos as d ON d.id = u.id_destino");
                  while ($datos=pg_fetch_assoc($ejecute)) {
                    ?>
                    <tr>
                      <td style="padding: 2px 5px 2px 10px;}"><?php echo $datos['nombres'] ?></td>
                      <td style="padding: 2px 5px 2px 10px;}"><?php echo $datos['apellidos'] ?></td>
                      <td style="padding: 2px 5px 2px 10px;}"><?php echo $datos['cedula'] ?></td>
                      <td style="padding: 2px 5px 2px 10px;}"><?php echo $datos['destino'] ?></td>
                      <td style="padding: 2px 5px 2px 10px;}"><?php echo $datos['cargo'] ?></td>
                      <td style="padding: 2px 5px 2px 10px;}">
                        <center>
                          <button class="btn btn-info btn-xs" onclick="verUsuario(<?php echo $datos['id'];?>)" data-toggle="modal" data-target="#updateusuarioModal">Ver</button>
                        </center>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <center>
            <a href="../crud/Createpdf.php/printreporteusuarioPDF/all" target="_blank"><button title="imprimir reporte" type="button" class="btn btn-success btn-sm">IMPRIMIR REPORTE <span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></a>
          </center>
        </div>
      </section>
      <?php 	include 'includes/modales.php'; ?>
    <?php }?>
  </div>
  <script>
    var id_cargos_u=0,id_destinos_u=0,id_usuario=0;
    $(document).ready(function(){
      $('#example1').DataTable({
        "order": [
          [0, "desc"]
        ],
        "dom": '<"top"f>t<"bottom"p>'
		  });
      $("#togglepassword,#togglepassword_u").click(function() {
          $(this).toggleClass("fa-eye fa-eye-slash");
               var input = $($(this).attr("toggle"));
              if (input.attr("type") == "password") {
                    input.attr("type", "text");
               }else {
                    input.attr("type", "password");
          }
      });
      $('#inputnombre,#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>3){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
      $('#inputapellido,#inputapellido_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>3){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
      $('#inputusuario,#inputusuario_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>2){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		  $('#inputci,#inputci_u').keypress(function(e){yes_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		  $('#inputpassword,#inputpassword_u').keyup(function(){if($(this).val().trim().length>4){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
      $("#selectcargo_u,#selectdestino_u").change(function(){function_validate('false');});
      $("#selectcargo,#selectdestino").change(function(){function_validate('true');});

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
            cargo:$('#selectcargo_u option:selected').attr('value'),
            destino:$('#selectdestino_u option:selected').attr('value')},
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
    function verUsuario(val){
      $('#error_update').hide();
      $.ajax({
        url: '../crud/ViewData.php/verUser/'+val,
        type: 'get',
        success:function(obj){
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

          var i=0;id_cargos_u=data.id_cargo;id_destinos_u=data.id_destino;
          $('#selectcargo_u').selectpicker('val', id_cargos_u);
          $('#selectdestino_u').selectpicker('val', id_destinos_u);$("#selectcargo_u,#selectcargo_u").selectpicker('refresh');
          // id_lugar_u=data.id_lugar;id_cargo_u=data.id_cargo;id_user_u=data.id;id_tipo_u=data.tipo;psw_u=data.password;
        }
      });
    }
    function function_validate(validate){
			if(validate!="false"&&validate=="true"){
				if(($('.fila1').hasClass('has-success'))&&($('.fila2').hasClass('has-success'))&&($('.fila3').hasClass('has-success'))&&($('.fila4').hasClass('has-success'))&&($('.fila5').hasClass('has-success'))&&($('#selectcargo').val()!=null)&&($('#selectdestino').val()!=null)){
						$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
			}else{
				if($('.fila1_u').hasClass('has-success') && $('.fila2_u').hasClass('has-success') && $('.fila3_u').hasClass('has-success') && $('.fila4_u').hasClass('has-success')){
					if (($('#inputpassword_u').val().trim()=="") || ($('.fila3_u').hasClass('has-success'))) {

						if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) ||
              ($('#inputapellido_u').attr('placeholder')!=$('#inputapellido_u').val().trim().toLowerCase())  ||
              ($('#inputusuario_u').attr('placeholder')!=$('#inputusuario_u').val().trim().toLowerCase())  ||
              ($('#inputci_u').attr('placeholder')!=$('#inputci_u').val()) ||
              ($('#selectcargo_u option:selected').attr('value')!=id_cargos_u) ||
							($('#selectdestino_u option:selected').attr('value')!=id_destinos_u) ||
              ($('.fila5_u').hasClass('has-success'))
						){
							$("#buttonupdate").attr('disabled', false);
						}else{$("#buttonupdate").attr('disabled', true);}
					}else{$("#buttonupdate").attr('disabled', true);}
				}else{$("#buttonupdate").attr('disabled', true);}
			}
		}
  </script>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.

<!-- Control de configuracion de pie de de js pagina -->
<?php include('includes/pie.php'); ?>
  </footer>

  <!-- Control de configuracion de pagina -->
  <?php include('includes/config_pag.php'); ?>

  <div class="control-sidebar-bg"></div>
</div>
<!-- Control de modalaesggg -->
