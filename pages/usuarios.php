<?php include("includes/header.php"); ?>
<?php include("includes/aside.php"); ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="fab" data-target="#modal_usuario" data-toggle="modal"> + </div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tabla de usuarios
      </h1>
      
      
        <!-- /.modal -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table style="font-style: oblique;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th width="13%">Acciones</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Cedula</th>
                  <th>Usuario</th>
                  <th>Cargos</th>
                </tr>
                </thead>
                <tbody>
              <?php 
                $ejecute=pg_query("SELECT u.*,c.nombre as cargo,d.nombre as destino FROM usuarios as u JOIN cargos as c ON c.id = u.id_cargo JOIN destinos as d ON d.id = u.id_destino");
                while ($datos=pg_fetch_assoc($ejecute)) {
                  ?>
                  <tr>
                    <td>
                      <button class="btn btn-info btn-xs" onclick="verUsuario(<?php echo $datos['id'];?>)" data-toggle="modal" data-target="#updateusuarioModal">Ver</button>
                    </td>
                    <td><?php echo $datos['nombres'] ?></td>
                    <td><?php echo $datos['apellidos'] ?></td>
                    <td><?php echo $datos['cedula'] ?></td>
                    <td><?php echo $datos['usuario'] ?></td>
                    <td><?php echo $datos['cargo'] ?></td>
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
      <!-- /.row -->
    </section>
    <?php 	include 'includes/modales.php'; ?>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
  
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


