<?php include("includes/header.php"); ?>
<?php include("includes/aside.php"); ?> 
<?php include("../crud/ListPOO.php");$listPOO= new ListPOO; $data=$listPOO->listHojaRuta();$datos=$data['hoja'];
  ?> 
<!--Control de mensajes-->
  <?php 
  if (isset($_SESSION['mensaje'])) {
  ?>
  <script type="text/javascript">
    alert("<?php echo $_SESSION['mensaje'] ?>")
  </script>
  <?php
  unset( $_SESSION["mensaje"] );
  }
  ?>
  
<!--Fin de control de mensajes-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php if ($con_funciones==1){ ?>
    <div class="fab" data-target="#modal_hoja" data-toggle="modal"> + </div>
  <?php } ?>
  
    <section class="content">
      <div class="row">
      <div class="fab2"><a href="../crud/Createpdf.php/loadPDF/?inicio=<?php echo $data['inicio']?>&fin=<?php echo $data['fin']?>&estado=all&remitente=all" target="_blank" style="color:#ffcccc"><span class="glyphicon glyphicon-print" aria-hidden="true" style="font-size: 30px;text-align: center;vertical-align: top;padding-top: 9px;"></span></a></div>
<!--***************************************INICIO DE ASIGNAR ACCIONES***************************************-->
        <?php
          if (isset($_GET['asig_accion'])) {
          $ide=$_GET['asig_accion'];
          $sql="SELECT re.nombres as nom_remitente, re.apellidos as ape_remitente, ad.nombre as adjunto, ti.nombre as tipo, hd.id as ide, hd.estado, hd.observacion as obs,hd.fecha, de.nombre as destino, u.nombres as nom_usu, u.apellidos as ape_usu, ho.*
            FROM remitentes re, adjuntos ad, tipos ti, hoja_destino hd, destinos de, hojas ho, usuarios u
            WHERE re.id=ho.remitente_id AND ad.id=ho.adjunto_id AND ti.id=ho.tipo_id AND u.id=ho.usuario_id 
            AND hd.hoja_id=ho.id AND hd.destino_id=de.id AND ho.id=$ide order by ide asc";
          $ejecute=pg_query($sql);
          $ejecute2=pg_query($sql);
          $ejecute3=pg_query($sql);
          $cont=pg_num_rows($ejecute);
          $pos=1;
          while ($resp=pg_fetch_array($ejecute2)) {
            for ($i=0; $i < count($destinoss); $i++) { 
                if ($resp['destino']==$destinoss[$i]) {
                  ?>
                  <div style="margin-left: 10%;" class="col-md-9">
                <!-- Box Comment -->
                <div class="box box-widget"><!--Si quiero que este minimizado lo cambio a remove y el icono en fa-plus-->
                  <div class="box-header with-border">
                    <div class="box-tools">
                      <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                        <i class="fa fa-circle-o"></i></button>
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="box box-primary">
                  <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title">Formulario revisión a <b> <?php echo $resp['destino']; ?></b></h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form onsubmit="return false" action="return false" id="frmasigaccion<?php echo $pos ?>">
                    <div class="box-body">
                      <input type="hidden"  name="des_accion" value="2">
                      <input type="hidden" name="id" value="<?php echo $resp['ide'] ?>">
                    
                    <div class="col-md-6" id="ok_funcion2">
                      <label for="exampleInputPassword1">Acciones <?php echo $resp['ide']; ?></label><br>
                      <?php 
                      $f = array();
                      $a=pg_query("SELECT * FROM acciones");
                      $b=pg_query("SELECT * FROM acciones");
                      $accion=pg_query("SELECT accion_id FROM hoja_accion where hoja_id=$resp[ide]");
                         while ($accion_id=pg_fetch_array($accion)) {
                            $f[]=$accion_id['accion_id'];
                        }
                      $con=0;
                        if (count($f)>0) {
                          while ($datos=pg_fetch_array($a)) {
                            for ($i=0; $i < count($f); $i++) { 
                              if ($f[$i]==$datos['id']) {
                                  $con++;
                              }
                            }
                            if ($con>0) {
                                echo "<input type='checkbox' name='accion[]' value='$datos[id]' checked> $datos[nombre] <br>";
                            }
                            else{
                              echo "<input type='checkbox' name='accion[]' value='$datos[id]'> $datos[nombre] <br>";
                            }
                            $con=0;
                          }
                        }
                        else{
                          while ($acc=pg_fetch_array($b)) {
                            ?>
                            <input type="checkbox" value="<?php echo $acc['id'] ?>" name="accion[]">  <?php echo $acc['nombre'] ?><br>
                            <?php
                          }
                        }
                       ?>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Estado <?php echo $resp['estado'] ?></label>
                        <select class="form-control select2"  name="estado" data-placeholder="Seleccione varios opciones" style="width: 100%;">
                          <?php 
                          if ($resp['estado']=='revisado'){ ?>
                              <option value="revisado" selected="">REVISADO</option>
                          <?php }
                          else{ ?>
                              <option value="revisado">REVISADO</option>
                          <?php }
                          ?>
                          <?php 
                          if ($resp['estado']=='no revisado'){ ?>
                              <option value="no revisado" selected="">NO REVISADO</option>
                          <?php }
                          else{ ?>
                              <option value="no revisado">NO REVISADO</option>
                          <?php }
                          ?>
                          <?php 
                          if ($resp['estado']=='rechazado'){ ?>
                              <option value="rechazado" selected="">RECHAZADO</option>
                          <?php }
                          else{ ?>
                              <option value="rechazado">RECHAZADO</option>
                          <?php }
                          ?>
                          <?php 
                          if ($resp['estado']=='en proceso'){ ?>
                              <option value="en proceso" selected="">EN PROCESO...</option>
                          <?php }
                          else{ ?>
                              <option value="en proceso">EN PROCESO...</option>
                          <?php }
                          ?>
                        </select><br><br>
                      </div>
                      <div class="form-group">
                        <label>Observacion</label>
                        <textarea class="form-control" rows="5" name="observacion" id="observacion"><?php echo $resp['obs'] ?></textarea>
                      </div>
                      
                    </div>

                  </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="btn_reg_cargo" id="boton7" onclick="reg_asignar_accion(<?php echo $pos ?>)">Guardar datos</button>
                </div>
              </form>
            </div>
              </div>
              
            </div>
            <!-- /.box -->
          </div>
                  <?php
                }
            }
          ?>
            
        <?php
        $pos++;
          }
        }
        ?>
