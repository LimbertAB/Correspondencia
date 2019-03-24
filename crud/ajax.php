<script type="text/javascript">
 $("#frm_registrar_activo").submit(function(e){               
        e.preventDefault();   
        $('#boton7').attr('disabled', true).text('Registrando...'); 
        var f= $(this);
        var formData = new FormData(document.getElementById("frm_registrar_activo"));
        $.ajax({
            url:"{{URL::to('activoRegistro')}}",
            type:'POST',  
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,                  
            data:formData

        }).done(function(resp){
    if(resp=='prueba')
    {
      $( "#focus102" ).focus();
      $('#boton7').attr('disabled', false).text('Registro Activo');
      notif ( {
                msg: "<p>El Codigo ya existe</p>",
                position: "center",
                bgcolor: "#ff5252",
                color: "#FFFFFF"
                } ) ;
    }
    else
    {
      tabla_activo();
      $("#frm_registrar_activo")[0].reset();
        $( "#focus6" ).focus();
      $('#boton7').attr('disabled', false).text('Registro Activo');
      notif ( {
                msg: "<p>Registro exitoso</p>",
                position: "center",
                bgcolor: "#57e075",
                color: "#FFFFFF"
                } ) ;
    }

    }); 
 });   
</script>