<div class="modal fade" id="modal_pedido">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_peticion" name="form_peticion" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header" style="background:#481848">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" style="color:#fff;font-weight:700">REGISTRO DE NUEVA PETICION</h4>
        </div>
        <div class="modal-body" style="background:#fff;">
          <div class="form-group">
            <label class="col-sm-3 control-label">Procedencia</label>
            <div class='input-group col-sm-9' style="padding:0 15px 0 15px" >
              <select name="id_destino" required class="form-control selectpicker show-tick" data-live-search="true">
                <?php $destin=$USER_DATA['id_destino'];$ejecute=pg_query("SELECT * FROM destinos WHERE id<>{$destin}");
                  while ($datos=pg_fetch_array($ejecute)) {?>
                    <option value="<?php echo $datos['id'] ?>"><?php echo strtoupper($datos['nombre'])?></option>
                  <?php } ?>
              </select>
              <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Descripción</label>
            <div class="col-sm-9">
              <input name="descripcion" placeholder="Ejemplo: Solicito la informacion de los salarios del mes de mayo" class="form-control" pattern=".{0}|.{4,400}.*\S+.*" required title="5 caracteres como minimo">
            </div>
          </div>
          <div class="form-group" style="margin:0">
            <label  class="col-sm-3 control-label">Archivo (<2MB) </label>
            <div class="col-sm-9">
              <input name="archivo" type="file" data-max-file-size="2MB" accept="application/pdf" onchange="displayPreview(this.files,'#file_error',true);" class="form-control">
              <small class="text-red hidden" id="file_error">Peso Maximo admitido 2MB</small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btnnueva_peticion">Enviar Petición</button>
        </div>
      </form>
    </div>
  </div>
</div>