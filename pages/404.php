<?php include("includes/header.php");include("includes/aside.php"); ?>
<style>
    .container{
        padding-top: 2rem;
        display: flex;
        flex-direction: column;
        align-items:center;
        justify-content: center;
        flex: 1;
        color: white;
    }
    .content {
        background: #fff;
        height: 92vh;
        display: flex;
        flex-direction: column;
    }
    .four-zero-four-container {
        justify-content: center;
        align-items: center;
    }
    p{
        text-align: center;
        font-weight: 200;
        margin-bottom: 3em;
        color:#000
    }
    h1{
        color:#22aaf9;
        text-align: center;
        font-size:9em;
        font-weight: 700;
        margin:0;
        line-height: .7em;
    }
    h3{
        font-size:3em;
        font-weight: 600;
        margin:0;
        color:#7b7b7b;
        text-align: center;
    }
    .button {
        justify-content: center;
        align-items: center;
        background: #fff;
        padding: .6em 2.5em;
        color: #22aaf9;
        font-weight: bold;
        border-radius:1.5em;
        border: 2px solid #22aaf9;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .button:hover {
        background:#22aaf9;
        color: #fff;  
    }
    
</style>
<div class="content-wrapper">
    <section class="content" style="padding:0 0 30px 0">
        <div class='container'>
            <div class='four-zero-four-container'>
                <h1>403</h1>
                <h3>Oops!</h3>
                <p>No tiene los permisos necesarios para acceder a esta sección</p>
            </div>
            <a href="index2.php" class='button'>Volver al Inicio</a>
        </div>
    </section>
</div>
<?php include('includes/config_pag.php'); ?>
<div class="control-sidebar-bg"></div>
</div>
<!-- Control de configuracion de pie de de js pagina -->
<?php include('includes/pie.php'); ?>