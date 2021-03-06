<!--registro de usuarios-->
<div class="modal fade" id="modal_usuario"> WHERE estado=1
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form name="cargo" onsubmit="return false" action="return false" id="frmusuario">
        <div class="modal-header" style="background:#a7bf20">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" style="color:#fff">REGISTRO DE USUARIOS</h4>
        </div>
        <div class="box box-primary" style="border-top-width: 0px;">
          <div class="modal-body" style="background:#fff">
            <div class="box-body">
              <input type="hidden"  name="usu" value="algo">
              <div class="form-group col-md-6 has-feedback  has-error fila1" style="padding:5px">
                <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRES</label>
                <input type="text" name="nom_usu" id="inputnombre" class="form-control" validate="true" toggle=".fila1" placeholder="Ejemplo: Alejandra">
                <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              </div>
              <div class="form-group col-md-6 has-feedback  has-error fila2" style="padding:5px">
                <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">APELIDOS</label>
                <input type="text" name="ape_usu" id="inputapellido" class="form-control" validate="true" toggle=".fila2" placeholder="Ejemplo: Torrez Ruiz">
                <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              </div>
              <div class="form-group col-md-6 has-feedback  has-error fila3" style="padding:5px">
                <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CEDULA DE IDENTIDAD</label>
                <input type="text" name="ced_usu" id="inputci" class="form-control" validate="true" toggle=".fila3" placeholder="Ejemplo: 5570345">
                <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              </div>
              <div class="form-group col-md-6 has-feedback has-error fila4" style="padding:5px">
                <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRE DE USUARIO</label>
                <input type="text" name="usu_usu" id="inputusuario" class="form-control" validate="true" toggle=".fila4" placeholder="Ejemplo: alejandra">
                <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <em style="color:#cf6666;display:none" id="error_registro_u">El nombre de usuario ya esta en uso!</em>
              </div>
              <div class="form-group col-md-6 has-feedback has-error fila5" style="padding:5px">
                <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CONTRASEÑA</label>
                <input type="password" name="pas_usu" autocomplete="false" autocorrect="off" class="form-control" id="inputpassword" validate="true" placeholder="Minimo 5 caracteres" toggle=".fila5">
                <span toggle="#inputpassword" id="togglepassword_u" class="fa fa-fw fa-eye field-icon"></span>
              </div>
              <div class="form-group col-md-6" style="padding:5px" id="ok_cargo15">
                <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CARGO</label>
                <div class='input-group'>
                  <select id="selectcargo" name="id_cargo" class="form-control selectpicker show-tick" data-live-search="true">
                    <?php $ejecute=pg_query("SELECT * FROM cargos WHERE estado=1");
                      while ($datos=pg_fetch_array($ejecute)) { ?>
                        <option value="<?php echo $datos['id'] ?>" data-subtext="<?php echo $datos['descripcion'];?>"><?php echo strtoupper($datos['nombre'])?></option>
                      <?php
                        }
                      ?>
                  </select>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
              </div>
              <div class="form-group col-md-12" style="padding:5px" id="ok_cargo16">
                <label style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">DESTINO</label>
                <div class='input-group'>
                  <select id="selectdestino" name="id_destino" class="form-control selectpicker show-tick" data-live-search="true">
                    <?php
                      $ejecute=pg_query("SELECT * FROM destinos WHERE estado=1");
                      while ($datos=pg_fetch_array($ejecute)) {
                        ?>
                        <option value="<?php echo $datos['id'] ?>" data-subtext="<?php echo $datos['descripcion'];?>"><?php echo strtoupper($datos['nombre'])?></option>
                        <?php
                      }
                    ?>
                  </select>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
            <button class="btn btn-success" id="btnregistrar" disabled onclick="reg_usuario()">Registrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--ver y modificar usuarios-->
