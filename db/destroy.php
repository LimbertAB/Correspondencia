<?php 
 //Crear sesión
 session_start();
 $_SESSION = array();
 //Destruir Sesión
 session_destroy();
 //Redireccionar a login.php
 header("location: ../index.php");
?>