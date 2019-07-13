<?php include("includes/header.php");$permiso=0;
  foreach($funciones as $key => $value){
    if ($value==3) {$permiso=1;}
  }
  if($permiso==0){?><script>window.location.href = "404.php";</script><?php } include("includes/aside.php");
?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
      
      <h1>Lista de cargos</h1><br>
      <ol class="breadcrumb">
        <li><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cargo">Nuevo cargo</button></li>
      </ol>
      
      <div class="row">
          <!--********************PARA EDITAR CARGO-->
          <?php
          if (isset($_GET['edit'])) {
            $ejecute=pg_query("SELECT * FROM cargos where id='$_GET[edit]'");
            $datos=pg_fetch_array($ejecute);
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
              <div class="box-header with-border">
                <h3 class="box-title">Formulario de edición</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form onsubmit="return false" action="return false" id="frmcargo_edit">
                <div class="box-body">
                  <input type="hidden"  name="ca" value="2">
                  <input type="hidden" name="ide" value="<?php echo $datos['id'] ?>">
                <div class="form-group" id="ok_cargo2">
                  <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" class="form-control" value="<?php echo $datos['nombre'] ?>" id="nombre1" name="nombre" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Descripcion</label>
                  <textarea class="form-control" rows="5"  name="descrip" id="descrip1"><?php echo $datos['descripcion'] ?></textarea>
                  </div>
                <div class="col-md-6" id="ok_funcion2">
                  <label for="exampleInputPassword1">Privilegios</label><br>
                  <label>
                    <?php 
                    $f_i=array();
                    $ejecute=pg_query("SELECT * FROM funciones");
                    $ejecute2=pg_query("SELECT funcion_id FROM funcion_cargo where cargo_id=$_GET[edit]");
                     while ($funcion_cargo=pg_fetch_array($ejecute2)) {
                        $f_i[]=$funcion_cargo['funcion_id'];
                    }
                    $con=0;
                    if (count($f_i)>0) {
                      while ($datos=pg_fetch_array($ejecute)) {
                        for ($i=0; $i < count($f_i); $i++) { 
                          if ($f_i[$i]==$datos['id']) {
                              $con++;
                          }
                        }
                        if ($con>0) {
                            echo "<input type='checkbox' name='funciones[]' value='$datos[id]' checked> $datos[nombre] <br>";
                        }
                        else{
                          echo "<input type='checkbox' name='funciones[]' value='$datos[id]'> $datos[nombre] <br>";
                        }
                        $con=0;
                      }
                    }
                    else
                      echo "No existe datos";
                    
                    
                     ?>
                    
                  </label>
                </div>

              </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="btn_reg_cargo" onclick="edit_cargo()">Guardar datos</button>
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
           <!--********************FIN PARA EDITAR CARGO-->
          
        <?php 
          $ejecute=pg_query("SELECT * FROM cargos order by id DESC");
          while ($datos=pg_fetch_array($ejecute)) {
            ?>
              <div  class="col-md-4" >
              <!-- Widget: user widget style 1 -->
              <div style=" height: 400px; overflow: auto;" class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-blue">
                  <div class="widget-user-image">
                    <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
                  </div>
                  <!-- /.widget-user-image -->
                  <h3 class="widget-user-desc"><?php echo $datos['nombre'] ?></h3>
                  <h5 class="widget-user-desc"><?php echo $datos['descripcion'] ?></h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li style=" text-align: center;">
                      <a href="#">Navegación </a>
                      <center><a href="cargos.php?edit=<?php echo $datos['id'] ?>"><i class="fa fa-pencil"></i> Editar</a></center>
                    </li>
                    <?php
                    $ejecute1=pg_query("SELECT fu.nombre from funciones fu, funcion_cargo fc WHERE fu.id= fc.funcion_id and fc.cargo_id=$datos[id]");
                    while ($datos1=pg_fetch_array($ejecute1)) { 
                     ?>
                    <li><a href="#"><?php echo $datos1['nombre'] ?> <span class="pull-right badge bg-green"><i class="fa fa-check"></i></span></a></li>
                  <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
            <?php
          }
           ?>
        
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
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
<!-- Control de configuracion de pie de de js pagina -->
<?php include('includes/pie.php'); ?>
<!-- Control de modales -->

<?php include('includes/modales.php'); ?>