<div class="modal fade" id="updateusuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
      <div class="modal-body" style="padding-top:0;padding-bottom:0;z-index:20">
				<div class="row">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px;z-index:100;position:absolute"><span aria-hidden="true">&times;</span></button>
	        <div class="col-md-4" height="100%" style="margin:0px;background:#0c2544;padding-top:40px;padding-left: 0;padding-right: 2px;z-index:-50;height: 560px;">
            <img src="../pages/images/man.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0px">
            <center class="unombre">
              <h5  style="color: #f2fafd;margin-top:0;margin-bottom:0px;text-transform:uppercase;z-index:900">Cargando <br> Usuario</h5>
              <p style="margin-bottom:0;color:#f7e70e;font-weight: 700;"></p>
            </center>
            <center>
              <img src="../pages/images/userlogin.png"  style="padding:15px 0 5px 0;margin-top:0px">
              <br><p class="ulogin" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">usuario</p>
            </center>
            <center>
              <img src="../pages/images/suitcase.png"  style="padding:15px 0 5px 0;margin-top:0px">
              <br><p class="ucargo" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">cargos</p>
            </center>
            <center>
              <img src="../pages/images/marker.png"  style="padding:15px 0 5px 0;margin-top:0px">
              <br><p class="udestino" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">destinos</p>
            </center>
            <center>
              <img src="../pages/images/status.png"  style="padding:15px 0 5px 0;margin-top:0px">
              <br><p class="uestado" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">Activo</p>
            </center>
          </div>

          <div class="col-md-8">
            <center><h3 style="margin-top:5px;color: #1cd2dc;font-weight: 700;">MODIFICAR USUARIO</h3></center>
            <form autocomplete="off">
              <div class="form-group has-feedback has-success fila1_u" style="margin-bottom:10px">
                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRES</label>
                <input type="text" id="inputnombre_u" class="form-control input-sm" validate="false" toggle=".fila1_u">
                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
              </div>
              <div class="form-group has-feedback has-success fila2_u" style="margin-bottom:10px">
                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">APELIDOS</label>
                <input type="text" id="inputapellido_u" class="form-control input-sm" validate="false" toggle=".fila2_u">
                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
              </div>
              <div class="form-group has-feedback has-success fila3_u" style="margin-bottom:10px">
                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NÚMERO DE CARNET</label>
                <input type="text" autocomplete="false"  id="inputci_u" class="form-control input-sm" validate="false" toggle=".fila3_u">
                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
              </div>
              <div class="form-group has-feedback has-success fila4_u" style="margin-bottom:10px">
                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRE DE USUARIO</label>
                <input type="text" id="inputusuario_u" class="form-control input-sm" validate="false" toggle=".fila4_u">
                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                <em style="color:#cf6666;display:none" id="error_update">El nombre de usuario ya esta en uso!</em>
              </div>
              <div class="form-group has-feedback has-error fila5_u" style="margin-bottom:10px">
                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CONTRASEÑA<small> (OPCIONAL)</small></label>
                <input type="password" autocomplete="false" autocorrect="off" class="form-control input-sm" id="inputpassword_u" validate="false" placeholder="Minimo 5 caracteres" toggle=".fila5_u">
                <span toggle="#inputpassword_u" id="togglepassword_u" class="fa fa-fw fa-eye field-icon"></span>
                <em style="color:#cf6666;display:none">El carnet de identidad ya esta en uso!</em>
              </div>
              <div class="form-group inputrow1_u" style="margin-bottom:10px">
                  <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CARGOS</label>
                  <div class='input-group'>
                  <select id="selectcargo_u" class="form-control selectpicker show-tick" data-live-search="true">
                  <?php
                    $ejecute=pg_query("SELECT * FROM cargos WHERE estado=1");
                    while ($datos=pg_fetch_array($ejecute)) { ?>
                      <option value="<?php echo $datos['id'] ?>" data-subtext="<?php echo $datos['descripcion'];?>"><?php echo strtoupper($datos['nombre'])?></option>
                    <?php
                      }
                    ?>
								</select>
								<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
              </div>
              <div class="form-group inputrow2_u" style="margin-bottom:10px">
                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">DESTINOS</label>
                <div class='input-group'>
                  <select id="selectdestino_u" class="form-control selectpicker show-tick" data-live-search="true">
                    <?php
                      $ejecute=pg_query("SELECT * FROM destinos WHERE estado=1");
                      while ($datos=pg_fetch_array($ejecute)) {
                        ?>
                        <option value="<?php echo $datos['id'] ?>" data-subtext="<?php echo $datos['descripcion'];?>"><?php echo strtoupper($datos['nombre'])?></option>
                        <?php
                      }
                    ?>
                </select>
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
              </div>
              <center>
                  <button class="btn btn-warning" style="margin:10px 0 18px 0px" id="buttonupdate" type="button" disabled>Guardar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--CArgo registro-->