<!--***************************************FIN DE ASIGNAR ACCIONES***************************************-->
<!--***************************************INICIO DE ASIGNAR DESTINOS***************************************-->
        <?php
          if (isset($_GET['asig_dest'])) {
          $ide=$_GET['asig_dest'];
          $ejecute=pg_query("SELECT * FROM hojas where id=$ide");
          $resp=pg_fetch_array($ejecute);
        ?>
        <div style="margin-left: 10%;" class="col-md-9">
            <!-- Box Comment -->
            <div class="box box-widget">
              <div class="box-header with-border">
                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                    <i class="fa fa-circle-o"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="box box-primary">
              <div class="box-header with-border" style="text-align: center;">
                <h3 class="box-title">Formulario asignacion de destinos</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form onsubmit="return false" action="return false" id="frmasigdestino">
                <div class="box-body">
                  <input type="hidden"  name="hoja_destino" value="2">
                  <input type="hidden" name="id" value="<?php echo $resp['id'] ?>">
                
                <div class="col-md-6" id="ok_funcion2">
                  <label for="exampleInputPassword1">Destinos</label><br>
                  <?php 
                  $ejecute=pg_query("SELECT * FROM destinos");
                  while ($datos=pg_fetch_array($ejecute)) {
                    ?>
                      <input type="checkbox"  name="destino[]"  value="<?php echo $datos['id'] ?>">
                      <i><?php echo $datos['nombre'] ?></i><br>
                    <?php
                  }
                   ?>
                </div>
              </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="btn_reg_cargo" id="boton7" onclick="reg_asignar_destino()">Guardar datos</button>
                </div>
              </form>
            </div>
              </div>
              
            </div>
            <!-- /.box -->
          </div>
        <?php
          }
          ?>
