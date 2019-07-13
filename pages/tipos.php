<?php include("includes/header.php");$permiso=0;
  foreach($funciones as $key => $value){
    if ($value==10) {$permiso=1;}
  }
  if($permiso==0){?><script>window.location.href = "404.php";</script><?php } include("includes/aside.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tabla de tipos de documentos
      </h1>
      <ol class="breadcrumb">
        <li><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_tipo">Nuevo tipo de documento</button></li>
      </ol>
      
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
                  <th>Id</th>
                  <th>Nombres</th>
                  <th>Estado</th>
                  <th width="20%">Acciones</th>
                </tr>
                </thead>
                <tbody>
              <?php 
                $ejecute=pg_query("SELECT * FROM tipos");
                while ($datos=pg_fetch_array($ejecute)) {
                  ?>
                  <tr>
                    <td><?=$datos['id'] ?></td>
                    <td><?php echo $datos['nombre'] ?></td>
                    <td><?=$datos['estado']==1?"Activo":"Inactivo"?></td>
                    <td>
                      <button class="btn btn-warning btn-xs" onclick="updateObjeto_all(<?=$datos['id']?>,'<?=$datos['nombre']?>','tipos')">Editar</button>
                      <?php if($datos['estado']==1):?>
                        <button class="btn btn-danger btn-xs" onclick="EliminarObjeto(<?=$datos['id']?>,'tipos')">Eliminar</button>
                      <?php else:?>
                        <button class="btn btn-success btn-xs" onclick="AltaObjeto(<?=$datos['id']?>,'tipos')">Alta</button>
                      <?php endif;?>
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
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Control de configuracion de pagina -->
  <?php include('includes/config_pag.php'); ?>

  <div class="control-sidebar-bg"></div>
</div>
<!-- Control de modalaes -->
<?php include('includes/modales.php'); ?>
<!-- Control de configuracion de pie de de js pagina -->
<?php include('includes/pie.php'); ?>