<div class="modal fade" id="cargo">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="cargo" onsubmit="return false" action="return false" id="frmcargo">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" align="center">Registro de cargo</h4>
        </div>
      <div class="box box-primary">
        <div class="modal-body">
            <div class="box-body">
                <input type="hidden"  name="ca" value="1">
              <div class="form-group" id="ok_cargo">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" autofocus="" name="nombre">
                <em style="color:#cf6666;display:none" class="error_registro_u">El nombre del cargo ya esta en uso!</em>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Descripcion</label>
                <textarea class="form-control" rows="5" name="descrip"></textarea>
              </div>
              <div class="col-md-6" id="ok_funcion">
                <label for="exampleInputPassword1">Privilegios</label><br>
                <label>
                  <?php $ejecute=pg_query("SELECT * FROM funciones ORDER BY id DESC");$pos=0;
                    while($datos=pg_fetch_array($ejecute)){ ?>
                    <input type="checkbox"  name="funcion[]" value="<?php echo $datos['id']?>">
                    <i><?php echo $datos['nombre']?></i><br>
                  <?php $pos++;}?>
                </label>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btn_reg_cargo" onclick="reg_cargo()">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--destinos registro-->
<div class="modal fade" id="modal_destino">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="destino" onsubmit="return false" action="return false" id="frmdestino">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" align="center">Registro de destino</h4>
        </div>
      <div class="box box-primary">
        <div class="modal-body">
            <div class="box-body">
                <input type="hidden"  name="dest" value="1">
              <div class="form-group" id="ok_cargo3">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" autofocus="" name="nombre">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Descripcion</label>
                <textarea class="form-control" rows="5" name="descrip"></textarea>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btn_reg_cargo" onclick="reg_destino()">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--tipo registro-->
<div class="modal fade" id="modal_tipo">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="destino" onsubmit="return false" action="return false" id="frmtipo">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" align="center">Registro de tipos</h4>
        </div>
      <div class="box box-primary">
        <div class="modal-body">
            <div class="box-body">
                <input type="hidden"  name="tip" value="1">
              <div class="form-group" id="ok_cargo4">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" autofocus="" name="nombre">
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btn_reg_cargo" onclick="reg_tipo()">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--adjuntos registro-->
<div class="modal fade" id="modal_adjunto">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="destino" onsubmit="return false" action="return false" id="frmadjunto">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" align="center">Registro de adjuntos</h4>
        </div>
      <div class="box box-primary">
        <div class="modal-body">
            <div class="box-body">
                <input type="hidden"  name="adj" value="1">
              <div class="form-group" id="ok_cargo5">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" autofocus="" name="nombre">
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btn_reg_cargo" onclick="reg_adjunto()">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--adjuntos registro-->
<div class="modal fade" id="modal_accion">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="destino" onsubmit="return false" action="return false" id="frmacciones">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" align="center">Registro de acciones</h4>
        </div>
      <div class="box box-primary">
        <div class="modal-body">
            <div class="box-body">
                <input type="hidden"  name="acc" value="1">
              <div class="form-group" id="ok_cargo6">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" autofocus="" name="nombre">
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btn_reg_cargo" onclick="reg_acciones()">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--procedencia registro-->
<div class="modal fade" id="modal_procedencia">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="destino" onsubmit="return false" action="return false" id="formprocedencia">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" align="center">Registro de Procedencias</h4>
        </div>
      <div class="box box-primary">
        <div class="modal-body">
            <div class="box-body">
                <input type="hidden"  name="proc" value="1">
              <div class="form-group has-error">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" autofocus="" name="nombre" placeholder="Ejemplo: Banco Union">
                <em style="color:#cf6666;display:none" id="error_registro_p">El nombre de la procedencia no esta disponible!</em>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onclick="reg_procedencia()">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--hoja registro-->
