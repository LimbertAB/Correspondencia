function reg_usuario() {
  var datos = $('#frmusuario').serialize();
  //$("#respuesta").html("<img src="loader.gif" /> Por favor espera un momento");
  $.ajax({
    type: "POST",
    url: "../crud/UpdatePOO.php/CreateUser/",
    data: datos,
    success: function (resp) {
      if (resp == 0) {
        console.log("aqui2");
        $('#error_registro').show();
      } else {
        swal("Mensaje de Alerta!", "Usuario Registrado Satisfactoriamente!", "success");
        setInterval(function () { location.reload() }, 1500);
      }
    }
  });
}
//Registro de cargo
function reg_cargo() {
  var datos = $('#frmcargo').serialize();
  $.ajax({
    type: "POST",
    url: "../crud/UpdatePOO.php/createUser/",
    data: datos,
    success: function (resp) {
      if (obj == false) {
        swal("Mensaje de Alerta!", "Usuario no Registrado. Ocurrio un Error Inesperado!", "error");
        setInterval(function () { location.reload() }, 1500);
      }
      if (obj == "ok") {
        swal("Mensaje de Alerta!", "Usuario Registrado Satisfactoriamente!", "success");
        setInterval(function () { location.reload() }, 1500);
      }
      if (obj == "duplicado") {
        $('#error_registro_u').show();
      }
    }
  });
}
//Editar cargo
function edit_cargo() {
  var datos = $('#frmcargo_edit').serialize();
  //$("#respuesta").html("<img src="loader.gif" /> Por favor espera un momento");
  $.ajax({
    type: "POST",
    url: "../crud/update.php",
    data: datos,
    success: function (resp) {
      if (resp == 0) {
        alert('Actualizacion exitoso');
        location.href = "cargos.php";
      }
      else {
        if (resp == 404) {
          alert('Ocurrio un error acuda a deaprtamento de sistemas');
        }
        else {
          if (resp == 1) {
            alert("nombre esta vacio");
            $(ok_cargo2).addClass('form-group has-error');
          }
          else {
            if (resp == 2) {
              alert("escoja funcion");
              $(ok_funcion2).addClass('form-group has-error');
            }
            else {
              alert("ya existe nombre" + resp);
              $(ok_cargo2).addClass('form-group has-error');

            }
          }
        }
      }

    }
  });
}
//Registro de destinos
function reg_destino() {
  var datos = $('#frmdestino').serialize();
  $.ajax({
    type: "POST",
    url: "../crud/insert.php",
    data: datos,
    success: function (resp) {
      if (resp == 0) {

        alert('Registro Existoso');
        location.href = "destinos.php";
      }
      else {
        if (resp == 404) {
          alert('Ocurrio un error acuda a deaprtamento de sistemas');
        }
        else {
          if (resp == 1) {
            alert("nombre esta vacio");
            $(ok_cargo3).addClass('form-group has-error');
          }
          else {
            alert("ya existe nombre" + resp);
            $(ok_cargo3).addClass('form-group has-error');
          }
        }
      }

    }
  });
}
//Registro de tipos
function reg_tipo() {
  var datos = $('#frmtipo').serialize();
  $.ajax({
    type: "POST",
    url: "../crud/insert.php",
    data: datos,
    success: function (resp) {
      if (resp == 0) {

        alert('Registro Existoso');
        location.href = "tipos.php";
      }
      else {
        if (resp == 404) {
          alert('Ocurrio un error acuda a deaprtamento de sistemas');
        }
        else {
          if (resp == 1) {
            alert("nombre esta vacio");
            $(ok_cargo4).addClass('form-group has-error');
          }
          else {
            alert("ya existe nombre");
            $(ok_cargo4).addClass('form-group has-error');
          }
        }
      }

    }
  });
}
//Registro de adjuntos
function reg_adjunto() {
  var datos = $('#frmadjunto').serialize();
  $.ajax({
    type: "POST",
    url: "../crud/insert.php",
    data: datos,
    success: function (resp) {
      if (resp == 0) {

        alert('Registro Existoso');
        location.href = "adjuntos.php";
      }
      else {
        if (resp == 404) {
          alert('Ocurrio un error acuda a deaprtamento de sistemas');
        }
        else {
          if (resp == 1) {
            alert("nombre esta vacio");
            $(ok_cargo5).addClass('form-group has-error');
          }
          else {
            alert("ya existe nombre");
            $(ok_cargo5).addClass('form-group has-error');
          }
        }
      }

    }
  });
}
//Registro de acciones
function reg_acciones() {
  var datos = $('#frmacciones').serialize();
  $.ajax({
    type: "POST",
    url: "../crud/insert.php",
    data: datos,
    success: function (resp) {
      if (resp == 0) {
        alert('Registro Existoso');
        location.href = "acciones.php";
      }
      else {
        if (resp == 404) {
          alert('Ocurrio un error acuda a deaprtamento de sistemas');
        }
        else {
          if (resp == 1) {
            alert("nombre esta vacio");
            $(ok_cargo5).addClass('form-group has-error');
          } else {
            alert("ya existe nombre");
            $(ok_cargo5).addClass('form-group has-error');
          }
        }
      }

    }
  });
}
//Registro de procedencia
function reg_procedencia() {
  var datos = $('#formprocedencia').serialize();
  $.ajax({
    type: "POST",
    url: "../crud/insert.php",
    data: datos,
    success: function (resp) {
      console.log(resp);
      if (resp == 0) {
        swal("Mensaje de Alerta!", "La procedencia Se Registro Satisfactoriamente", "success");
        setInterval(function () { location.reload(); }, 1500);
      } else {
        if (resp == 1) {
          $('#error_registro_p').show();
        }
      }
    }
  });
}
//Registro de hojas
function reg_hoja() {
  //var datos=$('#frmhoja').serialize();
  var formData = new FormData(document.getElementById("frmhoja"));
  $.ajax({
    url: "../crud/insert.php",
    type: "post",
    dataType: "html",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp == 0) {

        alert('Registro Existoso');
        location.href = "hojas.php";
      }
      else {
        if (resp == 404) {
          alert('Ocurrio un error acuda a deaprtamento de sistemas');
        }
        else {
          if (resp == 1) {
            alert("procedencia esta vacio");
            $(ok_cargo10).addClass('form-group has-error');
          }
          else {
            if (resp == 2) {
              alert("num_hojas esta vacio´" + resp);
              $(ok_cargo11).addClass('form-group has-error');
            }
            else {
              if (resp == 3) {
                alert("plazo esta vacio´" + resp);
                $(ok_cargo11a).addClass('form-group has-error');
              }
              else {
                alert("cite esta vacio´" + resp);
                $(ok_cargo11b).addClass('form-group has-error');

              }
            }
          }
        }
      }

    }
  });
}
var Asignar_destino = function (id) {
  var route = "../crud/show.php?asign_destino=" + id;
  $.get(route, function (data) {
    if (typeof data !== "object") data = JSON.parse(data);
    $("#id").val(data.id);
    //si es necesario envimos los demas datos
    //$("#procedenci").val(data.procedencia);
    //$("#descripc").val(data.descripcion);
  });
}
//Registro de asignacion de destino
function reg_asignar_destino() {
  var datos = $('#frmasigdestino').serialize();
  $.ajax({
    type: "POST",
    url: "../crud/insert.php",
    data: datos,
    success: function (resp) {
      if (resp == 0) {

        alert('Asignación Existoso');
        location.href = "hojas.php";
      }
      else {
        if (resp == 404) {
          alert('Ocurrio un error acuda a deaprtamento de sistemas');
        }
        else {
          alert("Escoja un destino" + resp);
          $(ok_cargo17).addClass('form-group has-error');
        }
      }

    }
  });
}
//Registro de acciones
function reg_asignar_accion(pos) {
  var datos = $('#frmasigaccion' + pos).serialize();
  $.ajax({
    type: "POST",
    url: "../crud/insert.php",
    data: datos,
    success: function (resp) {
      if (resp == 0) {

        alert('Asignación Existoso');
        location.href = "hojas.php";
      }
      else {
        if (resp == 404) {
          alert('Ocurrio un error acuda a deaprtamento de sistemas');
        }
        else {
          if (resp == 1) {
            alert("escoja accion");
          }
          else {
            if (resp == 2) {
              alert("selecciones estado");
            }
            else {
              alert("selecciones estadosss" + resp);
              //$(ok_cargo17).addClass('form-group has-error');
            }
          }
        }
      }

    }
  });
}
function yes_number(e) { var keyCode = (e.keyCode ? e.keyCode : e.which); if ((keyCode > 47 && keyCode < 58) || keyCode == 8) { return true; } else { e.preventDefault(); } }
function not_number(e) { var keyCode = (e.keyCode ? e.keyCode : e.which); if ((keyCode > 96 && keyCode < 123) || (keyCode > 64 && keyCode < 91) || keyCode == 241 || keyCode == 32 || keyCode == 8) { return true; } else { e.preventDefault(); } }
function key_placa(e) { var keyCode = (e.keyCode ? e.keyCode : e.which); if ((keyCode > 96 && keyCode < 123) || (keyCode > 64 && keyCode < 91) || keyCode == 241 || keyCode == 209 || (keyCode > 47 && keyCode < 58) || keyCode == 45 || keyCode == 8) { return true; } else { e.preventDefault(); } }
function validate_sinsmall(e, t) { if (t) { $(e).removeClass('has-error').addClass('has-success'); } else { $(e).removeClass('has-success').addClass('has-error'); } }
function small_error(e, t) { if (t) { $(e).removeClass('has-error').addClass('has-success'); $(e + " span").removeClass('glyphicon-remove').addClass('glyphicon-ok'); } else { $(e).removeClass('has-success').addClass('has-error'); $(e + " span").removeClass('glyphicon-ok').addClass('glyphicon-remove'); } }
