<?php
  session_start();
  include("../db/conexion.php");
  $enlace=conectar();
  if(!isset($_SESSION['nombres'])){
    header('Location: ../index.php');
    exit();
  }else{
    $USER_ID=$_SESSION['id_usu'];
    $ejecute=pg_query("SELECT fu.id as num_funcion FROM funciones fu,
    funcion_cargo fc, cargos ca, usuarios us WHERE fu.id=fc.funcion_id and fc.cargo_id=ca.id AND ca.id=us.id_cargo AND us.id=$USER_ID");
    while ($datos=pg_fetch_assoc($ejecute)) {
        $funciones[]=$datos['num_funcion'];
    }
    $funciones=array_unique($funciones);
    $con_funciones=0;
    foreach ($funciones as $key => $value){
      if ($value==13) {
        $con_funciones=1;
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Casa de la moneda | Correspondencia</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <link rel="stylesheet" href="../plugins/sweetalert.css">
  <link rel="stylesheet" href="../bower_components/style.css">
  <link rel="stylesheet" href="../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="../dist/css/notifIt.css">
  <link rel="stylesheet" href="../plugins/bootstrap-toggle.min.css">
  <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="../plugins/jQuery-2.1.4.min.js"></script>
  <script src="../plugins/bootstrap.min.js"></script>
  <script src="../plugins/sweetalert.min.js"></script>
  <script src="../plugins/bootstrap-select.min.js"></script>
  <script src="../plugins/admin.js"></script>
  <script src="../plugins/bootstrap-toggle.min.js"></script>
  <script src="../plugins/pdfobject.min.js"></script>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <?php
      $USER_DATA=pg_fetch_assoc(pg_query("SELECT u.*,c.nombre as cargos,d.nombre as destinos FROM usuarios as u JOIN cargos as c ON c.id = u.id_cargo JOIN destinos as d ON d.id = u.id_destino WHERE u.id=$_SESSION[id_usu]"));
    ?>
    <!-- Logo -->
    <a href="index2.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CNM</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo strtoupper($USER_DATA['destinos'])?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <div class="col-md-12" style="padding:0 15px 0 0">
        <div class="col-md-1 col-sm-2 col-xs-2" style="padding:0">
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="font-size:1.5em;padding-top:10px;padding-bottom:10px">
            <span class="sr-only"></span>
          </a>
        </div>
        <div class="col-md-6 hidden-sm hidden-xs" style="padding:0">
          <div style="float:left">
            <h3 class="title_page"></h3>
          </div>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
              <a href="mishojas.php?seleccionado=proceso">
                <i class="fa fa-bell-o"></i><span class="label label-danger" id="cantobject"></span>
              </a>
            </li>
            <li class="dropdown notifications-menu">
              <a href="peticiones.php">
                <i class="fa fa-envelope-o"></i><span class="label label-danger" id="cantobject1"></span>
              </a>
            </li>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['nombres'];?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                  <p><?=$USER_DATA['cargos'];?></p>
                  <button id="btnbackup" class="btn btn-warning btn-xs">Copia de Seguridad</button>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="../db/destroy.php" class="btn btn-default btn-flat">Salir</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
<script>
  $(document).ready(function(){
    $('#btnbackup').click(function(){
      $.ajax({
        type: "GET",
        url: "../crud/ViewData.php/backup/true",
        success: function (obj) {
          console.log(obj);
          
        }
      });
    });
    $.ajax({
      url: '../crud/ViewData.php/Notificacion/all',type: "get",success: function(res){
        var data = JSON.parse(res);
        if(data.mensaje>0){
          $('#cantobject1').text(data.mensaje);
          $('#cantobject1').show();
        }else{
          $('#cantobject1').hide();
        }
        if (data.notificacion>0) {
          $('#cantobject').text(data.notificacion);
          $('#cantobject').show();
        }else{
          $('#cantobject').hide();
        }
      }
    });
  });
</script>