<div class="modal fade" id="modal_hoja" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_createhoja" name="form_createhoja" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header" style="background:#481848">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" style="color:#fff;font-weight:700">REGISTRO DE HOJA DE RUTA</h4>
        </div>
      <div class="box box-primary" style="border-top-width: 0px;margin-bottom: 0px;">
        <div class="modal-body" style="background:#fff;padding:0">
          <ul role="tablist" style="padding:0px;background:#e0e0e0" class="nav nav-tabs nav-justified" id="myTab">
            <li  role="presentation" class="active"><a style="padding:0 15px 0 15px;color:#803b7f" href="#general_modal" aria-controls="general_modal" role="tab" data-toggle="tab">GENERAL<h5 id="idgeneral" class="badge" style="background:red;margin-left:10px">4</h5></a></li>
            <li role="presentation"><a style="padding:0 15px 0 15px;color:#803b7f" href="#documento_modal" aria-controls="documento_modal" role="tab" data-toggle="tab">DOCUMENTO<h5 id="iddocumento" class="badge" style="background:red;margin-left:10px">2</h5></a></li>
            <li role="presentation"><a style="padding:0 15px 0 15px;color:#803b7f" href="#destino_modal" aria-controls="destino_modal" role="tab" data-toggle="tab">DESTINOS<h5 id="iddestinos" class="badge" style="background:red;margin-left:10px">2</h5></a></li>
          </ul>
          <div class="row">
            <div class="tab-content" style="margin:20px 30px 10px 30px">
              <div id="general_modal" role="tabpanel" class="tab-pane active">
                <div class="box-body">
                  <input type="hidden"  name="hoj" value="1">
                  <div class="form-group has-feedback has-success">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">FECHA CITE</label>
                    <div class="col-sm-9" >
                      <div class='input-group date' id='datetimepicker1'>
                        <input name="fecha" readonly type='text' class="form-control" value="<?php echo date('Y-m-d')?>"  validate="true"/>
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
				        	</div>
                  <div class="form-group" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">PRIORIDAD</label>
                    <div class='input-group col-sm-9' style="padding:0 15px 0 15px">
                      <select id="selectprioridad" name="prioridad" class="form-control selectpicker show-tick">
                        <option value="baja">Baja</option>
                        <option value="media">Media</option>
                        <option value="alta">Alta</option>
                      </select>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-sort-by-attributes"></span></span>
                    </div>
                  </div>
                  <div class="form-group" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">PROCEDENCIA</label>
                    <div class='input-group col-sm-9' style="padding:0 15px 0 15px" >
                      <select id="selectprocedencia" name="procedencia" class="form-control selectpicker show-tick" data-live-search="true">
                        <?php $ejecute=pg_query("SELECT * FROM procedencia WHERE estado=1");
                          while ($datos=pg_fetch_array($ejecute)) {
                            ?>
                            <option value="<?php echo $datos['id'] ?>"><?php echo strtoupper($datos['nombre'])?></option>
                            <?php
                          }
                          ?>
                      </select>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                    </div>
                  </div>
                  <div class="form-group has-feedback  has-error fila1" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">REMITENTE</label>
                    <div class="col-sm-9">
                      <input type="text" name="remitente" id="inputremitente" class="form-control" validate="true" toggle=".fila1" placeholder="Ejemplo: juanito paredes">
                      <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group has-feedback  has-error fila2" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CARGO REMITENTE</label>
                    <div class="col-sm-9">
                      <input type="text" name="cargo_remitente" id="inputcargoremitente" class="form-control" validate="true" toggle=".fila2" placeholder="Ejemplo: encargado de almacenes">
                      <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group has-feedback has-error fila3" style="padding:5px">
                    <label  class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CITE</label>
                    <div class="col-sm-9">
                      <input type="text" name="cite" id="inputcite" class="form-control" validate="true" toggle=".fila3" placeholder="Ejemplo: MNG878">
                      <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                      <em style="color:#cf6666;display:none" id="error_registro">El numero de CITE ya esta en uso!</em>
                    </div>
                  </div>
                  <div class="form-group has-feedback has-error fila4" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">REFERENCIA</label>
                    <div class="col-sm-9">
                      <textarea name="referencia" rows="3" id="inputreferencia" cols="80" placeholder="Ejemplo: Este archivo de de suma importancia, el cual debera ser revisado detalladamente" maxlength="250" style="resize: none;" class="form-control"  validate=true toggle=".fila4"></textarea>
                      <span class="glyphicon glyphicon-remove form-control-feedback" style="margin:25px 8px 0 0" aria-hidden=true></span>
                    </div>
                  </div>
                </div>
              </div>
              <div id="documento_modal" role="tabpanel" class="tab-pane">
                <div class="box-body">
                  <div class="form-group" style="padding:5px">
                    <label  class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE ARCHIVO (<2MB)</label>
                    <div class="col-sm-9">
                      <input name="archivo" type="file" accept=".xls, .xlsx, .doc, .docx, application/pdf" onchange="displayPreview(this.files,'#file_error',true);" class="form-control">
                      <small class="text-red hidden" id="file_error">Peso Maximo admitido 2MB</small>
                    </div>
                  </div>
                  <div class="form-group has-feedback  has-error fila6" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">PROVEIDOS</label>
                    <div class="col-sm-9" >
                      <input type="text" name="proveido" id="inputproveido" class="form-control" validate="true" toggle=".fila6" placeholder="Ejemplo: pase a conocimiento de la jefatura ..">
                      <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group has-feedback  has-error fila7" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NUMERO DE HOJAS</label>
                    <div class="col-sm-9" >
                      <input type="number" name="num_hojas" id="inputhoja" class="form-control" validate="true" toggle=".fila7" placeholder="Ejemplo: 10 hojas">
                      <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">TIPO DE DOCUMENTO</label>
                    <div class='input-group col-sm-9' style="padding:0 15px 0 15px">
                      <select id="selecttipo" name="tipo" class="form-control selectpicker show-tick" data-live-search="true">
                        <?php $ejecute=pg_query("SELECT * FROM tipos WHERE estado=1");
                          while ($datos=pg_fetch_assoc($ejecute)) {
                            ?>
                            <option value="<?php echo $datos['id'] ?>"?><?php echo strtoupper($datos['nombre'])?></option>
                            <?php
                          }
                          ?>
                      </select>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
                    </div>
                  </div>
                  <div class="form-group" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">TIPO DE ADJUNTO</label>
                    <div class='input-group col-sm-9' style="padding:0 15px 0 15px">
                      <select id="selectadjunto" name="adjunto" class="form-control selectpicker show-tick" data-live-search="true">
                        <?php $ejecute=pg_query("SELECT * FROM adjuntos WHERE estado=1");
                          while ($datos=pg_fetch_assoc($ejecute)) {
                            ?>
                            <option value="<?php echo $datos['id'] ?>"?><?php echo strtoupper($datos['nombre'])?></option>
                            <?php
                          }
                          ?>
                      </select>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-folder-open"></span></span>
                    </div>
                  </div>
                </div>
              </div>
              <div id="destino_modal" role="tabpanel" class="tab-pane">
                <div class="box-body">
                  <div class="form-group has-feedback has-error fila8" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">DIAS DE PLAZO</label>
                    <div class="col-sm-9">
                      <input type="number" name="plazo" id="inputplazo" class="form-control" validate="true" toggle=".fila8" placeholder="Ejemplo: 5 dias">
                      <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE LAS ACCIONES</label>
                    <div class='input-group col-sm-9 has-feedback has-error' id="rowaccionerror" style="padding:0 15px 0 15px" >
                      <select id="selectaccion" name="accion[]" class="form-control selectpicker show-tick" multiple data-live-search="true" data-max-options="15" data-selected-text-format="count > 2">
                        <?php $ejecute=pg_query("SELECT * FROM acciones WHERE estado=1");
                          while ($datos=pg_fetch_array($ejecute)) {
                            ?>
                            <option value="<?php echo $datos['id'] ?>"?><?php echo strtoupper($datos['nombre'])?></option>
                            <?php
                          }
                          ?>
                      </select>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                    </div>
                  </div>
                  <div class="alert alert-warning alert-dismissible col-md-12" role="alert" style="background-color:#f3e47f !important">
                    <h5 style="color:#000"><strong>INFORMACION: </strong>Se enviara la hoja de ruta a todos los destinos que sean seleccionados en el siguiente Formulario</h5>
                  </div>
                  <div class="form-group" style="padding:5px">
                    <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE LOS DESTINOS</label>
                    <div class='input-group col-sm-9' style="padding:0 15px 0 15px" >
                      <select id="selectdestinos" class="form-control selectpicker show-tick" multiple data-live-search="true" data-max-options="10" data-selected-text-format="count > 3">
                        <?php $ejecute=pg_query("SELECT * FROM destinos WHERE estado=1");
                          while ($datos=pg_fetch_array($ejecute)) {
                            ?>
                            <option value="<?php echo $datos['id'] ?>"?><?php echo strtoupper($datos['nombre'])?></option>
                            <?php
                          }
                          ?>
                      </select>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                    </div>
                  </div>
                  <div class="row">
                     <table class="table table-hover table-bordered" style="width:95%;margin:0 auto">
                        <thead>
                           <tr style="background:#08c">
                              <th width="45%" style="border: 1px solid black;text-align:center;color:#fff">DESTINOS</th><th width="45%" style="border: 1px solid black;text-align:center;color:#fff">PROVEIDOS</th><th width="10%" style="border: 1px solid black;text-align:center;color:#fff">OPCIONES</th>
                           </tr>
                        </thead>
                        <tbody id="tabledestino_registro">
                        </tbody>
                     </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnregistrar_hoja" disabled>Registrar Hoja de Ruta</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--hoja update-->
