<div class="modal fade" id="modal_respuesta_pedido">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_respuesta_peticion" name="form_peticion" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header" style="background:#481848">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" style="color:#fff;font-weight:700">RESPONDER PETICIÓN</h4>
        </div>
        <div class="modal-body" style="background:#fff;">
          <div class="form-group">
            <label class="col-sm-3 control-label">Descripción</label>
            <div class="col-sm-9">
              <input name="descripcion" placeholder="Ejemplo: Adjunto archivo solicitado" class="form-control" pattern=".{0}|.{4,400}.*\S+.*" required title="5 caracteres como minimo">
            </div>
          </div>
          <div class="form-group" style="margin:0">
            <label  class="col-sm-3 control-label">Archivo (<2MB) </label>
            <div class="col-sm-9">
              <input name="archivo" type="file" data-max-file-size="2MB" accept="application/pdf" onchange="displayPreview(this.files,'#file_error_respuesta',false);" class="form-control">
              <small class="text-red hidden" id="file_error_respuesta">Peso Maximo admitido 2MB</small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btnresponder_peticion">Responder Petición</button>
        </div>
      </form>
    </div>
  </div>
</div>