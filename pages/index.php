<?php include("includes/header.php"); ?>
<?php include("includes/aside.php"); ?>

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border"  style="text-align: center;">

              <h3 class="box-title" >Bienvenido al Sistema de Correspondencia de la Casa de la Moneda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner" style="height:80vh">
                  <div class="item active">
                    <img src="../dist/img/2.jpg" alt="Primera slide" style="background-position: center center;background-repeat: no-repeat;background-size: cover;background-attachment: fixed;">
                    <div class="carousel-caption">
                      Primera Diapositiva
                    </div>
                  </div>
                  <div class="item">
                    <img src="../dist/img/1.jpg" alt="Segunda Diapositiva" style="background-position: center center;background-repeat: no-repeat;background-size: cover;background-attachment: fixed;">
                    <div class="carousel-caption">
                      Segunda Diapositiva
                    </div>
                  </div>
                  <div class="item">
                    <img src="../dist/img/3.jpg" alt="Tercera Diapositiva" style="background-position: center center;background-repeat: no-repeat;background-size: cover;background-attachment: fixed;">

                    <div class="carousel-caption">
                      Tercera Slide
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0.
    </div>
    <strong> &copy; 2018
  </footer>

  <!-- Control de configuracion de pagina -->
  <?php include('includes/config_pag.php'); ?>
  <div class="control-sidebar-bg"></div>
</div>
<!-- Control de configuracion de pie de de js pagina -->
<?php include('includes/pie.php'); ?>