<div class="modal fade" id="updatehoja_modal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_updatehoja" name="form_updatehoja" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header" style="background:#481848">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" style="color:#fff;font-weight:700">MODIFICAR HOJA DE RUTA</h4>
        </div>
        <div class="box box-primary" style="border-top-width: 0px;margin-bottom: 0px;">
          <div class="modal-body" style="background:#fff;padding:0">
            <ul role="tablist" style="padding:0px;background:#e0e0e0" class="nav nav-tabs nav-justified" id="myTab">
              <li  role="presentation" class="active"><a style="padding:0 15px 0 15px;color:#803b7f" href="#general_modal_u" aria-controls="general_modal_u" role="tab" data-toggle="tab">GENERAL<h5 class="badge" id="idgeneral_u" style="background:#00a65a;margin-left:10px"><span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span></h5></a></li>
              <li role="presentation"><a style="padding:0 15px 0 15px;color:#803b7f" href="#documento_modal_u" aria-controls="documento_modal_u" role="tab" data-toggle="tab">DOCUMENTO<h5 class="badge" id="iddocumento_u" style="background:#00a65a;margin-left:10px"><span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span></h5></a></li>
              <li role="presentation"><a style="padding:0 15px 0 15px;color:#803b7f" href="#destino_modal_u" aria-controls="destino_modal_u" role="tab" data-toggle="tab">DESTINOS<h5 class="badge" id="iddestinos_u" style="background:#00a65a;margin-left:10px"><span style="font-size:.8em;" class="glyphicon glyphicon-ok"></span></h5></a></li>
            </ul>
            <div class="row">
               <div class="tab-content" style="margin:20px 30px 10px 30px">
                <div id="general_modal_u" role="tabpanel" class="tab-pane active">
                  <div class="box-body">
                    <div class="form-group has-feedback has-success">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">FECHA CITE</label>
                      <div class="col-sm-9" >
                        <div class='input-group date' id='datetimepicker1_u'>
                          <input name="fecha_cite" readonly type='text' class="form-control" validate="false"/>
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">PRIORIDAD</label>
                      <div class='input-group col-sm-9' style="padding:0 15px 0 15px">
                        <select id="selectprioridad_u" name="prioridad" class="form-control selectpicker show-tick">
                          <option value="baja">Baja</option>
                          <option value="media">Media</option>
                          <option value="alta">Alta</option>
                        </select>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-sort-by-attributes"></span></span>
                      </div>
                    </div>
                    <div class="form-group" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">PROCEDENCIA</label>
                      <div class='input-group col-sm-9' style="padding:0 15px 0 15px" >
                        <select id="selectprocedencia_u" name="procedencia" class="form-control selectpicker show-tick" data-live-search="true">
                          <?php $ejecute=pg_query("SELECT * FROM procedencia WHERE estado=1");
                            while ($datos=pg_fetch_array($ejecute)) {
                              ?>
                              <option value="<?php echo $datos['id'] ?>"><?php echo strtoupper($datos['nombre'])?></option>
                              <?php
                            }
                            ?>
                        </select>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                      </div>
                    </div>
                     <div class="form-group has-feedback  has-success fila1_u" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">REMITENTE</label>
                      <div class="col-sm-9">
                        <input type="text" name="remitente" id="inputremitente_u" class="form-control" validate="false" toggle=".fila1_u">
                        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                      </div>
                     </div>
                     <div class="form-group has-feedback  has-success fila2_u" style="padding:5px">
                       <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CARGO REMITENTE</label>
                       <div class="col-sm-9">
                         <input type="text" name="cargo_remitente" id="inputcargoremitente_u" class="form-control" validate="false" toggle=".fila2_u">
                         <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                       </div>
                     </div>
                     <div class="form-group has-feedback has-success fila3_u" style="padding:5px">
                      <label  class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CITE</label>
                      <div class="col-sm-9">
                        <input type="text" name="cite" id="inputcite_u" class="form-control" validate="false" toggle=".fila3_u">
                        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                        <em style="color:#cf6666;display:none" id="error_update">El numero de CITE ya esta en uso!</em>
                      </div>
                     </div>
                     <div class="form-group has-feedback has-success fila4_u" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">REFERENCIA</label>
                      <div class="col-sm-9">
                        <textarea name="referencia" rows="3" id="inputreferencia_u" cols="80" maxlength="250" style="resize: none;" class="form-control"  validate=false toggle=".fila4_u"></textarea>
                        <span class="glyphicon glyphicon-ok form-control-feedback" style="margin:25px 8px 0 0" aria-hidden=true></span>
                      </div>
                     </div>
                  </div>
                </div>
                <div id="documento_modal_u" role="tabpanel" class="tab-pane">
                  <div class="box-body">
                    <div class="form-group" style="padding:5px">
                      <label  class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE ARCHIVO (<2MB)</label>
                      <div class="col-sm-9">
                        <input id="inputfile_u" name="archivo" type="file" accept=".xls, .xlsx, .doc, .docx, application/pdf" onchange="displayPreview(this.files,'#file_error_respuesta',false);" class="form-control">
                        <small class="text-red hidden" id="file_error_respuesta">Peso Maximo admitido 2MB</small>
                      </div>
                    </div>
                    <div class="form-group has-feedback  has-success fila6_u" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">PROVEIDOS</label>
                      <div class="col-sm-9" >
                        <input type="text" name="proveido" id="inputproveido_u" class="form-control" validate="false" toggle=".fila6_u">
                        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="form-group has-feedback  has-success fila7_u" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NUMERO DE HOJAS</label>
                      <div class="col-sm-9" >
                        <input type="number" name="num_hojas" id="inputhoja_u" class="form-control" validate="false" toggle=".fila7_u">
                        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="form-group" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">TIPO DE DOCUMENTO</label>
                      <div class='input-group col-sm-9' style="padding:0 15px 0 15px">
                        <select id="selecttipo_u" name="tipo" class="form-control selectpicker show-tick" data-live-search="true">
                          <?php $ejecute=pg_query("SELECT * FROM tipos WHERE estado=1");
                            while ($datos=pg_fetch_assoc($ejecute)) {
                              ?>
                              <option value="<?php echo $datos['id'] ?>"?><?php echo strtoupper($datos['nombre'])?></option>
                              <?php
                            }
                            ?>
                        </select>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
                      </div>
                    </div>
                    <div class="form-group" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">TIPO DE ADJUNTO</label>
                      <div class='input-group col-sm-9' style="padding:0 15px 0 15px">
                        <select id="selectadjunto_u" name="adjunto" class="form-control selectpicker show-tick" data-live-search="true">
                          <?php $ejecute=pg_query("SELECT * FROM adjuntos WHERE estado=1");
                            while ($datos=pg_fetch_assoc($ejecute)) {
                              ?>
                              <option value="<?php echo $datos['id'] ?>"?><?php echo strtoupper($datos['nombre'])?></option>
                              <?php
                            }
                            ?>
                        </select>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-folder-open"></span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="destino_modal_u" role="tabpanel" class="tab-pane">
                  <div class="box-body">
                     <div class="form-group has-feedback  has-success fila8_u" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">DIAS DE PLAZO</label>
                      <div class="col-sm-9">
                        <input type="number" name="plazo" id="inputplazo_u" class="form-control" validate="false" toggle=".fila8_u">
                        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                      </div>
                     </div>
                     <div class="form-group" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE LAS ACCIONES</label>
                      <div class='input-group col-sm-9 has-feedback has-success' id="rowaccionerror_u" style="padding:0 15px 0 15px" >
                        <select id="selectaccion_u" name="accion[]" class="form-control selectpicker show-tick" multiple data-live-search="true" data-max-options="15" data-selected-text-format="count > 2">
                          <?php $ejecute=pg_query("SELECT * FROM acciones WHERE estado=1");
                            while ($datos=pg_fetch_array($ejecute)) {
                              ?>
                              <option value="<?php echo $datos['id'] ?>"?><?php echo strtoupper($datos['nombre'])?></option>
                              <?php
                            }
                            ?>
                        </select>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                      </div>
                     </div>
                     <div class="alert alert-warning alert-dismissible col-md-12" role="alert" style="background-color:#f3e47f !important">
                      <h5 style="color:#000"><strong>INFORMACION: </strong>Se enviara la hoja de ruta a todos los destinos que sean seleccionados en el siguiente Formulario</h5>
                     </div>
                     <div class="form-group" style="padding:5px">
                      <label class="col-sm-3 control-label" style="color:#313131;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE LOS DESTINOS</label>
                      <div class='input-group col-sm-9' style="padding:0 15px 0 15px" >
                        <select id="selectdestinos_u" class="form-control selectpicker show-tick" multiple data-live-search="true" data-max-options="10" data-selected-text-format="count > 3">
                          <?php $ejecute=pg_query("SELECT * FROM destinos WHERE estado=1");
                            while ($datos=pg_fetch_array($ejecute)) {
                              ?>
                              <option value="<?php echo $datos['id'] ?>"?><?php echo strtoupper($datos['nombre'])?></option>
                              <?php
                            }
                            ?>
                        </select>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                      </div>
                     </div>
                     </div>
                     <div class="row">
                        <table class="table table-hover table-bordered" style="width:95%;margin:0 auto">
                           <thead>
                              <tr style="background:#08c">
                                  <th width="45%" style="border: 1px solid black;text-align:center;color:#fff">DESTINOS</th><th width="45%" style="border: 1px solid black;text-align:center;color:#fff">PROVEIDOS</th><th width="10%" style="border: 1px solid black;text-align:center;color:#fff">OPCIONES</th>
                              </tr>
                           </thead>
                           <tbody id="tabledestino_update">
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
        <button type="button" class="btn btn-success" id="btnupdate_hoja">Modificar Hoja de Ruta</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_update_objeto">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_update_objeto" name="form_update_objeto" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">MODIFICAR INFORMACIÓN</h4>
        </div>
      <div class="box box-primary">
        <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Nombre</label>
                <input name="nombre" id="nombre_objeto_u" placeholder="escriba un nombre" class="form-control" pattern=".{5,}" required title="minimo 5 caracteres">
                <small class="text-red hidden error_update_objeto">El nombre ya esta en uso!</small>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn_update_objeto">Guardar Cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_update_destino">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_update_destino" name="form_update_objeto" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">MODIFICAR INFORMACIÓN</h4>
        </div>
      <div class="box box-primary">
        <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Nombre</label>
                <input name="nombre" id="nombre_destino_u" placeholder="escriba un nombre" class="form-control" pattern=".{5,}" required title="minimo 5 caracteres">
                <small class="text-red hidden error_update_objeto">El nombre ya esta en uso!</small>
              </div>
              <div class="form-group">
                <label>Descripcion</label>
                <input name="descripcion" id="descripcion_destino_u" placeholder="escriba una descripción" class="form-control" pattern=".{5,}" required title="minimo 5 caracteres">
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn_update_destino">Guardar Cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>