<!--***************************************INICIO DE VER ESTADO DE RUTAS***************************************-->
          <?php
          if (isset($_GET['ver_estado'])) {
          $ide=$_GET['ver_estado'];
          $sql="SELECT re.nombres as nom_remitente, re.apellidos as ape_remitente, ad.nombre as adjunto, ti.nombre as tipo, hd.id as ide, hd.usuario_id as ide_usu, hd.estado, hd.observacion as obs,hd.fecha, de.nombre as destino, u.nombres as nom_usu, u.apellidos as ape_usu, ho.*
            FROM remitentes re, adjuntos ad, tipos ti, hoja_destino hd, destinos de, hojas ho, usuarios u
            WHERE re.id=ho.remitente_id AND ad.id=ho.adjunto_id AND ti.id=ho.tipo_id AND u.id=ho.usuario_id 
            AND hd.hoja_id=ho.id AND hd.destino_id=de.id AND ho.id=$ide order by ide asc";
          $ejecute=pg_query($sql);
          $ejecute2=pg_query($sql);
          $ejecute3=pg_query($sql);
          $resp=pg_fetch_array($ejecute);
        ?>
        <div class="col-md-12">
            <!-- Box Comment -->
            <div class="box box-widget">
              <div class="box-header with-border">
                <?php if ($con_funciones==1){ ?>
                  <a href="print/hoja.php?ide=<?php echo $ide ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Imprimir hoja</a>
                <?php } ?>
                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                    <i class="fa fa-circle-o"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove">CERRAR <i class="fa fa-times"></i> </button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive" ><style type="text/css">table,tr,th,td{border: #E4E3E3 1px solid;padding-left: 10px;}</style>
                  <table class="table-hover" width="100%">
                    <tr>
                      <th  rowspan="2" width="20%">
                      </th>
                      <th  colspan="3" rowspan="2"><h4 align="center">HOJA DE RUTA</h4></th>
                      <th width="20%">N° DE REGISTRO <br> <?php echo $resp['id'] ?></th>
                    </tr>
                    <tr>
                      <td >TRAMITE</td>
                    </tr>
                    <tr>
                      <td >PROCEDENCIA</td>
                      <td colspan="3"><?php echo $resp['procedencia'] ?></td>
                      <td >CITE</td>
                    </tr>
                    <tr>
                      <td >REMITENTE</td>
                      <td colspan="3"><?php echo "$resp[nom_remitente]"." $resp[ape_remitente]"; ?></td>
                      <td ></td>
                    </tr>
                    <tr>
                      <td >CARGO REMITENTE</td>
                      <td colspan="3"></td>
                      <td >FECHA Y HORA</td>
                    </tr>
                    <tr>
                      <td >ADJUNTOS</td>
                      <td colspan="3"><?php echo $resp['adjunto'] ?></td>
                      <td ></td>
                    </tr>
                    <tr>
                      <td >N° DE HOJAS</td>
                      <td colspan="3"><?php echo $resp['num_hojas'] ?></td>
                      <td ></td>
                    </tr>
                    <tr>
                      <td >TIPO DE DOCUMENTOS</td>
                      <td colspan="3"><?php echo $resp['tipo'] ?></td>
                      <td ></td>
                    </tr>
                    <tr>
                      <td >REFERENCIA</td>
                      <td colspan="4"><?php echo $resp['referencia'] ?></td>
                    </tr>
                    <tr>
                      <td  rowspan="2">AREA DE DESTINO</td>
                      <td width="40%" rowspan="2">
                        <?php
                        while ($resp2=pg_fetch_array($ejecute2)) {
                          echo "$resp2[destino] - ";
                        }
                         ?>
                      </td>
                      <td width="10%">NOMBRE</td>
                      <td colspan="2"></td>
                    </tr>
                    <tr>
                      <td >CARGO</td>
                      <td colspan="2"></td>
                    </tr>
                    <tr>
                      <td >GESTOR VC</td>
                      <td  colspan="4"><?php echo "$resp[nom_usu]"." $resp[ape_usu]" ?></td>
                    </tr>
                  </table>
                </div>
                <h3 align="center">ESTADO DE DESTINOS</h3>
                <?php
                while ($resp3=pg_fetch_array($ejecute3)) {
                  if ($resp3['estado']=="no revisado") {
                    $color="box box-warning box-solid";
                    $cargando="";
                    $icono="fa fa-hand-grab-o";
                  }
                  elseif ($resp3['estado']=="en proceso") {
                    $color="box box-default";
                    $cargando="<div class='overlay'>
                      <i class='fa fa-refresh fa-spin'></i>
                    </div>";
                    $icono="fa fa-hand-stop-o";
                  }
                  elseif ($resp3['estado']=="revisado") {
                    $color="box box-success box-solid";
                    $cargando="";
                    $icono="fa fa-thumbs-o-up";
                  }
                  elseif ($resp3['estado']=="rechazado") {
                    $color="box box-danger box-solid";
                    $cargando="";
                    $icono="fa fa-thumbs-o-down";
                  }
                  else{
                    echo "no existe";
                  }
                  ?>
                <div class="col-md-12">
                  <div class="<?php echo $color ?>">
                    <div class="box-header with-border">
                      <h3 class="box-title"><?php echo $resp3['destino'] ?></h3>

                      <div class="box-tools pull-right">
                        <?php $rev=pg_query("SELECT * FROM usuarios WHERE id=$resp3[ide_usu]");
                        $revisado_por=pg_fetch_array($rev); ?>
                        <?php echo $resp3['estado']."/"."$revisado_por[nombres] $revisado_por[apellidos]"; ?>
                        <button type="button" class="btn btn-box-tool" ><i class="<?php echo $icono ?>"></i></button>
                      </div>
                    </div>
                      <?php echo $cargando; ?>
                    <div class="box-body">
                      OBSERVACION.- <?php echo $resp3['obs'] ?>
                    </div>
                  </div>
                </div>
                  <?php
                } 
                 ?>
                
            </div>
            <!-- /.box -->
          </div>
        <?php
          }
         ?>
<!--***************************************FIN DE VER ESTADOS***************************************-->
<!--***************************************INICIO DE TABLA DE HOJAS DE RUTAS***************************************-->
  
  <div class="col-md-12 form-inline" >
    <h1 align="center" style="margin:0 0 20px 0;font-weight:600">HOJAS DE RUTA </h1>
    
    <form id="formsearch">
      fecha inicio : <input type="date" name="inicio" class="bg-info" value="<?php echo $data['inicio']?>">
      fecha fin : <input type="date" name="fin" value="<?php echo $data['fin']?>">
      estado : <select name="estados" class="form-control select2" data-placeholder="Seleccione un estado" style="width: 15%;">
        <option value="all" selected="">Ambos</option>
        <option value="1">Con estado</option>
        <option value="0">Sin estado</option>
      </select>
      remitente : <select name="remitentes" class="form-control select2" data-placeholder="Seleccione" style="width: 15%;">
        <option value="all">Todos</option>
        <?php
          $consul=pg_query("SELECT * FROM remitentes");
          while ($remitente=pg_fetch_array($consul)) {
            echo "<option value='$remitente[id]'>$remitente[nombres]</option>";
          } 
        ?>
      </select>
      <button type="submit" class="btn btn-info btn-sm" name="buscar">Buscar <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      
      </form>
          <div class="box">
            <div class="box-body">
              <table style="font-style: oblique;" id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr style="background:#313131;color:#fff">
                    <th width="8%">Acciones</th>
                    <th width="5%">N°</th>
                    <th>Estado</th>
                    <th>Procedencia</th>
                    <th>Remitente</th>
                    <th>Adjuntos</th>
                    <th>Tipo de documento</th>
                    <th>Numero de hojas</th>
                    <th>Referencias</th>
                    <th>fecha</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0;while($i<count($datos)):?>
                    <tr>
                      <?php if($con_funciones==1):?>
                        <td>
                          <div class='btn-group'>
                              <button data-toggle='dropdown' class='btn btn-primary dropdown-toggle'>
                                <i class='fa fa-cog fa-1x'></i>
                                <span class='caret'></span>
                              </button>
                              <ul class='dropdown-menu'>
                                <li ><a data-target="#verhojarutaModal" data-toggle="modal" onclick="verAjax(<?php echo $datos[$i]['id']?>)"><i class='fa fa-eye fa-1x'></i>Ver estado</a></li>
                                <li ><a href="../crud/Createpdf.php/PrintHoja/<?php echo $datos[$i]['id'] ?>" class="btn btn-default" target="_blank"><i class='fa fa-print fa-1x'></i>Imprimir</a></li>
                                <?php if($datos[$i]['estado']==0):?>
                                  <li><a href="#" data-toggle='modal' data-target='#editEsp' data-id_esp="<?php echo $dato[0]; ?>" data-nombre="<?php echo $dato[1];?>" data-sigla="<?php echo $dato[2];?>"><i class='fa fa-pencil fa-1x'></i> Editar</a></li>
                                <?php endif;?>
                              </ul>
                          </div>
                        </td>        
                      <?php else: ?>
                        <td>
                          <div class='btn-group'>
                              <button data-toggle='dropdown' class='btn btn-primary dropdown-toggle'>
                                <i class='fa fa-cog fa-1x'></i>
                                <span class='caret'></span>
                              </button>
                              <ul class='dropdown-menu'>
                              <li ><a data-target="#verhojarutaModal" data-toggle="modal" onclick="verAjax(<?php echo $datos[$i]['id']?>)" class="btn btn-default"><i class='fa fa-eye fa-1x'></i>Ver estado</a></li>
                              <li ><a href="../crud/Createpdf.php/PrintHoja/<?php echo $datos[$i]['id'] ?>" class="btn btn-default" target="_blank"><i class='fa fa-print fa-1x'></i>Imprimir</a></li>
                                <?php if($datos[$i]['estado']!=$datos[$i]['total']):?>
                                  <li><a href="hojas.php?asig_accion=<?php echo $datos[$i]['id'] ?>" class="btn btn-default"><i class='fa fa-pencil-square fa-1x'></i> Asignar accion</a></li>
                                <?php endif;?>
                              </ul>
                          </div>
                        </td>
                      <?php endif;?>
                      <td>00<?php echo $datos[$i]['id'] ?></td>
                      <td <?php echo $datos[$i]['estado']==$datos[$i]['total']?"bgcolor='#67FF99'" : "bgcolor='#f59a9a'";?>> <?php echo $datos[$i]['estado']==$datos[$i]['total']?"Completado" : "Sin Completar";?></td>
                      <td><?php echo strtolower($datos[$i]['procedencia'])?></td>
                      <td><?php echo strtolower($datos[$i]['remitente'])?></td>
                      <td><?php echo strtolower($datos[$i]['adjunto'])?></td>
                      <td><?php echo strtolower($datos[$i]['tipo'])?></td>
                      <td><?php echo $datos[$i]['num_hojas'] ?></td>
                      <td><?php echo strtolower($datos[$i]['referencia'])?></td>
                      <td><?php echo $datos[$i]['fecha'];$i++?></td>
                    </tr> 
                  <?php endwhile;?>
                </tbody>
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
    <!-- /.content -->
  </div>
  <style>
    .pdfobject-container { height: 50rem; border: 0.1rem solid ##565555;
     }
  </style>
  <?php include 'modalverhojaRuta.php'; ?>
  <script>
    var id_cargos_u=[],id_destinos_u=[],estado_cargo=false,estado_destino=false,id_usuario=0;
    $(document).ready(function(){
      $('#datetimepicker1').datetimepicker({
        locale: 'es',format: 'YYYY-MM-DD HH:mm:00',ignoreReadonly: true
      }).on('dp.change', function(e){ 
        validate_fecha("","true");
      });
      $('#inputprocedencia,#inputprocedencia_u,#inputreferencia,#inputreferencia_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>3){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
      $('#inputhoja,#inputhoja_u,#inputplazo,#inputplazo_u').keypress(function(e){yes_number(e);}).keyup(function(){if(parseInt($(this).val())>0){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		  $('#inputcite,#inputcite_u').keyup(function(){if($(this).val().trim().length>1){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
      $("#selectdestino_u").change(function(){estado_destino=evaluar_destinos();function_validate('false');});
      $("#selectdestinos").change(function(){function_validate('true');});
      
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
      $('#buttonupdate').click(function(){
        var cargos=[],values=$('#selectcargo_u').val();
        for (var i = 0; i < id_cargos_u.length; i++) {var aux=0;for (var j = 0; j < values.length; j++) {if(values[j]==id_cargos_u[i]){aux++;}}if(aux==0){cargos.push({id:id_cargos_u[i],estado:false});}}
        for (var j = 0; j < values.length; j++) {aux=0;for (var i = 0; i < id_cargos_u.length; i++) {if(values[j]==id_cargos_u[i]){aux++;}}if(aux==0){  cargos.push({id:values[j],estado:true});}}
        var destinos=[],values=$('#selectdestino_u').val();
        for (var i = 0; i < id_destinos_u.length; i++) {var aux=0;for (var j = 0; j < values.length; j++) {if(values[j]==id_destinos_u[i]){aux++;}}if(aux==0){destinos.push({id:id_destinos_u[i],estado:false});}}
        for (var j = 0; j < values.length; j++) {aux=0;for (var i = 0; i < id_destinos_u.length; i++) {if(values[j]==id_destinos_u[i]){aux++;}}if(aux==0){  destinos.push({id:values[j],estado:true});}}
        var user=$('#inputusuario_u').val().trim().toLowerCase();if($('#inputusuario_u').attr('placeholder')==$('#inputusuario_u').val().trim().toLowerCase()){user="";}
        $.ajax({
          url: '../crud/UpdatePOO.php/updateUser/',
          type: 'post',
          data:{id:id_usuario,
            nombre:$('#inputnombre_u').val(),
            apellido:$('#inputapellido_u').val(),
            cedula:$('#inputci_u').val(),
            usuario:user,
            password:$('#inputpassword_u').val(),
            cargos:cargos,
            destinos:destinos},
          success:function(obj){
            console.log(obj);
            if(obj==false){
              console.log(aqui1);
            }
            if(obj=="false"){
              console.log("aqui2");
              $('#error_update').show();
            }else{
              swal("Mensaje de Alerta!", "Usuario Modificado Satisfactoriamente!", "success");
              setInterval(function(){ location.reload() }, 1500);
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
				var data = JSON.parse(obj);
        var hoja=data.hoja;
        console.log(data);
        PDFObject.embed("../dist/archivos/"+hoja.archivo, "#archivopdf");
        var color=['#000d80','e9068b','#f7f2f6','06c3e9'];
        var titulo=['#06cfc3','#fbeb04','#ec2396','#0368b4'];
        var letra=['#fff','#fff','#000','#fff'];
        var imagen=['color1.png','color2.png','color3.png','color4.png'];
				var arrayaccion = hoja.accion,arraydestino = hoja.destino;

			  $('#seccion_action,#seccion_destino').empty();
				for (var i = 0; i < arrayaccion.length-1; i++) {
					$('#seccion_action').append('<h5 class="col-md-4" style="margin:0;font-style: italic"><img src="../pages/images/'+arrayaccion[i].estado==1?"checkedok":"nochecked"+'.png" style="margin-right:10px">'+arrayaccion[i].nombre+'</h5>');
				}
        
				for (var i = 0; i < arraydestino.length-1; i++) {
          $('#seccion_destino').append('<div class="col-sm-12 col-md-6 col-xs-12" style="background-color:#fff;background-clip:content-box;padding:15px"><div class="col-md-9 col-sm-9 col-xs-9" style="padding:0 0px 0 15px"><h3 style="color:#a2a2a2;font-weight:700;margin:15px 0 2px 0"><small class="badge" style="background:#f3c51d;margin-right:10px;color:#fff;font-size:1.2em">'+(i+1)+'</small>'+arraydestino[i].nombre.toUpperCase()+'</h3><div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin:20px 0 0 20px;padding:0">¡<div class="col-md-2 col-sm-2 col-xs-2" style="margin:0;padding:0"><img src="../pages/images/businessman.png"></div><div class="col-md-10 col-sm-10 col-xs-10" style="margin:0px;padding:0"><h4 style="font-weight:800;margin:0px;color:#0bc3d6">RECEPCIONADO POR</h4><h5 style="margin:0;font-style: italic">'+arraydestino[i].usuario.toLowerCase()+'</h5></div>¡</div>¡<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin:20px 0 0 20px;padding:0">¡<div class="col-md-2 col-sm-2 col-xs-2" style="margin:0;padding:0"><img src="../pages/images/calendario.png"></div><div class="col-md-10 col-sm-10 col-xs-10" style="margin:0px;padding:0"><h4 style="font-weight:800;margin:0px;color:#0bc3d6">FECHA</h4><h5 style="margin:0;font-style: italic">'+arraydestino[i].fecha+'</h5></div>¡</div>¡<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin:20px 0 0 20px;padding:0">¡<div class="col-md-2 col-sm-2 col-xs-2" style="margin:0;padding:0"><img src="../pages/images/ok.png"></div><div class="col-md-10 col-sm-10 col-xs-10" style="margin:0px;padding:0"><h4 style="font-weight:800;margin:0px;color:#0bc3d6">ESTADO</h4><h5 style="margin:0;font-style: italic">'+arraydestino[i].estado+'</h5></div></div></div><div class="col-md-3 col-sm-3 col-xs-3" style="padding:0"><img src="../pages/images/personajuridica.png" style="margin:0;width: 100% !important;float:right"></div></div>');
				}
				
				$('.vnombre').text(hoja.remitente.toLowerCase());
				$('.vcite').text(hoja.cite);
        $('.vprocedencia').text(hoja.procedencia.toLowerCase());
        $('.vtramite').text(hoja.tramite);
        $('.vprioridad').text(hoja.prioridad);
				$('.vplazo').text(hoja.plazo+" Dias");
        $('.vfecha').text(hoja.fecha);
        $('.vestado').text(hoja.estado);
        $('.vtipo').text(hoja.tipo.toLowerCase());
				$('.vadjunto').text(hoja.adjunto.toLowerCase());
        $('.vhojas').text(hoja.num_hojas+" hojas");
        $('.varchivo').text(hoja.archivo);
        $('.vobservacion span').text(hoja.referencia.toLowerCase());
				// $('.vvista_unidad').text(aux[data.vista_unidad]);
        //             $('.vfecha_elaboracion').text(data.fecha_elaboracion);
				// $('.vestado').text(data.estado==0 ? ("Sin Concluir"):("Concluido"));
				// if (data.fecha_presentacion==null || data.fecha_presentacion=="") {
				// 	$('.vfecha_presentacion').text("No Presentado");
				// 	$('.vobservacion').hide();$('#buttonvalidar').show();
				// }else{
				// 	$('.vobservacion').show();$('#buttonvalidar').hide();
				// 	$('.vfecha_presentacion').text(data.fecha_presentacion);
				// 	if (data.observacion==null || data.observacion=="") {
				// 		$('.vobservacion span').text("Sin Observaciones");
				// 	}else{
				// 		
				// 	}
				// }
				// if (data.estado==0) {
				// 	$('#esperado_modal,.esperadomodal').show();
				// 	$('#obtenido_modal,.obtenidomodal').hide();
				// }else{
				// 	$('#esperado_modal,.esperadomodal').hide();
				// 	$('#obtenido_modal,.obtenidomodal').show();
				// }
				// $('#myTab a:first').tab('show');
			}
		});
	}
    function function_validate(validate){
			if(validate!="false"&&validate=="true"){
        if(($('.fila1').hasClass('has-success'))&&($('.fila2').hasClass('has-success'))&&($('.fila3').hasClass('has-success'))&&($('.fila4').hasClass('has-success'))&&($('.fila5').hasClass('has-success'))&&($('.fila6').hasClass('has-success'))&&($('#selectremitente').val()!=null)&&($('#selecttipo').val()!=null)&&($('#selectadjunto').val()!=null)&&($('#selectdestinos').val()!=null)){
						$("#btnregistrar_hoja").attr('disabled', false);}else{$("#btnregistrar_hoja").attr('disabled', true);}
			}else{
				if($('.fila1_u').hasClass('has-success') && $('.fila2_u').hasClass('has-success') && $('.fila3_u').hasClass('has-success') && $('.fila4_u').hasClass('has-success')){
					if (($('#inputpassword_u').val().trim()=="") || ($('.fila3_u').hasClass('has-success'))) {

						if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) ||
              ($('#inputapellido_u').attr('placeholder')!=$('#inputapellido_u').val().trim().toLowerCase())  ||
              ($('#inputusuario_u').attr('placeholder')!=$('#inputusuario_u').val().trim().toLowerCase())  ||
              ($('#inputci_u').attr('placeholder')!=$('#inputci_u').val()) || estado_cargo || estado_destino ||
              ($('.fila5_u').hasClass('has-success'))
						){
							$("#buttonupdate").attr('disabled', false);
						}else{$("#buttonupdate").attr('disabled', true);}
					}else{$("#buttonupdate").attr('disabled', true);}
				}else{$("#buttonupdate").attr('disabled', true);}
			}
		}
    function displayPreview(files) {
      if(files.length>0){
        fileSize = Math.round(files[0].size/1024);
        if(fileSize>0 && files[0].type=="application/pdf"){
          small_error(".fila4",true);
        }else{
          small_error(".fila4",false);
        }
      }else{
        small_error(".fila4",false);
      }
      function_validate('true');
    }
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
  <?php include('includes/config_pag.php'); ?>

  <div class="control-sidebar-bg"></div>
</div>
<!-- Control de modalaes -->
<?php include('includes/modales.php'); ?>
<!-- Control de configuracion de pie de de js pagina -->
<?php include('includes/pie.php'); ?>