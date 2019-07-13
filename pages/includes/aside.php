<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$USER_DATA['nombres'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
        </div>

      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
          <a href="index2.php">
            <i class="fa fa-dashboard"></i> <span>Panel general</span>
          </a>
        </li>
        <?php foreach ($funciones as $key => $value) {
            if ($value==4):?>
               <li class="header" style="font-weight:200;color:#12c8f3">HOJAS DE RUTA</li>
               <li >
                  <a href="mishojas.php">
                     <i class="fa fa-file-powerpoint-o"></i>
                     <span>Mis Hojas de Ruta</span>
                  </a>
               </li>
            <?php endif;?>
            <?php if ($value==13):?>
               <li >
                  <a href="hojas.php">
                     <i class="fa fa-circle-o"></i>
                     <span>Administrar Hojas</span>
                  </a>
               </li>
            <?php endif; }?>
        <li class="header" style="font-weight:200;color:#12c8f3">CONFIGURACION</li>
        <?php foreach ($funciones as $key => $value) {
            if ($value==2) {
            ?>
              <li >
                <a href="usuarios.php">
                  <i class="fa fa-users"></i>
                  <span>Usuarios</span>
                </a>
              </li>
            <?php
            }
        } ?>
        <?php foreach ($funciones as $key => $value) {
            if ($value==3) {
            ?>
              <li>
                <a href="cargos.php">
                  <i class="fa fa-edit"></i>
                  <span>Cargos</span>
                </a>
              </li>
            <?php
            }
        } ?>
        <?php foreach ($funciones as $key => $value) {
            if ($value==6) {
            ?>
              <li>
                <a href="destinos.php">
                  <i class="fa fa-building-o"></i>
                  <span>Destinos</span>
                </a>
              </li>
            <?php
            }
        } ?>

        <?php foreach ($funciones as $key => $value) {
            if ($value==8) {
            ?>
              <li>
                <a href="procedencia.php">
                  <i class="fa fa-institution"></i>
                  <span>Procedencias</span>
                </a>
              </li>
            <?php
            }
        } ?>
        <?php foreach ($funciones as $key => $value) {
            if ($value==10) {
            ?>
              <li>
                <a href="tipos.php">
                  <i class="fa fa-file-o"></i>
                  <span>Tipos de doc</span>
                </a>
              </li>
            <?php
            }
        } ?>
        <?php foreach ($funciones as $key => $value) {
            if ($value==9) {
            ?>
              <li>
                <a href="adjuntos.php">
                  <i class="fa fa-paperclip"></i>
                  <span>Adjuntos</span>
                </a>
              </li>
            <?php
            }
        } ?>
        <?php foreach ($funciones as $key => $value) {
            if ($value==11) {
            ?>
              <li>
                <a href="acciones.php">
                  <i class="fa fa-hand-o-up"></i>
                  <span>Acciones</span>
                </a>
              </li>
            <?php
            }
        } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
