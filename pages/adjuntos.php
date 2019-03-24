<?php include("includes/header.php"); ?>
<?php include("includes/aside.php"); ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tabla de tipos adjuntos
      </h1>
      <ol class="breadcrumb">
        <li><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_adjunto">Nuevo adjunto</button></li>
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
                  <th width="13%">Acciones</th>
                  <th>Nombres</th>
                </tr>
                </thead>
                <tbody>
              <?php 
                $ejecute=pg_query("SELECT * FROM adjuntos");
                while ($datos=pg_fetch_array($ejecute)) {
                  ?>
                  <tr>
                    <td>
                      <button class="btn btn-success btn-sm">Editar</button>
                    </td>
                    <td><?php echo $datos['nombre'] ?></td>
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